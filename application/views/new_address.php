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

<div class="container">
	<table class="col-md-offset-1 col-md-10">
		<tr>
			<td>
				<h1>All You Need</h1>
			</td>
		</tr>
		<tr>
			<td class="header">
				Logged in as: <?php echo ucfirst($content['user']['username']) ?>
			</td>
			<td class="header right">
				<a href="/Users/main">Home</a> |
				<a href="/Users/cart">Cart</a>
				<?php if($content['cart_count'] == 0) { ?>
					(empty)
				<?php } else { ?>
					(<?= $content['cart_count'] ?>)
				<?php } ?>
				 | <a href="/Users/wishlist">Wishlist</a>
				 <?php if($content['wishlist_count']) { ?>
					 (<?php echo $content['wishlist_count'] ?>)
				 <?php } ?>
				 | <a href="/Users/account">Account</a>
				 | <a href="/Users/logout">Logout</a>
			</td>
		</tr>
	</table>

	<table class="col-md-offset-1 col-md-10 margin-top-10">
		<tr>
			<td class="valign-top">
	            <h3>Add an address</h3>

	            <table>
	            <form action="/Users/add_address/" method="POST">
	                <tr>
	                    <td>
	                        Street:</td><td><input type="text" name="street" class="form-control" /></td>
	                </tr>
	                <tr>
	                    <td>
	                        City:</td><td><input type="text" name="city" class="form-control" /></td>
	                </tr>
	                <tr>
	                    <td>
	                        State:</td><td><input type="text" name="state" class="form-control" /></td>
	                </tr>
	                <tr>
	                    <td>
	                        Zipcode:</td><td><input type="text" name="zip" class="form-control" /></td>
	                </tr>
					<tr>
						<td>
							Primary:</td><td><input type="checkbox" name="main" /> (Yes, make this my primary address)</td>
					</tr>
	                <tr>
	                    <td></td>
	                    <td>
							<br />
	                        <input type="submit" value="Add address" class="btn btn-primary" />
	                    </td>
	                </tr>
					<tr>
						<td>
							<a href="/Users/account">Back</a>
						</td>
					</tr>
				</form>
	            </table>

				<br />
				<?php
					if($this->session->flashdata('add_address_errors'))
					{
						echo $this->session->flashdata('add_address_errors');
					}
				?>
	        </td>
	    </tr>
	</table>
</div>

</body>
</html>
