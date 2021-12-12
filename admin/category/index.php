<?php
require_once('../../database/dbhelper.php');
?>
<!DOCTYPE html>
<html>

<head>
	<title>Category Management</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="../style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
	<ul class="nav">
		<li class="nav-item">
			<a class="nav-link active" href="#">Category Management</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" style="color:black" href="../product/">Products Management</a>
		</li>
	</ul>
	
	<div class="wrapper">
		<div class="container">
				<div class="panel-heading">
					<h2 class="text-center">CATEGORY</h2>
				</div>
				<div class="panel-body">
					<a href="add.php">
						<button class="bt">Create</button>
					</a>
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th width="50px"></th>
								<th>Category</th>
								<th width="50px"></th>
								<th width="50px"></th>
							</tr>
						</thead>
						<tbody>
							<?php
							//Lay danh sach danh muc tu database
							$sql          = 'select * from category';
							$categoryList = executeResult($sql);

							$index = 1;
							foreach ($categoryList as $item) {
								echo '<tr>
									<td>' . ($index++) . '</td>
									<td>' . $item['name'] . '</td>
									<td>
										<a href="add.php?id=' . $item['id'] . '"><button class="btn-up">Update</button></a>
									</td>
									<td>
										<button class="btn-del" onclick="deleteCategory(' . $item['id'] . ')">Delete</button>
									</td>
								</tr>';
							}
							?>
						</tbody>
					</table>
				</div>
		</div>
	</div>
	<script type="text/javascript">
		function deleteCategory(id) {
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