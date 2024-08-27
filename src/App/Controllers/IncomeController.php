<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class IncomeController
{
  public function __construct(private TemplateEngine $view) {}

  public function income()
  {
    echo $this->view->render("incomes.php", [
      'title' => 'Income page'
    ]);
  }
}
