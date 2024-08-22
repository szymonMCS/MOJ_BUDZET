<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class IncomeController
{
  private TemplateEngine $view;

  public function __construct()
  {
    $this->view = new TemplateEngine(Paths::VIEW);
  }

  public function income()
  {
    echo $this->view->render("incomes.php", [
      'title' => 'Income page'
    ]);
  }
}
