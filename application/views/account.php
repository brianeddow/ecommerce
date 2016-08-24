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
<body class="account">

<table class="col-md-offset-1 col-md-10">
	<tr>
		<td>
		</td>
		<td>
			<h1 class="align-right title-padding-right">All You Need</h1>
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
		<td class="title">
            <h3>Account Settings</h3>
		</td>
	</tr>
    <tr>
        <td>
            <table>
                <tr>
                    <td>
                        <h4>User Information</h4>
                    </td>
                    <td>
                          <span class="padding-left-10">(<a href="/Users/edit">Edit</a>)</span>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td>
                        <p>Username:</td><td><?php echo $content['user']['username'] ?></p></td>
                </tr>
                <tr>
                    <td>
                        <p>Full name:</td><td><?php echo $content['user']['f_name']." ".$content['user']['l_name'] ?></p></td>
                </tr>
                <tr>
                    <td>
                        <p>Email address:</td><td><?php echo $content['user']['email'] ?></p></td>
                </tr>
                <tr>
                    <td>
                        <p>Password:</td><td><a href="/Users/edit_password">Change Password</a></p></td>
                </td>
            </table>
        </td>
        <td class="title">
			<table>
				<tr>
					<td>
			            <h4>Payment Methods</h4>
					</td>
					<td>
						<span class="padding-left-10">(<a href="/Users/new_payment_method">Add Payment Method</a>)</span>
					</td>
				</tr>
				<tr>
					<td>
						<?php if($content['payment']) { ?>
							<?php if($content['payment'][0]['main'] == 1) { ?>
								<p><?= $content['payment'][0]['type'] ?> (<span style="font-weight: bold;">primary</span>)</p>
							<?php } ?>
						<?php } ?>
					</td>
				</tr>
			</table>
        </td>
    </tr>
    <tr>
        <td class="title">
            <h4>Purchase History</h4>

			<p><a href="/Users/checkout">Current order</a></p>

			<?php if($content['order_history']) { ?>
				<?php foreach($content['order_history'] as $item) { ?>
					<p>Order #<?= $item['id'] ?> - placed on <?= $item['created_at'] ?></p>
				<?php } ?>
			<?php } ?>

        </td>
        <td class="title">

			<table>
				<tr>
					<td>
			            <h4>Addresses</h4>
					</td>
					<td>
						<span class="padding-left-10">(<a href="/Users/new_address">Add Address</a>)</span>
					</td>
				</tr>
			</table>

			<?php if($content['addresses']) { ?>
				<?php foreach($content['addresses'] as $address) { ?>
					<p><?= $address['street'] ?>, <?= $address['city'] ?> <?= $address['state'] ?> <?= $address['zip'] ?>
						<?php if($address['main'] == 1) { ?>
							(<span class="bold">primary</span>)
						<?php } ?>
					</p>
				<?php } ?>
			<?php } ?>
        </td>
    </tr>
</table>

</body>
</html>
