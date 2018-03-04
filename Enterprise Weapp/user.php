<!DOCTYPE html>
<html>
    <head>
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
                    <a class="nav-link" href="ideapage.html">IDEAS</a>
                </li>

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
          </div>
        </div>
            <script src="http://code.jquery.com/jquery-3.2.1.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
