<?php
require_once('../../database/dbhelper.php');

$id = $title = $price = $thumbnail = $content = $id_category = '';
if (!empty($_POST)) {
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	}

	if (isset($_POST['title'])) {
		$title = $_POST['title'];
	}

	if (isset($_POST['price'])) {
		$price = $_POST['price'];
	}

	if (isset($_POST['thumbnail'])) {
		$thumbnail = $_POST['thumbnail'];
	}

	if (isset($_POST['content'])) {
		$content = $_POST['content'];
	}
	if (isset($_POST['id_category'])) {
		$id_category = $_POST['id_category'];
	}
	//update san pham vao database
	if (!empty($title)) {
		$created_at = $updated_at = date('Y-m-d H:s:i');

		if ($id == '') {
			$sql = 'insert into product(title, price, thumbnail, content, id_category, created_at, updated_at) values ("' . $title . '", "' . $price . '", "' . $thumbnail . '", "' . $content . '", "' . $id_category . '", "' . $created_at . '", "' . $updated_at . '")';
		} else {
			$sql = 'update product set title = "' . $title . '", price = "' . $price . '", thumbnail = "' . $thumbnail . '", content = "' . $content . '", id_category = "' . $id_category . '",  updated_at = "' . $updated_at . '" where id = ' . $id;
		}

		execute($sql);

		header('Location: index.php');
	}
}

//

if (isset($_GET['id'])) {
	$id      = $_GET['id'];
	$sql      = 'select * from product where id = ' . $id;
	$product = executeSingleResult($sql);
	if ($product != null) {
		$title = $product['title'];
		$price = $product['price'];
		$thumbnail = $product['thumbnail'];
		$content = $product['content'];
		$id_category = $product['id_category'];
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>UPDATE PRODUCTS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="../style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<!-- include summernote css/js -->
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>

<body>
	<ul class="nav nav-tabs">
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
				<form action="" method="post" enctype="multipart/form-data">
					<h3>UPDATE PRODUCTS</h3>
					<div class="form-group ">
						<label for="title">Name: </label>
						<input type="text" name="id" value="<?= $id ?>" hidden="true">
						<input required="true" type="text" class="form-control" id="title" name="title" value="<?= $title ?>">
					</div>

					<div class="form-group">
						<label for="id_category">Category</label>
						<select class="form-control" name="id_category" id="id_category">
							<option>Select</option>
							<?php
							$sql          = 'select * from category';
							$categoryList = executeResult($sql);

							foreach ($categoryList as $item) {
								echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
							}
							?>
						</select>
					</div>

					<div class="form-group">
						<label for="price">Price:</label>
						<input type="text" name="id" value="<?= $id ?>" hidden="true">
						<input required="true" type="number" class="form-control" id="price" name="price" value="<?= $price ?>">
					</div>

					<div class="form-group">
						<label for="thumbnail">Thumbnail:</label>
						<input type="text" name="id" value="<?= $id ?>" hidden="true">
						<input required="true" type="text" class="form-control" id="thumbnail" name="thumbnail" value="<?= $thumbnail ?>">
					</div>
				</form>
			<form action="" method="post">
				<div class="cont">
					<label for="content">Content:</label>
					<input type="text" name="id" value="<?= $id ?>" hidden="true">
					<input required="true" type="text" class="form-control" id="content" name="content" value="<?= $content ?>">
				</div>

				<div class="button">
					<button>Save</button>
			</form>
		</div>
	</div>

	<script type="text/javascript">
		$(function() {
			$('#content').summernote({
				height: 350,
				codemirror: {
					theme: 'monokai'
				}
			});
		})
	</script>

</body>

</html>