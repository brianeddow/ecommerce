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
			<?php echo $content['product']['category'] ?>
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
	<tr>
		<td class="valign-top padding-top fixed-width">
            <?php if($content['product']) { ?>
               <form action="/Users/add_to_cart/<?php echo $content['product']['id'] ?>/" method="post">
               <p><?php echo $content['product']['name'] ?></p>
               <p><?php echo $content['product']['description'] ?></p>
               <p>$<?php echo $content['product']['price'] ?></p>
               <p><?php echo $content['product']['quant_avail'] ?> left
                   <select>
                       <?php for($i=1;$i<11;$i++) { ?>
                           <option value="<?= $i ?>"><?= $i ?></option>
                       <?php } ?>
                   </select>
                   <input type="button" value="Add to cart" class="btn btn-primary" />
                   <a href="/Users/add_to_wishlist/<?= $content['product']['id'] ?>/">Add to wishlist</a>
				   <!-- already_on_wishlist validation -->
				   <?php if($this->session->flashdata('wishlist_error')){ ?>
					  <span class="alert"><?= $this->session->flashdata('wishlist_error'); ?></span>
				  <?php } ?>
				  <!-- end validation -->
               </p>
               <p><img src="/img/scott.jpg"></p>
			   </form>
            <?php } ?>
		</td>
		<td class="valign-top">
			<h3>Product Reviews</h3>

			<form action="/Users/add_review/<?= $content['id'] ?>/<?= $content['product']['id'] ?>/" method="POST">
			<h4>Add a Review</h4>
			<p>Rating:
				<?php if($content['rating']) { ?>
					<select name="score">
					<?php foreach($content['rating'] as $option) { ?>
						<option value=<?= $option ?>><?= $option ?></option>
					<?php } ?>
					</select>
				<?php } ?>
			</p>
			<p><textarea name="text" class="form-control"></textarea></p>
			<p><input type="submit" value="Submit" class="btn btn-primary"/></p>
			</form>
			<br />

			<?php if($content['reviews']) { ?>
				<?php foreach($content['reviews'] as $review) { ?>
					<p class="rating">
						<?php for($i = 0; $i<$review['rating']; $i++) { ?>
							<?= "*" ?>
						<?php } ?>
						<?= $review['rating']."/10" ?>
					</p>
					<p class="text"><?= $review['text'] ?></p>
					<p class="review_head"><?= $review['name'] ?> - <?= $review['created_at'] ?></p>
				<?php } ?>
			<?php } else { ?>
				<p>No reviews yet</p>
			<?php } ?>
		</td>
	</tr>
</table>

</body>
</html>
