<?php
require_once('../../database/dbhelper.php');

$id = $name = '';
if (!empty($_POST)) {
	if (isset($_POST['name'])) {
		$name = $_POST['name'];
	}
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	}

	if (!empty($name)) {
		$created_at = $updated_at = date('Y-m-d H:s:i');
		//Luu vao database
		if ($id == '') {
			$sql = 'insert into category(name, created_at, updated_at) values ("' . $name . '", "' . $created_at . '", "' . $updated_at . '")';
		} else {
			$sql = 'update category set name = "' . $name . '", updated_at = "' . $updated_at . '" where id = ' . $id;
		}

		execute($sql);

		header('Location: index.php');
	}
}

if (isset($_GET['id'])) {
	$id       = $_GET['id'];
	$sql      = 'select * from category where id = ' . $id;
	$category = executeSingleResult($sql);
	if ($category != null) {
		$name = $category['name'];
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Update Category</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="../style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
	<ul class="nav navbar-fixed-top">
		<li class="nav-item">
			<a class="nav-link" href="index.php">Category Management</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="../product/">Products Management</a>
		</li>
	</ul>

	<div class="wrapper">
		<div class="inner">
			<div class="image-holder">
				<img src="../images/flowers.png" alt="">
			</div>
			<form action="" method="post">
				<h3>UPDATE CATEGORY</h3>
				<div class="form-group">
					<label for="name">Category:</label>
					<input type="text" name="id" value="<?= $id ?>" hidden="true">
					<input required="true" type="text" class="form-control" id="name" name="name" value="<?= $name ?>">
				</div>
				<div class="button">
					<button>Save</button>
				</div>
			</form>
		</div>
	</div>
</body>

</html>