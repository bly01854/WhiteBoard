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
      $id = $_GET['id'];
    $name = $_GET['name'];
  ?>
    <div class='container'>
    <div class="row justify-content-md-center"><div class="col whiteboard whiteboard-main" style="height: 300px ;position: relative;">
    <h3 class="text-center"><?php echo $name ?></h3>
    <iframe src="chat.php?id=<?php echo $id ?>" seamless='seamless' id='iframe' style="width: 100%;height: 85%;position: relative;"></iframe>
    
    </div>

  
      <div class="container whiteboard">
              <form id="confirmation" method="post" enctype="multipart/form-data" >
                
               <div class="form-group assgn">

                  <textarea class="form-control" rows="3" name="content" placeholder="Enter Text Here" id="textarea" required></textarea>
                </div>

                  <input type="submit" class="btn btn-primary assgn pull-right" name="input">
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
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>');</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script>
     <script type="text/javascript">
      // Variable to hold request
var request;

// Bind to the submit event of our form
$("form#confirmation").submit(function(e){

    var formData = new FormData(this);
    

    $.ajax({
        url: "chat.php?id=<?php echo $id ?>",
        type: 'POST',
        data: formData,
        success: function (data) {
            document.getElementById('iframe').contentDocument.location.reload(true);
            $("form#confirmation").trigger('reset');
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