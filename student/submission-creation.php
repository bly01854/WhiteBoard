<?php
include '../session/student-session.php';
include '../functions/html_element.php';
include '../functions/console_log.php';


if(isset($_POST['comments'])){
  
  
  $comments = htmlspecialchars($_POST['comments']);
  $graded = 0;
  $assignment_id = $_POST['assignment'];
 
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  
  
  $query = "INSERT INTO Submission (studentID, comments, assignmentID, graded) VALUES (?, ?, ?, ?)";
  $stmt = $db->stmt_init();
  $stmt->prepare($query);
  $stmt->bind_param('dsdi', $session_studentId, $comments, $assignment_id, $graded);
  $stmt->execute();
  
  console_log($target_file);
  
  $file = $_FILES['fileToUpload']['name'];
  $file_size = $_FILES['fileToUpload']['size'];
  $file_type = $_FILES['fileToUpload']['type'];
  $submission_id = $db->insert_id;
  
  
  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
  $sql="INSERT INTO submission_file(file, type, size, submission_id) VALUES(?, ?, ?, ?)";
  $stmt = $db->stmt_init();
  $stmt->prepare($sql);
  $stmt->bind_param('ssds', $file, $file_type, $file_size, $submission_id);
  $stmt->execute();
 
  
}


// cleans input
function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>