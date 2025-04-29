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
  NumericRule,
  CorrectPassRule,
  BetweenCategoryRule
};
use Framework\Database;

class ValidatorService
{
  private Validator $validator;

  public function __construct(private Database $db)
  {
    $this->validator = new Validator();

    $this->validator->add('required', new RequiredRule());
    $this->validator->add('email', new EmailRule());
    $this->validator->add('btwname', new BetweenNameRule());
    $this->validator->add('btwpassword', new BetweenPasswordRule());
    $this->validator->add('name', new NameRule());
    $this->validator->add('match', new MatchRule());
    //$this->validator->add('bot', new CaptchaRule());
    $this->validator->add('in', new InRule());
    $this->validator->add('lengthMax', new LengthMaxRule());
    $this->validator->add('isNumeric', new NumericRule());
    $this->validator->add('passok', new CorrectPassRule());
    $this->validator->add('btwcategory', new BetweenCategoryRule());
  }

  public function validateRegister(array $formData)
  {
    $this->validator->validate($formData, [
      'username' => ['btwname:3,20', 'name'],
      'email' => ['required', 'email'],
      'password' => ['required', 'btwpassword:8,20'],
      'confirmPassword' => ['required', 'match:password'],
      'tos' => ['required'],
      //'bot' => ['bot:6Lc3uQcqAAAAANhhWprLaN6JeI9wwThVgKGh-UmK']
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

  public function validateProfileEdit(array $formData)
  {
    $this->validator->validate($formData, [
      'username' => ['required', 'name', 'btwname:3,20']
    ]);
  }

  public function validatePasswordChange(array $formData)
  {
    $user = $this->db->query(
      'SELECT password FROM users WHERE id = :id',
      [
        'id' => $_SESSION['logged_id']
      ]
    )->fetch();

    $passwordCurrent = $user['password'];


    $this->validator->validate($formData, [
      'passOld' => ['required', 'passok:' . $passwordCurrent . ''],
      'passNew1' => ['required', 'btwpassword:8,20'],
      'passNew2' => ['required', 'match:passNew1']
    ]);
  }

  public function validateAddCategory(array $formData)
  {
    $this->validator->validate($formData, [
      'newCategoryType' => ['required', 'in'],
      'newCategoryName' => ['required', 'btwcategory:3,20']
    ]);
  }

  public function validateRemoveCategory(array $formData)
  {
    $this->validator->validate($formData, [
      'removeCategoryType' => ['required', 'in'],
      'removeCategoryName' => ['required', 'in']
    ]);
  }

  public function validateEditCategory(array $formData)
  {
    $this->validator->validate($formData, [
      'changedCategoryName' => ['required', 'btwcategory:3,20']
    ]);
  }
}
