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
	
   $query = "INSERT INTO users (userID, firstName, lastName) VALUES (:userID, :firstName, :lastName)";

   $statement = $db->prepare($query);
   $statement->bindValue(':userID', $userID);
   $statement->bindValue(':firstName', $firstName);
   $statement->bindValue(':lastName', $lastName);
   $statement->execute();     // if the statement is successfully executed, execute() returns true
   // false otherwise
		
   $statement->closeCursor();
}

function getNonUserEvents($userID)
{
   global $db;
   $query = "select * from friends";
   $statement = $db->prepare($query);
   $statement->execute();
	
   // fetchAll() returns an array for all of the rows in the result set
   $results = $statement->fetchAll();
	
   // closes the cursor and frees the connection to the server so other SQL statements may be issued
   $statement->closecursor();
	
   return $results;
}


function getAllEvents()
{
   global $db;
   $query = "select * from events";
   $statement = $db->prepare($query);
   $statement->execute();
	
   // fetchAll() returns an array for all of the rows in the result set
   $results = $statement->fetchAll();
	
   // closes the cursor and frees the connection to the server so other SQL statements may be issued
   $statement->closecursor();
	
   return $results;
}


function addEvent($name, $description, $userID)
{
   global $db;
	
   $query = "INSERT INTO events (name, description, userID) VALUES (:name, :description, :userID)";

   $statement = $db->prepare($query);
   $statement->bindValue(':name', $name);
   $statement->bindValue(':description', $description);
   $statement->bindValue(':userID', $userID);
   $statement->execute();     // if the statement is successfully executed, execute() returns true
   // false otherwise
		
   $statement->closeCursor();
}


function updateEventInfo($name, $description, $userID)
{
   global $db;

   $query = "UPDATE events SET description=:description, userID=:userID WHERE name=:name";
   $statement = $db->prepare($query);
   $statement->bindValue(':name', $name);
   $statement->bindValue(':description', $description);
   $statement->bindValue(':userID', $userID);
   $statement->execute();
   $statement->closeCursor();
}


function deleteEvent($name)
{
   global $db;
	
   $query = "DELETE FROM events WHERE name=:name";
   $statement = $db->prepare($query);
   $statement->bindValue(':name', $name);
   $statement->execute();
   $statement->closeCursor();
}
?>

