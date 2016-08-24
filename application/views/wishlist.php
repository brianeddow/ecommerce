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
			Welcome, <?php echo ucfirst($content['user']['username']); ?>!
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
        <td>
            <h3>Wishlist</h3>
        </td>
    </tr>
	<tr>
		<td>
            <?php if($content['wishlist']) { ?>
                <?php foreach($content['wishlist'] as $item) { ?>
                    <p><a href="/Products/show/<?= $item['id'] ?>/"><?= $item['name'] ?></a></p>
                    <p><?= $item['description'] ?></p>
                    <p><?= $item['price'] ?></p>
                    <form action="/Products/move_to_cart/<?= $item['id'] ?>/" method="POST">
                    <p><?= $item['quant_avail'] ?> left
                        <select name="quantity">
                            <?php for($i=1;$i<11;$i++) { ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?>
                        </select>
                        <input type="submit" value="Move to cart" class="btn btn-primary">
                        <p><a href="/Users/remove_from_wishlist/<?= $item['id'] ?>/<?= $item['quantity'] ?>/">Remove from wishlist</a></p>
                    </p>
                    </form>
                <?php } ?>
            <?php } else { ?>
                Add something to your wishlist!
            <?php } ?>
		</td>
	</tr>
</table>

</body>
</html>
