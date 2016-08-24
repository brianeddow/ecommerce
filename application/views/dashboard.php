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

<table class="col-md-offset-1 col-md-10">
	<!-- row 1 -->
	<tr>
		<td>
			<h3 class="underline">Newest</h3>
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
	<tr class="bg-color">
		<td>
			<h4><a href="/Products/homegarden">Home & Garden</a></h4>
			<?php if($content['homeAndGarden']) { ?>
				<p><a href="/Products/show/<?= $content['homeAndGarden']['id'] ?>/"><?= $content['homeAndGarden']['name'] ?></a></p>
				<p><?= $content['homeAndGarden']['description'] ?></p>
				<p>$<?= $content['homeAndGarden']['price'] ?></p>
				<form action="/Users/add_to_cart/<?= $content['homeAndGarden']['id'] ?>/" method="POST">
				<p><?= $content['homeAndGarden']['quant_avail'] ?> left
					<select name="quantity">
						<?php for($i=1;$i<11;$i++) { ?>
							<option value="<?= $i ?>"><?= $i ?></option>
						<?php } ?>
					</select>
					<input type="submit" value="Add to cart" class="btn btn-primary">
				</p>
			    </form>
			<?php } ?>

		</td>
		<td>
			<h4><a href="/Products/clothingfootwear">Clothing & Footwear</a></h4>
			<?php if($content['clothingAndFootwear']) { ?>
				<form action="/Users/add_to_cart/<?php echo $content['clothingAndFootwear']['id'] ?>/" method="POST">
				<p><a href="/Products/show/<?= $content['clothingAndFootwear']['id'] ?>/"><?= $content['clothingAndFootwear']['name'] ?></a></p>
				<p><?= $content['clothingAndFootwear']['description'] ?></p>
				<p>$<?= $content['clothingAndFootwear']['price'] ?></p>
				<p><?= $content['clothingAndFootwear']['quant_avail'] ?> left
					<select name="quantity">
						<?php for($i=1;$i<11;$i++) { ?>
							<option value="<?= $i ?>"><?= $i ?></option>
						<?php } ?>
					</select>
					<input type="submit" value="Add to cart" class="btn btn-primary" />
				</p>
				</form>
			<?php } ?>

		</td>
		<td>
			<h4><a href="/Products/technologygadgets">Technology & Gadgets</a></h4>
			<?php if($content['technologyAndGadgets']) { ?>
				<form action="/Users/add_to_cart/<?php echo $content['technologyAndGadgets']['id'] ?>/" method="POST">
				<p><a href="/Products/show/<?= $content['technologyAndGadgets']['id'] ?>/"><?= $content['technologyAndGadgets']['name'] ?></a></p>
				<p><?= $content['technologyAndGadgets']['description'] ?></p>
				<p>$<?= $content['technologyAndGadgets']['price'] ?></p>
				<p><?= $content['technologyAndGadgets']['quant_avail'] ?> left
					<select name="quantity">
						<?php for($i=1;$i<11;$i++) { ?>
							<option value="<?= $i ?>"><?= $i ?></option>
						<?php } ?>
					</select>
					<input type="submit" value="Add to cart" class="btn btn-primary" />
				</p>
				</form>
			<?php } ?>
		</td>
	</tr>
	<!-- end row 1 -->
	<!-- row 2 -->
	<tr>
		<td>
			<h3 class="underline">Most Popular</h3>
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
	<tr class="bg-color">
		<td>
			<h4><a href="/Products/homegarden">Home & Garden</a></h4>
			<?php if($content['popular_homeAndGarden']) { ?>
				<form action="/Users/add_to_cart/<?php echo $content['popular_homeAndGarden']['id'] ?>/" method="POST">
				<p><a href="/Products/show/<?= $content['popular_homeAndGarden']['id'] ?>/"><?= $content['popular_homeAndGarden']['name'] ?></a></p>
				<p><?= $content['popular_homeAndGarden']['description'] ?></p>
				<p>$<?= $content['popular_homeAndGarden']['price'] ?></p>
				<p><?= $content['popular_homeAndGarden']['quant_avail'] ?> left
					<select name="quantity">
						<?php for($i=1;$i<11;$i++) { ?>
							<option value="<?= $i ?>"><?= $i ?></option>
						<?php } ?>
					</select>
					<input type="submit" value="Add to cart" class="btn btn-primary" />
				</p>
				</form>
			<?php } ?>
		</td>
		<td>
			<h4><a href="/Products/clothingfootwear">Clothing & Footwear</a></h4>
			<?php if($content['popular_clothingAndFootwear']) { ?>
				<form action="/Users/add_to_cart/<?php echo $content['popular_clothingAndFootwear']['id'] ?>/" method="POST">
				<p><a href="/Products/show/<?= $content['popular_clothingAndFootwear']['id'] ?>/"><?= $content['popular_clothingAndFootwear']['name'] ?></a></p>
				<p><?= $content['popular_clothingAndFootwear']['description'] ?></p>
				<p>$<?= $content['popular_clothingAndFootwear']['price'] ?></p>
				<p><?= $content['popular_clothingAndFootwear']['quant_avail'] ?> left
					<select name="quantity">
						<?php for($i=1;$i<11;$i++) { ?>
							<option value="<?= $i ?>"><?= $i ?></option>
						<?php } ?>
					</select>
					<input type="submit" value="Add to cart" class="btn btn-primary" />
				</p>
				</form>
			<?php } ?>

		</td>
		<td>
			<h4><a href="/Products/technologygadgets">Technology & Gadgets</a></h4>
			<?php if($content['popular_technologyAndGadgets']) { ?>
				<form action="/Users/add_to_cart/<?php echo $content['popular_technologyAndGadgets']['id'] ?>/" method="POST">
				<p><a href="/Products/show/<?= $content['popular_technologyAndGadgets']['id'] ?>/"><?= $content['popular_technologyAndGadgets']['name'] ?></a></p>
				<p><?= $content['popular_technologyAndGadgets']['description'] ?></p>
				<p>$<?= $content['popular_technologyAndGadgets']['price'] ?></p>
				<p><?= $content['popular_technologyAndGadgets']['quant_avail'] ?> left
					<select name="quantity">
						<?php for($i=1;$i<11;$i++) { ?>
							<option value="<?= $i ?>"><?= $i ?></option>
						<?php } ?>
					</select>
					<input type="submit" value="Add to cart" class="btn btn-primary" />
				</p>
				</form>
			<?php } ?>
		</td>
	</tr>
	<!-- end row 2 -->
</table>

</body>
</html>
