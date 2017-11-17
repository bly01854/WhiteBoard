<?php
include '../session/student-session.php';
include '../functions/console_log.php';

$term = $_GET['term'];
$id_array = array();
for ($i=0; $i<count($courseArray); $i++){
	array_push($id_array, $courseArray[$i]->get_id());
}
$id_array = implode(" OR ", $id_array);

$sql = "SELECT DISTINCT firstName, lastName, userId FROM Student JOIN Student_Course_Junction ON Student.studentID=Student_Course_Junction.student_id WHERE course_id = ($id_array) AND (concat_ws(' ', firstName, lastName) LIKE '%$term%')";
$result = $db->query($sql);
$json = array();
while($row = $result->fetch_array(MYSQLI_ASSOC)){
	$json[] = array(
		'value' => 'message.php?id=' . $row['userId'],
		'label' => $row['firstName'] . " " . $row['lastName']);
		
}

$sql = "SELECT DISTINCT firstName, lastName, userId FROM Course JOIN Staff ON Course.staffID=Staff.id WHERE courseID = ($id_array) AND (concat_ws(' ', firstName, lastName) LIKE '%$term%')";
$result = $db->query($sql);
while($row = $result->fetch_array(MYSQLI_ASSOC)){
	$json[] = array(
		'value' => 'message.php?id=' . $row['userId'],
		'label' => $row['firstName'] . " " . $row['lastName']);
		
}

echo json_encode($json);

?>