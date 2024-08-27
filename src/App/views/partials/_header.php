<header class="container">
  <div class="d-flex flex-wrap justify-content-between py-3 border-bottom">
    <div>
      <a href="/home" class="d-flex align-items-center mb-3 mb-md-0 me-2 link-body-emphasis text-decoration-none">
        <img src="/images/swinkalogo.png" class="bi me-2" width="80" height="80"></img>
        <h1 id="main-name">
          <span>Mój</span>
          <span>Budżet</span>
        </h1>
      </a>
    </div>

    <div class="d-flex flex-row justify-content-between align-items-center py-3 border-bottom">
      <ul class="nav nav-pills align-content-center me-2">
        <li class="nav-item me-1">
          <p class="me-1">Zalogowany jako</p>
          <a class="ms-1" href="#" aria-current="page"><?= $_SESSION['username'] ?></a>
        </li>
      </ul>

      <div class="flex-shrink-0 dropdown ms-2">
        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="/images/person-circle.svg" alt="mdo" width="32" height="32" class="rounded-circle">
        </a>
        <ul class="dropdown-menu text-small shadow" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(0.5px, 34px, 0px);" data-popper-placement="bottom-end">
          <li class="dropdown-flex">
            <img src="/images/person-lines-fill.svg" alt="profile" width="20" height="20">
            <a class="dropdown-item" href="#">Profil</a>
          </li>
          <li class="dropdown-flex">
            <img src="/images/trybik.png" alt="gear" width="20" height="20">
            <a class="dropdown-item" href="#">Ustawienia</a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li class="dropdown-flex">
            <img src="/images/power.svg" alt="house" width="20" height="20">
            <a class="dropdown-item" href="logout.php">Wyloguj</a>
          </li>
        </ul>
      </div>
    </div>
  </div>



  <nav class="navbar navbar-expand-lg bg-body-tertiary rounded" aria-label="menu-navbar">
    <div class="container-fluid justify-content-end">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample10" aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample10">
        <ul class="navbar-nav align-items-center">
          <li class="nav-item">
            <a class="nav-link ps-3" href="/home"><img class="me-2" src="/images/domek.png" alt="house" width="30" height="25">Strona główna</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ps-3" href="/income"><img class="me-2" src="/images/plus.png" alt="plus icon" width="25" height="24">Dodaj przychód</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ps-3" href="/outcome"><img class="me-2" src="/images/minus.png" alt="minus icon" width="26" height="30">Dodaj wydatek</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ps-3" href="/balance"><img class="me-2" src="/images/wykres.png" alt="bar diagram" width="30" height="30">Przedstaw bilans</a>
          </li>


        </ul>
      </div>
    </div>
  </nav>

  </nav>
</header>