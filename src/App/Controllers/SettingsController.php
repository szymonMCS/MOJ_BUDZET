<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, UserService, TransactionService};

class SettingsController
{
  public function __construct(
    private TemplateEngine $view,
    private ValidatorService $validatorService,
    private UserService $userService,
    private TransactionService $transactionService
  ) {}

  public function settingsView()
  {
    echo $this->view->render("settings.php");
  }

  public function profileEdit()
  {
    if (isset($_POST['submitChangeProfileForm'])) {
      $this->validatorService->validateProfileEdit($_POST);
      $this->userService->updateProfile($_POST);
    }
    if (isset($_POST['submitDeleteAccountForm'])) {
      $this->userService->deleteProfile();
      $this->userService->logout();
      redirectTo('/');
    }
    if (isset($_POST['submitChangePasswordForm'])) {
      $this->validatorService->validatePasswordChange($_POST);
      $this->userService->updatePassword($_POST);
    }
    if (isset($_POST['submitAddCategoryForm'])) {
      $this->validatorService->validateAddCategory($_POST);
      $this->transactionService->addCategory($_POST);
    }
    if (isset($_POST['submitRemoveCategoryForm'])) {
      $this->validatorService->validateRemoveCategory($_POST);
      $this->transactionService->removeCategory($_POST);
    }
    redirectTo('/settings');
  }
}
