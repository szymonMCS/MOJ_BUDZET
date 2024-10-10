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

  //public function profileEdit()
  //{
  //$this->validatorService->validateProfileEdit($_POST);

  //$this->userService->updateProfile($_POST);

  //  redirectTo('/settings');
  //}
}
