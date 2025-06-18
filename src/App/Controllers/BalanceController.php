<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\TransactionService;
use App\Services\ApiService;

class BalanceController
{
  public function __construct(
    private TemplateEngine $view,
    private TransactionService $transactionService,
    private ApiService $apiService
  ) {}

  public function balance()
  {
    $incomes = $this->transactionService->getUserIncomes();
    $incomesums = $this->transactionService->getUserIncomesSum();
    $expenses = $this->transactionService->getUserOutcomes();
    $expensesums = $this->transactionService->getUserOutcomesSum();
    $sumOfIncomes = $this->transactionService->getUserIncomesSummary();
    $sumOfExpenses = $this->transactionService->getUserOutcomesSummary();
    $geminiResponse = $this->apiService->getResponseFromGemini($incomes, $expenses);
    echo $this->view->render("balance.php", [
      'incomes' => $incomes,
      'incomesums' => $incomesums,
      'expenses' => $expenses,
      'expensesums' => $expensesums,
      'sumOfIncomes' => $sumOfIncomes,
      'sumOfExpenses' => $sumOfExpenses,
      'geminiResponse' => $geminiResponse
    ]);
  }
}
