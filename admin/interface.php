<?php
include '../session/admin-session.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhiteBoard Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/PUSH---Bootstrap-Button-Pack1.css">
    <link rel="stylesheet" href="../css/PUSH---Bootstrap-Button-Pack3.css">
    <link rel="stylesheet" href="../css/PUSH---Bootstrap-Button-Pack2.css">
    <link rel="stylesheet" href="../css/Navigation-with-Button1.css">
    <link rel="stylesheet" href="../css/PUSH---Bootstrap-Button-Pack.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <?php include 'header.php';?>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h2 class="text-center"><?php echo $session_institution ?> </h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="text-center">Student </h3>
                    <div class="btn-group btn-group-justified" role="group">
                        <a class="btn btn-default" role="button" href="student-create.php" id="addStudent">Add </a>
                        <a class="btn btn-default" role="button" href="student-update-delete.php" id="updateStudent">Update/Delete </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3 class="text-center">Staff </h3>
                    <div class="btn-group btn-group-justified" role="group">
                        <a class="btn btn-default" role="button" href="staff-create.php" id="staffAdd">add </a>
                        <a class="btn btn-default" role="button" href="staff-update-delete.php" id="staffUpdate">Update/Delete </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="text-center">Admin </h3>
                    <div class="btn-group btn-group-justified" role="group">
                        <a class="btn btn-default" role="button" href="admin-create.php" id="addAdmin">Add </a>
                        <a class="btn btn-default" role="button" href="admin-update-delete.php" id="updateStudent">Update/Delete </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3 class="text-center">Website / Server Status </h3>
                    <div class="btn-group btn-group-justified" role="group">
                        <a class="btn btn-default" role="button" href="changecolor.php" id="colorChange">Change Colors </a>
                        <a class="btn btn-default" role="button" href="resource-monitor.php" id="resource-monitor">Resource Monitor </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>