<?php
class DatabaseAdaptor {
	// the instance variable used in every one of the functions in class Database Adapator
	private $DB;
	
	// make a connection to an existing data based named 'quotes' that has table quotations
	public function __construct() {
		$db = 'mysql:dbname=quotes;host=127.0.0.1';
		$user = 'root';
		$password = '';
		
		try {
			$this->DB = new PDO ( $db, $user, $password );
			$this->DB->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		} catch ( PDOException $e ) {
			echo ('Rick writes: Error establising Connection!!!!');
			exit ();
		}
	}
	public function getQuotesAsArray() {
		$stmt = $this->DB->prepare ( "SELECT * FROM quotations" );
		$stmt->execute ();
		return $stmt->fetchAll ( PDO::FETCH_ASSOC );
	}
	public function add($quote, $author) {
		$stmt = $this->DB->prepare ( "INSERT INTO quotations (dateAdded, quotation, author, likes) values(now(), :quote, :author, 0)" );
		$stmt->bindParam ( 'quote', $quote );
		$stmt->bindParam ( 'author', $author );
		
		$stmt->execute ();
	}
	public function changeRatings($val) {
		try {
			//$stmt = $this->DB->prepare ( "SELECT * FROM quotations" );
				
			$id = $_POST ["rate"];
			$id = rtrim($id,"/");
			
			if($val == 'up'){
				
				$sql = "UPDATE quotations SET likes=likes+1 WHERE id=" . $id . ";";
			}
			else{
				$sql = "UPDATE quotations SET likes=likes-1 WHERE id=" . $id;
			}
			
			$stmt = $this->DB->prepare ( $sql );
			
			$stmt->execute ();
		} catch ( PDOException $e ) {
			echo $sql . "<br>" . $e->getMessage ();
		}
		
		$stmt = null;
	}
	
	public function getID($date, $quote, $author, $likes){
		
		$stmt = $this->DB->prepare ( "SELECT id, dateAdded, quotation, author, likes FROM quotations WHERE dateAdded= '" . $date . "' AND quotation= '" . $quote . "' AND author= '" . $author . "' AND likes= '" . $likes . "';");
		$stmt->execute ();
		$user_data = $stmt->fetch();
		
		$id = $user_data['id'];
		return $id;
		
	}

	
	public function getQuotesAsArraySorted() {
		$stmt = $this->DB->prepare ( "SELECT dateAdded, quotation, author, likes FROM quotations ORDER BY likes DESC, dateAdded ASC;" );
		$stmt->execute ();
		return $stmt->fetchAll ( PDO::FETCH_ASSOC );
	}
}

// test code can only be used temporarily here
$myDatabaseFunctions = new DatabaseAdaptor ();
$array = $myDatabaseFunctions->getQuotesAsArray ();
// foreach ( $array as $record ) {
// echo [
// 'id'
// ] . ' ' . $record ['dateAdded'] . ' ' . $record ['quote'] . PHP_EOL;
// }

?>