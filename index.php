<?php

/*
 * This file is the page manager. It is what will load the 'home' page
 *
 * by default. If a url argument contains ?mode=addQoute or ?mode=showQuotes,
 * a different HTML page will be loaded, one of which has a form. When
 * the form is submitted, the controller absorbs the form and redirects
 * back to here when this PHP code runs:
 *
 * header ( "Location: index.php" );
 *
 * This represents a Single Page Application (SPA) with two views.
 *
 * Authors: Rick Mercer and Hassanain Jamal
 */
if (isset ( $_GET ['mode'] )) {
	if ($_GET ['mode'] === 'new')
		require_once ("./addQuote.html");
} else // default
	require_once ("./showQuotes.php");
?>
