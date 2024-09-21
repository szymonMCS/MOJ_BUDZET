<!--<?php
    /*
	session_start();

	if (!isset($_SESSION['loggedIn'])) {
		header('Location: index.php');
		exit();
	}

	if (!isset($_SESSION['date_range'])) {
		$today = date('d.m.Y');
		$_SESSION['date_range'] = "$today - $today";
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['dateValue'])) {
			$_SESSION['date_range'] = $_POST['dateValue'];
		}
	}

    list($date2, $date1) = explode(' - ', $_SESSION['date_range']);

    $date1 = DateTime::createFromFormat('d.m.Y', $date1)->format('Y-m-d');
    $date2 = DateTime::createFromFormat('d.m.Y', $date2)->format('Y-m-d');

    require_once "database.php";
    
    try {
        $incomesquery = $db->prepare('SELECT
                                        incomes.date_of_income,
                                        incomes_category_assigned_to_users.name,
                                        incomes.amount,
                                        incomes.income_comment
                                      FROM incomes
                                        INNER JOIN users ON users.id = incomes.user_id
                                        INNER JOIN incomes_category_assigned_to_users ON incomes_category_assigned_to_users.id = incomes.income_category_assigned_to_user_id
                                      WHERE incomes.user_id = :user_id AND
                                            incomes.date_of_income BETWEEN :date_begin AND :date_end');
        $incomesquery->bindValue(':user_id', $_SESSION['logged_id'], PDO::PARAM_INT);
        $incomesquery->bindValue(':date_begin', $date2, PDO::PARAM_STR);
        $incomesquery->bindValue(':date_end', $date1, PDO::PARAM_STR);
        $incomesquery->execute();
        $incomes = $incomesquery->fetchAll(PDO::FETCH_ASSOC);

        $incomesumquery = $db->prepare('SELECT
                                            incomes_category_assigned_to_users.name,
                                            SUM(incomes.amount) AS sum
                                        FROM incomes
                                            INNER JOIN users ON users.id = incomes.user_id
                                            INNER JOIN incomes_category_assigned_to_users ON
                                                       incomes_category_assigned_to_users.user_id = users.id AND
                                                       incomes_category_assigned_to_users.id = incomes.income_category_assigned_to_user_id
                                        WHERE incomes.user_id = :user_id AND
                                              incomes.date_of_income BETWEEN :date_begin AND :date_end
                                        GROUP BY incomes.income_category_assigned_to_user_id
                                        ORDER BY sum DESC');
        $incomesumquery->bindValue(':user_id', $_SESSION['logged_id'], PDO::PARAM_INT);
        $incomesumquery->bindValue(':date_begin', $date2, PDO::PARAM_STR);
        $incomesumquery->bindValue(':date_end', $date1, PDO::PARAM_STR);
        $incomesumquery->execute();
        $incomesums = $incomesumquery->fetchAll(PDO::FETCH_ASSOC);

        $expensesquery = $db->prepare('SELECT
                                        expenses.date_of_expense,
										payment_methods_assigned_to_users.name AS payment,
                                        expenses_category_assigned_to_users.name AS category,
                                        expenses.amount,
                                        expenses.expense_comment
                                      FROM expenses
                                        INNER JOIN users ON users.id = expenses.user_id
                                        INNER JOIN expenses_category_assigned_to_users ON expenses_category_assigned_to_users.id = expenses.expense_category_assigned_to_user_id
										INNER JOIN payment_methods_assigned_to_users ON payment_methods_assigned_to_users.id = expenses.payment_method_assigned_to_user_id
                                      WHERE expenses.user_id = :user_id AND
                                            expenses.date_of_expense BETWEEN :date_begin AND :date_end');
        $expensesquery->bindValue(':user_id', $_SESSION['logged_id'], PDO::PARAM_INT);
        $expensesquery->bindValue(':date_begin', $date2, PDO::PARAM_STR);
        $expensesquery->bindValue(':date_end', $date1, PDO::PARAM_STR);
        $expensesquery->execute();
        $expenses = $expensesquery->fetchAll(PDO::FETCH_ASSOC);

        $expensesumquery = $db->prepare('SELECT
                                            expenses_category_assigned_to_users.name,
                                            SUM(expenses.amount) AS sum
                                        FROM expenses
                                            INNER JOIN users ON users.id = expenses.user_id
                                            INNER JOIN expenses_category_assigned_to_users ON
                                                       expenses_category_assigned_to_users.user_id = users.id AND
                                                       expenses_category_assigned_to_users.id = expenses.expense_category_assigned_to_user_id
                                        WHERE expenses.user_id = :user_id AND
                                              expenses.date_of_expense BETWEEN :date_begin AND :date_end
                                        GROUP BY expenses.expense_category_assigned_to_user_id
                                        ORDER BY sum DESC');
        $expensesumquery->bindValue(':user_id', $_SESSION['logged_id'], PDO::PARAM_INT);
        $expensesumquery->bindValue(':date_begin', $date2, PDO::PARAM_STR);
        $expensesumquery->bindValue(':date_end', $date1, PDO::PARAM_STR);
        $expensesumquery->execute();
        $expensesums = $expensesumquery->fetchAll(PDO::FETCH_ASSOC);
		
		$incomessummary = $db->prepare('SELECT
											SUM(incomes.amount) AS total_sum
										FROM incomes
										WHERE incomes.user_id = :user_id AND
										incomes.date_of_income BETWEEN :date_begin AND :date_end
										ORDER BY incomes.id');
		$incomessummary->bindValue(':user_id', $_SESSION['logged_id'], PDO::PARAM_INT);
        $incomessummary->bindValue(':date_begin', $date2, PDO::PARAM_STR);
        $incomessummary->bindValue(':date_end', $date1, PDO::PARAM_STR);
        $incomessummary->execute();
			$totalSumOne = $incomessummary->fetch(PDO::FETCH_ASSOC);
			$sumOfIncomes = $totalSumOne['total_sum'];

		$exensessummary = $db->prepare('SELECT
											SUM(expenses.amount) AS total_sum
										FROM expenses
										WHERE expenses.user_id = :user_id AND
										expenses.date_of_expense BETWEEN :date_begin AND :date_end
										ORDER BY expenses.id');
		$exensessummary->bindValue(':user_id', $_SESSION['logged_id'], PDO::PARAM_INT);
        $exensessummary->bindValue(':date_begin', $date2, PDO::PARAM_STR);
        $exensessummary->bindValue(':date_end', $date1, PDO::PARAM_STR);
        $exensessummary->execute();
			$totalSumTwo = $exensessummary->fetch(PDO::FETCH_ASSOC);
			$sumOfExpenses = $totalSumTwo['total_sum'];
		
		

    } catch (PDOException $e) {
        echo "Błąd: " . $e->getMessage();
        error_log('PDOException: ' . $e->getMessage());
        $error_message = "Wystąpił błąd. Proszę spróbować później.";
    }
*/
    ?>-->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php echo e($title); ?> - Budżet domowy</title>

  <link rel="icon" type="image/png" sizes="32x32" href="./images/icons/coin.svg">
  <link rel="stylesheet" href="balance.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Castoro:ital@0;1&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
  <script src="balance.js" charset="utf-8"></script>
</body>

</html>