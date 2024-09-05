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
  CaptchaRule
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
  }

  public function validateRegister(array $formData)
  {
    $this->validator->validate($formData, [
      'username' => ['btwname:3,20', 'name'],
      'email' => ['required', 'email'],
      'password' => ['required', 'btwpassword:8,20'],
      'confirmPassword' => ['required', 'match:password'],
      'tos' => ['required'],
      'bot' => ['bot:6LcavzYqAAAAAA_rQh195YfD2cAw5LLHCeXaHqQo']
    ]);
  }
}
