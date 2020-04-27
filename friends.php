<?php
require('connectdb.php');
require('db-commands.php');
?>

<?php
$msg = '';
$friends = viewFriends($_COOKIE['pwd']);
$blocked = viewBlocked($_COOKIE['pwd']);

if (!empty($_POST['db-btn']))
{
   if($_POST['db-btn'] == "Add Friend")  {

      if (!empty($_POST['firstName']) && !empty($_POST['lastName'])){
        addFriend($_COOKIE['pwd'], $_POST['firstName'], $_POST['lastName']);
      }
      else
         $msg = "Enter friends first and last name";

   } else if($_POST['db-btn'] == "Block User") {

      if (!empty($_POST['firstName']) && !empty($_POST['lastName'])){
        addBlocked($_COOKIE['pwd'], $_POST['firstName'], $_POST['lastName']);
      }
      else
        $msg = "Enter user to block's first and last name";

   } else if($_POST['db-btn'] == "Remove Friend") {

      if (!empty($_POST['firstName']) && !empty($_POST['lastName'])){
        removeFriend($_COOKIE['pwd'], $_POST['firstName'], $_POST['lastName']);
      }
      else
        $msg = "Enter friends first and last name";

   } else if($_POST['db-btn'] == "Unblock User") {

      if (!empty($_POST['firstName']) && !empty($_POST['lastName'])){
        removeBlocked($_COOKIE['pwd'], $_POST['firstName'], $_POST['lastName']);
      }
      else
        $msg = "Enter user to unblock's first and last name";
  } 
}
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
        <h1>Friends & Blocked Users</h1>
        <a href="/database-project/logout.php">Log Out</a>
        <a href="/database-project/friends.php">Friends</a>
        <a href="/database-project/pastTransactions.php">Transactions</a>
        <a href="/database-project/user-home.php" class="active"><?php echo $_COOKIE['firstName'] ?> <?php echo $_COOKIE['lastName'] ?></a>
      </nav>
      <div id="middle"></div>
    </div>
    <div id="bottomhalf">
      <h3 style="padding: 10px;">Friends</h3>


      <form class = "form-inline" action="friends.php" method="post">
          <h5 style="padding: 10px;">Remove Friend</h5>
          <div class="form-group">
            <input type="text" class="form-control" name="firstName" placeholder="First Name">        
          </div>  
          <div class="form-group">
            <input type="text" class="form-control" name="lastName" placeholder="Last Name">        
          </div>  
          <div class="form-group">
            <input type="submit" value="Remove Friend" class="btn btn-dark" name="db-btn" title="Remove user from friends list" />
          </div>  
      </form>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($friends as $friend): ?>
            <tr>
              <td><?php echo $friend['fFirstName']; ?></td>
              <td><?php echo $friend['fLastName']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      

      <form class = "form-inline" action="friends.php" method="post">
          <h5 style="padding: 10px;">Add a Friend</h5>
          <div class="form-group">
            <input type="text" class="form-control" name="firstName" placeholder="First Name">        
          </div>  
          <div class="form-group">
            <input type="text" class="form-control" name="lastName" placeholder="Last Name">        
          </div>  
          <div class="form-group">
            <input type="submit" value="Add Friend" class="btn btn-dark" name="db-btn" title="Add user to friends list" />
          </div>  
      </form>
      
      </br>


      <h3 style="padding: 10px;">Blocked</h3>

      <form class = "form-inline" action="friends.php" method="post">
          <h5 style="padding: 10px;">Remove Friend</h5>
          <div class="form-group">
            <input type="text" class="form-control" name="firstName" placeholder="First Name">        
          </div>  
          <div class="form-group">
            <input type="text" class="form-control" name="lastName" placeholder="Last Name">        
          </div>  
          <div class="form-group">
            <input type="submit" value="Unblock User" class="btn btn-dark" name="db-btn" title="Remove user from blocked list" />
          </div>  
      </form>

      <table class="table">
        <thead>
          <tr>
          <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($blocked as $block): ?>
            <tr>
              <td><?php echo $block['bFirstName']; ?></td>
              <td><?php echo $block['bLastName']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <form class = "form-inline" action="friends.php" method="post">
          <h5 style="padding: 10px;">Block a User</h5>
          <div class="form-group">
            <input type="text" class="form-control" name="firstName" placeholder="First Name">        
          </div>  
          <div class="form-group">
            <input type="text" class="form-control" name="lastName" placeholder="Last Name">        
          </div>  
          <div class="form-group">
            <input type="submit" value="Block User" class="btn btn-dark" name="db-btn" title="Add user to blocked list" />
          </div>  
      </form>



    </div>
  </body>
</html>
