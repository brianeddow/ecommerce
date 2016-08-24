<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
</head>
<body>

<table class="col-md-offset-1 col-md-10">
	<tr>
		<td>
			<h1>All You Need</h1>
		</td>
	</tr>
	<tr>
		<td class="header">
			Products
		</td>
		<td class="header right">
			<a href="/Users/main">Home</a> | <a href="/Users/logout">Logout</a>
		</td>
	</tr>
</table>

<table class="col-md-offset-1 col-md-10 margin-top-10">
	<tr>
		<td>
			<h4>New Product</h4>
			<form action="/Products/add_product" method="post">
			<table>
				<tr>
					<td>
					Name:</td><td><input type="text" name="name" class="form-control" /></td>
				</tr>
				<tr>
					<td>
					Description:</td><td><input type="text" name="description" class="form-control" /></td>
				</tr>
				<tr>
					<td>
					Price:</td><td><input type="number" step="any" name="price" class="form-control" /></td>
				</tr>
				<tr>
					<td>
					Category:</td><td><input type="text" name="category" class="form-control" /></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="hidden" name="quant_avail" value="50" />
						<input type="hidden" name="url" value="http://" />
						<input type="submit" value="Add Product" class="btn btn-primary"/></td>
				</tr>
			</table>
			</form>
		</td>
	</tr>
</table>

</body>
</html>
