<?php
require('connectdb.php');
require('db-commands.php');
?>

<?php

$transactions = viewTransactions($_COOKIE['pwd']);

?>

<html>
  <head>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="events.css" />
  </head>
  <script type="text/javascript">
    function showMessage() {
      alert("Hello friends, this is message.");
    }
  </script>
  <body>
    <div id="tophalf">
      <nav>
        <h1>View Transactions</h1>
        <a href="/database-project/logout.php">Log Out</a>
        <a href="/database-project/friends.php">Friends</a>
        <a href="/database-project/pastTransactions.php">Transactions</a>
        <a href="/database-project/user-home.php" class="active"><?php echo $_COOKIE['firstName'] ?> <?php echo $_COOKIE['lastName'] ?></a>
      </nav>
      <div id="middle"></div>
    </div>
    <div id="bottomhalf">
      <h3 style="padding: 10px;">Past Transactions</h3>
      <a href="/database-project/transactionsToCSV.php">Get CSV</a>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Transaction ID</th>
            <th scope="col">Sender</th>
            <th scope="col">Recipient</th>
            <th scope="col">Amount</th>
            <th scope="col">Date</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($transactions as $transaction): ?>
            <tr>
              <th scope="row"><?php echo $transaction['transactionID']; ?></th>
              <td><?php echo $transaction['userID']; ?></td>
              <td><?php echo $transaction['recipient']; ?></td>
              <td><?php echo $transaction['amount']; ?></td>
              <td><?php echo $transaction['date']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>




    </div>
  </body>
</html>
