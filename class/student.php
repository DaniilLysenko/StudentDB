<?php

	require_once(dirname(__FILE__).'/db.php');

	class Student 
	{
		public function addStudent($name, $age, $sex, $phone, $birthday) 
		{
			$db = Db::getConnection();
			try {
				$sql = $db->prepare("INSERT INTO `student` (`name`, `age`, `sex`, `phone`, `birthday`) VALUES (:name, :age, :sex, :phone, :birthday)");
				$sql->execute(['name' => $name,'age' => $age,'sex' => $sex,'phone' => $phone,'birthday' => $birthday]);
				return $this->getSingleStudent($db->lastInsertId());
			} catch (PDOException $e) {
				return false;
			}
		}

		public function removeStudent($id) 
		{
			$db = Db::getConnection();
			try {
				if (intval($id)) {
					$sql = $db->prepare("DELETE FROM `student` WHERE `id` = :id");
					$sql->execute(['id' => $id]);
					return true;
				}
				return false;
			} catch (PDOException $e) {
				return false;
			}
		}

		public function getAllStudents($page)
		{
			$db = Db::getConnection();
			$offset = $page > 1 ? (($page - 1) * 3) : 0;
			$sql = $db->prepare("SELECT * FROM `student` ORDER BY `id` DESC LIMIT 3 OFFSET ?");
			$sql->bindValue(1, $offset, PDO::PARAM_INT);
			$sql->execute();
			return $sql->fetchAll();
		}

		public function getUserPageCount()
		{
			$db = Db::getConnection();
			$count = intval($db->query("SELECT COUNT(`id`) FROM `student`")->fetch()[0]);
			$pages = 0;
			if (($count % 3) == 0) {
				$pages = $count / 3;
			} else {
				$pages = floor($count / 3) + 1;
			}
			return $pages;
		}

		public function getSingleStudent($id) 
		{
			if (intval($id)) {
				$db = Db::getConnection();
				$st = $db->prepare("SELECT * FROM `student` WHERE `id` = :id");
				$st->execute(["id" => $id]);
				return $st->fetch(PDO::FETCH_LAZY);			
			}
			return false;
		}

		public function uploadUserImg($tmp, $type, $name, $id) 
		{
			$types = ['image/gif', 'image/png', 'image/jpeg'];
			if (!in_array($type,$types)) {
				return false;
			} 
			if (move_uploaded_file($tmp,'../user_img/'.$name)) {
				$url = 'user_img/'.$name;
				$db = Db::getConnection();
				$sql = $db->prepare("UPDATE `student` SET `image` = :image WHERE `id` = :id");
				$sql->execute(['id' => $id, 'image' => $url]);
				return true;
			} else {
				return false;
			}
		}

		public function findStudent($query)
		{	
			if ($query !== "") {
				$query = "%$query%";
				$db = Db::getConnection();
				$sql = $db->prepare("SELECT * FROM `student` WHERE `name` LIKE :name");
				$sql->execute(['name' => $query]);
				return $sql->fetchAll();
			} 
			return [];
		}

		public function updateUserInfo($name, $age, $sex, $phone, $birthday, $id)
		{
			$db = Db::getConnection();
			$sql = $db->prepare("UPDATE `student` SET `name` = :name, `age` = :age, `sex` = :sex, `phone` = :phone, `birthday` = :birthday WHERE `id` = :id");
			$sql->execute(['name' => $name, 'age' => $age, 'sex' => $sex, 'phone' => $phone, 'birthday' => $birthday, 'id' => $id]);
			return true;
		}

		public function removeStudentComms($id) {
			if (intval($id)) {
				$db = Db::getConnection();
				$sql = $db->prepare("DELETE FROM `student_teacher` WHERE `student_id` = :id");
				$sql->execute(['id' => $id]);
				return true;
			}	
			return false;
		}

		// API methods

		public function addStudentAPI($name, $age, $sex, $phone, $birthday) 
		{
			$db = Db::getConnection();
			try {
				$sql = $db->prepare("INSERT INTO `student` (`name`, `age`, `sex`, `phone`, `birthday`) VALUES (:name, :age, :sex, :phone, :birthday)");
				$sql->execute(['name' => $name,'age' => $age,'sex' => $sex,'phone' => $phone,'birthday' => $birthday]);
				return json_encode(["student" => $this->getSingleStudent($db->lastInsertId())]);
			} catch (PDOException $e) {
				return json_encode(["error" => "Something wrong with db connection"]);
			}
		}

		public function removeStudentAPI($id) 
		{
			$db = Db::getConnection();
			try {
				if (intval($id)) {
					$sql = $db->prepare("DELETE FROM `student` WHERE `id` = :id");
					$sql->execute(['id' => $id]);
					return json_encode(["success" => "User removed successfully"]);
				} else {
					return json_encode(["error" => "Id is not a number"]);
				}
			} catch (PDOException $e) {
				return json_encode(["error" => "Something wrong with db connection"]);
			}
		}

		public function getAllStudentsAPI($page)
		{
			$db = Db::getConnection();
			$offset = $page > 1 ? (($page - 1) * 3) : 0;
			$sql = $db->prepare("SELECT * FROM `student` ORDER BY `id` DESC LIMIT 3 OFFSET ?");
			$sql->bindValue(1, $offset, PDO::PARAM_INT);
			$sql->execute();
			return json_encode(["students" => $sql->fetchAll()]);
		}

		public function getSingleStudentAPI($id) 
		{
			if (intval($id)) {
				$db = Db::getConnection();
				$st = $db->prepare("SELECT * FROM `student` WHERE `id` = :id");
				$st->execute(["id" => $id]);
				return json_encode(["student" => $st->fetch(PDO::FETCH_LAZY)]);			
			}
			return json_encode(["error" => "Id is not a number"]);
		}
	}