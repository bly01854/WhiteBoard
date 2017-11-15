<?php
session_start();
    include '../../../connection.php';
    include '../../../objects/course.php';
    include '../../../functions/console_log.php';
    
    
    
    
    $user_check=$_SESSION['login_user'];
    
    //get user details
    $sql = "SELECT username, role, instId FROM User WHERE id = '$user_check'";
    $result = mysqli_query($db, $sql) or die('error getting data');
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $login_session = $row['username'];
    $session_role=$row['role'];
    $session_instId = $row['instId'];
    
    //get institution details
    $sql = "SELECT name, primaryColor, secondaryColor FROM Institution WHERE id = '$session_instId'";
    $result = mysqli_query($db, $sql) or die('error getting data');
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $session_institution = $row['name'];
    $session_primaryColor=$row['primaryColor'];
    $session_secondaryColor = $row['secondaryColor'];
    
    //get staff details
    $sql = "SELECT * FROM Staff WHERE userId = '$user_check'";
    $result = mysqli_query($db, $sql) or die('error getting data');
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $session_staffId=$row['id'];
    $session_firstName=$row['firstName'];
    $session_lastName=$row['lastName'];
    $session_email=$row['email'];
    
    //get staff courses
    $sql = "SELECT * FROM Course WHERE staffID = '$session_staffId'";
    $result = mysqli_query($db, $sql) or die('error getting data');
              
    $courseArray = array();
    $i = 0;
              
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $course = new course;
        $course->set_id($row['courseID']);
        $course->set_name($row['courseName']);
        $course->set_description($row['description']);
        $course->set_staffId($row['staffID']);
        // add to session array
        $courseArray[$i] = $course;
        $i++;
    }
    
    
    // redirect if session is lost
    if(!isset($login_session)){
        mysqli_close($db);
        header( 'Location: ../login.php' );
    }
    // redirect if role is not student
     if ($session_role!=='staff') {
        header( 'Location: ../login.php' );

    }
    
?>