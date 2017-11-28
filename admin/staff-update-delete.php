<?php
include '../session/admin-session.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update/Delete Staff</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/Pretty-Registration-Form.css">
    <link rel="stylesheet" href="../css/PUSH---Bootstrap-Button-Pack1.css">
    <link rel="stylesheet" href="../css/PUSH---Bootstrap-Button-Pack3.css">
    <link rel="stylesheet" href="../css/PUSH---Bootstrap-Button-Pack2.css">
    <link rel="stylesheet" href="../css/Navigation-with-Button1.css">
    <link rel="stylesheet" href="../css/PUSH---Bootstrap-Button-Pack.css">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        .results:hover {
        background-color:LightGrey;
        cursor:pointer;
        }
    </style>
</head>

<body>
    
    <?php include 'header.php';
    ?>
    
    <div class="container">
        <h2 class="text-center">Search for Staff</h2>
	<div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div id="imaginary_container"> 
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="input-group stylish-input-group">
                    
                        <input type="text" class="form-control"  placeholder="Search by name" name="criteria" >
                        <span class="input-group-addon">
                        <button type="submit" >
                            <span class="glyphicon glyphicon-search"></span>
                        </button>  
                        </span>
                </div>
            </form>
            </div>
        </div>
	</div>
</div>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $criteria = $_POST['criteria'];
        $query = "SELECT * FROM Staff WHERE (concat_ws(' ', firstName, lastName) LIKE '%$criteria%')";
        $result = mysqli_query($db, $query) or die('error getting data');
        $num_rows = mysqli_num_rows($result);
        
        
        //show results
        
        echo "$num_rows results found";
        echo "<table class='table'>";
        echo "<tr> <th> First Name </th> <th> Last Name </th> <th> Username </th> <th> Email </th> <th> Phone </th>  </tr>"; 
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            
            $userId = $row['userId'];
            $query1 = "SELECT username FROM User WHERE id= '$userId'";
            $result1 = $db->query($query1);
            $row1 = $result1->fetch_array(MYSQLI_ASSOC);
            $username = $row1['username'];
            
            
            
            $staffID = $row['id'];
            echo "<tr class='results' data-value='$staffID'><td>";
            echo $row['firstName'];
            echo "</td><td>";
            echo $row['lastName'];
            echo "</td><td>";
            echo $username;
            echo "</td><td>";
            echo $row['email'];
            echo "</td><td>";
            echo $row['phone'];
            echo "</a></td></tr>";
        }
        
        echo "</table>";
    }


?>
    
    
    
    
    
    
    
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function(){
        $('tr.results').click(function(){
            var value = this.getAttribute('data-value');
            window.location.assign('staff.php?staffID=' + value);
            
        })

        
    });
        
    </script>
    

</body>

</html>