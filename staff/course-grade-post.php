<?php
include '../session/staff-session.php';
include '../functions/html_element.php';
include '../functions/console_log.php';

if(isset($_POST['grade'])){
    
    $submission_id = $_POST['submission'];
    $grade = $_POST['grade'];
    $comments = htmlspecialchars($_POST['comments']);
    
    $query = "INSERT INTO Grade (grade, comment, submissionID) VALUES (?, ?, ?)";
    $stmt = $db->stmt_init();
    $stmt->prepare($query);
    $stmt->bind_param('dsd', $grade, $comments, $submission_id);
    $stmt->execute();
    
    $sql = "UPDATE Submission SET graded=1 WHERE id=$submission_id";
    $result = $db->query($sql);
    
}
?>