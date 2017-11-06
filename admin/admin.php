<?php
include '../session/admin-session.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Info</title>
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
    
    //is $_Get Secure in the scenerio probably.   
    $userId = $_GET['adminID'];
    
    $query1 = "SELECT username FROM User WHERE id= '$userId'";
    $result1 = $db->query($query1);
    $row1 = $result1->fetch_array(MYSQLI_ASSOC);
    $oldUsername = $row1['username'];
    
    
    
    $username = "";
    
    //sanitize inputs
    if (isset($_POST['update_button'])) {
        $username = test_input($_POST["username"]);

        
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

        
        //submit success message
        
        $success = "Admin Account Updated!";
        
        //refresh data
        
        
        $query1 = "SELECT username FROM User WHERE id= '$userId'";
        $result1 = $db->query($query1);
        $row1 = $result1->fetch_array(MYSQLI_ASSOC);
        $oldUsername = $row1['username'];
        
        
        
        
    }
    
    else if (isset($_POST['delete_button'])){
        
        
        $sql2 = "DELETE FROM User WHERE id=?";
        $stmt1 = $db->stmt_init();
        $stmt1->prepare($sql2);
        $stmt1->bind_param('d', $userId);
        $stmt1->execute();
        
        echo '<script type="text/javascript">
           window.location.replace("admin-update-delete.php");
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
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?adminID=" . $_GET['adminID'];?>">
            <div class="row profile-row">
                <div class="col-md-12">
                    <h2 class="text-center">Admin Profile</h2>
                    <hr>
                    <div class="form-group">
                        <label class="control-label">Username </label>
                        <input class="form-control" type="text" required="" autocomplete="off" name="username" value='<?php echo $oldUsername; ?>'>
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