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
<body class="checkout">

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
		<td  class="header right">
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
            <h3>Checkout</h3>
		</td>
	</tr>
    <tr>
        <!-- top left quadrant -->
        <td>
            <h3>Order</h3>

            <?php if($content['checkout']) { ?>
                <?php foreach($content['checkout'] as $item) { ?>
                    <table>
                        <tr>
                            <td class="top">
                                <p><span class="bold"><?= $item['quantity'] ?></span> x <a href="/Products/show/<?= $item['product_id'] ?>/"><?= $item['name'] ?></a></p>
                                <p>$<?= $item['price'] ?> each</p>
                            </td>
                            <td class="product-view">
                                <img src="<?= $item['url'] ?>" class="product-image">
                            </td>
                        </tr>
						<tr>
							<td>
								<hr>
								<?php if($content['amount']) { ?>
									TOTAL: <span class="bold">$<?= $content['amount'] ?></span>
								<?php } ?>
							</td>
						</tr>
                    </table>
                <?php } ?>
            <?php } ?>
        </td>
        <!-- end top left quadrant -->

        <!-- top right quadrant -->
        <td class="title">
            <h3>Shipping Address</h3>

            <?php if($content['address']) { ?>
                <p><span class="bold">Use</span>: <?= $content['address']['street'] ?> <?= $content['address']['city'] ?>, <?= $content['address']['state'] ?> <?= $content['address']['zip'] ?> (primary)</p>
            <?php } ?>
        </td>
    </tr>
    <!-- end top right quadrant -->

    <!-- bottom left quadrant -->
    <tr>
        <td style="vertical-align: top; width: 375px;">
            <!-- purposely left empty -->
        </td>
        <!-- end bottom left quadrant -->

        <!-- bottom right quadrant -->
        <td class="title">
            <h3>Payment Method</h3>

			<form action="" method="POST">
			  <script
			    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
			    data-key="pk_live_8CEnCAmwhuDrxdHGC1TGX07s"
			    data-amount="<?= $content['total'] ?>"
			    data-name="All You Need"
			    data-description=""
			    data-image="http://stripe.com/img/documentation/checkout/marketplace.png"
			    data-locale="auto"
				data-zip-code="true">
			  </script>
			</form>
        </td>
        <!-- end bottom right quadrant -->
    </tr>
</table>

</body>
</html>
