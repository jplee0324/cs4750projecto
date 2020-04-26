<?php
require('connectdb.php');
require('db-commands.php');
?>

<?php
$msg = '';
$event_to_update = '';

if (!empty($_POST['db-btn']))
{
   if ($_POST['db-btn'] == "Insert")
   {
      if (!empty($_POST['name']) && !empty($_POST['description'])){
         addEvent($_POST['name'], $_POST['description'], $_COOKIE['pwd']);
         $msg = "Successfully entered!!";
      }
      else 
         $msg = "Enter event information to create a new event";
   }
   else if($_POST['db-btn'] == "Update Event")  
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
      <h1>INVITE UP</h1>
      <nav>
        <a href="/webpl-project/logout.php">Log Out</a>
        
        <a href="/webpl-project/events.php">Events</a>
        <a href="/webpl-project/user-home.php" class="active"><?php echo $_COOKIE['firstName'] ?> <?php echo $_COOKIE['lastName'] ?></a>
      </nav>
      <div id="middle">
        <h3>Invitations made easy</h3>
        <h5>Make an event and invite your friends to it.</h5>
        <form action="user-home.php" method="post">
          <div class="form-group">
            Event Name:
            <input type="text" class="form-control" name="name" />        
          </div>  
          <div class="form-group">
            Description:
            <input type="text" class="form-control" name="description"/>        
          </div>  
          
          <div class="form-group">
            <input type="submit" value="Insert" class="btn btn-dark" name="db-btn" title="Insert event into table"/>
            <input type="submit" value="Update Event" class="btn btn-dark" name="db-btn" title="Update 'events' info" />
            <small class="text-danger"><?php echo $msg ?></small>
          </div>  
        </form>
      </div>
    </div>
    <div id="bottomhalf">
    </table>
      <h3>Events Created By You</h3>
      <div class="card-deck">
      
      <?php foreach ($events as $event): ?>
  <div class="card">

    <div class="card-body">
      <h5 class="card-title" id=<?php echo $event['name']; ?>><?php echo $event['name']; ?> </h5>
      <p class="card-text"><?php echo $event['description']; ?> </p>
      <form action="user-home.php" method="post">
            <input type="submit" value="Delete" name="action" class="btn btn-danger" />      
            <input type="hidden" name="name" value="<?php echo $event['name'] ?>" />
          </form>
    </div>
  </div>
  <?php endforeach; ?>
</div>
    
  </body>
</html>
