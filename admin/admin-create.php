<?php
include '../session/admin-session.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Staff</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/Pretty-Registration-Form.css">
    <link rel="stylesheet" href="../css/PUSH---Bootstrap-Button-Pack1.css">
    <link rel="stylesheet" href="../css/PUSH---Bootstrap-Button-Pack3.css">
    <link rel="stylesheet" href="../css/PUSH---Bootstrap-Button-Pack2.css">
    <link rel="stylesheet" href="../css/Navigation-with-Button1.css">
    <link rel="stylesheet" href="../css/PUSH---Bootstrap-Button-Pack.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    
    <?php include 'header.php';
    
    
    // define variables and set to empty values
   $username = $password = $repeatPassword = "";
        
        //sanitize inputs
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = test_input($_POST["username"]);
            $password = test_input($_POST["password"]);
            $repeatPassword = test_input($_POST["repeatPassword"]);
            $role = 'admin';
            
            //Confirm if passwords match
            if($password !== $repeatPassword){
                $passwordError = "Passwords don't match!";
            }
            
            else{
                $sql = "SELECT username FROM User WHERE username = '$username'";
                $result = mysqli_query($db, $sql) or die('error getting data');
                $num_rows = mysqli_num_rows($result);
                
                //Check if user already exists
                if ($num_rows > 0){
                    $takenusername = "User already exists!";
                }
                //Create admin account
                else{
                    //Hash password
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    //Insert into user Table
                    
                    $sql = "INSERT INTO User (username, password, role)
                    VALUES (?,?,?)";
                    $stmt = $db->stmt_init();
                    $stmt->prepare($sql);
                    $stmt->bind_param('sss', $username, $password, $role);
                    $stmt->execute();
                    
                    $success = "Admin account successfully created!";
                    
                    
                }
            }
            
            }
        //sanitize input
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

    ?>
    
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row register-form">
                        <div class="col-md-8 col-md-offset-2">
                            <h2 class="text-center">Create Admin</h2>
                            <form method="post" class="custom-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <div class="form-group">
                                    <label class="control-label" for="name-input-field">Username </label>
                                    <input class="form-control" type="text" name="username" required="" id="username">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="pawssword-input-field">Password </label>
                                    <input class="form-control" type="password" name="password" required="" id="password">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="repeat-pawssword-input-field">Repeat Password </label>
                                    <input class="form-control" type="password" name="repeatPassword" required="" id="repeatPassword">
                                    <p class="text-danger text-center"><?php echo $passwordError; echo $takenusername; ?></p>
                                </div>
                                <p class="text-success text-center"><?php echo $success ?></p>
                                <button class="btn btn-default submit-button" type="submit" id="submit">Submit Form</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    

</body>

</html>