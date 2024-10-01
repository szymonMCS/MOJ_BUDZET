<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Validator;
use Framework\Rules\{
  RequiredRule,
  EmailRule,
  BetweenNameRule,
  BetweenPasswordRule,
  NameRule,
  MatchRule,
  CaptchaRule,
  InRule,
  LengthMaxRule,
  NumericRule
};

class ValidatorService
{
  private Validator $validator;

  public function __construct()
  {
    $this->validator = new Validator();

    $this->validator->add('required', new RequiredRule());
    $this->validator->add('email', new EmailRule());
    $this->validator->add('btwname', new BetweenNameRule());
    $this->validator->add('btwpassword', new BetweenPasswordRule());
    $this->validator->add('name', new NameRule());
    $this->validator->add('match', new MatchRule());
    $this->validator->add('bot', new CaptchaRule());
    $this->validator->add('in', new InRule());
    $this->validator->add('lengthMax', new LengthMaxRule());
    $this->validator->add('isNumeric', new NumericRule());
  }

  public function validateRegister(array $formData)
  {
    $this->validator->validate($formData, [
      'username' => ['btwname:3,20', 'name'],
      'email' => ['required', 'email'],
      'password' => ['required', 'btwpassword:8,20'],
      'confirmPassword' => ['required', 'match:password'],
      'tos' => ['required'],
      'bot' => ['bot:6LefBT8qAAAAADM9wGTLpdOV4BuraLHUCkMAvqjZ']
    ]);
  }

  public function validateLogin(array $formData)
  {
    $this->validator->validate($formData, [
      'email' => ['required', 'email'],
      'password' => ['required', 'btwpassword:8,20']
    ]);
  }

  public function validateIncome(array $formData)
  {
    $this->validator->validate($formData, [
      'amount' => ['required', 'isNumeric'],
      'date' => ['required'],
      'category' => ['required', 'in'],
      'comment' => ['lengthMax:50']
    ]);
  }

  public function validateOutcome(array $formData)
  {
    $this->validator->validate($formData, [
      'amount' => ['required', 'isNumeric'],
      'date' => ['required'],
      'method' => ['required', 'in'],
      'category' => ['required', 'in'],
      'comment' => ['lengthMax:50']
    ]);
  }
}
