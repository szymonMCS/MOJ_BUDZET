<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{
  AboutController,
  HomeController,
  BalanceController,
  IncomeController,
  OutcomeController,
  LoginController,
  RegisterController
};

function registerRoutes(App $app)
{
  $app->get('/', [AboutController::class, 'about']);
  $app->get('/home', [HomeController::class, 'home']);
  $app->get('/register', [RegisterController::class, 'register']);
  $app->get('/login', [LoginController::class, 'login']);
  $app->get('/income', [IncomeController::class, 'income']);
  $app->get('/outcome', [OutcomeController::class, 'outcome']);
  $app->get('/balance', [BalanceController::class, 'balance']);
}
