<ul class="pagination">
<?php 
	$prevPage = $currentPage-1;
	$nextPage = $currentPage+1;
	if ($currentPage > 1) {
		if(isset($_GET['category'])){ echo " <li><a href='{$_SERVER['PHP_SELF']}?currentPage=$prevPage&category=".$_GET['category']."'>&laquo;</a> </li>";} else {echo " <li><a href='{$_SERVER['PHP_SELF']}?currentPage=$prevPage'>&laquo;</a> </li>"; }
	}
	for ($i = 1; $i <= $pages; $i++) {
		if(isset($_GET['category'])){ echo " <li><a href='{$_SERVER['PHP_SELF']}?currentPage=$i&category=".$_GET['category']."'>".$i."</a> </li>";} else {echo " <li><a href='{$_SERVER['PHP_SELF']}?currentPage=$i'>".$i."</a> </li>"; }
	}
	if ($currentPage < $pages) {
		if(isset($_GET['category'])){ echo " <li><a href='{$_SERVER['PHP_SELF']}?currentPage=$nextPage&category=".$_GET['category']."'>&raquo;</a> </li>";} else {echo " <li><a href='{$_SERVER['PHP_SELF']}?currentPage=$nextPage'>&raquo;</a> </li>"; }
	}
?>
</ul>