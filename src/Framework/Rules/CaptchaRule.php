<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class CaptchaRule implements RuleInterface
{
  public function validate(array $data, string $field, array $params): bool
  {
    $secret = $params[0];
    $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
    $response = json_decode($check);

    if ($response->success == false) {
      return false;
    } else {
      return true;
    }
  }

  public function getMessage(array $data, string $field, array $params): string
  {
    return "Potwirdz że nie jesteś botem.";
  }
}
