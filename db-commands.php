<?php 

function getAllSpecificEvents($userID)
{
   global $db;
   $query = "SELECT * FROM events WHERE userID=:userID";
   $statement = $db->prepare($query);
   $statement->bindValue(':userID', $userID);
   $statement->execute();
	
   // fetchAll() returns an array for all of the rows in the result set
   $results = $statement->fetchAll();
	
   // closes the cursor and frees the connection to the server so other SQL statements may be issued
   $statement->closecursor();
	
   return $results;
}

function insertUser($userID, $firstName, $lastName){
   global $db;
	
   $query = "INSERT INTO user (userID, firstName, lastName, balance) VALUES (:userID, :firstName, :lastName, :balance)";

   $statement = $db->prepare($query);
   $statement->bindValue(':userID', $userID);
   $statement->bindValue(':firstName', $firstName);
   $statement->bindValue(':lastName', $lastName);
   $statement->bindValue(':balance', 0.0);
   $statement->execute();     // if the statement is successfully executed, execute() returns true
   // false otherwise
		
   $statement->closeCursor();
}


// VIEW FUNCTIONS

function viewPersonalInfo($userID)
{
   global $db;

   $query = "SELECT * FROM user WHERE userID=:userID";
   $statement = $db->prepare($query);
   $statement->bindValue(':userID', $userID);
   $statement->execute();
	
   // fetchAll() returns an array for all of the rows in the result set
   $results = $statement->fetchAll();
	
   // closes the cursor and frees the connection to the server so other SQL statements may be issued
   $statement->closecursor();
	
   return $results;
}

function viewTransactions($userID)
{
   global $db;

   $query = "SELECT * FROM transactions WHERE userID=:userID OR recipient=:userID";
   $statement = $db->prepare($query);
   $statement->bindValue(':userID', $userID);
   $statement->execute();
	
   // fetchAll() returns an array for all of the rows in the result set
   $results = $statement->fetchAll(PDO::FETCH_ASSOC);
	
   // closes the cursor and frees the connection to the server so other SQL statements may be issued
   $statement->closecursor();
	
   return $results;
}

function viewFriends($userID)
{
   global $db;

   $query = "SELECT 
               friends.friendID friendID, 
               user.firstName firstName, 
               user.lastName lastName
            FROM friends
            LEFT JOIN user ON user.userID = friends.friendID
            WHERE friends.userID = :userID";

   $statement = $db->prepare($query);
   $statement->bindValue(':userID', $userID);
   $statement->execute();
	
   // fetchAll() returns an array for all of the rows in the result set
   $results = $statement->fetchAll();
	
   // closes the cursor and frees the connection to the server so other SQL statements may be issued
   $statement->closecursor();
	
   return $results;
}

function viewBlocked($userID)
{
   global $db;

   $query = "SELECT 
               blocked.blockedID blockedID, 
               user.firstName firstName, 
               user.lastName lastName
            FROM friends
            LEFT JOIN user ON user.userID = friends.friendID
            WHERE blocked.userID = :userID";

   $statement = $db->prepare($query);
   $statement->bindValue(':userID', $userID);
   $statement->execute();
	
   // fetchAll() returns an array for all of the rows in the result set
   $results = $statement->fetchAll();
	
   // closes the cursor and frees the connection to the server so other SQL statements may be issued
   $statement->closecursor();
	
   return $results;
}


# BALANCE INTERACTION

function depositBalance($userID, $amount)
{
   global $db;

   $query = "UPDATE user
	         SET balance  = balance + :amount
	         WHERE userID = :userID";

   $statement = $db->prepare($query);
   $statement->bindValue(':userID', $userID);
   $statement->bindValue(':amount', $amount);
   $statement->execute();     
   // if the statement is successfully executed, execute() returns true
   // false otherwise
   
   $statement->closeCursor();
}

function withdrawBalance($userID, $amount)
{
   global $db;

   //Subtracts amount from the user who sent the money and updates balance of recipient
   $query = "SELECT balance FROM user WHERE userID=:userID";
   $statement = $db->prepare($query);
   $statement->bindValue(':userID', $userID);
   $statement->execute();

   $senderAmount = $statement->fetch();
	

   $statement->closecursor();

   $senderNewBalance = floatval($senderAmount['balance']) - floatval($amount);

   if($senderNewBalance >= 0){

   $query = "UPDATE user
	         SET balance  = balance - :amount
	         WHERE userID = :userID";

   $statement = $db->prepare($query);
   $statement->bindValue(':userID', $userID);
   $statement->bindValue(':amount', $amount);
   $statement->execute();     
   // if the statement is successfully executed, execute() returns true
   // false otherwise
   
   $statement->closeCursor();
   }else{
      echo '<script>alert("You cannot withdraw money greater than your balance!")</script>';
   }
}

function sendTransaction($userID, $recipient, $amount){
   global $db;
	
   $query = "INSERT INTO transactions (userID, recipient, amount, date) VALUES (:userID, :recipient, :amount, :date)";

   $statement = $db->prepare($query);
   $statement->bindValue(':userID', $userID);
   $statement->bindValue(':recipient', $recipient);
   $statement->bindValue(':amount', $amount);
   $statement->bindValue(':date', date("Y-m-d h:i:sa"));
   $statement->execute();     // if the statement is successfully executed, execute() returns true
   // false otherwise
		
   $statement->closeCursor();
}




// ADD/REMOVE FROM FRIENDS/BLOCKED LIST FUNCTIONS

function addFriend($userID, $friendID)
{
   global $db;

   $query = "INSERT INTO friends 
            VALUES (:userID, :friendID)";

   $statement = $db->prepare($query);
   $statement->bindValue(':userID', $userID);
   $statement->bindValue(':friendID', $friendID);
   $statement->execute();     
   // if the statement is successfully executed, execute() returns true
   // false otherwise
   
   $statement->closeCursor();
}

function addblocked($userID, $blockedID)
{
   global $db;

   $query = "INSERT INTO blocked 
            VALUES (:userID, :blockedID)";

   $statement = $db->prepare($query);
   $statement->bindValue(':userID', $userID);
   $statement->bindValue(':blockedID', $blockedID);
   $statement->execute();     
   // if the statement is successfully executed, execute() returns true
   // false otherwise
   
   $statement->closeCursor();
}

function removeFriend($userID, $friendID)
{
   global $db;

   $query = "DELETE FROM friends
	         WHERE userID = :userID AND friendID = :friendID";

   $statement = $db->prepare($query);
   $statement->bindValue(':userID', $userID);
   $statement->bindValue(':friendID', $friendID);
   $statement->execute();     
   // if the statement is successfully executed, execute() returns true
   // false otherwise
   
   $statement->closeCursor();
}

function removeBlocked($userID, $blockedID)
{
   global $db;

   $query = "DELETE FROM blocked
	         WHERE userID = :userID AND blockedID = :blockedID";

   $statement = $db->prepare($query);
   $statement->bindValue(':userID', $userID);
   $statement->bindValue(':blockedID', $blockedID);
   $statement->execute();     
   // if the statement is successfully executed, execute() returns true
   // false otherwise
   
   $statement->closeCursor();
}

function getBalance($userID){
   global $db;
   $query = "SELECT balance FROM user WHERE userID=:userID";
   $statement = $db->prepare($query);
   $statement->bindValue(':userID', $userID);
   $statement->execute();

   $result = $statement->fetch();
	
   // closes the cursor and frees the connection to the server so other SQL statements may be issued
   $statement->closecursor();
	
   return $result;
}

function sendMoney($firstName, $lastName, $amount, $userID){
   global $db;

   //Subtracts amount from the user who sent the money and updates balance of recipient
   $query = "SELECT balance FROM user WHERE userID=:userID";
   $statement = $db->prepare($query);
   $statement->bindValue(':userID', $userID);
   $statement->execute();

   $senderAmount = $statement->fetch();
	

   $statement->closecursor();

   $senderNewBalance = floatval($senderAmount['balance']) - floatval($amount);

   if($senderNewBalance >= 0){

   $query2 = "UPDATE user SET balance=:senderNewBalance WHERE userID=:userID";
   $statement2 = $db->prepare($query2);
   $statement2->bindValue(':senderNewBalance', $senderNewBalance);
   $statement2->bindValue(':userID', $userID);
   $statement2->execute();
   $statement2->closeCursor();
   
   //Totals up and updates balance of the recipient
   $query3 = "SELECT balance, userID FROM user WHERE firstName=:firstName AND lastName=:lastName";
   $statement3 = $db->prepare($query3);
   $statement3->bindValue(':firstName', $firstName);
   $statement3->bindValue(':lastName', $lastName);
   $statement3->execute();

   $recipient = $statement3->fetch();
	

   $statement3->closecursor();

   $total = floatval($recipient['balance']) + floatval($amount);


   $query4 = "UPDATE user SET balance=:total WHERE firstName=:firstName AND lastName=:lastName";
   $statement4 = $db->prepare($query4);
   $statement4->bindValue(':firstName', $firstName);
   $statement4->bindValue(':lastName', $lastName);
   $statement4->bindValue(':total', $total);
   $statement4->execute();
   $statement4->closeCursor();

   //Update the transaciton table
   $query5 = "INSERT INTO transactions (userID, recipient, amount, date) VALUES (:userID, :recipient, :amount, :date)";
   $statement5 = $db->prepare($query5);
   $statement5->bindValue(':userID', $userID);
   $statement5->bindValue(':recipient', $recipient['userID']);
   $statement5->bindValue(':amount', floatval($amount));
   $statement5->bindValue(':date', date("Y-m-d"));
   $statement5->execute();
   $statement5->closeCursor();

   echo '<script>alert("Money successfully sent!")</script>';
   }else{
      echo '<script>alert("You cannot send money greater than your balance!")</script>';
   }
}



?>