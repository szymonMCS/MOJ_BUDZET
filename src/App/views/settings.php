<?php include $this->resolve("partials/_head.php"); ?>
<link rel="stylesheet" href="/assets/settings.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

  <?php include $this->resolve("partials/_header.php"); ?>

  <main>

    <div class="container px-4 py-5">
      <div class="row gutters-sm">
        <div class="col-md-4 d-none d-md-block">
          <div class="card">
            <div class="card-body">
              <nav class="nav flex-column nav-pills nav-gap-y-1">
                <a href="#profile" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded active">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user mr-2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                  </svg>Informacje o profilu
                </a>
                <a href="#account" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings mr-2">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                  </svg>Usuń konto
                </a>
                <a href="#security" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield mr-2">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                  </svg>Zmień hasło
                </a>
                <a href="#billing" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card mr-2">
                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                    <line x1="1" y1="10" x2="23" y2="10"></line>
                  </svg>Dostosuj kategorie
                </a>
              </nav>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-header border-bottom mb-3 d-flex d-md-none">
              <ul class="nav nav-tabs card-header-tabs nav-gap-x-1" role="tablist">
                <li class="nav-item">
                  <a href="#profile" data-toggle="tab" class="nav-link has-icon active"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                      <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                      <circle cx="12" cy="7" r="4"></circle>
                    </svg></a>
                </li>
                <li class="nav-item">
                  <a href="#account" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings">
                      <circle cx="12" cy="12" r="3"></circle>
                      <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                    </svg></a>
                </li>
                <li class="nav-item">
                  <a href="#security" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield">
                      <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg></a>
                </li>
                <li class="nav-item">
                  <a href="#billing" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card">
                      <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                      <line x1="1" y1="10" x2="23" y2="10"></line>
                    </svg></a>
                </li>
              </ul>
            </div>
            <div class="card-body tab-content">
              <div class="tab-pane active" id="profile">
                <h6>INFORMACJE O PROFILU</h6>
                <hr>
                <form method="post">
                  <div class="form-group">
                    <label for="fullName">Imie</label>
                    <input type="text" class="form-control" id="floatingInput" value="<?php echo e($_SESSION['username']); ?>" name="username" />
                  </div>

                  <?php if (array_key_exists('username', $errors)) : ?>
                    <div class="error">
                      <?php echo e($errors['username'][0]); ?>
                    </div>
                  <?php endif; ?>

                  <div class="form-group">
                    <label for="bio">E-mail</label>
                    <input type="text" class="form-control" id="floatingInput" value="<?php echo e($_SESSION['email']); ?>" name="email" />
                  </div>

                  <?php if (array_key_exists('email', $errors)) : ?>
                    <div class="error">
                      <?php echo e($errors['email'][0]); ?>
                    </div>
                  <?php endif; ?>

                  <button type="submit" class="btn btn-primary" aria-current="page">Zaaktualizuj dane</button>


                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Dane zmienione pomyślnie</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-footer">
                          <div class="btn btn-danger">
                            <a href="/" class="nav-link active" aria-current="page">Wróć</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </form>
              </div>
              <div class="tab-pane" id="account">
                <h6>USUŃ KONTO</h6>
                <hr>
                <form method="post">
                  <div class="form-group">
                    <label class="d-block text-danger">Usuń konto</label>
                    <p class="text-muted font-size-sm">W momencie usunięcia konta, nie ma możliwości odwrotu. Uważaj!</p>
                  </div>
                  <button class="btn btn-danger" type="submit">Usuń konto</button>
                </form>
              </div>
              <div class="tab-pane" id="security">
                <h6>ZMIEŃ HASŁO</h6>
                <hr>
                <form>
                  <div class="form-group">
                    <label class="d-block">Zmień hasło</label>
                    <input type="text" class="form-control" placeholder="Wprowadź obecne hasło">
                    <hr>
                    <input type="text" class="form-control mt-1" placeholder="Nowe hasło">
                    <hr>
                    <input type="text" class="form-control mt-1" placeholder="Potwierdź nowe hasło">
                  </div>
                  <hr>
                  <button type="button" class="btn btn-primary">Zaaktualizuj hasło</button>
                </form>
                <hr>
              </div>
              <div class="tab-pane" id="billing">
                <h6>DODAJ KATEGORIE</h6>
                <hr>
                <form>
                  <div class="form-group">
                    <label class="d-block">Wybierz typ</label>
                    <select class="form-select" id="floatingCategory" aria-label="Floating label select example" name="category">
                      <option selected="">Choose...</option>
                      <option>...</option>
                    </select>
                    <hr>
                    <label class="d-block">Wpisz nazwe</label>
                    <input type="text" class="form-control mt-1" placeholder="Wpisz nazwe nowej kategorii">
                  </div>
                  <button type="button" class="btn btn-info">Dodaj</button>
                </form>
                <hr>

                <h6>USUŃ KATEGORIE</h6>
                <hr>
                <form>
                  <div class="form-group">
                    <label class="d-block">Wybierz typ</label>
                    <select class="form-select" id="floatingCategory" aria-label="Floating label select example" name="category">
                      <option selected="">Choose...</option>
                      <option>...</option>
                    </select>
                    <hr>
                    <label class="d-block">Wybierz kategorię</label>
                    <select class="form-select" id="floatingCategory" aria-label="Floating label select example" name="category">
                      <option selected="">Choose...</option>
                      <option>...</option>
                    </select>
                  </div>
                  <button class="btn btn-danger" type="button">Usuń kategorię</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>










  </main>

  <?php include $this->resolve("partials/_footer.php"); ?>
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="/assets/settings.js" charset="utf-8"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      <?php
      if (isset($_SESSION['success_profileUpdate']) && $_SESSION['success_profileUpdate']) {
        $_SESSION['success_profileUpdate'] = false;
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