<?php
	include 'DBConnection.php';
	$Name = $_POST["categoryName"];
	$ID = $_POST["categoryID"];
	
	DBConnect();
	if ($Name != null){
		if (insertCategory($Name) == true){
			echo "New category has been created";
		} else {
			echo "There was a error adding the new category";
		}
	}
	
	if ($ID != null){
		if (deleteCategory($ID) == true){
			echo "Category has been correctly deleted";
		} else {
			echo "There was a error deleting the given category";
		}
		
	}
	DBClose();
	
?>