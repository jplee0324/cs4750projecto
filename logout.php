<?php
if (count($_COOKIE) > 0)
{
   foreach ($_COOKIE as $key => $value)
   {
   	  // Deletes the variable (array element) where the value is stored in this PHP.
   	  // However, the original cookie still remains intact in the browser.
   	  unset($_COOKIE[$key]);    
   	
      // To completely remove cookies from the client, set the expiration time to be in the past
      setcookie($key, '', time() - 3600);  
   }
   
   // redirect to the login page immediately
      header('Location: login.php');
}
?>