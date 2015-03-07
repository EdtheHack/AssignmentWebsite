<?php

	function getNewestItems($itemNumber){
	include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');
		$query = "SELECT * FROM product ORDER BY price DESC;";
		
		if ($result = mysqli_query($db_con, $query)) {		//getting array of rows
			$row = mysqli_fetch_row($result);
			
			echo $result[$itemNumber];
			echo $row["ROW: ".$itemNumber];
			
			return $row[$itemNumber];
		}
	}
	
?>