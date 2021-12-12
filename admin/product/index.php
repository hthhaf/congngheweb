<?php
require_once('../../database/dbhelper.php');
?>
<!DOCTYPE html>
<html>

<head>
	<title>Products Management</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="../style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
	<ul class="nav">
		<li class="nav-item">
			<a class="nav-link" style="color:black" href="../category/">Category Management</a>
		</li>
		<li class="nav-item">
			<a class="nav-link active" href="#">Products Management</a>
	</ul>

	<div class="wrapper">
		<div class="container">
				<div class="panel-heading">
					<h2 class="text-center">PRODUCTS</h2>
				</div>
				<br>
				<div class="panel-body">
					<a href="add.php">
						<button class="bt">Create</button>
					</a>
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th width="50px"></th>
								<th>Image</th>
								<th>Name</th>
								<th>Price</th>
								<th>Color</th>
								<th width="50px"></th>
								<th width="50px"></th>
							</tr>
						</thead>
						<tbody>
							<?php
							//Lay danh sach san pham tu database
							$sql          = 'select product.id, product.title, product.price, product.thumbnail, category.name category_name from product left join category on product.id_category = category.id ';
							$productList = executeResult($sql);

							$index = 1;
							foreach ($productList as $item) {
								echo '<tr>
										<td>' . ($index++) . '</td>
										<td><img src="' . $item['thumbnail'] . '" style="max-width: 150px"/></td>
										<td>' . $item['title'] . '</td>
										<td>' . $item['price'] . '</td>
										<td>' . $item['category_name'] . '</td>
										<td>
											<a href="add.php?id=' . $item['id'] . '"><button class="btn-up">Update</button></a>
										</td>
										<td>
											<button class="btn-del" onclick="deleteProduct(' . $item['id'] . ')">Delete</button>
										</td>
									</tr>';
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function deleteProduct(id) {
			var option = confirm('Are you sure you want to delete this item?')
			if (!option) {
				return;
			}

			console.log(id)
			$.post('ajax.php', {
				'id': id,
				'action': 'delete'
			}, function(data) {
				location.reload()
			})
		}
	</script>
</body>

</html>