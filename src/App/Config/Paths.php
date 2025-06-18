<?php

declare(strict_types=1);

namespace App\Config;

class Paths
{
  public const VIEW = __DIR__ . "/../views";
  public const SOURCE = __DIR__ . "/../../";
  public const ROOT = __DIR__ . "/../../../";
  public const FINANCIAL_ADVISOR_PROMPT = self::SOURCE . 'App/Resources/prompts/financialAdvisor.txt';
}
