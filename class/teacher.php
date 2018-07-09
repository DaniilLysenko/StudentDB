<?php

	require_once(dirname(__FILE__).'/db.php');

	class Teacher
	{
		public function addNewTeacher($teacher_id, $student_id)
		{
			$db = Db::getConnection();
			$sql = $db->prepare("INSERT INTO `student_teacher` (`student_id`, `teacher_id`) VALUES (:uid, :tid)");
			$sql->execute(['uid' => $student_id, 'tid' => $teacher_id]);
			return $teacher_id;
		}

		public function getAllTeachers() {
			$db = Db::getConnection();
			return $db->query("SELECT * FROM `teachers`")->fetchAll();
		}

		public function getStudentTeachers($student_id) {
			$db = Db::getConnection();
			$sql = $db->prepare("SELECT `teacher_id` FROM `student_teacher` WHERE `student_id` = :sid");
			$sql->execute(['sid' => $student_id]);
			$result = [];
			$ids = $sql->fetchAll();
			foreach ($ids as $el) {
				$sql = $db->prepare("SELECT * FROM `teachers` WHERE `id` = :tid");
				$sql->execute(['tid' => intval($el['teacher_id'])]);
				$result[] = $sql->fetch();
			}
			return $result;
		}

		public function killTeacher($teacher_id, $student_id) {
			$db = Db::getConnection();
			$sql = $db->prepare("DELETE FROM `student_teacher` WHERE `student_id` = :sid AND `teacher_id` = :tid");
			$sql->execute(['sid' => $student_id, "tid" => $teacher_id]);
			return true;
		}

		public function getTeacherInfo($id) 
		{
			if (intval($id)) {
				$db = Db::getConnection();
				$st = $db->prepare("SELECT * FROM `teachers` WHERE `id` = :id");
				$st->execute(["id" => $id]);
				return $st->fetch(PDO::FETCH_LAZY);			
			}
			return false;			
		}

		public function removeTeacherComms($id) {
			if (intval($id)) {
				$db = Db::getConnection();
				$sql = $db->prepare("DELETE FROM `student_teacher` WHERE `teacher_id` = :id");
				$sql->execute(['id' => $id]);
				return true;
			}	
			return false;
		}
	}