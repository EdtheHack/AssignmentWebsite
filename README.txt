#************************************************************************#
#																		 #
#PLEASE WRITE CODING NOTES FOR ALL TO BE AWARE OF IN HERE PLEASE THANKYOU#
#																		 #
#************************************************************************#

====================
	STATUS CODES
====================

0 -> normal listed product (default)
1 -> listed and is a sale item 
2 -> not listed 


===================
   PRODUCT TABLE
===================

- product_id		 
- name	 
- price	
- description		 
- percentage_off
- status	 
- img		 
- stock	 
- date_added	  

===================
	PAGING
==================


$pageId = $_SERVER[ 'QUERY_STRING' ]; get the page id for example viewProducts.php?5 this means the productId is 5
		
$rows = getPage($pageId); get the rows received form the database based on the ID

rows can then be passed into the contructor for product like so 

$product = new product($rows[0], $rows[1], $rows[2], $rows[3], $rows[4], $rows[5], $rows[6], $rows[7], $rows[8]);