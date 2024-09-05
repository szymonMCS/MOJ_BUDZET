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
  AuthController
};

function registerRoutes(App $app)
{
  $app->get('/', [AboutController::class, 'about']);
  $app->get('/home', [HomeController::class, 'home']);
  $app->get('/register', [AuthController::class, 'registerView']);
  $app->post('/register', [AuthController::class, 'register']);
  $app->get('/login', [AuthController::class, 'loginView']);
  $app->get('/income', [IncomeController::class, 'income']);
  $app->get('/outcome', [OutcomeController::class, 'outcome']);
  $app->get('/balance', [BalanceController::class, 'balance']);
}
