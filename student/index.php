<?php
include '../session/student-session.php';
?>
<!DOCTYPE html>
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
  
  <?php
  include 'header.php';
  include '../functions/html_element.php';
  
?>

  <body style="background-color: <?php echo $session_primaryColor; ?>">




      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col whiteboard whiteboard-main">
           <!--- <p class="lead"> Announcement in CS 360 <i class="fa fa-bullhorn" aria-hidden="true"></i></p>
            <p class="lead"> Homework assignment available in CS 360 <i class="fa fa-pencil" aria-hidden="true"></i></p>
            <p class="lead"> New message from Michael Galloway <i class="fa fa-envelope-open" aria-hidden="true"></i></p>
            <p class="lead"> Announcement in CS 360 <i class="fa fa-bullhorn" aria-hidden="true"></i></p>. -->

            <iframe src="announcements.php" seamless='seamless'></iframe>

          </div>
          <div class="col col col-md-3 whiteboard">
            <p class="lead"> Classes</p>
            <?php
            
              $i=0;
              while($i < count($courseArray)){
                $course = $courseArray[$i];
                
                $staffID = $course->get_staffId();
                
                $staffSql = "SELECT firstName, lastName FROM Staff WHERE id= '$staffID'";
                $staffResult = mysqli_query($db, $staffSql) or die('error getting data');
                $staffRow = mysqli_fetch_array($staffResult, MYSQLI_ASSOC);
                $staffName = $staffRow['firstName'] . " " . $staffRow['lastName'];
                
                
                $inner_p_tag = new html_element('p');
                $inner_p_tag->set('class','instructor');
                $inner_p_tag->set('text',$staffName);
                $outer_p_tag = new html_element('p');
                $outer_p_tag->set('class','lead');
                $outer_p_tag->set('text',$course->get_name());
                $outer_p_tag->inject($inner_p_tag);
                $outer_p_tag->output();
                
                $i++;
                
                //echo "<p class='lead'>";
                //echo $course->get_name();
                //echo "</p><p class ='instructor'>";
                //echo $staffName;
                //echo "</p>";
              }
              
              
             
            
            ?>
            
          </div>
        </div>

    <footer style="background-color: <?php echo $session_secondaryColor; ?>"> <p>  </p> </footer>

    </div>

   


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>');</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>