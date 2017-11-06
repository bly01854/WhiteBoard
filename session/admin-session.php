<?php
session_start();
    include '../connection.php';
    
    $user_check=$_SESSION['login_user'];
    
    $sql = "SELECT username, role, instId FROM User WHERE id = '$user_check'";
    $result = mysqli_query($db, $sql) or die('error getting data');
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $login_session = $row['username'];
    $session_role=$row['role'];
    $session_isntId = $row['instId'];
    
    $sql = "SELECT name, primaryColor, secondaryColor FROM Institution WHERE id = '$session_isntId'";
    $result = mysqli_query($db, $sql) or die('error getting data');
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $session_institution = $row['name'];
    $session_primaryColor = $row['primaryColor'];
    $session_secondaryColor = $row['secondaryColor'];
    
    
    
    
    if(!isset($login_session)){
        mysqli_close($db);
        header( 'Location: ../login.php' );
    }
    
     if ($session_role!=='admin') {
        header( 'Location: ../login.php' );

    }
    
?>