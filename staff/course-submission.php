<?php
include '../session/staff-session.php';
include '../functions/html_element.php';
include '../functions/console_log.php';


$assignment_id = $_GET['id'];
$sql = "SELECT * FROM Assignment WHERE id =$assignment_id";
$result = $db->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);


$dueDate = date("m-d-y", strtotime($row['dueDate']));




?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Assignment</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/whiteboard.css" rel="stylesheet">

    <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">

  </head>

  <body style="background-color: <?php echo $session_primaryColor; ?>">
<?php
include 'header.php';


//echo "<script type='text/javascript'>alert(". $feedback . ")</script>";
?>


      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col whiteboard whiteboard-main gradebook">
              <h4 style="margin-bottom:10px"><?php echo $row['title']; ?></h4>

              

                <p class="lead"><?php echo $row['body'] ?></p>
                
                <p class="lead">Due date: <?php echo $dueDate ?></p>
                
                <h4 style="margin-top:10px">Ungraded Submissions:</h4>
                
                <?php
                $query = "SELECT * FROM Submission WHERE assignmentID = $assignment_id AND graded = 0";
                $result_submission = $db->query($query);
                while($row_submission = $result_submission->fetch_array(MYSQLI_ASSOC)){
                    $studentId = $row_submission['studentID'];
                    $sql ="SELECT firstName, lastName FROM Student WHERE studentID = $studentId";
                    $result = $db->query($sql);
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    $name = $row['firstName'] . " " . $row['lastName'];
                    $submission_id = $row_submission['id'];
                    
                    //create HTML
                    $p = new html_element('p');
                    $p->set('class', 'lead');
                    $p->set('text', $name);
                    $link = new html_element('a');
                    $link->set('href', 'course-grade.php?id=' . $submission_id . '&assignment_id=' . $assignment_id);
                    $link->set('style', 'color:inherit; text-decoration: none');
                    $link->inject($p);
                    $link->output();
                    
                }
                
                
                ?>
                

              
          </div>
        </div>

    </div>

   


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script
      src="https://code.jquery.com/jquery-3.2.1.js"
      integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
      crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>