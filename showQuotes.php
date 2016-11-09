<!-- katie pan -->

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
<title>Project 8</title>
<meta charset="utf-8" />
</head>
<body>


	<h1>Quotes</h1>

	<form action="./addQuote.html" method="post">
		<div class="addQuoteButton">
			<input type="hidden" name="mode" value="new" /> <input type="submit"
				name="add" value="Add Quotation" />

		</div>
	</form>

	<br>
	
	<?php
	require_once './DataBaseAdaptor.php';
	$arrayOfQuotes = $myDatabaseFunctions->getQuotesAsArraySorted();
	
	
	for($i = 0; $i < sizeof ( $arrayOfQuotes ); $i ++) {
		
		$quote = $arrayOfQuotes [$i] ['quotation'];
		$author = $arrayOfQuotes [$i] ['author'];
		$likes = $arrayOfQuotes [$i] ['likes'];
		$date = $arrayOfQuotes [$i] ['dateAdded'];
		
		echo "<div class='box'>
				<div class='quoteAuthorBox'>
					<div class='quotes'>" . $quote . "</div>
					<div class='author'>" . "-" . $author . "</div>
				</div>
				<div class='buttonLikesBox'>	
				<form action='./controller.php' method='post'>
					<div class='likes'>" . $likes . "</div>
					
						<input type='hidden' name='rate' value=" . $myDatabaseFunctions->getID($date, $quote, $author, $likes) . "/> 
						<input type='submit' name='rateup' value='+'/><br>
						<input type='submit' name='ratedown' value='-'/> 
						
					
					</div>
				</form>
			  </div><br>";
		
	}
	?>
</body>
</html>