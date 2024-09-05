<?php
/*
		$password_hash = password_hash($password1, PASSWORD_DEFAULT);
		
		require_once "database.php";

		$emailquery = $db->prepare('SELECT id FROM users WHERE email= :email');
		$emailquery->bindValue(':email', $email, PDO::PARAM_STR);
		$emailquery->execute();
		
		$isEmailInBase = $emailquery->rowCount();
		
		if($isEmailInBase > 0){
			$everything_ok = false;
			$_SESSION['e_email'] = "Istnieje już konto przypisane do tego adresu e-mail.";
		}
		
		if($everything_ok){	
			$query = $db->prepare('INSERT INTO users VALUES (NULL, :username, :password, :email)');
			$query->bindValue(':username', $username, PDO::PARAM_STR);
			$query->bindValue(':password', $password_hash, PDO::PARAM_STR);
			$query->bindValue(':email', $email, PDO::PARAM_STR);
			$query->execute();
			
			$idquery = $db->prepare('SELECT id FROM users WHERE email= :email');
			$idquery->bindValue(':email', $email, PDO::PARAM_STR);
			$idquery->execute();
			
			$user = $idquery->fetch(PDO::FETCH_ASSOC);
			$user_id = $user['id']; 
			
			$copyIncomesCategories = $db->prepare('INSERT INTO incomes_category_assigned_to_users (user_id , name) 
												   SELECT :id, name
												   FROM incomes_category_default');
			$copyIncomesCategories->bindValue(':id', $user_id, PDO::PARAM_STR);
			$copyIncomesCategories->execute();
			
			$copyOutcomesCategories = $db->prepare('INSERT INTO expenses_category_assigned_to_users (user_id , name) 
													SELECT :id, name
													FROM expenses_category_default');
			$copyOutcomesCategories->bindValue(':id', $user_id, PDO::PARAM_STR);
			$copyOutcomesCategories->execute();
			
			$copyPaymentMethods = $db->prepare('INSERT INTO payment_methods_assigned_to_users (user_id , name) 
												SELECT :id, name
												FROM payment_methods_default');
			$copyPaymentMethods->bindValue(':id', $user_id, PDO::PARAM_STR);
			$copyPaymentMethods->execute();
			
			unset($_SESSION['e_email']);
			unset($_SESSION['e_password']);
			unset($_SESSION['e_terms']);
			unset($_SESSION['e_bot']);
			$_SESSION['success_registration'] = true;
		}
	}		
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php echo e($title); ?> - Budżet domowy</title>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <link rel="icon" type="image/png" sizes="32x32" href="/images/coin.svg">
  <link rel="stylesheet" href="registerStyle.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Castoro:ital@0;1&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    .error {
      --tw-bg-opacity: 1;
      background-color: rgb(243 244 246 / var(--tw-bg-opacity));
      --tw-text-opacity: 1;
      color: rgb(239 68 68 / var(--tw-text-opacity));
      margin-top: 10px;
      margin-bottom: 10px;
    }
  </style>
</head>

<body>

  <header class="container">
    <div class="d-flex flex-wrap justify-content-between py-3 border-bottom">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-2 link-body-emphasis text-decoration-none">
        <img src="/images/swinkalogo.png" class="bi me-2" width="80" height="80"></img>
        <h2 id="main-name">
          <span>Mój</span>
          <span>Budżet</span>
        </h2>
      </a>

      <ul class="nav nav-pills align-content-center ms-2">
        <li class="nav-item me-1"><a href="/login" class="nav-link active" aria-current="page">Logowanie</a></li>
        <li class="nav-item ms-1"><a href="/register" class="nav-link">Rejestracja</a></li>
      </ul>
    </div>
  </header>

  <main>
    <div class="container col-xl-10 col-xxl-8 px-4 py-5 d-flex justify-content-center">
      <div class="card mb-4 rounded-3 shadow-sm mainCard">
        <div class="card-header py-3">
          <h4 id="rejestracja" class="my-0 fw-normal text-center">REJESTRACJA</h4>
        </div>
        <form class="p-4 p-md-5 border rounded-3 .bg-light-subtle" method="post">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="Imie" value="<?php echo e($oldFormData['username'] ?? ''); ?>" name="username" />
            <label for="floatingInput"><img src="/images/person.svg" class="me-3" alt="minus icon" width="25" height="20">Imie</label>
          </div>

          <?php if (array_key_exists('username', $errors)) : ?>
            <div class="error">
              <?php echo e($errors['username'][0]); ?>
            </div>
          <?php endif; ?>

          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php echo e($oldFormData['email'] ?? ''); ?>" name="email" />
            <label for="floatingPassword"><img src="/images/envelope.svg" class="me-3" alt="envelope" width="25" height="20">E-mail</label>
          </div>

          <?php if (array_key_exists('email', $errors)) : ?>
            <div class="error">
              <?php echo e($errors['email'][0]); ?>
            </div>
          <?php endif; ?>

          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="password" name="password" />
            <label for="floatingInput"><img src="/images/lock.svg" class="me-3" alt="locker" width="25" height="20">Hasło</label>
          </div>

          <?php if (array_key_exists('password', $errors)) : ?>
            <div class="error">
              <?php echo e($errors['password'][0]); ?>
            </div>
          <?php endif; ?>

          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="password" name="confirmPassword" />
            <label for="floatingInput"><img src="/images/lock.svg" class="me-3" alt="locker" width="25" height="20">Powtórz hasło</label>
          </div>

          <?php if (array_key_exists('confirmPassword', $errors)) : ?>
            <div class="error">
              <?php echo e($errors['confirmPassword'][0]); ?>
            </div>
          <?php endif; ?>



          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" name="tos" <?php echo $oldFormData['tos'] ?? false ? 'checked' : ''; ?> /> Akceptuje regulamin
            </label>
          </div>

          <?php if (array_key_exists('tos', $errors)) : ?>
            <div class="error">
              <?php echo e($errors['tos'][0]); ?>
            </div>
          <?php endif; ?>

          <div class="g-recaptcha" data-sitekey="6LcavzYqAAAAAOYogrEPZ1e2ar5nXeLjsfrFeVkh"></div></br>

          <?php if (array_key_exists('bot', $errors)) : ?>
            <div class="error">
              <?php echo e($errors['bot'][0]); ?>
            </div>
          <?php endif; ?>

          <button type="submit" class="w-100 btn btn-lg btn-primary mt-4">
            Zarejestruj
          </button>

          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Rejestracja zakończona</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Zdecyduj czy chcesz zalogować się od razu czy wrócić do strony głównej?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Anuluj</button>
                  <div class="btn btn-primary">
                    <a href="logowanie.php" class="nav-link active" aria-current="page">Zaloguj</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <hr class="my-4">
          <small class="text-body-secondary">Klikając zarejestruj, zgadzasz się na warunki użytkowania.</small>
        </form>
      </div>
    </div>
    </div>

  </main>

  <?php include $this->resolve("partials/_footer.php"); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      <?php
      if (isset($_SESSION['success_registration']) && $_SESSION['success_registration']) {
        $_SESSION['success_registration'] = false;
      ?>
        showSuccessModal();
      <?php } ?>

      function showSuccessModal() {
        var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
        myModal.show();
      }
    });
  </script>
</body>

</html>