<?php
$incomesCategories = json_encode($_SESSION['incomesCategories']);
$outcomesCategories = json_encode($_SESSION['outcomesCategories']);
$oldFormData = $oldFormData ?? [];
$errors = $errors ?? [];
$_SESSION['openEditModalAtStart'] = false;
$openEditModalAtStart = count($oldFormData) > 0;
?>
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
                <form method="post" name="changeProfileForm">
                  <?php include $this->resolve("partials/_csrf.php"); ?>
                  <div class="form-group">
                    <label for="username">Imie</label>
                    <input type="text" class="form-control" id="username" value="<?php echo e($_SESSION['username']); ?>" name="username" />
                  </div>

                  <?php if (array_key_exists('username', $errors)) : ?>
                    <div class="error">
                      <?php echo e($errors['username'][0]); ?>
                    </div>
                  <?php endif; ?>

                  <button name="submitChangeProfileForm" class="btn btn-primary" type="submit" aria-current="page">Zaaktualizuj dane</button>

                  <div class="modal fade" id="usernameModal" tabindex="-1" aria-labelledby="usernameModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="usernameModalLabel">Dane zmienione pomyślnie</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-footer">
                          <div>
                            <a href="" class="btn btn-success" aria-current="page">Wróć</a>
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
                <form method="post" name="deleteAccountForm">
                  <?php include $this->resolve("partials/_csrf.php"); ?>
                  <div class="form-group">
                    <label class="d-block text-danger">Usuń konto</label>
                    <p class="text-muted font-size-sm">W momencie usunięcia konta, nie ma możliwości odwrotu. Uważaj!</p>
                  </div>
                  <button id="openDeleteModal" class="btn btn-danger" type="button" aria-current="page">Usuń konto</button>

                  <div class="modal fade" id="delAccountModal" tabindex="-1" aria-labelledby="delAccountModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="delAccountModalLabel">Na pewno chcesz usunąć konto?</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-footer">
                          <div>
                            <button name="submitDeleteAccountForm" type="submit" class="btn btn-danger" data-bs-dismiss="modal">Usuń</button>
                          </div>
                          <div>
                            <a href="/home" class="btn btn-success" aria-current="page">Anuluj</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </form>
              </div>

              <div class="tab-pane" id="security">
                <h6>ZMIEŃ HASŁO</h6>
                <hr>
                <form method="post" name="changePasswordForm">
                  <?php include $this->resolve("partials/_csrf.php"); ?>
                  <div class="form-group">
                    <label class="d-block">Zmień hasło</label>
                    <input type="password" class="form-control" name="passOld" placeholder="Wprowadź obecne hasło">

                    <?php if (array_key_exists('passOld', $errors)) : ?>
                      <div class="error">
                        <?php echo e($errors['passOld'][0]); ?>
                      </div>
                    <?php endif; ?>
                    <hr>
                    <input type="password" class="form-control mt-1" name="passNew1" placeholder="Nowe hasło">

                    <?php if (array_key_exists('passNew1', $errors)) : ?>
                      <div class="error">
                        <?php echo e($errors['passNew1'][0]); ?>
                      </div>
                    <?php endif; ?>

                    <hr>
                    <input type="password" class="form-control mt-1" name="passNew2" placeholder="Potwierdź nowe hasło">

                    <?php if (array_key_exists('passNew2', $errors)) : ?>
                      <div class="error">
                        <?php echo e($errors['passNew2'][0]); ?>
                      </div>
                    <?php endif; ?>

                  </div>
                  <hr>

                  <button name="submitChangePasswordForm" type="submit" class="btn btn-primary" aria-current="page">Zaaktualizuj hasło</button>

                  <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="passwordModalLabel">Hasło zmienione pomyślnie</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-footer">
                          <div>
                            <a href="/settings" class="btn btn-success" aria-current="page">Wróć</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </form>
                <hr>
              </div>

              <div class="tab-pane" id="billing">
                <h6>DODAJ KATEGORIE</h6>
                <hr>
                <form method="post" name="addCategoryForm">
                  <?php include $this->resolve("partials/_csrf.php"); ?>
                  <div class="form-group">
                    <label class="d-block">Wybierz typ</label>
                    <select class="form-select" id="newCategoryType" name="newCategoryType">
                      <option value="-1" selected>Wybierz typ...</option>
                      <option value="incomes">przychody</option>
                      <option value="outcomes">wydatki</option>
                    </select>

                    <?php if (array_key_exists('newCategoryType', $errors)) : ?>
                      <div class="error">
                        <?php echo e($errors['newCategoryType'][0]); ?>
                      </div>
                    <?php endif; ?>

                    <hr>
                    <label class="d-block">Wpisz nazwe</label>
                    <input type="text" class="form-control mt-1" placeholder="Wpisz nazwe nowej kategorii" name="newCategoryName">

                    <?php if (array_key_exists('newCategoryName', $errors)) : ?>
                      <div class="error">
                        <?php echo e($errors['newCategoryName'][0]); ?>
                      </div>
                    <?php endif; ?>

                    <div id="addLimitOptions" style="display: none">
                      <hr>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="addLimitCheckbox">
                        <label class="form-check-label" for="addLimitCheckbox">
                          Dodaj miesięczny limit
                        </label>
                      </div>
                      <hr>
                      <div id="limitInput" style="display: none">
                        <label class="d-block mt-2">Wpisz limit</label>
                        <input type="number" class="form-control mt-1" placeholder="Wpisz limit" name="newCategoryLimit">
                      </div>
                      <hr>
                    </div>
                  </div>

                  <button name="submitAddCategoryForm" class="btn btn-info" type="submit" aria-current="page">Dodaj</button>

                  <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="addCategoryLabel">Kategoria dodana pomyślnie</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-footer">
                          <div>
                            <a href="" class="btn btn-success" aria-current="page">Wróć</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <hr>

                <h6>USUŃ KATEGORIE</h6>
                <hr>
                <form method="post" name="removeCategoryForm">
                  <?php include $this->resolve("partials/_csrf.php"); ?>
                  <div class="form-group">
                    <label class="d-block">Wybierz typ</label>
                    <select class="form-select" id="removeCategoryType" name="removeCategoryType">
                      <option value="-1" selected>Wybierz typ...</option>
                      <option value="incomes">przychody</option>
                      <option value="outcomes">wydatki</option>
                    </select>

                    <?php if (array_key_exists('removeCategoryType', $errors)) : ?>
                      <div class="error">
                        <?php echo e($errors['removeCategoryType'][0]); ?>
                      </div>
                    <?php endif; ?>

                    <hr>
                    <label class="d-block">Wybierz kategorię</label>
                    <select class="form-select" id="removeCategoryName" name="removeCategoryName">
                      <option value="-1" selected>Wybierz kategorię...</option>
                    </select>

                    <?php if (array_key_exists('removeCategoryName', $errors)) : ?>
                      <div class="error">
                        <?php echo e($errors['removeCategoryName'][0]); ?>
                      </div>
                    <?php endif; ?>

                  </div>
                  <button name="submitRemoveCategoryForm" class="btn btn-danger" type="submit" aria-current="page">Usuń kategorię</button>

                  <div class="modal fade" id="removeCategoryModal" tabindex="-1" aria-labelledby="removeCategoryModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="removeCategoryLabel">Kategoria usunięta pomyślnie</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-footer">
                          <div>
                            <a href="/settings" class="btn btn-success" aria-current="page">Wróć</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <hr>

                <h6>EDYTUJ KATEGORIE</h6>
                <hr>
                <form method="post" name="editCategoryForm" id="editCategoryForm">
                  <?php include $this->resolve("partials/_csrf.php"); ?>
                  <div class="form-group">
                    <label class="d-block">Wybierz typ</label>
                    <select class="form-select" id="editCategoryType" name="editCategoryType">
                      <option value="-1">Wybierz typ...</option>
                      <option value="incomes"
                        <?= ($oldFormData['editCategoryType'] ?? '') === 'incomes' ? 'selected' : '' ?>>
                        Przychody
                      </option>
                      <option value="outcomes"
                        <?= ($oldFormData['editCategoryType'] ?? '') === 'outcomes' ? 'selected' : '' ?>>
                        Wydatki
                      </option>
                    </select>

                    <hr>
                    <label class="d-block">Wybierz kategorię</label>
                    <select class="form-select" id="editCategoryName" name="editCategoryName">
                      <option value="-1">Wybierz kategorię...</option>
                      <?php
                      $cats = ($oldFormData['editCategoryType'] ?? '') === 'incomes'
                        ? $_SESSION['incomesCategories']
                        : $_SESSION['outcomesCategories'];
                      foreach ($cats as $cat):
                      ?>
                        <option value="<?= e($cat['id']) ?>" data-limit="<?= e($cat['limit']) ?>"
                          <?= ((string)($oldFormData['editCategoryName'] ?? '') === (string)$cat['id'])
                            ? 'selected' : '' ?>>
                          <?= e($cat['name']) ?>
                        </option>
                      <?php endforeach; ?>
                    </select>

                  </div>
                  <button id="openEditModal" class="btn btn-info" type="button" aria-current="page">Edytuj</button>

                  <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="editCategoryModalLabel">Edytuj kategorie</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                          <label class="d-block">Wpisz nową nazwe</label>
                          <input type="text" class="form-control mt-1" placeholder="Wpisz nową nazwe kategorii..." name="changedCategoryName" id="changedCategoryName" value="<?= e($oldFormData['changedCategoryName'] ?? '') ?>" />

                          <?php if (isset($errors['changedCategoryName'])): ?>
                            <div class="error" id="modalError">
                              <?= e($errors['changedCategoryName'][0]) ?>
                            </div>
                          <?php endif; ?>

                          <div id="editLimitOptions" style="<?= empty($cats) ? 'display:none' : '' ?>">
                            <hr>
                            <div class="form-check" id="editorBox" style="display: none">
                              <input class="form-check-input" type="checkbox" id="editLimitCheckbox">
                              <label class="form-check-label" for="editLimitCheckbox">Dodaj miesięczny limit</label>
                            </div>
                            <hr>
                            <div id="addInEditLimitInput"
                              style="<?= empty($oldFormData['addInEditLimitInput']) ? 'display:none' : '' ?>">
                              <label class="d-block mt-2">Wpisz nowy miesięczny limit</label>
                              <input type="number" class="form-control mt-1" placeholder="Wpisz limit" name="addInEditLimitInput">
                            </div>
                            <div id="editLimitInput" style="<?= empty($oldFormData['editLimitInput']) ? 'display:none' : '' ?>">
                              <label class="d-block mt-2">Edytuj obecny miesięczny limit</label>
                              <input type="number" class="form-control mt-1" placeholder="Wpisz limit" name="editLimitInput"
                                value="<?= e($oldFormData['editLimitInput'] ?? '') ?>">
                            </div>
                          </div>
                        </div>

                        <div class="modal-footer">
                          <div>
                            <button name="submitEditCategoryForm" type="submit" class="btn btn-success">Akceptuj</button>
                          </div>
                          <div>
                            <a data-bs-dismiss="modal" class="btn btn-danger" aria-current="page">Anuluj</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal fade" id="succesCategoryEditModal" tabindex="-1" aria-labelledby="succesCategoryEditModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="removeCategoryLabel">Kategoria zmieniona pomyślnie</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-footer">
                          <div>
                            <a href="/settings" class="btn btn-success" aria-current="page">Wróć</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <hr>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php include $this->resolve("partials/_footer.php"); ?>
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    window.settingsData = {
      incomesCategories: <?= $incomesCategories; ?>,
      outcomesCategories: <?= $outcomesCategories; ?>,
      openEditModalAtStart: <?= json_encode($openEditModalAtStart); ?>,
      oldFormData: <?= json_encode($oldFormData); ?>,
      errors: <?= json_encode($errors); ?>,
      successFlags: {
        profileUpdate: <?= json_encode(isset($_SESSION['success_profileUpdate']) && $_SESSION['success_profileUpdate']); ?>,
        passwordUpdate: <?= json_encode(isset($_SESSION['success_passwordUpdate']) && $_SESSION['success_passwordUpdate']); ?>,
        categoryAdded: <?= json_encode(isset($_SESSION['category_added']) && $_SESSION['category_added']); ?>,
        categoryRemoved: <?= json_encode(isset($_SESSION['category_removed']) && $_SESSION['category_removed']); ?>,
        categoryEdited: <?= json_encode(isset($_SESSION['category_edited']) && $_SESSION['category_edited']); ?>
      }
    };
  </script>
  <?php
  unset(
    $_SESSION['success_profileUpdate'],
    $_SESSION['success_passwordUpdate'],
    $_SESSION['category_added'],
    $_SESSION['category_removed'],
    $_SESSION['category_edited']
  );
  ?>
  <script src="/assets/settings.js" charset="utf-8"></script>
</body>

</html>