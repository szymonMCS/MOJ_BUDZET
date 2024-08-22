<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class OutcomeController
{
  private TemplateEngine $view;

  public function __construct()
  {
    $this->view = new TemplateEngine(Paths::VIEW);
  }

  public function outcome()
  {
    echo $this->view->render("outcomes.php", [
      'title' => 'Outcomes page'
    ]);
  }
}
