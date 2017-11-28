<?php
include '../session/staff-session.php';
include '../functions/html_element.php';

$location = $_GET['location'];
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

  <body class="whiteboard-iframe">

  	<nav class="navbar navbar-expand-md fixed-top whiteboard-nav">
  	  <div class="btn-group btn-group-justified">
        <a class="btn navbar-brand nav-elem" href="course-announcement.php?location=<?php echo $location ?>">Announcements</a>
        <a class="btn navbar-brand nav-elem" href="course-assignment.php?location=<?php echo $location ?>">Assignments</a>
        <a class="btn navbar-brand nav-elem nav-curr" href="course-content.php?location=<?php echo $location ?>">Content</a>
        <a class="btn navbar-brand nav-elem" href="course-roster.php?location=<?php echo $location ?>">Roster</a>
      </div>
      <div class="btn-group btn-group-right float-right">
        <a class="btn btn-outline-secondary" style="margin-left:45px" href="course-content-creation.php?location=<?php echo $location ?>" target="_parent">Add content</a>
      </div>

    </nav>

<?php
    
       
       //create assignment object
       $column = new html_element('div');
       $column->set('class','col');
       
       $courseId = $courseArray[$location]->get_id();
       $sql = "SELECT id, title, timestamp FROM content WHERE course_id = '$courseId' ORDER BY timestamp DESC";
       $result = mysqli_query($db, $sql) or die('error getting data');
       $num_rows = mysqli_num_rows($result);
       while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
            $image = new html_element('i');
            $image->set('class', 'fa fa-sticky-note-o');
            $image->set('aria-hidden', 'true');
            $title = new html_element('p');
            $title->set('class','lead');
            $title->set('text',$row['title']);
            $title->inject($image);
            $link = new html_element('a');
            $link->set('href', 'content-view.php?id=' . $row['id']);
            $link->set('style', 'color:inherit; text-decoration: none');
            $link->set('target', '_parent');
            $link->inject($title);
            $column->inject($link);
            $dueDate = date("m-d-y", strtotime($row['timestamp']));
            $due = new html_element('p');
            $due->set('text', "Posted: $dueDate");
            $column->inject($due);
        }
        $row = new html_element('div');
        $row->set('class','row');
        $row->inject($column);
        $row->output();
                
    
    
    
    
    ?>


   


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>