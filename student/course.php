<?php
include '../session/student-session.php';
include '../functions/html_element.php';

$location = $_GET['location'];
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>WhiteBoard</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/whiteboard.css" rel="stylesheet">

    <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
    

  </head>

  <body style="background-color: <?php echo $session_primaryColor; ?>">

<?php
  include 'header.php';
?>

      <div class="container">
        <div class="row justify-content-md-center">
            <div class="col whiteboard whiteboard-main gradebook">
                <h3><?php echo $courseArray[$location]->get_name() . " // " . $courseArray[$location]->get_description(); ?></h3>
                <iframe style="width: 100%;height: 100%;position: relative;"  src="course-announcement.php?location=<?php echo $location ?>"></iframe>
                
            </div>
        </div>
          
              
          
          
          <footer style="background-color: <?php echo $session_secondaryColor; ?>"> <p>  </p> </footer>

      </div>

   


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>