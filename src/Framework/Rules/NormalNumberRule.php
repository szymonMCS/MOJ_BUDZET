<?php

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class NormalNumberRule implements RuleInterface
{
  public function validate(array $data, string $field, array $params): bool
  {
    return $data[$field] >= 0;
  }

  public function getMessage(array $data, string $field, array $params): string
  {
    return "Wprowadzona liczba nie może być ujemna";
  }
}
