<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\TransactionService;

class BalanceController
{
  public function __construct(
    private TemplateEngine $view,
    private TransactionService $transactionService
  ) {}

  public function balance()
  {
    $incomes = $this->transactionService->getUserIncomes();
    $incomesums = $this->transactionService->getUserIncomesSum();
    $expenses = $this->transactionService->getUserOutcomes();
    $expensesums = $this->transactionService->getUserOutcomesSum();
    $sumOfIncomes = $this->transactionService->getUserIncomesSummary();
    $sumOfExpenses = $this->transactionService->getUserOutcomesSummary();
    echo $this->view->render("balance.php", [
      'incomes' => $incomes,
      'incomesums' => $incomesums,
      'expenses' => $expenses,
      'expensesums' => $expensesums,
      'sumOfIncomes' => $sumOfIncomes,
      'sumOfExpenses' => $sumOfExpenses
    ]);
  }
}
