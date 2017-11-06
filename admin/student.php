<?php
include '../session/admin-session.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Info</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/Profile-Edit.css">
    <link rel="stylesheet" href="../css/Profile-Edit1.css">
    <link rel="stylesheet" href="../css/Pretty-Registration-Form.css">
    <link rel="stylesheet" href="../css/PUSH---Bootstrap-Button-Pack1.css">
    <link rel="stylesheet" href="../css/PUSH---Bootstrap-Button-Pack3.css">
    <link rel="stylesheet" href="../css/PUSH---Bootstrap-Button-Pack2.css">
    <link rel="stylesheet" href="../css/Navigation-with-Button1.css">
    <link rel="stylesheet" href="../css/PUSH---Bootstrap-Button-Pack.css">
    <link rel="stylesheet" href="../css/styles.css">

</head>

<?php
    include 'header.php';
    
    
    $studentID = $_GET['studentID'];
    $query = "SELECT * FROM Student WHERE studentID= '$studentID'";
    $result = $db->query($query);
    
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $userId = $row['userId'];
    
    $query1 = "SELECT username FROM User WHERE id= '$userId'";
    $result1 = $db->query($query1);
    $row1 = $result1->fetch_array(MYSQLI_ASSOC);
    $oldUsername = $row1['username'];
    
    
    
    $firstName = $lastName = $username = $email = "";
    
    //sanitize inputs
    if (isset($_POST['update_button'])) {
        $firstName = test_input($_POST["firstName"]);
        $lastName = test_input($_POST["lastName"]);
        $username = test_input($_POST["username"]);
        $email = test_input($_POST["email"]);
        
        if ($username != $oldUsername){
            $sql = "SELECT username FROM User WHERE username = '$username'";
                $result = mysqli_query($db, $sql) or die('error getting data');
                $num_rows = mysqli_num_rows($result);
                
                //Check if user already exists
                if ($result->num_rows > 0){
                    $takenusername = "User already exists!";
                    exit;
                }
        }
        
        
        $sql2 = "UPDATE User SET username=? WHERE id=?";
        $stmt1 = $db->stmt_init();
        $stmt1->prepare($sql2);
        $stmt1->bind_param('sd', $username, $userId);
        $stmt1->execute();
            
        $sql1 = "UPDATE Student SET firstName=?, lastName=?, email=? WHERE userId=?";
        //Prepared Statement
        $stmt =  $db->stmt_init();
        $stmt->prepare($sql1);
        $stmt->bind_param('sssd', $firstName, $lastName, $email, $userId);
        $stmt->execute();
        
        
        //submit success message
        
        $success = "Student Account Updated!";
        
        //refresh data
        
        $studentID = $_GET['studentID'];
        $query = "SELECT * FROM Student WHERE studentID= '$studentID'";
        $result = $db->query($query);
    
        $row = $result->fetch_array(MYSQLI_ASSOC);
        
        $query1 = "SELECT username FROM User WHERE id= '$userId'";
        $result1 = $db->query($query1);
        $row1 = $result1->fetch_array(MYSQLI_ASSOC);
        $oldUsername = $row1['username'];
        
        
        
        
    }
    
    else if (isset($_POST['delete_button'])){
        
        $sql1 = "DELETE FROM Student WHERE userId=?";
        //Prepared Statement
        $stmt =  $db->stmt_init();
        $stmt->prepare($sql1);
        $stmt->bind_param('d', $userId);
        $stmt->execute();
        
        $sql2 = "DELETE FROM User WHERE id=?";
        $stmt1 = $db->stmt_init();
        $stmt1->prepare($sql2);
        $stmt1->bind_param('d', $userId);
        $stmt1->execute();
        
        echo '<script type="text/javascript">
           window.location.replace("student-update-delete.php");
                </script>';
        
        
        
    }
    
    //sanitize input
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>

<body>
    <div class="container profile profile-view" id="profile">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?studentID=" . $_GET['studentID'];?>">
            <div class="row profile-row">
                <div class="col-md-12">
                    <h2 class="text-center">Student Profile</h2>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="control-label">First name </label>
                                <input class="form-control" type="text" required="" name="firstName" value='<?php echo $row['firstName']; ?>'>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Last name </label>
                                <input class="form-control" type="text" required="" name="lastName" value='<?php echo $row['lastName']; ?>'>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Username </label>
                        <input class="form-control" type="text" required="" autocomplete="off" name="username" value='<?php echo $oldUsername; ?>'>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email </label>
                        <input class="form-control" type="email" required="" autocomplete="off" name="email" value='<?php echo $row['email']; ?>'>
                    </div>
                    <div class="row">
                        <p class="text-danger text-center"><?php echo $takenusername  ?></p>
                        <p class="text-success text-center"><?php echo $success ?></p>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 content-right">
                            <button class="btn btn-primary form-btn" name="update_button" type="submit">UPDATE </button>
                            <button class="btn btn-danger form-btn" name="delete_button" type="submit">DELETE </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>