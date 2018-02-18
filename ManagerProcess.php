<html>
<head>
        <title>Manager Results Page</title>
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

<div class="Container">
<div class="container-background">
<h2>Categories Updated</h2>
<?php
	//error_reporting(E_ERROR | E_PARSE);
	include 'DBConnection.php';
	$Name = $_POST["categoryName"];
	$ID = $_POST["categoryID"];
	$IDEdit = $_POST["editCategoryID"];
	$NameEdit = $_POST["editCategoryName"];
	
	//DBConnect();
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
	DBClose();
	
?>

<table align="center">
	  <tr>
		<th>Category ID</th>
		<th>Category Name</th> 
	  </tr>
	<?php
	DBConnect();
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
