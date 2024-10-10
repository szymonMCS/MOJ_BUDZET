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

  // public function updateProfile(array $formData)
  // {
  //   $this->db->query(
  //     'UPDATE users SET username = :username, email = :email WHERE id = :id',
  //     [
  //       'username' => $formData['username'],
  //       'email' => $formData['email'],
  //       'id' => $_SESSION['logged_id']
  //     ]
  //   );

  //   $_SESSION['success_profileUpdate'] = true;
  // }
}
