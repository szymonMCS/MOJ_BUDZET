<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";

use Framework\{TemplateEngine, Database, Container};
use App\Config\Paths;
use App\Services\{
  ValidatorService,
  UserService,
  TransactionService,
  ApiService
};

return [
  TemplateEngine::class => fn() => new TemplateEngine(Paths::VIEW),
  Database::class => fn() => new Database($_ENV['DB_DRIVER'], [
    'host' => $_ENV['DB_HOST'],
    'port' => $_ENV['DB_PORT'],
    'dbname' => $_ENV['DB_NAME']
  ], $_ENV['DB_USER'], $_ENV['DB_PASS']),
  ValidatorService::class => function (Container $container) {
    $db = $container->get(Database::class);
    return new ValidatorService($db);
  },
  UserService::class => function (Container $container) {
    $db = $container->get(Database::class);
    return new UserService($db);
  },
  TransactionService::class => function (Container $container) {
    $db = $container->get(Database::class);
    return new TransactionService($db);
  },
  ApiService::class => function (Container $container) {
    $db = $container->get(Database::class);
    $apiURL = $_ENV['GEMINI_API_URL'] ?? null;
    $promptFilePath = Paths::FINANCIAL_ADVISOR_PROMPT;
    $promptContent = file_get_contents($promptFilePath);
    return new ApiService($db, $apiURL, $promptContent);
  }
];
