<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;
use InvalidArgumentException;

class BetweenPasswordRule implements RuleInterface
{

  public function validate(array $data, string $field, array $params): bool
  {
    if (empty($params[0]) || empty($params[1])) {
      throw new InvalidArgumentException("brzegowe parametry długości ciągu nie wyspecyfikowane");
    }

    $minLength = (int) $params[0];
    $maxLength = (int) $params[1];
    $passwordLength = strlen($data[$field]);

    return !(($passwordLength < $minLength) || ($passwordLength > $maxLength));
  }

  public function getMessage(array $data, string $field, array $params): string
  {
    return "Hasło musi posiadać od 8 do 20 znaków.";
  }
}
