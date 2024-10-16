<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, UserService};

class SettingsController
{
  public function __construct(
    private TemplateEngine $view,
    private ValidatorService $validatorService,
    private UserService $userService
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
    }
    if (isset($_POST['submitRemoveCategoryForm'])) {
    }
    redirectTo('/settings');
  }
}
