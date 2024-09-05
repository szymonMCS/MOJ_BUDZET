<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class NameRule implements RuleInterface
{

  public function validate(array $data, string $field, array $params): bool
  {
    return (ctype_alpha($data[$field]));
  }

  public function getMessage(array $data, string $field, array $params): string
  {
    return "Imie może skladać się tylko z liter (bez polskich znaków).";
  }
}
