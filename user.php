<?php
include 'DBConnection.php';
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Nav Bar Examples</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="entweb.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    </head>
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
                    <button class="nav-link" type="submit" href="#">LOG OUT</button>
                  </form>
                </li>
            </ul>
          </div>
          <div class="inner cover">
            <h1 class="cover-heading">User Page</h1>
            <p class="lead subhead">Something about Greenwich idea thing.</p>
              <?php 
        if (getUserType($userName) == "1"){ ?>
            <p class="btn btn-primary"> <a href="https://stuweb.cms.gre.ac.uk/~cl7533q/WebDev/New%20site/ManagerDownloadPage.php">Download Page</a></p>
        <?php } ?>
			<p class="btn btn-primary"> <a href="http://stuweb.cms.gre.ac.uk/~cl7533q/WebDev/New%20site/CreateIdea.php">Add Idea</a></p>
          </div>
        </div>
            <script src="http://code.jquery.com/jquery-3.2.1.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			
	
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
	<?php $userName = $_SESSION['login_user'];
                if (getUserType($userName) == "0"){?>
	<div style="display: inline-block" id="chart_div"></div>
				<?php } 
				DBClose();
				?>
	
    </body>
</html>
