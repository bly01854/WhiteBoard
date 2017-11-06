<?php
session_start();
    include '../connection.php';
    include '../objects/course.php';
    
    
    
    
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
    
    //get student details
    $sql = "SELECT studentID, firstName, lastName, email FROM Student WHERE userId = '$user_check'";
    $result = mysqli_query($db, $sql) or die('error getting data');
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $session_studentId=$row['studentID'];
    $session_firstName=$row['firstName'];
    $session_lastName=$row['lastName'];
    $session_email=$row['email'];
    
    //get student courses
    $sql = "SELECT * FROM Student_Course_Junction WHERE student_id = '$session_studentId'";
    $result = mysqli_query($db, $sql) or die('error getting data');
              
    $courseArray = array();
    $i = 0;
              
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $courseId = $row['course_id'];
                
        $courseSql = "SELECT * FROM Course WHERE courseID= '$courseId'";
        $courseResult = mysqli_query($db, $courseSql) or die('error getting data');
        $courseRow = mysqli_fetch_array($courseResult, MYSQLI_ASSOC);
        $course = new course;
        $course->set_id($courseRow['courseID']);
        $course->set_name($courseRow['courseName']);
        $course->set_description($courseRow['description']);
        $course->set_staffId($courseRow['staffID']);
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
     if ($session_role!=='student') {
        header( 'Location: ../login.php' );

    }
    
?>