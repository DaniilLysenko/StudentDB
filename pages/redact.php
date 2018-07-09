<?php
	require_once('./class/student.php');
  	$st = new Student;
  	$student = $st->getSingleStudent($_GET['id']);

  	if (isset($_POST['update'])) {
  		$st->updateUserInfo($_POST['name'], $_POST['age'], $_POST['sex'], $_POST['phone'], $_POST['birthday'], $_POST['id']);
  		header('Location: /');
  	}
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('./layouts/head.php'); ?>
<body>
   <?php require_once('./layouts/navbar.php'); ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<form action="redact.php" method="POST">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $student["name"]; ?>">
					</div>
					<div class="form-group">
						<label for="age">Age</label>
						<input type="text" class="form-control" id="age" name="age" placeholder="Age" value="<?php echo $student["age"]; ?>">
					</div>
					<div class="form-group">
						<label for="sex">Sex</label>
						<input type="text" class="form-control" id="sex" name="sex" placeholder="Sex" value="<?php echo $student["sex"]; ?>">
					</div>
					<div class="form-group">
						<label for="phone">Phone</label>
						<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?php echo $student["phone"]; ?>">
					</div>
					<div class="form-group">
						<label for="birthday">Birthday</label>
						<input type="text" class="form-control" id="birthday" name="birthday" placeholder="Birthday" value="<?php echo $student["birthday"]; ?>">
					</div>
					<input type="hidden" name="id" value="<?php echo $student['id']; ?>">
					<button type="submit" class="btn btn-warning" name="update">Update</button>
				</form>
			</div>
			<div class="col-sm-4">
				<div class="card" style="width: 18rem;">
					<img class="card-img-top" src="https://i1.wp.com/www.make-info.com/wp-content/uploads/2018/02/PHP.png" alt="Card image cap">
					<div class="card-body">
						<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
					</div>
				</div><br>
				<div class="card" style="width: 18rem;">
					<img class="card-img-top" src="http://www.leadingittrainings.com/courselists_img/29.png" alt="Card image cap">
					<div class="card-body">
						<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php require_once('./layouts/footer.php'); ?>
</body>
</html>
