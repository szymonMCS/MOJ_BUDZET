<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{
  AboutController,
  ApiController,
  HomeController,
  BalanceController,
  TransactionController,
  AuthController,
  ErrorController,
  SettingsController
};
use App\Middleware\{
  AuthRequiredMiddleware,
  GuestOnlyMiddleware,
  IncomesCategoriesMiddleware,
  OutcomesCategoriesMiddleware,
  BalanceDateMiddleware
};

function registerRoutes(App $app)
{
  $app->get('/', [AboutController::class, 'about'])->add([GuestOnlyMiddleware::class]);
  $app->get('/home', [HomeController::class, 'home'])->add([IncomesCategoriesMiddleware::class, OutcomesCategoriesMiddleware::class, AuthRequiredMiddleware::class]);
  $app->get('/register', [AuthController::class, 'registerView'])->add([GuestOnlyMiddleware::class]);
  $app->post('/register', [AuthController::class, 'register'])->add([GuestOnlyMiddleware::class]);
  $app->get('/login', [AuthController::class, 'loginView'])->add([GuestOnlyMiddleware::class]);
  $app->post('/login', [AuthController::class, 'login'])->add([GuestOnlyMiddleware::class]);
  $app->get('/income', [TransactionController::class, 'incomeView'])->add([IncomesCategoriesMiddleware::class, AuthRequiredMiddleware::class]);
  $app->post('/income', [TransactionController::class, 'income'])->add([IncomesCategoriesMiddleware::class, AuthRequiredMiddleware::class]);
  $app->get('/outcome', [TransactionController::class, 'outcomeView'])->add([OutcomesCategoriesMiddleware::class, AuthRequiredMiddleware::class]);
  $app->post('/outcome', [TransactionController::class, 'outcome'])->add([OutcomesCategoriesMiddleware::class, AuthRequiredMiddleware::class]);
  $app->get('/balance', [BalanceController::class, 'balance'])->add([BalanceDateMiddleware::class, AuthRequiredMiddleware::class]);
  $app->post('/balance', [BalanceController::class, 'balance'])->add([BalanceDateMiddleware::class, AuthRequiredMiddleware::class]);
  $app->get('/settings', [SettingsController::class, 'settingsView'])->add([IncomesCategoriesMiddleware::class, OutcomesCategoriesMiddleware::class, AuthRequiredMiddleware::class]);
  $app->post('/settings', [SettingsController::class, 'profileEdit'])->add([IncomesCategoriesMiddleware::class, OutcomesCategoriesMiddleware::class, AuthRequiredMiddleware::class]);
  $app->get('/logout', [AuthController::class, 'logout'])->add([AuthRequiredMiddleware::class]);
  $app->get('/api/limit/(?<category>\d+)/date/(?<date>\d{4}-\d{2}-\d{2})', [ApiController::class, 'fetchLimitDetails'])->add([AuthRequiredMiddleware::class]);

  $app->setErrorHandler([ErrorController::class, 'notFound']);
}
