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
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
</head>
<body>


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
			Welcome, <?php echo ucfirst($content['user']['username']) ?>!
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
			 |  <a href="/Users/logout">Logout</a>
		</td>
	</tr>
</table>

<table class="col-md-offset-1 col-md-10 margin-top-10">
    <tr>
        <td>
            <h3>Cart</h3>
        </td>
		<td>
		</td>
		<td class="right">
			<?php if(!$content['cart']) { ?>

			<?php } else { ?>
			<span class="alert"> --> <a href="/Users/get_checkout">Proceed to Checkout</a></span>
			<?php } ?>
	</td>
    </tr>
    <tr>
		<?php if($content['cart']) { ?>
			<?php foreach($content['cart'] as $item) { ?>
		        <td>
	                <p>Name: <?= $item['name'] ?></p>
	                <p>Description: <?= $item['description'] ?></p>
	                <p>Price: $<?= $item['price'] ?></p>
					<p>Quantity: <?= $item['quantity'] ?></p>
	                <p><img src="/img/<?= $item['url'] ?>"></p>
	                <p><a href="/Users/remove_from_cart/<?= $item['id'] ?>/<?= $item['quantity'] ?>/">remove from cart</a></p>
				</td>
	        <?php } ?>
		<?php } else { ?>
		<td>
			Nothing in cart
		</td>
		<?php } ?>
    </tr>
	<tr>
		<td>
		</td>
		<td>
		</td>
		<td class="right">
			<?php if(!$content['cart']) { ?>

			<?php } else { ?>
				<form action="/Users/get_checkout">
					<input type="submit" value=">>> Proceed to Checkout" class="btn btn-danger" />
				</form>
			<?php } ?>
		</td>
	</tr>
</table>

</body>
</html>
