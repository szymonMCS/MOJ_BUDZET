<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, TransactionService};

class TransactionController
{
  public function __construct(
    private TemplateEngine $view,
    private ValidatorService $validatorService,
    private TransactionService $transactionService
  ) {}

  public function incomeView()
  {
    echo $this->view->render("incomes.php");
  }

  public function outcomeView()
  {
    echo $this->view->render("outcomes.php");
  }

  public function income()
  {
    $this->validatorService->validateIncome($_POST);

    $this->transactionService->createIncome($_POST);

    redirectTo('/income');
  }

  public function outcome()
  {
    $this->validatorService->validateOutcome($_POST);

    $this->transactionService->createOutcome($_POST);

    redirectTo('/outcome');
  }
}
