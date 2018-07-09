<?php
	require_once('./class/student.php');
	$st = new Student;
	
	$search_st = [];

	// Pagination
	$pages = $st->getUserPageCount();
	$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$students = $st->getAllStudents($current_page);
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('./layouts/head.php'); ?>
<body>
	<?php require_once('./layouts/navbar.php'); ?>
	<?php require_once('./layouts/modals.php'); ?>
	<div class="container">
		<div class="alert alert-success alert-custom" role="alert"></div>
		<div class="alert alert-danger alert-custom" role="alert"></div>
		<div class="row">
			<div class="col-sm-8">
				<h2>Students</h2><hr>
				<button class="btn btn-warning" data-toggle="modal" data-target="#addModal">Add Student</button>
				<hr>
				<table class="table students-table table-responsive">
				  <thead>
				    <tr>
				      <th scope="col">Name</th>
				      <th scope="col">Age</th>
				      <th scope="col">Sex</th>
				      <th scope="col">Delete</th>
				      <th scope="col">Edit</th>
				      <th scope="col">Page</th>
				      <th scope="col">Teachers</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php for ($i = 0; $i < count($students); $i++): ?>
				  		<tr class="st_col<?php echo $students[$i]['id']; ?>">
							<td><?php echo $students[$i]["name"]; ?></td>
							<td><?php echo $students[$i]["age"]; ?></td>
							<td><?php echo $students[$i]["sex"]; ?></td>
							<td>
								<button class="btn btn-danger removeStudent" type="button" data-id="<?php echo $students[$i]["id"]; ?>">Delete</button>
							</td>
							<td>
								<button class="btn btn-warning editInfo" data-toggle="modal" data-id="<?php echo $students[$i]['id']; ?>" data-name="<?php echo $students[$i]["name"]; ?>">Edit</button>
							</td>
							<td>
								<button class="btn btn-primary openPage" data-id="<?php echo $students[$i]['id']; ?>">Page</button>
							</td>
							<td>
								<button class="btn btn-success openTeachers" data-id="<?php echo $students[$i]['id']; ?>">Teachers</button>
							</td>
						</tr>
				  	<?php endfor; ?>
				  </tbody>
				</table>
				<nav aria-label="Page navigation example">
				<ul class="pagination">
					<li class="page-item"><a class="page-link" href="/index.php?page=<?php if ($current_page > 1) echo $current_page-1; else echo $current_page; ?>">Previous</a></li>
					<?php for ($i = 1; $i <= $pages; $i++): ?>
					<li class="page-item"><a class="page-link" href="/index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
					<?php endfor; ?>
					<?php 
						$next = isset($_GET['page']) ? intval($_GET['page'])+1 : 2;
						if ($next > $pages) $next = $pages;
					?>
					<li class="page-item"><a class="page-link" href="/index.php?page=
						<?php echo $next; ?>
					">Next</a></li>
				</ul>
				</nav>
		        <br><hr>
		        <form id="searchStudent">
		          <div class="form-group">
		          	<h2>Search</h2>
		            <input type="text" class="form-control" id="query" placeholder="Text student name" autocomplete="off"><br>
		          </div>
		        </form>
		        <table class="table search-table">
				    <tr>
				      <th scope="col">Name</th>
				      <th scope="col">Age</th>
				      <th scope="col">Sex</th>
				      <th scope="col">Delete</th>
				      <th scope="col">Edit</th>
				      <th scope="col">Page</th>
				      <th scope="col">Teachers</th>
				    </tr>
		        </table>
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
	<script type="text/javascript" src="assets/js/index.js"></script>
</body>
</html>
