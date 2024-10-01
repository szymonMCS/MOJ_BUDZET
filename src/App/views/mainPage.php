<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php echo e($title); ?> - Budżet domowy</title>

  <link rel="icon" type="image/png" sizes="32x32" href="/images/icons/coin.svg">
  <link rel="stylesheet" href="/assets/mainStyle.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Castoro:ital@0;1&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

  <?php include $this->resolve("partials/_header.php"); ?>

  <main>

    <section class="container mt-4 powitanie">
      <h2>Cześć <?= $_SESSION['username'] ?></h2>
      <h3>pora rzucic okiem twoje finanse!</h3>
    </section>


    <section class="container">

      <div class="row row-cols-1 row-cols-md-3 mb-3  mt-5 pt-4 text-center">
        <div class="col d-flex align-items-stretch justify-content-center">
          <div class="card mb-4 rounded-3 shadow-sm">
            <div class="modal-body p-4">
              <img src="/images/plus.png" alt="plus icon" width="120" height="120">
              <div class="w-100 btn btn-lg btn-outline-primary">
                <a href="/income" class="nav-link active" aria-current="page">Dodaj przychód
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col d-flex align-items-stretch justify-content-center">
          <div class="card mb-4 rounded-3 shadow-sm">
            <div class="modal-body p-4">
              <img src="/images/minus.png" alt="plus icon" width="120" height="120">
              <div class="w-100 btn btn-lg btn-outline-primary">
                <a href="/outcome" class="nav-link active" aria-current="page">Dodaj wydatek
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col d-flex align-items-stretch justify-content-center">
          <div class="card mb-4 rounded-3 shadow-sm">
            <div class="modal-body p-4">
              <img src="/images/wykres.png" alt="plus icon" width="150" height="120">

              <div class="w-100 btn btn-lg btn-outline-primary">
                <a href="/balance" class="nav-link active" aria-current="page">Pokaż bilans
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include $this->resolve("partials/_footer.php"); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>