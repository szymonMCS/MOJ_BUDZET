<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class OutcomeController
{
  public function __construct(private TemplateEngine $view) {}

  public function outcomeView()
  {
    echo $this->view->render("outcomes.php");
  }
}
