<?php
session_start();
include "connection.php"; 

if (isset($_SESSION['login_user'])){
        
        if ($_SESSION['role'] == 'admin'){
            header( 'Location: /admin/interface.php' );
        }
        else if ($_SESSION['role'] == 'student'){
            header( 'Location: /student/index.php');
        }
    }
    
    $error = ""; //declare error variable
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        //information sent from form
        $username = mysqli_real_escape_string($db,$_POST['username']);
        $password = mysqli_real_escape_string($db,$_POST['password']);
        
        $sql = "SELECT * FROM User WHERE username = '$username'";
        $result = mysqli_query($db, $sql) or die('error getting data');
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $hash = $row['password'];
        $id = $row['id'];
        $role = $row['role'];
        $num_rows = mysqli_num_rows($result);
        
        if ($num_rows == 0){
            $error = "Incorrect username or password";
        }
        
        else {
            if ((password_verify($password, $hash))) {
                $_SESSION['login_user']=$id;
                $_SESSION['role']=$role;
            
                if ($_SESSION['role'] == 'admin'){
                    header( 'Location: /admin/interface.php' );
                
                }
                else if ($_SESSION['role'] == 'student'){
                    header( 'Location: /student/index.php');
                }
                else if ($_SESSION['role'] == 'staff'){
                    header( 'Location: /staff/index.php');
                }
            }
            
            else{
                $error= "Incorrect username or password";
            }

        }
    }

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhiteBoard Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="css/Login-Form-Clean.css">
    <link rel="stylesheet" href="css/styles.css">
</head>


<body>
    <div class="login-clean">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-browsers-outline"></i></div>
            <p class="text-danger text-center"><?php echo $error;?></p>
            <div class="form-group">
                <input class="form-control" type="text" name="username" required="" placeholder="Username">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" required="" placeholder="Password">
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit" style="background-color:#505e6c;">Log In</button>
            </div><a href="#" class="forgot">Forgot your email or password?</a></form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>