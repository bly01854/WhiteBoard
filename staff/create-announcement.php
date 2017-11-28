<?php
include '../session/staff-session.php';
include '../functions/html_element.php';

if(isset($_POST['title'])){
  //messages to give back to the user
  $feedback="";
  
  $title = test_input($_POST['title']);
  $description = htmlspecialchars($_POST['description']);
  $course = $_POST['course'];
  
  $sql = "SELECT courseID FROM Course WHERE courseName ='$course'";
  $result = $db->query($sql);
  $row = $result->fetch_array(MYSQLI_ASSOC);
  $courseId = $row['courseID'];
  
  $sql = "INSERT INTO Announcement (title, body, courseID) VALUES (?, ?, ?)";
  $stmt = $db->stmt_init();
  $stmt->prepare($sql);
  $stmt->bind_param('ssd', $title, $description, $courseId);
  if ($stmt->execute() == TRUE){
    $feedback = "Assignment Created!";
  }
  else{
    $feedback = "Assignment Creation Failed!";
  }
  
  if($_POST['checkbox'] == 'on'){
    $date = date('Y-m-d',strtotime($_POST['date']));
    $last_id = $db->insert_id;
    $sql = "INSERT INTO event_announcement (title, start, announcement_id, course_id) VALUES (?, ?, ?, ?)";
    $stmt = $db->stmt_init();
    $stmt->prepare($sql);
    $stmt->bind_param('ssdd', $title, $date, $last_id, $courseId);
    $stmt->execute();
  }
  
  
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

    <title>Create Announcement</title>

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
              <p class="lead"> Create New Announcement </p>

              <form id="confirmation">

                <input class="form-control assgn" type="text" name="title" id="title" placeholder="Announcement Title" required>

                <select class="form-control assgn" name="course" required>
                  <option value="" disabled selected>Select your option</option>
                  <?php
                  for ($i = 0; $i<count($courseArray); $i++){
                    $option = new html_element('option');
                    $option->set('text', $courseArray[$i]->get_name());
                    $option->output();
                  }
                  ?>
                </select>


               <div class="form-group assgn">
                  <label for="exampleFormControlTextarea1">Announcement Description</label>
                  <textarea class="form-control" rows="3" name="description" form="confirmation" required></textarea>
                </div>
                
                  <div class="form-check assgn">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox" id="eventBox" name='checkbox' value="on">
                          Make an event?
                    </label>
                  </div>
                  
                  <input class="form-control assgn" type="date" min="2017-04-01" id='date' name="date" disabled>

                  <input type="submit" class="btn btn-primary assgn" >
              </form>
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
        url: "create-announcement.php",
        type: "post",
        data: serializedData
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Alert the user of success
        alert("Announcement Successfully Posted!");
        window.location.replace(history.back());
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
        alert("Announcement failed to post!");
    });

    // Callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
        // Reenable the inputs
        $inputs.prop("disabled", false);
    });

});
//for checkbox
document.getElementById('eventBox').onchange = function() {
    document.getElementById('date').disabled = !this.checked;
    document.getElementById('date').required = this.checked;
};



    </script>
  </body>
</html>