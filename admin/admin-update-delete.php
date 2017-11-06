<?php
include '../session/admin-session.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update/Delete Admin</title>
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
    
    <?php include 'header.php';?>
    
<div class="container">
        <h2 class="text-center">Admin List</h2>
	<div class="row">
        <div class="col-sm-6 col-sm-offset-3">
           

<?php
    
        
       
        $query = "SELECT username, id FROM User WHERE role = 'admin'";
        $result = mysqli_query($db, $query) or die('error getting data');
        $num_rows = mysqli_num_rows($result);
        
        
        //show results
        
        echo "$num_rows results found";
        echo "<table class='table'>";
        echo "<tr> <th> Username </th> </tr>"; 
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            
            $userId = $row['id'];

            
            $studentID = $row['studentID'];
            echo "<tr><td><a href='admin.php?adminID=" . $userId . "'>";
            echo $row['username'];
            echo "</a></td></tr>";
        }
        
        echo "</table>";
    


?>

        </div>
	</div>
</div>

    
    
    
    
    
    
    
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    

</body>

</html>