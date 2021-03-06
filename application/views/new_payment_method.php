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
            <h3>New payment method</h3>

            <table>
            <form action="/Users/add_payment_method" method="POST">
                <tr>
                    <td>
                        Card number:</td><td><input type="text" name="number" class="form-control" /></td>
                </tr>
                <tr>
                    <td>
                        Name on card:</td><td><input type="text" name="cardholder" class="form-control" /></td>
                </tr>
                <tr>
                    <td>
                        Card type:</td>
                        <td>
                            <select name="type" class="form-control">
							<?php foreach($content['cardtypes'] as $card) { ?>
                                <option value="<?= $card ?>"><?= $card ?></option>
							<?php } ?>
                            </select>
                        </td>
                </tr>
                <tr>
                    <td>
                        Experation date:</td><td><input type="date" name="exp" class="form-control" /></td>
                </tr>
				<tr>
					<td>
						Security code:</td><td><input type="text" name="code" class="form-control" maxlength="3" /></td>
				</tr>
				<tr>
					<td>
						Primary:</td><td><input type="checkbox" name="main" /> (Yes, make this my primary payment method)</td>
				</tr>
                <tr>
                    <td></td>
                    <td>
						<br />
                        <input type="submit" value="Add payment method" class="btn btn-primary" />
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
				if($this->session->flashdata('add_payment_method_errors'))
				{
					echo $this->session->flashdata('add_payment_method_errors');
				}
			?>
        </td>
    </tr>
</table>

</body>
</html>
