<?php
	require_once('../class/teacher.php');
	$teacher = new Teacher;

	// get student teachers

	if (isset($_POST['id']) && isset($_POST['type']) && $_POST['type'] == 'studentTeachers') {
		$teachers = $teacher->getStudentTeachers(intval($_POST['id']));
		$allTeachers = $teacher->getAllTeachers();
		echo json_encode(["teachers" => $teachers, "allTeachers" => $allTeachers]);
	}

	// remove teacher by id

	if (isset($_POST['tid']) && isset($_POST['sid']) && isset($_POST['type']) && $_POST['type'] == 'removeTeacher') {
		$teachers = $teacher->killTeacher(intval($_POST['tid']), intval($_POST['sid']));
		$teacher->removeTeacherComms($_POST['tid']);
		echo "OK";
	}

	// add student teacher by id

	if (isset($_POST['stid']) && isset($_POST['tid']) && isset($_POST['type']) && $_POST['type'] == 'addTeacher') {
		$insertId = $teacher->addNewTeacher($_POST['tid'], $_POST['stid']);
		$teacher = $teacher->getTeacherInfo($insertId);
		echo json_encode(["teacher" => $teacher]);
	}