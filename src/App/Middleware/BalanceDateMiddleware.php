<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Database;
use Framework\Contracts\MiddlewareInterface;
use DateTime;

class BalanceDateMiddleware implements MiddlewareInterface
{
  public function __construct(private Database $db) {}
  public function process(callable $next)
  {
    if (!isset($_SESSION['date_range'])) {
      $today = date('d.m.Y');
      $_SESSION['date_range'] = "$today - $today";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['dateValue'])) {
      $_SESSION['date_range'] = $_POST['dateValue'];
    }

    list($date2, $date1) = explode(' - ', $_SESSION['date_range']);

    $_SESSION['date1'] = DateTime::createFromFormat('d.m.Y', $date1)->format('Y-m-d');
    $_SESSION['date2'] = DateTime::createFromFormat('d.m.Y', $date2)->format('Y-m-d');

    $next();
  }
}
