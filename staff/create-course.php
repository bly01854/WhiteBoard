<?php
include '../session/staff-session.php';
include '../functions/html_element.php';
include '../functions/console_log.php';

if(isset($_POST['title'])){
  //messages to give back to the user
  $feedback="";
  
  $title = test_input($_POST['title']);
  $description = test_input($_POST['description']);
  
  $sql = "INSERT INTO Course (courseName, description, staffID) VALUES (?, ?, ?)";
  $stmt = $db->stmt_init();
  $stmt->prepare($sql);
  $stmt->bind_param('ssd', $title, $description, $session_staffId);
  $stmt->execute();
  
}



// cleans input
function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
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
              <p class="lead"> Create New Course </p>

              <form id="confirmation">

                <input class="form-control assgn" type="text" name="title" placeholder="Course Title e.g. PSY 100" required>

                <input class="form-control assgn" type="text"  name="description" placeholder="Course Name e.g. Intro to Psychology" required>


                  <input type="submit" class="btn btn-primary assgn" >
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
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>');</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript">
      // Variable to hold request
var request;

// Bind to the submit event of our form
$("#confirmation").submit(function(event){

    // Prevent default posting of form - put here to work in case of errors
    event.preventDefault();

    // Abort any pending request
    if (request) {
        request.abort();
    }
    // setup some local variables
    var $form = $(this);

    // Let's select and cache all the fields
    var $inputs = $form.find("input, select, button, textarea");

    // Serialize the data in the form
    var serializedData = $form.serialize();

    // Let's disable the inputs for the duration of the Ajax request.
    // Note: we disable elements AFTER the form data has been serialized.
    // Disabled form elements will not be serialized.
    $inputs.prop("disabled", true);

    // Fire off the request to /form.php
    request = $.ajax({
        url: "create-course.php",
        type: "post",
        data: serializedData
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Alert the user of success
        alert("Course Successfully Created!");
        window.location.replace('course-view.php');
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });

    // Callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
        // Reenable the inputs
        $inputs.prop("disabled", false);
    });

});
    </script>
  </body>
</html>