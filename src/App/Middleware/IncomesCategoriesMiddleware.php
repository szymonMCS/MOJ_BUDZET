<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Database;
use Framework\Contracts\MiddlewareInterface;

class IncomesCategoriesMiddleware implements MiddlewareInterface
{
  public function __construct(private Database $db) {}
  public function process(callable $next)
  {
    $categories = $this->db->query(
      'SELECT id, name FROM incomes_category_assigned_to_users WHERE user_id = :user_id',
      [
        'user_id' => $_SESSION['logged_id']
      ]
    )->fetchAll();

    $_SESSION['incomesCategories'] = $categories;

    $next();
  }
}
