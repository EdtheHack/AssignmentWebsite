<?php

	function getNewestItems($itemNumber){
	include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');
		$query = "SELECT * FROM product ORDER BY price DESC;";
		
		if ($result = mysqli_query($db_con, $query)) {		//getting array of rows
			$rows = array();
			while($row = $db_con->mysqli_fetch_assoc($query))
				{
					$rows[] = $row;
				}
			return $rows[$itemNumber];
		}
	}
	
?>