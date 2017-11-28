<?php
include '../session/staff-session.php';
include '../functions/html_element.php';
include '../functions/console_log.php';

$submission_id = $_GET['id'];
$assignment_id = $_GET['assignment_id'];

//query for submission information
$sql = "SELECT * FROM Submission WHERE id =$submission_id";
$result = $db->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);

$timestamp = date("m-d-y h:i A", strtotime($row['timestamp']));
$comments = $row['comments'];

//query for file information
$sql = "SELECT file FROM submission_file WHERE submission_id = $submission_id";
$result = $db->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);

$file = $row['file'];
$upload = "";
if ($file != "")
$upload = '../student/uploads/' . $file;

//query for assignment information
$sql = "SELECT points FROM Assignment WHERE id = $assignment_id";
$result = $db->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);

$points = $row['points'];


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
              <h4 style="margin-bottom:10px">Student Submission:</h4>

              

                <a class="lead" href='<?php echo $upload ?>'><?php echo $file ?></a>
                
                <p class="lead">Student Comment: <?php echo $comments ?></p>
                
                <p class='lead'>Submission time: <?php echo $timestamp ?></p>
                

                <form id="confirmation" method="post" enctype="multipart/form-data" >
                
                
                <div class="form-group assgn">
                    <label for="exampleFormControlFile1">Grade (Out of <?php echo $points ?> )</label>
                    <input type="number" class="form-control" name="grade" id="grade" required>
                  </div>


               <div class="form-group assgn">
                  <label for="exampleFormControlTextarea1">Comments</label>
                  <textarea class="form-control" rows="3" name="comments"></textarea>
                </div>
                
                <input  type="hidden" name="submission" value="<?php echo $submission_id; ?>">

                

                  

                  <input type="submit" class="btn btn-primary assgn" name="input">
              </form>
              
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
    <script type="text/javascript">
      // Variable to hold request
var request;

// Bind to the submit event of our form
$("form#confirmation").submit(function(){

    var formData = new FormData(this);

    $.ajax({
        url: "course-grade-post.php",
        type: 'POST',
        data: formData,
        success: function (data) {
            alert("Submission Graded!");
            window.location.replace('course-submission.php?id=<?php echo $assignment_id ?>');
        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;
});
    </script>
  </body>
</html>