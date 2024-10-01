<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class IncomeController
{
  public function __construct(private TemplateEngine $view) {}

  public function incomeView()
  {
    echo $this->view->render("incomes.php");
  }
}
