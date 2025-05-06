<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class ApiService
{
  public function __construct(private Database $db) {}

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
}
