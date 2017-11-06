<?php
include '../session/admin-session.php';
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
  
  <?php
    include '../connection.php';
    include '../session/admin-session.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $color1 = $_POST['color1'];
      $color2 = $_POST['color2'];
      
      $sql = "UPDATE Institution SET primaryColor='$color1', secondaryColor='$color2' WHERE id='$session_isntId'";
      $result = mysqli_query($db, $sql) or die('error getting data');
      
      header("Refresh:0");
    }
    ?>

  <body id="main" style="background-color: <?php echo $session_primaryColor; ?>">
    
    

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top secondary">
      <a class="navbar-brand" href="interface.php">WhiteBoard Admin</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="manage.html">Manage Accounts <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Change Colors</a>
          </li>
         <li class="nav-item">
            <a class="nav-link disabled" href="#">Use Statistics</a>
          </li>
        <!---  <li class="nav-item">
            <a class="nav-link disabled" href="#"></a>
          </li>-->
          
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Settings <i class="fa fa-cog" aria-hidden="true"></i></a>
          </li>
        </ul>
    
      </div>
    </nav>

<div class="container">
        <div class="row justify-content-md-center">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div class="col whiteboard whiteboard-main gradebook">
           <p class="lead grades"> Set School Colors  </p>
            <div class="row">
              <div class="col">
                <p class="lead ingrade"> Main Color:</p>
                  <input type="color" id="color" class="colorinput" value="<?php echo $session_primaryColor; ?>" name="color1">
                <p class="lead ingrade"> Secondary Color:</p>
                  <input type="color" id="color2" class="colorinput" value="<?php echo $session_secondaryColor; ?>" name="color2">
              </div>
              <div class="col">
              </div>

              <button type="button" class="btn btn-outline-secondary"
          onclick="document.getElementById('main').style.backgroundColor = document.getElementById('color').value; document.getElementById('secondary').style.backgroundColor = document.getElementById('color2').value">
              Change Colors
            </button>
            <button type="submit" class="btn btn-outline-secondary" style="padding:45px;margin-left:20px">Save</button>
            </div>


          </div>
          
        </div>
        </form>

        <script>
         document.getElementById("test").style.color = "blue";
        </script>


    <footer id="secondary" style="background-color: <?php echo $session_secondaryColor; ?>"> <p>  </p> </footer>

    </div>

   


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>');</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>