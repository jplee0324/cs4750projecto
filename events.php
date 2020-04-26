<?php
require('connectdb.php');
require('db-commands.php');
?>

<?php
$events = getAllEvents();
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
      <h1>INVITE UP</h1>
      <nav>
        <a href="/webpl-project/logout.php">Log Out</a>
        <a href="/webpl-project/events.php" class="active">Events</a>
        <a href="/webpl-project/user-home.php"><?php echo $_COOKIE['firstName'] ?> <?php echo $_COOKIE['lastName'] ?></a>
      </nav>
      <div id="middle"></div>
    </div>
    <div id="bottomhalf">
      <h3 style="padding: 10px;">Events Attending</h3>
      <div class="card-deck">
      <?php foreach ($events as $event): ?>
  <div class="card">
    
    <div class="card-body">
      <h5 class="card-title"><?php echo $event['name']; ?> </h5>
      <p class="card-text"><?php echo $event['description']; ?> </p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <?php endforeach; ?>
</div>
      <h3 style="padding: 10px;">Events Your Friends Created</h3>
      <div class="card-deck">
      <?php foreach ($events as $event): ?>
  <div class="card">
    
    <div class="card-body">
      <h5 class="card-title"><?php echo $event['name']; ?> </h5>
      <p class="card-text"><?php echo $event['description']; ?> </p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <?php endforeach; ?>
</div>
    </div>
  </body>
</html>
