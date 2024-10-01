<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php echo e($title); ?> - Budżet domowy</title>

  <link rel="icon" type="image/png" sizes="32x32" href="/images/icons/coin.svg">
  <link rel="stylesheet" href="/assets/registerStyle.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Castoro:ital@0;1&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    <div class="container col-xl-10 col-xxl-8 px-4 py-5 d-flex justify-content-center">
      <div class="card mb-4 rounded-3 shadow-sm mainCard">
        <div class="card-header py-3">
          <h4 id="rejestracja" class="my-0 fw-normal text-center">DODAJ PRZYCHÓD</h4>
        </div>
        <form class="p-4 p-md-5 border rounded-3 .bg-light-subtle" method="post">
          <?php include $this->resolve("partials/_csrf.php"); ?>
          <div class="col-auto">
            <label class="visually-hidden" for="autoSizingInputGroup">Kwota</label>
            <div class="input-group">
              <div class="input-group-text"><img src="/images/currency-dollar.svg" alt="dollar" width="25" height="20">
              </div>
              <span class="input-group-text">0.00</span>
              <input type="text" class="form-control" id="autoSizingInputGroup" placeholder="Wpisz kwote.." value="<?php echo e($oldFormData['amount'] ?? ''); ?>" name="amount">
            </div>

            <?php if (array_key_exists('amount', $errors)) : ?>
              <div class="error">
                <?php echo e($errors['amount'][0]); ?>
              </div>
            <?php endif; ?>

          </div>

          <div class="col-auto">
            <label for="floatingDate"></label>
            <div class="input-group">
              <div class="input-group-text"><img src="/images/calendar3.svg" alt="calendar" width="25" height="20">
              </div>
              <input value="<?php echo e($oldFormData['date'] ?? ''); ?>" type="date" class="form-control" id="floatingDate" placeholder="Data" name="date">
            </div>

            <?php if (array_key_exists('date', $errors)) : ?>
              <div class="error">
                <?php echo e($errors['date'][0]); ?>
              </div>
            <?php endif; ?>
          </div>

          <div class="col-auto">
            <label for="floatingCategory"></label>
            <div class="input-group">
              <div class="input-group-text"><img src="/images/puzzle.svg" alt="puzzle" width="25" height="20">
              </div>
              <select class="form-select" id="floatingCategory" aria-label="Floating label select example" name="category">
                <option value="-1" selected>Wybierz kategorię...</option>
                <?php
                foreach ($_SESSION['incomesCategories'] as $category) {
                  echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                }
                ?>
              </select>
            </div>
          </div>

          <?php if (array_key_exists('category', $errors)) : ?>
            <div class="error">
              <?php echo e($errors['category'][0]); ?>
            </div>
          <?php endif; ?>

          <div class="mb-3 mt-4">
            <label for="exampleFormControlTextarea1" class="form-label">Komentarz (opcjonalnie)</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comment"></textarea>
          </div>

          <?php if (array_key_exists('comment', $errors)) : ?>
            <div class="error">
              <?php echo e($errors['comment'][0]); ?>
            </div>
          <?php endif; ?>

          <div class="w-40 btn btn-lg btn-success mt-4">
            <button type="submit" class="nav-link active" aria-current="page">Dodaj
            </button>
          </div>
          <div class="w-40 btn btn-lg btn-danger mt-4">
            <a href="/home" class="nav-link active" aria-current="page">Anuluj
            </a>
          </div>

          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Przychód dodany</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Chcesz dodać kolejny czy przejść do menu?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-bs-dismiss="modal">Dodaj</button>
                  <a href="/home" class="btn btn-danger" aria-current="page">Anuluj</a>
                </div>
              </div>
            </div>
          </div>

        </form>
      </div>
    </div>
    </div>

  </main>

  <?php include $this->resolve("partials/_footer.php"); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="/assets/income.js" charset="utf-8"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      <?php
      if (isset($_SESSION['income_added']) && $_SESSION['income_added']) {
        $_SESSION['income_added'] = false;
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