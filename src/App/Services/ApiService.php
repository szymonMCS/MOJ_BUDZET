<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class ApiService
{
  public function __construct(
    private Database $db,
    private string $apiURL,
    private string $promptContent
  ) {}

  public function fetchLimit($categoryId): array|false
  {
    $categoryIdInt = (int) $categoryId;

    $limit = $this->db->query(
      'SELECT `limit` FROM expenses_category_assigned_to_users WHERE id = :id',
      [
        'id' => $categoryIdInt
      ]
    )->fetch();

    return $limit;
  }

  public function fetchMoneyspentSoFar($categoryId, $pickedDate): array
  {
    $categoryIdInt = (int) $categoryId;
    $pickedYear = (int) substr($pickedDate, 0, 4);
    $pickedMonth = (int) substr($pickedDate, 5, 2);

    $spentSum = $this->db->query(
      'SELECT SUM(amount) AS total_spent FROM expenses WHERE expense_category_assigned_to_user_id = :id 
      AND YEAR(date_of_expense) = :year AND MONTH(date_of_expense) = :month',
      [
        'id' => $categoryIdInt,
        'year' => $pickedYear,
        'month' => $pickedMonth
      ]
    )->fetch();

    if ($spentSum && $spentSum['total_spent'] === null) {
      $spentSum['total_spent'] = '0.00';
    } elseif (!$spentSum) {
      return ['total_spent' => '0.00'];
    }

    return $spentSum;
  }

  public function getResponseFromGemini($incomes, $expenses): string
  {
    if (empty($incomes) && empty($expenses)) {
      return "Brak przychodów i wydatków w wybranym okresie, analiza nie jest możliwa.";
    }

    $formattedIncomes = !empty($incomes) ? json_encode($incomes) : '[]';
    $formattedOutcomes = !empty($expenses) ? json_encode($expenses) : '[]';
    $financialData = "Przychody: " . $formattedIncomes . "\n\n" . "Wydatki: " . $formattedOutcomes;
    $initialPrompt = $this->promptContent . "\n\n" . "Oto dane finansowe użytkownika, których dotyczy zapytanie:" . "\n\n" . $financialData;
    $requestBody = json_encode([
      'contents' => [
        [
          'parts' => [
            ['text' => $initialPrompt]
          ]
        ]
      ]
    ]);

    $options = [
      'http' => [
        'header' => "Content-Type: application/json\r\n",
        'method' => 'POST',
        'content' => $requestBody,
        'ignore_errors' => true
      ]
    ];

    $context = stream_context_create($options);
    $response = @file_get_contents($this->apiURL, false, $context);

    if ($response === false) {
      return "Błąd: Nie udało się połączyć z API Gemini.";
    }

    $responseData = json_decode($response, true);

    if (isset($responseData['error'])) {
      return "Błąd API: " . $responseData['error']['message'];
    }

    $apiResponseText = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? "Coś poszło nie tak z połączniem z GEMINI.";

    return trim($apiResponseText);
  }
}
