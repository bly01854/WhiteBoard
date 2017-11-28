<?php
include '../session/staff-session.php';
include '../functions/console_log.php';

if(isset($_POST['id'])){
  //messages to give back to the user
  
  $id = $_POST['id'];
  $course_id = $_POST['course_id'];
  
  $sql = "INSERT INTO Student_Course_Junction (student_id, course_id) VALUES (?, ?)";
  $stmt = $db->stmt_init();
  $stmt->prepare($sql);
  $stmt->bind_param('dd', $id, $course_id);
  $stmt->execute();
  
}

$term = $_GET['term'];

$sql = "SELECT DISTINCT firstName, lastName, studentID FROM Student WHERE (concat_ws(' ', firstName, lastName) LIKE '%$term%')";
$result = $db->query($sql);
$json = array();
while($row = $result->fetch_array(MYSQLI_ASSOC)){
	$name = $row['firstName'] . " " . $row['lastName'];
	$json[] = array(
		'value' => $row['studentID'],
		'label' => $name);
		
}

echo json_encode($json);

?>