<?php
include 'DBConnection.php';
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="entweb.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    </head>
	<style>
th, td {
    border: 1px solid grey;
    border-collapse: collapse;
	padding: 10px;
	text-align: center;
}
tr td:last-child, th:last-child {
border: none;
}
</style>
    <body class="home-bg">
        <div class="site-wrapper">
          <div>
            <ul class="nav nav-pills nav-fill">
                <!-- <li class="nav-item">
                    <a class="navbar-brand" href="#"><img src="Images/logo4.png"</a>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link active" href="#">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ideaSample.php">IDEAS</a>
                </li>
                <?php 
                $userName = $_SESSION['login_user'];
                if (getUserType($userName) == "1"){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="ManagerPage.php">MANAGER PAGE</a>
                </li>
                <?php } ?>
                <li class="nav-item pull-right">
                  <form action ="logout.php" method="POST">
                    <button class="nav-link btn" type="submit" href="#">LOG OUT</button>
                  </form>
                </li>
            </ul>
          </div>
          <div class="inner cover">
            <h1 class="cover-heading">Welcome back, <?php echo $userName; ?></h1>
            <p class="lead subhead">To Greenwich University Idea Submission Thing.</p>
			<b><p style="strong">Your last login was, <?php $result = getLastLogin($userName); echo $result[0]; setLastLogin($userName); ?></p></b>
              <?php 
        if (getUserType($userName) == "1"){ ?>
            <p class="btn btn-primary"> <a href="ideaSample.php">Download Page</a></p>
        <?php } ?>
        <?php if (getUserType($userName) != "0"){ ?>
			<p class="btn btn-primary"> <a href="CreateIdea.php">Add Idea</a></p>
        <?php } ?>
          </div>
        </div>
            <script src="http://code.jquery.com/jquery-3.2.1.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			
	<!--Sets up the google charts pie chart with the different ideas-->
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
		DBConnect();
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
                       'height':300,
					   backgroundColor: { fill:'transparent' }};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
	
	<!--Sets up the google charts pie chart with the different ideas-->
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
        data.addColumn('number', 'Ideas');
		data.addRows([
		<?php
		DBConnect();
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
                       'height':300,
					   backgroundColor: { fill:'transparent' }};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div_bar'));
        chart.draw(data, options);
      }
    </script>
	
<!--Checks if it is a admin user who has loaded the page-->
	<?php $userName = $_SESSION['login_user'];
                if (getUserType($userName) == "0"){?>
	<div>
		<div style="height 250px; width : 350px; background: white; border-radius:15px; margin: auto; margin-left: 250px; margin-top: 20px; padding-bottom: 20px; color: white; opacity: 0.85; display: table; float: left;">
			<span id="chart_div" ></span></div>
		<div style="height 250px; width : 350px; background: white; border-radius:15px; margin: auto; margin-right: 250px; margin-top: 20px; padding-bottom: 20px; color: white; opacity: 0.85; display: table; float: right;">
			<span id="chart_div_bar" ></span>
		</div>
	</div>
<!--Checks if it is a QA Manger who has loaded the page-->
				<?php } 
				if (getUserType($userName) == "1"){
				?>
            <div style="height 250px;
  width : 350px; background: black; border-radius:15px; margin: auto; margin-left: 20px; margin-top: 20px; padding-bottom: 20px; color: white; opacity: 0.85;">				
	<!--Displays the number of reported Ideas and provides links to the coresponding idea page-->
	<u><p>The following Ideas have been reported: </p></u>
	<table align="center">
	  <tr>
		<th>Idea Title</th>
		<th>Time Reported</th>
		<th></th>
	  </tr>
	<?php 
	$result = getReportedIdeas();
	if ($result[2] != 1){
		$count = 0;
		while ($count != count($result)){
			if ($result[$count+2] > 0){
				echo "<tr><td>" . $result[$count+1] . "</td>"; 
				echo "<td>" . $result[$count+2] . "</td>";
				?><td><a class="btn btn-primary" href="ideaPage.php?id=<?php echo $result[$count]?>">HOME</a></td></tr><?php
			}
			$count++;
			$count++;
			$count++;
		}
	} else {
		echo "There are no reported posts!";
	}
				} ?>
	<?php
	DBClose();
	?>
</div>
    </body>
</html>
