<?php
	require_once('../class/student.php');
	$st = new Student;

	// get single student info by id

	if (isset($_POST['id']) && isset($_POST['type']) && $_POST['type'] == 'singleStudent') {
		sleep(1);
		$student = $st->getSingleStudent(intval($_POST['id']));
		echo json_encode(["student" => $student]);
		return true;
	} 

	// remove student by id

	if (isset($_POST['id']) && isset($_POST['type']) && $_POST['type'] == 'removeStudent') {
		$student = $st->removeStudent(intval($_POST['id']));
		echo "OK";
		return true;
	}

	// edit student image

	if (isset($_POST['sid']) && isset($_FILES['image']) && isset($_POST['type']) && $_POST['type'] == 'uploadImage') {
		$result = $st->uploadUserImg($_FILES['image']['tmp_name'], $_FILES['image']['type'], $_FILES['image']['name'], $_POST['sid']);
		echo json_encode(["result" => $result]);
		return true;
	}

	// add new student

	if (isset($_POST['name']) && isset($_POST['age']) && isset($_POST['sex']) && isset($_POST['phone']) && 	isset($_POST['birthday']) && isset($_POST['type']) && $_POST['type'] == 'addStudent') {
		if ($_POST['name'] == "" || $_POST['age'] == "" || $_POST['sex'] == "" || $_POST['phone'] == "" || $_POST['birthday'] == "" || !intval($_POST['age'])) {
			echo json_encode(["error" => "You missing some data"]);
			return;
		}
		$student = $st->addStudent($_POST['name'], intval($_POST['age']), $_POST['sex'], $_POST['phone'], $_POST['birthday']);
		echo json_encode(["student" => $student]);
	}