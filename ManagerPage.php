<!DOCTYPE HTML>
<html>
<head>
        <title>Manager Profile Page</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">   
        <link rel="stylesheet" type="text/css" href="entweb.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
</head>  
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
	padding: 10px;
	width: 50%;
	text-align: center;
}
</style>
<body>

<div> 
            <ul class="nav nav-pills nav-fill nav-div">
                <!-- <li class="nav-item">
                    <a class="navbar-brand" href="#">Greenwich</a> 
                </li> -->
                <li class="nav-item">
                    <a class="nav-link active" href="#">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">IDEAS</a>
                </li>
                <li class="nav-item pull-right">
                    <a class="nav-link" href="#">LOGIN</a>
                </li>     
            </ul>
         </div>


<?php
include 'DBConnection.php';
?>
<h2>Managers Profile Page</h2>

<div class="container">
<div class="container-background">
<p><b>The following section allows you to add or delete category</b></p>
	<form action="ManagerPage.php" method="post">
		Enter New Category Name: <input type="text" name="categoryName">
		<input type="submit" value="Add" class="btn btn-primary">
	</form>
<br>
	<form action="ManagerPage.php" method="post">
		Enter Category ID: <input type="text" name="categoryID">
		<input type="submit" value="Delete" class="btn btn-primary">
	</form>
<br><p><b>The following section allows you to edit an existing category</b></p>
	<form action="ManagerPage.php" method="post">
		Enter Category ID: <input type="text" name="editCategoryID"><br><br>
		Enter New Category Name: <input type="text" name="editCategoryName">
		<input type="submit" value="Update" class="btn btn-primary">
<br>
<br>
<p><b>The following table shows all categories currently avaliable</b></p>
	<table align="center">
	  <tr>
		<th>Category ID</th>
		<th>Category Name</th> 
	  </tr>
	<?php
	DBConnect();
	error_reporting(E_ERROR | E_PARSE);
	$ID = $_POST["categoryID"];
	$Name = $_POST["categoryName"];
	$ID = $_POST["categoryID"];
	$IDEdit = $_POST["editCategoryID"];
	$NameEdit = $_POST["editCategoryName"];
	
	if ($Name != null){
		if (insertCategory($Name) == true){
			echo "The category name that you entered has been successfully added, please look at the table below for an updated list of all of the avaliable categories.";
		} else {
			echo "There was a error adding the new category";
		}
	}
	
	if ($ID != null){
		if (deleteCategory($ID) == true){
			echo "The category ID that you entered has been successfully deleted, please look at the table below for an updated list of all of the avaliable categories.";
		} else {
			echo "There was a error deleting the given category";
		}
		
	}
	
	if ($IDEdit != null){
		if (updateCategory($IDEdit, $NameEdit) == true){
			echo "The category ID that you entered has been successfully updated, please lookmat the table below for an updated list of all of the avaliable categories.";
		} else {
			echo "There was a error updating the given category";
		}
	}
	$categoriesID = getCategoriesID();
	$categoriesType = getCategoriesType();
	$count = 0;
	foreach ($categoriesID as $categoryID){
			echo "<tr><td>$categoryID</td>";
			echo "<td>$categoriesType[$count]</td></tr>";
			$count++;
	}
	DBClose();
	?>
	</table>
</div>
</div>

</body>
</html>
