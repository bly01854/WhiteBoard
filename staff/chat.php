<?php
include '../session/staff-session.php';
include '../functions/html_element.php';
include '../functions/console_log.php';
$id = $_GET['id'];

if(isset($_POST['content'])){
    $content = htmlspecialchars($_POST['content']);
    $sql = 'INSERT INTO message (content, reciever, creator) VALUES (?, ?, ?)';
    console_log($sql);
    $stmt = $db->stmt_init();
    $stmt->prepare($sql);
    $stmt->bind_param('sdd', $content, $id, $user_check);
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

  </head>
  
  <body class="whiteboard-iframe">
      
      <?php
    $sql = 'SELECT * FROM (SELECT content, creator, reciever, timestamp FROM message WHERE reciever =  ' . $user_check . ' AND creator =' . $id . ') as FirstSet
          union (
          SELECT content, creator, reciever, timestamp FROM message WHERE reciever =' . $id . ' AND creator = ' . $user_check . ') ORDER BY timestamp';
    $result = $db->query($sql);
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
      if($row['creator'] == $user_check){
          $div = new html_element('div');
          $div->set('class', 'row');
          $col = new html_element('div');
          $col->set('class', 'col-md-8');
          $card = new html_element('div');
          $card->set('class', 'card');
          $body = new html_element('div');
          $body->set('class', 'card-body bg-primary');
          $content = new html_element('p');
          $content->set('class', 'p-y-1 text-white pull-right');
          $content->set('text', $row['content']);
          $body->inject($content);
          $card->inject($body);
          $col->inject($card);
          $col2 = new html_element('div');
          $col2->set('class', 'col-md-4');
          $div->inject($col2);
          $div->inject($col);
          $div->output();
      }
      else{
          $div = new html_element('div');
          $div->set('class', 'row');
          $col = new html_element('div');
          $col->set('class', 'col-md-8');
          $card = new html_element('div');
          $card->set('class', 'card');
          $body = new html_element('div');
          $body->set('class', 'card-body ');
          $content = new html_element('p');
          $content->set('class', 'p-y-1');
          $content->set('text', $row['content']);
          $body->inject($content);
          $card->inject($body);
          $col->inject($card);
          $col2 = new html_element('div');
          $col2->set('class', 'col-md-4');
          $div->inject($col);
          $div->inject($col2);
          $div->output();
      }
    } 
      
      ?>
      
      <script>
          function scrollBottom() {window.scrollTo(0, document.body.scrollHeight);}
            if (document.addEventListener) document.addEventListener("DOMContentLoaded", scrollBottom, false)
            else if (window.attachEvent) window.attachEvent("onload", scrollBottom);
      </script>
  
  
      <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>');</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
  
 