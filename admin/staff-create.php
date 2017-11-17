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
    $firstName = $lastName = $username = $phone = $email = $password = $repeatPassword = "";
        
        //sanitize inputs
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $firstName = test_input($_POST["firstName"]);
            $lastName = test_input($_POST["lastName"]);
            $username = test_input($_POST["username"]);
            $phone = test_input($_POST["phone"]);
            $email = test_input($_POST["email"]);
            $password = test_input($_POST["password"]);
            $repeatPassword = test_input($_POST["repeatPassword"]);
            $role = 'staff';
            
            //Confirm if passwords match
            if($password !== $repeatPassword){
                $passwordError = "Passwords don't match!";
            }
            
            else{
                $sql = "SELECT username FROM User WHERE username = '$username'";
                $result = mysqli_query($db, $sql) or die('error getting data');
                $num_rows = mysqli_num_rows($result);
                
                //Check if user already exists
                if ($result->num_rows > 0){
                    $takenusername = "User already exists!";
                }
                //Create staff account
                else{
                    //Hash password
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    //Insert into Staff Table
                    $sql2 = "INSERT INTO User (username, password, role, instId)
                    VALUES (?,?,?,?)";
                    $stmt1 = $db->stmt_init();
                    $stmt1->prepare($sql2);
                    $stmt1->bind_param('sssd', $username, $password, $role, $session_isntId);
                    $stmt1->execute();
                    
                    $sql = "SELECT id FROM User WHERE username = '$username'";
                    $result = mysqli_query($db, $sql) or die('error getting data');
                    $row = mysqli_fetch_array($result);
                    $userId = $row['id'];
                    
                    
                    $sql = "INSERT INTO Staff (firstName, lastName, email, phone, userId)
                    VALUES (?,?,?,?,?)";
                    //Prepared Statement
                    $stmt =  $db->stmt_init();
                    $stmt->prepare($sql);
                    $stmt->bind_param('sssss', $firstName, $lastName, $email, $phone, $userId);
                    $stmt->execute();

                    
                    $success = "Staff account successfully created!";
                    
                    
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
                            <h2 class="text-center">Create Staff</h2>
                            <form method="post" class="custom-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <div class="form-group">
                                    <label class="control-label" for="name-input-field">First Name</label>
                                    <input class="form-control" type="text" name="firstName" required="" id="firstName">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="name-input-field">Last Name</label>
                                    <input class="form-control" type="text" name="lastName" required="" id="lastName">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="name-input-field">Username </label>
                                    <input class="form-control" type="text" name="username" required="" id="username">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="name-input-field">Phone Number (format: x-xxx-xxx-xxxx) </label>
                                    <input class="form-control" type="tel" name="phone" required="" id="phone" pattern="^\d{1}-\d{3}-\d{3}-\d{4}$">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="email-input-field">Email </label>
                                    <input class="form-control" type="email" name="email" required="" id="email">
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