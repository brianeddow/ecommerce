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
			<?php echo ucfirst($content['user']['username']) ?>
		</td>
		<td class="header" style="text-align: right;">
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
            <h3>Update Password</h3>

            <table>
            <form action="/Users/update_password" method="POST">
                <tr>
                    <td>
                        Username:</td><td><?= $content['user']['username'] ?></td>
                </tr>
                <tr>
                    <td>
                        First name:</td><td><?= $content['user']['f_name'] ?></td>
                </tr>
                <tr>
                    <td>
                        Last name:</td><td><?= $content['user']['l_name'] ?></td>
                </tr>
                <tr>
                    <td>
                        Email address:</td><td><?= $content['user']['email'] ?></td>
                </tr>
				<tr>
					<td>
						New Password:</td><td><input type="password" name="password" class="form-control" /></td>
				</tr>
                <tr>
                    <td>
                        Confirm New Password:</td><td><input type="password" name="password_conf" class="form-control" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
						<br />
                        <input type="submit" value="Submit" class="btn btn-primary" />
                    </td>
                </tr>
				<tr>
					<td>
						<a href="/Users/edit">Back</a>
					</td>
				</tr>
			</form>
            </table>

			<br />
			<?php
				if($this->session->flashdata('update_password_errors'))
				{
					echo $this->session->flashdata('update_password_errors');
				}
			?>
        </td>
    </tr>
</table>

</body>
</html>
