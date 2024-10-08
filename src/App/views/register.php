  <?php include $this->resolve("partials/_head.php"); ?>
  <script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>
  <link rel="stylesheet" href="/assets/registerStyle.css">
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
            <?php include $this->resolve('partials/_csrf.php'); ?>
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

            <div class="g-recaptcha" data-sitekey="6Lc3uQcqAAAAABrAcdQ6NpN4_UOuXDkEslgJhTlc"></div>
            </br>

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
                    <div class="btn btn-danger">
                      <a href="/" class="nav-link active" aria-current="page">Wróć</a>
                    </div>
                    <div class="btn btn-primary">
                      <a href="/login" class="nav-link active" aria-current="page">Zaloguj</a>
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