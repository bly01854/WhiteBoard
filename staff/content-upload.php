<?php
include '../session/student-session.php';
include '../functions/html_element.php';
include '../functions/console_log.php';


if(isset($_POST['title'])){
  
  
  $body = htmlspecialchars($_POST['body']);
  $course_id = $_POST['course'];
  $title = test_input($_POST['title']);
 
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  
  
  $query = "INSERT INTO content (title, body, course_id) VALUES (?, ?, ?)";
  $stmt = $db->stmt_init();
  $stmt->prepare($query);
  $stmt->bind_param('ssd', $title, $body, $course_id);
  $stmt->execute();
  
  console_log($target_file);
  
  $file = $_FILES['fileToUpload']['name'];
  $file_size = $_FILES['fileToUpload']['size'];
  $file_type = $_FILES['fileToUpload']['type'];
  $content_id = $db->insert_id;
  
  
  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
  $sql="INSERT INTO content_file(file, type, size, content_id) VALUES(?, ?, ?, ?)";
  $stmt = $db->stmt_init();
  $stmt->prepare($sql);
  $stmt->bind_param('ssds', $file, $file_type, $file_size, $content_id);
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