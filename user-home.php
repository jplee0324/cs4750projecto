<?php
require('connectdb.php');
require('db-commands.php');
?>

<?php
$msg = '';
$event_to_update = '';

if (!empty($_POST['db-btn']))
{
   if ($_POST['db-btn'] == "Transfer")
   {
      if (!empty($_POST['name']) && !empty($_POST['description'])){
         addEvent($_POST['name'], $_POST['description'], $_COOKIE['pwd']);
         $msg = "Successfully entered!!";
      }
      else 
         $msg = "Enter event information to create a new event";
   }
   else if($_POST['db-btn'] == "Send")  
   {
      if (!empty($_POST['name']) && !empty($_POST['description']))
         updateEventInfo($_POST['name'], $_POST['description'], $_COOKIE['pwd']);
      else
         $msg = "Enter event information to update";
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

$events = getAllSpecificEvents($_COOKIE['pwd']);
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
            Recipient Name:
            <input type="text" class="form-control" name="name" />        
          </div>  
          <div class="form-group">
            Amount:
            <input type="text" class="form-control" name="description"/>        
          </div>  
          
          <div class="form-group">
            <input type="submit" value="Transfer" class="btn btn-dark" name="db-btn" title="Insert event into table"/>
            <input type="submit" value="Send" class="btn btn-dark" name="db-btn" title="Update 'events' info" />
            <small class="text-danger"><?php echo $msg ?></small>
          </div>  
        </form>
      </div>
    </div>
    <div id="bottomhalf">
    </table>
    
  </body>
</html>
