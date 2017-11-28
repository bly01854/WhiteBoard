<?php
include '../session/student-session.php';
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
    <link rel='stylesheet' href='../fullcalendar/fullcalendar.css' />
    <script src='../fullcalendar/lib/jquery.min.js'></script> 
    <script src='../fullcalendar/lib/moment.min.js'></script>
    <script src='../fullcalendar/fullcalendar.js'></script>
<!--<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery.min.js'></script>
<script src="http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery-ui.custom.min.js"></script>
    <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script>
<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js'></script>-->

    <script> 
    $(document).ready(function() {
        $('#calendar').fullCalendar({
          events: 'get-events.php'

        });
    });

       </script>


  </head>

  <body style="background-color: <?php echo $session_primaryColor; ?>">

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="index.php">WhiteBoard</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="whiteboardcalendar.php">Calendar <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="gradebook.php">Grades</a>
          </li>
          
          
          <li class="nav-item">
              
          </li>
        </ul>
        
        <a class="btn btn-default action-button navbar-text navbar-right actions" role="button" href="../logout.php">Log Out</a>
    
      </div>
    </nav>


      <div class="container">
        <div id='calendar' class="whiteboard">
          
        </div>

    <footer style="background-color: <?php echo $session_secondaryColor; ?>"> <p>  </p> </footer>

    </div>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
   <!-- <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>-->
    <script src="../fullcalendar/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>