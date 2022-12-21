<?php

// Connect to database, require(database.php), defined (host, user, password and database)
function connect_db($host, $user, $pass, $db) {
	$connection = mysqli_connect($host, $user, $pass)
	or die("db selection problem1; " . mysqli_error());
	mysqli_select_db($connection, $db)
	or die("db selection problem2; " . mysqli_error());
	return $connection;
}

// Clean input strings ready for MYSQL query, stripslash and real_escape_string input text
function clean_strings($connection, $inText) {
	// Initialise	
    $outText = "";

    // Clean the input
    $outText = stripslashes($inText);
	$outText = mysqli_real_escape_string($connection, $outText);
    return trim($outText);

}

function clean_array($connection, $input) {
    
for ($i=0; $i < count($input); $i++) {
    
    $input[$i] = clean_strings($connection, $input[$i]);
}
    
return $input;   
    
}


?>