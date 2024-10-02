<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php echo e($title); ?> - Budżet domowy</title>

  <link rel="icon" type="image/png" sizes="32x32" href="/images/coin.svg">
  <link rel="stylesheet" href="/assets/welcomeStyle.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Castoro:ital@0;1&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<div class="container py-5 bg-body-tertiary">
  <h1 class="text-body-emphasis">404</h1>
  <p class="col-lg-8 mx-auto lead">
    The page you are looking for was moved, removed renamed or might never
    existed.
  </p>
  <a href="/" class="text-body-emphasis">Go Home</a>
</div>

<?php include $this->resolve("partials/_footer.php"); ?>