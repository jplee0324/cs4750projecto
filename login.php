<?php
//John Ramirez, jr5xw
//Reeya Rabena, rvr2fg
require('connectdb.php');
require('db-commands.php');
?>

<html>
  <head>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="login.css" />
    <script src="login.js"></script>
  </head>
  <body>
    <section id="login">
      <h1>INVITE UP</h1>
      <h5>Log in to start making events and inviting your friends</h5>

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="onClickMe()">
      First Name: <input type="text" name="firstName" class="form-control" autofocus required /> <br/>
      Last Name: <input type="text" name="lastName" class="form-control" autofocus required /> <br/>
      Password: <input type="password" name="pwd" class="form-control" required /> <br/>
      <input type="submit" value="Sign In/Sign Up" class="btn btn-light"  />   
    </form>
    </section>


  <?php
    session_start();
  ?>

  <?php
    function reject($entry)
    {
      echo "Reject $entry <br/>";	
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST" && strlen($_POST['firstName']) > 0)
    {
      $first = trim($_POST['firstName']);
      $last = trim($_POST['lastName']);
      if (!ctype_alnum($first) && !ctype_alnum($last)) // checks for only alphanumeric
        reject('User Name');

      if (isset($_POST['pwd']))
      {
        $password = trim($_POST['pwd']);
        if (!ctype_digit($password)){
          reject(': Password needs to be non-zero digits');
        }
        else
        {
          setcookie('firstName', $first, time()+3600);
          setcookie('lastName', $last, time()+3600);
         
          setcookie('pwd', $password, time()+3600);

          $_SESSION['firstName'] = $first;
          $_SESSION['lastName'] = $last;
          $_SESSION['password'] = $password;

          insertUser($password,$first, $last);

          header('Location: user-home.php');

        }
      }
    } 
  ?>


  </body>
</html>
