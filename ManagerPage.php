<!DOCTYPE HTML>
<html>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
</style>  
<body>

<?php
include 'DBConnection.php';
?>
<h1>Managers Profile Page</h1>
<br>
<p>The following section allows you to add a new category</p>
<form action="ManagerProcess.php" method="post">
Enter New Category Name: <input type="text" name="categoryName"><br>
<input type="submit">
<br>
<p>The following table shows all categories currently avaliable</p>
<table ">
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
<br>
<p>The following section allows you to remove a cateogry</p>
<form action="ManagerProcess.php" method="post">
Enter Category ID: <input type="text" name="categoryID"><br>
<input type="submit">
</form>

</body>
</html>



