<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\ApiService;

class ApiController
{
  public function __construct(
    private ApiService $apiService
  ) {}

  public function fetchLimitDetails($category, $date)
  {
    try {
      $limitData = $this->apiService->fetchLimit($category);
      $spentSum = $this->apiService->fetchMoneyspentSoFar($category, $date);
      $details = [];

      if ($limitData !== false && isset($limitData['limit'])) {
        $details['limit'] = $limitData['limit'];
        $details['sum'] = $spentSum['total_spent'];
      } else {
        $details['limit'] = null;
      }

      http_response_code(200);
      header('Content-Type: application/json');
      echo json_encode($details);
    } catch (\Throwable $e) {
      http_response_code(500);
      header('Content-Type: application/json');
      error_log("API Error: " . $e->getMessage());
      echo json_encode(['error' => 'An unexpected server error occurred.']);
    }
  }
}
