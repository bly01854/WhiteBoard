<?php
include '../session/staff-session.php';
include '../functions/html_element.php';

$location = $_GET['location'];
$courseId = $courseArray[$location]->get_id();

if(isset($_POST['id'])){
  //messages to give back to the user
  
  $id = $_POST['id'];
  $course_id = $_POST['course_id'];
  
  $sql = "INSERT INTO Student_Course_Junction (student_id, course_id) VALUES (?, ?)";
  $stmt = $db->stmt_init();
  $stmt->prepare($sql);
  $stmt->bind_param('dd', $id, $course_id);
  $stmt->execute();
  
}

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
            <script
      src="https://code.jquery.com/jquery-3.2.1.js"
      integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
      crossorigin="anonymous"></script>
    <script
      src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"
      integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk="
      crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>');</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script>
    $(document).ready(function() {
    $("#autoComplete").autocomplete({
      source: "course-add-student.php",
      select: function(event, ui){
        $.post( "course-add-student.php", { id: ui.item.value, course_id: <?php echo $courseId ?>  })
          .done(function() {
            window.location.reload();
        });
      }

        });
    });
        </script>

  </head>

  <body class="whiteboard-iframe">

  	<nav class="navbar navbar-expand-md fixed-top whiteboard-nav">
  	  <div class="btn-group btn-group-justified">
        <a class="btn navbar-brand nav-elem" href="course-announcement.php?location=<?php echo $location ?>">Announcements</a>
        <a class="btn navbar-brand nav-elem" href="course-assignment.php?location=<?php echo $location ?>">Assignments</a>
        <a class="btn navbar-brand nav-elem" href="course-content.php?location=<?php echo $location ?>">Content</a>
        <a class="btn navbar-brand nav-elem nav-curr" href="course-roster.php?location=<?php echo $location ?>">Roster</a>
      </div>
      <div class="btn-group btn-group-right float-right">
        <button class="btn btn-outline-secondary" style="margin-left:45px"  data-toggle='modal' data-target="#myModal">Add Student</button>
      </div>

    </nav>
    
      <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Add who?</p>
          <input id='autoComplete' name='student'/>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<?php
    
       
       //create assignment object
       $student_id_array = array();
       
       $column = new html_element('div');
       $column->set('class','col');
       
       $sql = "SELECT student_id FROM Student_Course_Junction WHERE course_id = '$courseId'";
       $result = mysqli_query($db, $sql) or die('error getting data');
       $num_rows = mysqli_num_rows($result);
       while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
           $student_id_array[] = $row['student_id'];

        }
        $student_id_array = implode(" OR ", $student_id_array);
        if ($num_rows > 0){
        $sql = "SELECT firstName, lastName FROM Student WHERE studentID= $student_id_array ORDER BY lastName";
        $result = mysqli_query($db, $sql) or die('error getting data');
        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
            $name = new html_element('p');
            $name->set('class', 'lead');
            $name->set('text', $row['firstName'] . " " . $row['lastName']);
            $column->inject($name);
        }
        }
        $row = new html_element('div');
        $row->set('class','row');
        $row->inject($column);
        $row->output();
                
    
    
    
    
    ?>


   


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>