  <?php include $this->resolve("partials/_head.php"); ?>
  <link rel="stylesheet" href="/assets/welcomeStyle.css">
  </head>

  <body>

    <header class="container">
      <div class="d-flex flex-wrap justify-content-between py-3 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-2 link-body-emphasis text-decoration-none">
          <img src="/images/swinkalogo.png" alt="logo strony świnka skarbonka" class="bi me-2" width="80" height="80"></img>
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
      <div class="my-5">
        <div class="p-5 text-center">
          <div class="container py-5 bg-body-tertiary">
            <h1 class="text-body-emphasis">Witaj w serwisie mój budżet</h1>
            <p class="col-lg-8 mx-auto lead">
              Czujesz że chcesz mieć dużo większą kontrolę nad swoimi wydatkami? Chcesz efektywniej gromadzić pieniądze na wymarzony cel? Z nami w bardzo prosty sposób możesz dodawać swoje wydatki oraz przychody, wyświetlać wyniki w przejżysty sposób w postaci raportów i wykresów.
            </p>
          </div>
        </div>
      </div>
    </main>

    <?php include $this->resolve("partials/_footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php
    if (isset($_SESSION['error']))
      echo $_SESSION['error'];
    ?>
  </body>

  </html>