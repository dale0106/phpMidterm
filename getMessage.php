<?php
// Check if the correct get request has been recieved signaling what message number to start the selection from
if(isset($_GET["getMessagesAfterLine"]))
{
	// Make empty variable to hold the response to echo back to user
	$respondText="";
	
	// Create a variable that holds the SELECT query
   $sqlQuery =  SELECT 'message_id', 'message_text', 'time_stamp' FROM `messages` WHERE 'message_id' > '$_GET["getMessagesAfterLine"]';
	
	// Create PDO login credentials for host, db name, user name, and user password
        $db_host = "localhost";
        $db_name = "messages";
        $db_user = "root";
        $db_password = "root";
	
	// Connect to mySQL DB with a PDO connection
    $pdo_link = new PDO("mysql:host = $db_host; dbname = $db_name" ,$db_user, $db_password);
	
	// Query the DB with the SELECT query and store the results
    $result = $pdo_link->query($sqlQuery);
	
	// Close link to PDO connection
    $pdo_link = NULL;
	
	// Check if the results is set to something
    if ($result)	
    {
    // Store all the results in an array using the fetchAll() set to fech a numeric array
      $fetchedArray = fetchAll(PDO::FETCH_NUM) ) 
    // Encode the array as JSON data   
      $respondText = json_encode($fetchedArray);
    //   echo $newVar;      
    }
    
    // Else, if the results were not set then set a response message
    else
    {
        echo "That didnt work.";
        
    }
			    
	
	// echo the response text to the user
	echo $respondText;
}

?>
