<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;

class UserService
{
  public function __construct(private Database $db) {}

  public function isEmailTaken(string $email)
  {
    $emailCount = $this->db->query(
      "SELECT COUNT(*) FROM users WHERE email = :email",
      [
        'email' => $email
      ]
    )->count();

    if ($emailCount > 0) {
      throw new ValidationException(['email' => ['Email już jest używany']]);
    }
  }

  public function create(array $formData)
  {
    $password_hash = password_hash($formData['password'], PASSWORD_DEFAULT);


    $this->db->query(
      'INSERT INTO users VALUES (NULL, :username, :password, :email)',
      [
        'username' => $formData['username'],
        'password' => $password_hash,
        'email' => $formData['email']
      ]
    );

    $user = $this->db->query(
      'SELECT id FROM users WHERE email= :email',
      [
        'email' => $formData['email']
      ]
    )->fetch();

    $user_id = $user['id'];

    $this->db->query(
      'INSERT INTO incomes_category_assigned_to_users (user_id , name) 
        SELECT :id, name
        FROM incomes_category_default',
      [
        'id' => $user_id
      ]
    );

    $this->db->query(
      'INSERT INTO expenses_category_assigned_to_users (user_id , name) 
        SELECT :id, name
        FROM expenses_category_default',
      [
        'id' => $user_id
      ]
    );

    $this->db->query(
      'INSERT INTO payment_methods_assigned_to_users (user_id , name) 
        SELECT :id, name
        FROM payment_methods_default',
      [
        'id' => $user_id
      ]
    );

    $_SESSION['success_registration'] = true;
  }

  public function login(array $formData)
  {
    $password = $formData['password'];

    $user = $this->db->query(
      'SELECT id, username, password FROM users WHERE email= :email',
      [
        'email' => $formData['email']
      ]

    )->fetch();

    $passwordsMatch = password_verify(
      $password,
      $user['password'] ?? ''
    );

    if (!$user || !$passwordsMatch) {
      throw new ValidationException(['password' => ['Nieprawidłowe dane']]);
    }

    session_regenerate_id();

    $_SESSION['logged_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $formData['email'];
    $_SESSION['choosenCategories'] = [];
  }

  public function logout()
  {
    session_destroy();

    $params = session_get_cookie_params();
    setcookie(
      'PHPSESSID',
      '',
      time() - 3600,
      $params['path'],
      $params['domain'],
      $params['secure'],
      $params['httponly']
    );
  }

  public function updateProfile(array $formData)
  {
    $this->db->query(
      'UPDATE users SET username = :username WHERE id = :id',
      [
        'username' => $formData['username'],
        'id' => $_SESSION['logged_id']
      ]
    );

    $_SESSION['username'] = $formData['username'];
    $_SESSION['success_profileUpdate'] = true;
  }

  public function deleteProfile()
  {
    $this->db->query(
      'DELETE FROM expenses WHERE user_id = :id',
      [
        'id' => $_SESSION['logged_id']
      ]
    );
    $this->db->query(
      'DELETE FROM expenses_category_assigned_to_users WHERE user_id = :id',
      [
        'id' => $_SESSION['logged_id']
      ]
    );
    $this->db->query(
      'DELETE FROM incomes WHERE user_id = :id',
      [
        'id' => $_SESSION['logged_id']
      ]
    );
    $this->db->query(
      'DELETE FROM incomes_category_assigned_to_users WHERE user_id = :id',
      [
        'id' => $_SESSION['logged_id']
      ]
    );
    $this->db->query(
      'DELETE FROM payment_methods_assigned_to_users WHERE user_id = :id',
      [
        'id' => $_SESSION['logged_id']
      ]
    );
    $this->db->query(
      'DELETE FROM users WHERE id = :id',
      [
        'id' => $_SESSION['logged_id']
      ]
    );
  }

  public function updatePassword(array $formData)
  {
    $password_hash = password_hash($formData['passNew1'], PASSWORD_DEFAULT);

    $this->db->query(
      'UPDATE users SET password = :password WHERE id = :id',
      [
        'password' => $password_hash,
        'id' => $_SESSION['logged_id']
      ]
    );

    $_SESSION['success_passwordUpdate'] = true;
  }
}
