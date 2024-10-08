  <?php include $this->resolve("partials/_head.php"); ?>
  <link rel="stylesheet" href="/assets/balance.css">
  <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js'></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  </head>

  <body>

    <?php include $this->resolve("partials/_header.php"); ?>

    <main class="container">
      <section>
        <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 mt-3">
          <h2 class="h2 me-4" id="nameOfPeriod">Dzisiaj</h2>

          <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border-radius: 7px;border: 3px solid #807c7c; width: 100%">
            <i class="fa fa-calendar"></i>&nbsp;
            <span id="selectedDate"></span>
          </div>
        </div>
        <form id="invisibleForm" method="GET" style="display:none;">
          <input value="<?php echo e((string) $dateToTransfer); ?>" type="text" name="s" id="searchInput" />
        </form>

      </section>

      <section>
        <div class="container d-flex justify-content-center flex-wrap table-responsive">
          <table class="table-sm align-middle">
            <thead>
              <tr>
                <th scope="col">
                  <div class="d-flex flex-row align-items-center">
                    <img class="me-3" src="/images/graph-up-arrow.svg" width="27px" height="27px">
                    <h4>Twoje przychody</h4>
                  </div>
                </th>
              </tr>
            </thead>

            <thead class="table-group-divider">
              <tr>
                <th scope="col">DATA</th>
                <th scope="col">KATEGORIA</th>
                <th scope="col">KWOTA</th>
                <th scope="col">KOMENTARZ</th>
              </tr>
            </thead>

            <tbody class="table-group-divider">
              <?php foreach ($incomes as $income): ?>
                <tr>
                  <td><?php echo $income['date_of_income']; ?></td>
                  <td><?php echo $income['name']; ?></td>
                  <td scope="col">
                    <p class="earnings">+ <?php echo $income['amount']; ?></p>
                  </td>
                  <td><?php echo $income['income_comment']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <thead class="table-group-divider">
              <tr>
                <th scope="col">BILANS PRZYCHODÓW</th>
                <th scope="col">KATEGORIA</th>
                <th scope="col">SUMA</th>
              </tr>
            </thead>

            <tbody class="table-group-divider">
              <?php foreach ($incomesums as $incomesum): ?>
                <tr>
                  <td></td>
                  <td><?php echo $incomesum['name']; ?></td>
                  <td scope="col">
                    <p class="earnings text-nowrap">+ <?php echo $incomesum['sum']; ?></p>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <thead class="table-group-divider">
                <tr>
                  <th></th>
                  <th scope="col" style="font-size: 25px;">SUMA</th>
                  <th scope="col" style="font-size: 25px;">
                    <p id="sumOne" class="earnings"><?php echo $sumOfIncomes; ?></p>
                  </th>
                </tr>
              </thead>
            </tfoot>
          </table>

          <div class="d-flex justify-content-center flex-column pieID--przychody pie-chart--wrapper">
            <h2>Przychody</h2>
            <div class="pie-chart">
              <div class="pie-chart__pie"></div>
              <ul class="pie-chart__legend">
                <?php foreach ($incomesums as $incomesum): ?>
                  <li><em><?php echo $incomesum['name']; ?></em><span><?php echo $incomesum['sum']; ?></span></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>

        </div>
      </section>

      <section style="margin-top: 100px;">
        <div class="container d-flex justify-content-center flex-wrap">
          <table class="table-sm align-middle">
            <thead>
              <tr>
                <th scope="col">
                  <div class="d-flex flex-row align-items-center">
                    <img class="me-3" src="/images/graph-down-arrow.svg" width="27px" height="27px">
                    <h4>Twoje wydatki</h4>
                  </div>
                </th>
              </tr>
            </thead>

            <thead class="table-group-divider">
              <tr>
                <th scope="col">DATA</th>
                <th scope="col">SPOSÓB PŁATNOŚCI</th>
                <th scope="col">KATEGORIA</th>
                <th scope="col">KWOTA</th>
                <th scope="col">KOMENTARZ</th>
              </tr>
            </thead>

            <tbody class="table-group-divider">
              <?php foreach ($expenses as $expense): ?>
                <tr>
                  <td><?php echo $expense['date_of_expense']; ?></td>
                  <td><?php echo $expense['payment']; ?></td>
                  <td><?php echo $expense['category']; ?></td>
                  <td scope="col">
                    <p class="expenses text-nowrap">- <?php echo $expense['amount']; ?></p>
                  </td>
                  <td><?php echo $expense['expense_comment']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>

            <thead class="table-group-divider">
              <tr>
                <th scope="col">BILANS WYDATKÓW</th>
                <th scope="col">KATEGORIA</th>
                <th scope="col">SUMA</th>
              </tr>
            </thead>

            <tbody class="table-group-divider">
              <?php foreach ($expensesums as $expensesum): ?>
                <tr>
                  <td></td>
                  <td><?php echo $expensesum['name']; ?></td>
                  <td scope="col">
                    <p class="expenses">- <?php echo $expensesum['sum']; ?></p>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>

            <tfoot>
              <thead class="table-group-divider">
                <tr>
                  <th></th>
                  <th scope="col" style="font-size: 25px;">SUMA</th>
                  <th scope="col" style="font-size: 25px;">
                    <p id="sumTwo" class="expenses"><?php echo "-" . $sumOfExpenses; ?></p>
                  </th>
                </tr>
              </thead>
            </tfoot>
          </table>

          <div class="d-flex justify-content-center flex-column pieID--wydatki pie-chart--wrapper">
            <h2>Wydatki</h2>
            <div class="pie-chart">
              <div class="pie-chart__pie"></div>
              <ul class="pie-chart__legend">
                <?php foreach ($expensesums as $expensesum): ?>
                  <li><em><?php echo $expensesum['name']; ?></em><span><?php echo $expensesum['sum']; ?></span></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>

        </div>
      </section>

      <section>
        <div class="container d-flex flex-column justify-content-center align-items-center my-4 py-4">
          <h3 class="mb-3">Twój bilans za</h3>
          <h3 id="balancePeriod">.</h3>
          <h2 id="balanceSum" class="my-4"></h2>
          <div style="border: 1px solid black; width: 70%;"></div>
          <h3 id="balanceDescription" class="mb-4 mt-3 pb-4"></h3>
        </div>
      </section>
    </main>

    <?php include $this->resolve("partials/_footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js" integrity="sha512-XKa9Hemdy1Ui3KSGgJdgMyYlUg1gM+QhL6cnlyTe2qzMCYm4nAZ1PsVerQzTTXzonUR+dmswHqgJPuwCq1MaAg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js" integrity="sha512-mh+AjlD3nxImTUGisMpHXW03gE6F4WdQyvuFRkjecwuWLwD2yCijw4tKA3NsEFpA1C3neiKhGXPSIGSfCYPMlQ==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.css" integrity="sha512-rBi1cGvEdd3NmSAQhPWId5Nd6QxE8To4ADjM2a6n0BrqQdisZ/RPUlm0YycDzvNL1HHAh1nKZqI0kSbif+5upQ==" crossorigin="anonymous" />
    <script src="/assets/balance.js" charset="utf-8"></script>
  </body>

  </html>