<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class LoginController
{
  public function __construct(private TemplateEngine $view) {}

  public function login()
  {
    echo $this->view->render("login.php", [
      'title' => 'login'
    ]);
  }
}
