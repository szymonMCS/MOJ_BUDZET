<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class BalanceController
{
  private TemplateEngine $view;

  public function __construct()
  {
    $this->view = new TemplateEngine(Paths::VIEW);
  }

  public function balance()
  {
    echo $this->view->render("balance.php", [
      'title' => 'Balance page'
    ]);
  }
}
