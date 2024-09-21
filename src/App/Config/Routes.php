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
use App\Middleware\{AuthRequiredMiddleware, GuestOnlyMiddleware};

function registerRoutes(App $app)
{
  $app->get('/', [AboutController::class, 'about']);
  $app->get('/home', [HomeController::class, 'home'])->add(AuthRequiredMiddleware::class);
  $app->get('/register', [AuthController::class, 'registerView'])->add(GuestOnlyMiddleware::class);
  $app->post('/register', [AuthController::class, 'register'])->add(GuestOnlyMiddleware::class);
  $app->get('/login', [AuthController::class, 'loginView'])->add(GuestOnlyMiddleware::class);
  $app->post('/login', [AuthController::class, 'login'])->add(GuestOnlyMiddleware::class);
  $app->get('/income', [IncomeController::class, 'income'])->add(AuthRequiredMiddleware::class);
  $app->get('/outcome', [OutcomeController::class, 'outcome'])->add(AuthRequiredMiddleware::class);
  $app->get('/balance', [BalanceController::class, 'balance'])->add(AuthRequiredMiddleware::class);
  $app->get('/logout', [AuthController::class, 'logout'])->add(AuthRequiredMiddleware::class);
}
