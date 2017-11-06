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
    <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body>
    
    <?php include 'header.php';
    
    
    $monitor = shell_exec('python simple_resource_monitor.py ');
    
    $monitorData = json_decode($monitor, true);
    
    $number_of_users = count(scandir(ini_get("session.save_path"))) - 30;
    
    
    ?>
    
    <div style="padding:25px">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center" style="padding:10px">
                    <i class="fa fa-desktop fa-5x" aria-hidden="true"></i><h4 id="cpu"> CPU Usage:  <?php echo $monitorData[0]  ?>%</h4>
                </div>
            </div>
            <div class="row" style="padding:10px">
                <div class="col-md-12 text-center">
                    <i class="fa fa-tachometer fa-5x" aria-hidden="true"></i><h4 id="ram"> Memory Usage:  <?php echo $monitorData[1]  ?>%</h4>
                </div>
            </div>
            <div class="row" style="padding:10px">
                <div class="col-md-12 text-center">
                    <i class="fa fa-hdd-o fa-5x" aria-hidden="true"></i><h4 id="disk"> Disk Usage:  <?php echo $monitorData[2]  ?>%</h4>
                </div>
            </div>
            <div class="row" style="padding:10px">
                <div class="col-md-12 text-center">
                    <i class="fa fa-users fa-5x" aria-hidden="true"></i><h4 id="users"> Active Users:  <?php echo $number_of_users  ?></h4>
                </div>
            </div>
        </div>
    </div>
    
    
    
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script>
    $(document).ready(function(){
        setInterval(function() {
            $('#cpu').load(window.location.href + ' #cpu');
            $('#ram').load(window.location.href + ' #ram');
            $('#disk').load(window.location.href + ' #disk');
            $('#users').load(window.location.href + ' #users');
        }, 3000);
    });
</script>
    

</body>

</html>