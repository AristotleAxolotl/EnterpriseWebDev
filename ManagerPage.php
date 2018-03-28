<?php 
session_start();
include 'DBConnection.php';
DBConnect();
?>
<!DOCTYPE HTML>
<html>
<head> 
	<!--chart code adapted from https://developers.google.com/chart/interactive/docs/quick_start -->
	
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {
        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
		data.addRows([
		<?php
		$total = getIdeaCount();
		$count = 0;
		while ($count!= count($total)){
		?>
          ['<?php echo $total[$count]; ?>', <?php echo $total[$count+1]; ?> ],
		<?php 
		$count++;
		$count++;
		} ?>
        ]);
		
        // Set chart options
        var options = {'title':'Number of Ideas in each department',
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {
        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Total Ideas');
		data.addRows([
		<?php
		$total = getIdeaCount();
		$count = 0;
		while ($count!= count($total)){
		?>
          ['<?php echo $total[$count]; ?>', <?php echo $total[$count+1]; ?> ],
		<?php 
		$count++;
		$count++;
		} ?>
        ]);
		
        // Set chart options
        var options = {'title':'Number of Ideas in each department',
                       'width':500,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div_Bar'));
        chart.draw(data, options);
      }
    </script>
    
    
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
                    <a class="nav-link active" href="index.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ideaSample.php">IDEAS</a>
                </li>
                <?php 
                      if ($_SESSION['login_user'] != null){
                ?>
                <form action ="logout.php" method="POST">
                    <button class="nav-link pull-right" type="submit" href="#">LOG OUT</button>
                  </form>
                <?php } else { ?>
                    <a class="nav-link pull-right" href="index.php">LOGIN</a>
                <?php } ?>    
            </ul>
         </div>
<h2>Managers Profile Page</h2>
<div class="container">
<div class="row">
<div class="col-sm-6">
          <div class="card card-div">
            <div class="card-block">
<p><b>The following section allows you to add a category</b></p>
	<form action="ManagerPage.php" method="post">
		Enter New Category Name: <input type="text" name="categoryName"><br><br>
		Enter New Category End Date: <input type="date" name="categoryDate"><br><br>
		<input type="submit" value="Add" class="btn btn-primary">
	</form>
<br>
<p><b>The following section allows you to delete a category</b></p>
	<form action="ManagerPage.php" method="post">
		Enter Category ID: <input type="text" name="categoryID"><br><br>
		<input type="submit" value="Delete" class="btn btn-primary">
	</form>
<br>
<br>
</div>	
</div>	
</div>
	<div class="col-sm-6">
          <div class="card card-div">
            <div class="card-block">
<p><b>The following section allows you to edit an existing category</b></p>
	<form action="ManagerPage.php" method="post">
		Enter Category ID: <input type="text" name="editCategoryID"><br><br>
		Enter New Category Name: <input type="text" name="editCategoryName"><br><br>
		Enter New Category Date: <input type="date" name="editCategoryDate"><br><br>
		<input type="submit" value="Update" class="btn btn-primary">
		<br><br><br><br><br><br><br>
    </form>
</div>
</div>
</div>
</div>
<p><b>The following table shows all categories currently avaliable</b></p>
	<table align="center">
	  <tr>
		<th>Category ID</th>
		<th>Category Name</th>
		<th>End Date</th>
	  </tr>
	<?php
	error_reporting(E_ERROR | E_PARSE);
	$ID = $_POST["categoryID"];
	$Name = $_POST["categoryName"];
	$Date = $_POST["categoryDate"];
	$date=date("Y-m-d",strtotime($Date));
	$ID = $_POST["categoryID"];
	$IDEdit = $_POST["editCategoryID"];
	$NameEdit = $_POST["editCategoryName"];
	$DateEdit = $_POST["editCategoryDate"];
	$dateEdit=date("Y-m-d",strtotime($DateEdit));
	
	if ($Name != null && $Date != null){
		if (insertCategory($Name, $date) == true){
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
	
	if ($IDEdit != null || $DateEdit != null){
		if (updateCategory($IDEdit, $NameEdit, $dateEdit) == true){
			echo "The category ID that you entered has been successfully updated, please look at the table below for an updated list of all of the avaliable categories.";
		} else {
			echo "There was a error updating the given category";
		}
	}
	$categoriesID = getCategoriesID();
	$categoriesType = getCategoriesType();
	$categoriesDate = getCategoriesDate();
	$count = 0;
	foreach ($categoriesID as $categoryID){
			echo "<tr><td>$categoryID</td>";
			echo "<td>$categoriesType[$count]</td>";
			echo "<td>$categoriesDate[$count]</td></tr>";
			$count++;
	}
	DBClose();
	?>
	</table>
	</div>
	<!--Div that will hold the pie chart-->
<div style="display: inline-block" id="chart_div"></div>
<div style="display: inline-block" id="chart_div_Bar"></div>
</div>
</body>
</html>
