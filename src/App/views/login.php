  <?php include $this->resolve("partials/_head.php"); ?>
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
        <div class="card mb-4 rounded-3 shadow-sm mainCard" style="width: 27rem;">
          <div class="card-header py-3">
            <h4 id="rejestracja" class="my-0 fw-normal text-center">LOGOWANIE</h4>
          </div>
          <form method="post" class="p-4 p-md-5 border rounded-3 .bg-light-subtle">
            <?php include $this->resolve('partials/_csrf.php'); ?>

            <div class="form-floating mb-3">
              <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php echo e($oldFormData['email'] ?? ''); ?>" name="email">
              <label for="floatingPassword"><img src="/images/envelope.svg" class="me-3" alt="envelope" width="25" height="20">E-mail</label>
            </div>

            <?php if (array_key_exists('email', $errors)) : ?>
              <div class="error">
                <?php echo e($errors['email'][0]); ?>
              </div>
            <?php endif; ?>

            <div class="form-floating mb-3">
              <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
              <label for="floatingInput"><img src="/images/lock.svg" class="me-3" alt="locker" width="25" height="20">Hasło</label>
            </div>

            <?php if (array_key_exists('password', $errors)) : ?>
              <div class="error">
                <?php echo e($errors['password'][0]); ?>
              </div>
            <?php endif; ?>

            <button type="submit" class="w-100 btn btn-lg btn-primary mt-4">
              Zaloguj
            </button>

            <hr class="my-4">
            <p class="text">Nie masz jeszcze u nas konta?</p>

            <div class="w-100 btn btn-lg btn-primary mt-4">
              <a href="/register" class="nav-link active" aria-current="page">Rejestracja</a>
            </div>
          </form>
        </div>
      </div>
      </div>
    </main>

    <?php include $this->resolve("partials/_footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>

  </html>