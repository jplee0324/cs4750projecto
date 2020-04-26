<?php
require('connectdb.php');
require('db-commands.php');
?>

<?php
$msg = '';
$event_to_update = '';

if (!empty($_POST['db-btn']))
{
   if($_POST['db-btn'] == "Send Money")  
   {
      if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['amount'])){
         updateUserBalance($_POST['firstName'], $_POST['lastName'], $_POST['amount'], $_COOKIE['pwd']);
      }
      else
         $msg = "Enter payment information to send";
   }
}

if (!empty($_POST['action']))
{
   if ($_POST['action'] == "Delete")
   {
      if (!empty($_POST['name']) )
         deleteEvent($_POST['name']);
   }
}

$balance = getBalance($_COOKIE['pwd']);

?>

<html>
  <head>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="user-home.css" />
  </head>
  <body>
    <div id="tophalf">
      
      <nav>
      <h1>Payment!</h1>
        <a href="/database-project/logout.php">Log Out</a>
        <a href="/database-project/events.php">Friends</a>
        <a href="/database-project/pastTransactions.php">Transactions</a>
        <a href="/database-project/user-home.php" class="active"><?php echo $_COOKIE['firstName'] ?> <?php echo $_COOKIE['lastName'] ?></a>
      </nav>
      <div id="middle">
        <h3>Current Balance: $<?php echo $balance['balance'] ?></h3>
        <h5>Make a payment:</h5>
        <form action="user-home.php" method="post">
          <div class="form-group">
            Recipient First Name:
            <input type="text" class="form-control" name="firstName" />        
          </div>  
          <div class="form-group">
            Recipient Last Name:
            <input type="text" class="form-control" name="lastName" />        
          </div>  
          <div class="form-group">
            Amount:
            <input type="text" class="form-control" name="amount"/>        
          </div>  
          
          <div class="form-group">
            <input type="submit" value="Send Money" class="btn btn-dark" name="db-btn" title="Update 'events' info" />
            <small class="text-danger"><?php echo $msg ?></small>
          </div>  
        </form>
      </div>
    </div>
    <div id="bottomhalf">
    </table>
    
  </body>
</html>
