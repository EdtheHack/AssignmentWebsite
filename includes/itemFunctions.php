<?php

	function getNewestItem($itemNumber){
		include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');
		$query = "SELECT * FROM product ORDER BY price DESC;";
		
		if ($result = mysqli_query($db_con, $query)) {		//getting array of rows
			$rows = array();
			while($row = mysqli_fetch_array($result)) {
				$rows[] = $row;
			}
			return $rows[$itemNumber];
		}
	}
	
?>