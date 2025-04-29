<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;
use DateTime;
use DateTimeZone;

class TransactionService
{
  public function __construct(private Database $db) {}

  public function createIncome(array $formData)
  {
    $date = $formData['date'];
    if (strpos($date, '.') !== false) {
      list($day, $month, $year) = explode('.', $date);
      $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
    }

    $amount = trim($formData['amount']);
    $amount = str_replace(',', '.', $amount);

    $this->db->query(
      'INSERT INTO incomes VALUES (NULL, :user_id, :income_category_assigned_to_user_id, :amount, :date_of_income, :income_comment)',
      [
        'user_id' => $_SESSION['logged_id'],
        'income_category_assigned_to_user_id' => $formData['category'],
        'amount' => $amount,
        'date_of_income' => $date,
        'income_comment' => $formData['comment']
      ]
    );

    $_SESSION['income_added'] = true;
  }

  public function createOutcome(array $formData)
  {
    $date = $formData['date'];
    if (strpos($date, '.') !== false) {
      list($day, $month, $year) = explode('.', $date);
      $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
    }

    $amount = trim($formData['amount']);
    $amount = str_replace(',', '.', $amount);

    $this->db->query(
      'INSERT INTO expenses VALUES (NULL, :user_id, :expense_category_assigned_to_user_id, :payment_method_assigned_to_user_id, :amount, :date_of_expense, :expense_comment)',
      [
        'user_id' => $_SESSION['logged_id'],
        'expense_category_assigned_to_user_id' => $formData['category'],
        'payment_method_assigned_to_user_id' => $formData['method'],
        'amount' => $amount,
        'date_of_expense' => $date,
        'expense_comment' => $formData['comment']
      ]
    );

    $_SESSION['expense_added'] = true;
  }

  private function getSubmittedDate()
  {
    $dateToTransfer = $_GET['s'] ?? '';
    $dateSubmitted = [];

    if (strpos($dateToTransfer, ' - ') !== false) {
      list($date2, $date1) = explode(' - ', $dateToTransfer);
      $dateSubmitted[0] = DateTime::createFromFormat('d.m.Y', $date1)->format('Y-m-d');
      $dateSubmitted[1] = DateTime::createFromFormat('d.m.Y', $date2)->format('Y-m-d');
    } else {
      $dateSubmitted[0] = $_SESSION['date1'];
      $dateSubmitted[1] = $_SESSION['date2'];
    }
    return $dateSubmitted;
  }

  public function getUserIncomes()
  {
    $dateSubmitted = $this->getSubmittedDate();

    $incomes = $this->db->query(
      'SELECT
        incomes.date_of_income,
        incomes_category_assigned_to_users.name,
        incomes.amount,
        incomes.income_comment
      FROM incomes
        INNER JOIN users ON users.id = incomes.user_id
        INNER JOIN incomes_category_assigned_to_users ON incomes_category_assigned_to_users.id = incomes.     income_category_assigned_to_user_id
      WHERE incomes.user_id = :user_id AND
        incomes.date_of_income BETWEEN :date_begin AND :date_end',
      [
        'user_id' => $_SESSION['logged_id'],
        'date_begin' => $dateSubmitted[1],
        'date_end' => $dateSubmitted[0]
      ]
    )->fetchAll();

    return $incomes;
  }

  public function getUserIncomesSum()
  {
    $dateSubmitted = $this->getSubmittedDate();

    $incomesums = $this->db->query(
      'SELECT
        incomes_category_assigned_to_users.name,
      SUM(incomes.amount) AS sum
      FROM incomes
        INNER JOIN users ON users.id = incomes.user_id
        INNER JOIN incomes_category_assigned_to_users ON
                 incomes_category_assigned_to_users.user_id = users.id AND
                 incomes_category_assigned_to_users.id = incomes.income_category_assigned_to_user_id
      WHERE incomes.user_id = :user_id AND
        incomes.date_of_income BETWEEN :date_begin AND :date_end
      GROUP BY incomes.income_category_assigned_to_user_id
      ORDER BY sum DESC',
      [
        'user_id' => $_SESSION['logged_id'],
        'date_begin' => $dateSubmitted[1],
        'date_end' => $dateSubmitted[0]
      ]
    )->fetchAll();

    return $incomesums;
  }

  public function getUserOutcomes()
  {
    $dateSubmitted = $this->getSubmittedDate();

    $expenses = $this->db->query(
      'SELECT
        expenses.date_of_expense,
        payment_methods_assigned_to_users.name AS payment,
        expenses_category_assigned_to_users.name AS category,
        expenses.amount,
        expenses.expense_comment
      FROM expenses
        INNER JOIN users ON users.id = expenses.user_id
        INNER JOIN expenses_category_assigned_to_users ON expenses_category_assigned_to_users.id = expenses.    expense_category_assigned_to_user_id
        INNER JOIN payment_methods_assigned_to_users ON payment_methods_assigned_to_users.id = expenses.payment_method_assigned_to_user_id
        WHERE expenses.user_id = :user_id AND
        expenses.date_of_expense BETWEEN :date_begin AND :date_end',
      [
        'user_id' => $_SESSION['logged_id'],
        'date_begin' => $dateSubmitted[1],
        'date_end' => $dateSubmitted[0]
      ]
    )->fetchAll();

    return $expenses;
  }

  public function getUserOutcomesSum()
  {
    $dateSubmitted = $this->getSubmittedDate();

    $expensesums = $this->db->query(
      'SELECT
      expenses_category_assigned_to_users.name,
      SUM(expenses.amount) AS sum
      FROM expenses
        INNER JOIN users ON users.id = expenses.user_id
        INNER JOIN expenses_category_assigned_to_users ON
          expenses_category_assigned_to_users.user_id = users.id AND
          expenses_category_assigned_to_users.id = expenses.expense_category_assigned_to_user_id
      WHERE expenses.user_id = :user_id AND 
        expenses.date_of_expense BETWEEN :date_begin AND :date_end
      GROUP BY expenses.expense_category_assigned_to_user_id
      ORDER BY sum DESC',
      [
        'user_id' => $_SESSION['logged_id'],
        'date_begin' => $dateSubmitted[1],
        'date_end' => $dateSubmitted[0]
      ]
    )->fetchAll();

    return $expensesums;
  }

  public function getUserIncomesSummary()
  {
    $dateSubmitted = $this->getSubmittedDate();

    $incomessummary = $this->db->query(
      'SELECT
      SUM(incomes.amount) AS total_sum
      FROM incomes
      WHERE incomes.user_id = :user_id AND
      incomes.date_of_income BETWEEN :date_begin AND :date_end
      ORDER BY incomes.id',
      [
        'user_id' => $_SESSION['logged_id'],
        'date_begin' => $dateSubmitted[1],
        'date_end' => $dateSubmitted[0]
      ]
    )->fetch();

    $sumOfIncomes = $incomessummary['total_sum'];

    return $sumOfIncomes;
  }

  public function getUserOutcomesSummary()
  {
    $dateSubmitted = $this->getSubmittedDate();

    $expensessummary = $this->db->query(
      'SELECT
      SUM(expenses.amount) AS total_sum
      FROM expenses
      WHERE expenses.user_id = :user_id AND
      expenses.date_of_expense BETWEEN :date_begin AND :date_end
      ORDER BY expenses.id',
      [
        'user_id' => $_SESSION['logged_id'],
        'date_begin' => $dateSubmitted[1],
        'date_end' => $dateSubmitted[0]
      ]
    )->fetch();

    $sumOfExpenses = $expensessummary['total_sum'];

    return $sumOfExpenses;
  }

  public function addCategory(array $formData)
  {
    if ($formData['newCategoryType'] === 'przychody') {

      $this->db->query(
        'INSERT INTO incomes_category_assigned_to_users VALUES (NULL, :user_id, :name)',
        [
          'user_id' => $_SESSION['logged_id'],
          'name' => $formData['newCategoryName']
        ]
      );
    } else if ($formData['newCategoryType'] === 'wydatki') {
      $this->db->query(
        'INSERT INTO expenses_category_assigned_to_users VALUES (NULL, :user_id, :name)',
        [
          'user_id' => $_SESSION['logged_id'],
          'name' => $formData['newCategoryName']
        ]
      );
    }
    $_SESSION['category_added'] = true;
  }

  public function removeCategory(array $formData)
  {
    $selectedCategoryId = (int) $formData['removeCategoryName'];

    if ($formData['removeCategoryType'] === 'przychody') {

      $this->db->query(
        'DELETE FROM incomes_category_assigned_to_users WHERE id = :id',
        [
          'id' => $selectedCategoryId
        ]
      );
    } else if ($formData['removeCategoryType'] === 'wydatki') {

      $this->db->query(
        'DELETE FROM expenses_category_assigned_to_users WHERE id = :id',
        [
          'id' => $selectedCategoryId
        ]
      );
    }
    $_SESSION['category_removed'] = true;
  }

  public function editCategory(array $formData)
  {
    if ($formData['editCategoryType'] === 'przychody') {

      $editedIncomeCategoryId = $this->db->query(
        'SELECT id FROM incomes_category_assigned_to_users WHERE
        user_id = :user_id AND name = :name',
        [
          'user_id' => $_SESSION['logged_id'],
          'name' => $formData['editCategoryName']
        ]
      )->fetch();

      $this->db->query(
        'UPDATE incomes_category_assigned_to_users SET name = :name
        WHERE id = :id',
        [
          'id' => $editedIncomeCategoryId,
          'name' => $formData['changedCategoryName']
        ]
      );
    } else if ($formData['editCategoryType'] === 'wydatki') {

      $editedOutcomeCategory = $this->db->query(
        'SELECT * FROM expenses_category_assigned_to_users WHERE
        user_id = :user_id AND name = :name',
        [
          'user_id' => $_SESSION['logged_id'],
          'name' => $formData['editCategoryName']
        ]
      )->fetch();

      $categoryId = $editedOutcomeCategory['id'];
      $categoryLimit = $editedOutcomeCategory['limit'];

      if ($categoryLimit === null) {
        $_SESSION['categoryLimitSet'] = false;

        $this->db->query(
          'UPDATE expenses_category_assigned_to_users SET name = :name
          WHERE id = :id',
          [
            'name' => $formData['changedCategoryName'],
            'id' => $categoryId
          ]
        );
      } else {
        $_SESSION['categoryLimitSet'] = true; //jak zaznaczymy booxa a było null też

        $this->db->query(
          'UPDATE expenses_category_assigned_to_users SET name = :name,
          `limit` = :categoryLimit WHERE id = :id',
          [
            'name' => $formData['changedCategoryName'],
            'limit' => $formData['newCategoryLimit'],
            'id' => $categoryId
          ]
        );
      }
    }
    $_SESSION['category_edited'] = true;
  }
}
