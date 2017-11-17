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

  </head>
  
  
  <body style="background-color: <?php echo $session_primaryColor; ?>">
    
  <?php
  include 'header.php';
  ?>
    
    <div class="row justify-content-md-center"><div class="container whiteboard" style="margin-top: 100px">
    <?php
    $id = $_GET['id'];
    $sql = 'SELECT content, timestamp FROM message WHERE reciever =' . $user_check . ' OR ' . $id . ' AND creator =' . $user_check . ' OR ' . $id;
    ?>
    <div class="row">
    <div class="col-md-8"><div class="card">
    
    <div class="card-body">
      
      
      <p class=" p-y-1">Some quick example text to build on the card title .</p>
    </div>
  </div></div>
    <div class="col-md-4"></div>
  </div><div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-8"><div class="card">
    
    <div class="card-body bg-primary">
      
      
      <p class="p-y-1 text-white pull-right">Some quick example text to build on the card title .</p>
    </div>
  </div></div>
  </div></div></div>
  
  <div class="row justify-content-md-center">
      <div class="container whiteboard">
              <form id="confirmation" method="post" enctype="multipart/form-data" >
                
               <div class="form-group assgn">

                  <textarea class="form-control" rows="3" name="comments" placeholder="Enter Text Here"></textarea>
                </div>

                  <input <?php echo $hidden ?> type="submit" class="btn btn-primary assgn pull-right" name="input">
              </form>
        </div>
    </div>
      
      
    



   


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