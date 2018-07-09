<?php
	require_once('./class/student.php');
  	$st = new Student;

	if (isset($_POST["submit"])) {
		if ($st->addStudent($_POST['name'], $_POST['age'], $_POST['sex'], $_POST['phone'], $_POST['birthday'])) {
			header('Location: /');
		} else {
			header('Location: /form.php');
		}
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
				<form action="form.php" method="POST">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Name">
					</div>
					<div class="form-group">
						<label for="age">Age</label>
						<input type="text" class="form-control" id="age" name="age" placeholder="Age">
					</div>
					<div class="form-group">
						<label for="sex">Sex</label>
						<input type="text" class="form-control" id="sex" name="sex" placeholder="Sex">
					</div>
					<div class="form-group">
						<label for="phone">Phone</label>
						<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
					</div>
					<div class="form-group">
						<label for="birthday">Birthday</label>
						<input type="text" class="form-control" id="birthday" name="birthday" placeholder="Birthday">
					</div>
					<button type="submit" class="btn btn-success" name="submit">Submit</button>
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
