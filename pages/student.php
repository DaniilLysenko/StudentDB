<?php
	require_once('./class/student.php');

  $st = new Student;
  $student = $st->getSingleStudent($_GET['id']);
  $all_teachers = $st->getAllTeachers();
  $student_teachers = $st->getStudentTeachers($_GET['id']);

  if (isset($_POST['upload'])) {
    $st->uploadUserImg($_FILES['image']['tmp_name'], $_FILES['image']['type'], $_FILES['image']['name'], $_POST['id']);
    header('Location: /');
  }

  if (isset($_POST['choose'])) {
    $st->addNewTeacher($_POST['teacher'], $_POST['id']);
    header('Location: /student.php?id='.$_POST['id']);
  }

  if (isset($_POST['kill'])) {
    $st->killTeacher($_POST['teacher_id'], $_POST['student_id']);
    header('Location: /student.php?id='.$_POST['student_id']);
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
        <?php if ($student): ?>
        <h2>Student <?php echo $student['name']; ?></h2><br>
        <div class="panel panel-default">
          <ul class="list-group">
            <li class="list-group-item active"><strong>Name: </strong><?php echo $student['name']; ?></li>
            <li class="list-group-item"><a data-fancybox="gallery" href="<?php echo $student['image']; ?>"><img style="width: 100%;" src="<?php echo $student['image']; ?>"></a></li>
            <li class="list-group-item"><strong>Sex: </strong><?php echo $student['sex']; ?></li>
            <li class="list-group-item"><strong>Age: </strong><?php echo $student['age']; ?></li>
            <li class="list-group-item"><strong>Phone number: </strong><?php echo $student['phone']; ?></li>
            <li class="list-group-item"><strong>Birthday: </strong><?php echo $student['birthday']; ?></li>
          </ul>
        </div>
        <br><hr>
        <form method="POST" action="student.php" enctype="multipart/form-data">
          <h3>Upload your photo</h3>
          <div class="form-group">
            <input type="file" name="image">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
          </div>
          <button class="btn btn-success" type="submit" name="upload">Upload</button>
        </form>
        <?php else: ?>
        <h2><?php echo "Такого юзера немає :("; ?></h2>
        <?php endif; ?>
        <br><hr><br>
        <div class="teachers">
          <h2><?php echo $student['name']; ?> teachers</h2>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Course</th>
                <th scope="col">Kill</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($student_teachers as $teacher): ?>
                <tr>
                  <th scope="row"><?php echo $teacher["name"]; ?></th>
                  <td><?php echo $teacher["course"]; ?></td>
                  <td>
                    <form method="POST" action="student.php">
                      <input type="hidden" value="<?php echo $teacher['id']; ?>" name="teacher_id">
                      <input type="hidden" value="<?php echo $student['id']; ?>" name="student_id">
                      <button class="btn btn-danger" type="submit" name="kill">Kill</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <br><hr><br>
        <div class="add_teacher">
          <h2>Choose teacher you want right now!</h2>
          <form method="POST" action="student.php">
            <div class="form-group">
              <label for="sel">Select teacher:</label>
              <select class="form-control" id="sel" name="teacher">
                <?php for ($i = 0; $i < count($all_teachers); $i++): ?>
                  <option value="<?php echo $all_teachers[$i]['id']; ?>"><?php echo $all_teachers[$i]['name']; ?>, <?php echo $all_teachers[$i]['course']; ?></option>
                <?php endfor; ?>
              </select><br>
            </div>
            <input type="hidden" value="<?php echo $student['id']; ?>" name="id">
            <button class="btn btn-warning" type="submit" name="choose">Choose</button>
          </form>
          <br><br>
        </div>
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
