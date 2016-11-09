<?php 
include 'DataBaseAdaptor.php';

	
echo "hello";
	
if(isset($_POST['quote']) && isset($_POST['author'])){
	$myDatabaseFunctions->add($_POST['quote'], $_POST['author']);
}

if(isset($_POST['rateup'])){
	$myDatabaseFunctions->changeRatings('up');
	
}

if(isset($_POST['ratedown'])){
	$myDatabaseFunctions->changeRatings('down');
}

 header('Location: showQuotes.php');


?>