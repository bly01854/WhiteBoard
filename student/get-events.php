<?php
include '../session/student-session.php';
include '../functions/console_log.php';

$id_array = array();
for ($i=0; $i<count($courseArray); $i++){
	array_push($id_array, $courseArray[$i]->get_id());
}
$id_array = implode(" OR ", $id_array);
$sql = "SELECT title, start, reference_id FROM event WHERE course_id = $id_array";
$result = $db->query($sql);
$json = array();
while($row = $result->fetch_array(MYSQLI_ASSOC)){
	$json[] = array(
	    'title' => $row['title'],
	    'start' => $row['start'],
	    'url' => 'assignment.php?id=' . $row['reference_id'],
	    'allDay' => true);
}

echo json_encode($json);

?>