<?php
include '../session/student-session.php';
include '../functions/html_element.php';
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
      source: "get-contacts.php",
      select: function(event, ui){
        window.top.location.href = ui.item.value;
      }

        });
    });
        </script>

  </head>

  <body class="whiteboard-iframe">

  	<nav class="navbar navbar-expand-md fixed-top whiteboard-nav">
  	  <div class="btn-group btn-group-justified">
        <a class="btn navbar-brand nav-elem" href="announcements.php">Feed</a>
  
        <a class="btn navbar-brand nav-elem nav-curr" href="inbox.php">Inbox</a>
  
        <a class="btn navbar-brand nav-elem" href="homework.php">Homework</a>
      </div>
      <div class="btn-group btn-group-right float-right">
        <button class="btn btn-outline-secondary" style="margin-left:45px"  data-toggle='modal' data-target="#myModal">Create Message</button>
      </div>

    </nav>
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Send to who?</p>
          <input id='autoComplete'/>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  
  <?php
  $sql = 'SELECT SUBSTRING(content, 1, 45) AS content, creator, timestamp FROM message WHERE reciever =' . $user_check;
  $result = $db->query($sql);
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    //get creator name
    $creator_sql = 'SELECT role FROM User WHERE id=' . $row['creator'];
    $creator_result = $db->query($creator_sql);
    $creator_row = $creator_result->fetch_array(MYSQLI_ASSOC);
    if ($creator_row['role'] == 'staff'){
      $creator_sql = 'SELECT firstName, lastName FROM Staff WHERE userId=' . $row['creator'];
      $creator_result = $db->query($creator_sql);
      $creator_row = $creator_result->fetch_array(MYSQLI_ASSOC);
      $name = $creator_row['firstName'] . ' ' . $creator_row['lastName'];
    }
    else{
      $creator_sql = 'SELECT firstName, lastName FROM Student WHERE userId=' . $row['creator'];
      $creator_result = $db->query($creator_sql);
      $creator_row = $creator_result->fetch_array(MYSQLI_ASSOC);
      $name = $creator_row['firstName'] . ' ' . $creator_row['lastName'];
    }
    
    $content = $row['content'];
    $creator = $row['creator'];
    if (strlen($content) > 40){
      $content = $content . "...";
    }
    
    //generate HTML
    $row = new html_element('div');
    $row->set('class', 'row');
    $col = new html_element('div');
    $col->set('class', 'col');
    $link = new html_element('a');
    $link->set('style', 'color:inherit; text-decoration: none');
    $link->set('href', 'message.php?id=' . $creator);
    $title = new html_element('p');
    $title->set('class', 'lead');
    $title->set('text', $content);
    $image = new html_element('i');
    $image->set('class', 'fa fa-envelope');
    $image->set('aria-hidden', 'true');
    $title->inject($image);
    $link->inject($title);
    $col->inject($link);
    $row->inject($col);
    $col = new html_element('div');
    $col->set('class', 'col');
    $title = new html_element('p');
    $title->set('class', 'instructor');
    $title->set('text', $name);
    $col->inject($title);
    $row->inject($col);
    $row->output();
    
  }
  ?>



   


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="../js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>