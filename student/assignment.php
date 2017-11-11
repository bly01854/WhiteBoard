<?php
include '../session/student-session.php';
include '../functions/html_element.php';
include '../functions/console_log.php';


$assignment_id = $_GET['id'];
$sql = "SELECT * FROM Assignment WHERE id =$assignment_id";
$result = $db->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);


$dueDate = date("m-d-y", strtotime($row['dueDate']));

$query = "SELECT * FROM Submission WHERE studentID =$session_studentId AND assignmentID = $assignment_id";
$result_submission = $db->query($query);
$row_submission = $result_submission->fetch_array(MYSQLI_ASSOC);
$submission_id = $row_submission['id'];
$num_rows = mysqli_num_rows($result_submission);

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
                
                <?php
                if ($num_rows >= 1){
                  $hidden = "hidden";
                  $sql_file = "SELECT * FROM submission_file WHERE submission_id = $submission_id";
                  $result_file = $db->query($sql_file);
                  $num_rows_file = mysqli_num_rows($result_file);
                  if ($num_rows_file>=1){
                    $row_file = $result_file->fetch_array(MYSQLI_ASSOC);
                    $file = $row_file['file'];
                  }
                  
                
                  $header = new html_element('h4');
                  $header->set('style', 'margin-bottom:10px; margin-top:10px');
                  $header->set('text', "Your submission:");
                  $header->output();
                  
                  $upload = new html_element('a');
                  $upload->set('href', 'uploads/'.$file);
                  $upload->set('text', $file);
                  $upload->output();
                  
                  $comment = new html_element('p');
                  $comment->set('class', 'lead');
                  $comment->set('text', $row_submission['comments']);
                  $comment->output();
                  
                  $header = new html_element('h5');
                  $header->set('style', 'margin-bottom:10px; margin-top:10px');
                  $header->set('text', "Your grade:");
                  $header->output();
                  
                  $grade = new html_element('p');
                  $grade->set('class', 'lead');
                  if($row_submission['graded'] == 0){
                    $grade->set('text', "Not graded");
                  }
                  $grade->output();
                
                }
              ?>
                <form id="confirmation" method="post" enctype="multipart/form-data" >
                
                
                <div class="form-group assgn" <?php echo $hidden ?>>
                    <label for="exampleFormControlFile1">Upload the assignment here</label>
                    <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload">
                  </div>


               <div class="form-group assgn" <?php echo $hidden ?>>
                  <label for="exampleFormControlTextarea1">Comments</label>
                  <textarea class="form-control" rows="3" name="comments"></textarea>
                </div>
                
                <input  type="hidden" name="assignment" value="<?php echo $assignment_id; ?>">

                

                  

                  <input <?php echo $hidden ?> type="submit" class="btn btn-primary assgn" name="input">
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
        url: "submission-creation.php",
        type: 'POST',
        data: formData,
        success: function (data) {
            alert("Submission created successfully!")
            window.location.reload(true);
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