<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;
use Framework\Database;

class CorrectPassRule implements RuleInterface
{
  public function __construct() {}

  public function validate(array $data, string $field, array $params): bool
  {
    $password = $data[$field];
    $passwordCurrent = $params[0];

    $passwordsMatch = password_verify(
      $password,
      $passwordCurrent ?? ''
    );

    if (!$passwordsMatch) {
      return false;
    } else {
      return true;
    }
  }

  public function getMessage(array $data, string $field, array $params): string
  {
    return "Niepoprawne hasło.";
  }
}
