<?php

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class NumericRule implements RuleInterface
{
  public function validate(array $data, string $field, array $params): bool
  {
    if (strpos($data[$field], '..') !== false) {
      return false;
    }

    if (strpos($data[$field], ',,') !== false) {
      return false;
    }

    $value = str_replace([',', '.'], '', $data[$field]);

    return is_numeric($value);
  }

  public function getMessage(array $data, string $field, array $params): string
  {
    return "Kwota musi zawierać same cyfry";
  }
}
