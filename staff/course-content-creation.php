<?php
include '../session/staff-session.php';
include '../functions/html_element.php';
include '../functions/console_log.php';


$location = $_GET['location'];
$course_id = $courseArray[$location]->get_id();

?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Content Upload</title>

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
              <h4 style="margin-bottom:10px">Upload Content</h4>

                <form id="confirmation" method="post" enctype="multipart/form-data" >
                    
                <div class="form-group assgn">
                    <label for="exampleFormControlFile1">Content Title</label>
                    <input type="text" class="form-control" name="title">
                  </div>
                
                <div class="form-group assgn">
                    <label for="exampleFormControlFile1">Upload the Content here</label>
                    <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload">
                  </div>


               <div class="form-group assgn">
                  <label for="exampleFormControlTextarea1">Body</label>
                  <textarea class="form-control" rows="3" name="body"></textarea>
                </div>
                
                <input  type="hidden" name="course" value="<?php echo $course_id ?>">

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
        url: "content-upload.php",
        type: 'POST',
        data: formData,
        success: function (data) {
            alert("Content uploaded sucessfully!");
            window.location.replace(history.back());
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