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
			Welcome, <?php echo ucfirst($content['user']['username']) ?>!
		</td>
		<td class="header right">
			<?php if($content['logged_in_user'] == $content['admin']) { ?>
				<a href="/Products/new_product">Add Product</a> |
			<?php } ?>
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
	<!-- row 1 -->
	<tr>
		<td>
			<h3>Home & Garden</h3>
		</td>
	</tr>
	<tr>
		<td>
			<hr>
		</td>
		<td>
			<hr>
		</td>
		<td>
			<hr>
		</td>
	</tr>
	<tr>
		<td>
			<?php if($content['category']) { ?>
                <?php foreach($content['category'] as $item) { ?>
                    <p><a href="/Products/show/<?= $item['id'] ?>/"><?= $item['name'] ?></a> - <?= $item['quant_avail'] ?> left</p>
                <?php } ?>
            <?php } ?>
		</td>
	</tr>
	<!-- end row 1 -->
	<!-- row 2 -->
	<tr>
		<td>
			<hr>
		</td>
		<td>
			<hr>
		</td>
		<td>
			<hr>
		</td>
	</tr>
	<!-- end row 2 -->
</table>

</body>
</html>
