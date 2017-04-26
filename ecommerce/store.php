<?php 
require_once 'php/db_functions.php';
session_start();
if (!isset($_SESSION['username'])) {
	header("location: login");
}

if (isset($_POST['product'])) {
$product_id = $_POST['product'];
$quantity = $_POST['quantity'];

$totalItems = 0;

$type = $_POST['type'];
	switch ($type) {
		case 'add':
			$_SESSION['cart'][$product_id] += $quantity;
			break;
		case 'remove':
			unset($_SESSION['cart'][$product_id]);
			break;
		case 'update':
			$_SESSION['cart'][$product_id] = $quantity;			
			break;
		default:
			$_SESSION['cart'][$product_id] += $quantity;
			break;
	}
	foreach ($_SESSION['cart'] as $product => $quantity) {
		if ($quantity <= 0 ) {
			unset($_SESSION['cart'][$product]);
			$quantity = 0;
		}
		$totalItems += $quantity;
	}
	unset($_POST);
}
// echo "<br>POST";
// print_r($_POST);
// echo "<br> SESSION";
// print_r($_SESSION);
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<style type="text/css">

	@import url(https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css);

	nav {
		display: flex;
		flex-direction: row;
		flex-wrap: none;
		align-items: stretch;
		width: 100vw;
		background-color: #577590;
		color: #f2f2f2;
		position: fixed;
		top: 0;
		padding: 0 15px;
	}

	nav > span {
		flex-grow:1;
	}

	nav > a {
		color: #f1f1f1;
		text-decoration: none;
		margin: auto 15px;
		padding: 12px;
		border-radius: 4px;
		background-color: #f08a4b;
	}

	p {
		margin: 12px;
	}

	.catelog-wrapper {
		margin: 10px;
		padding: 10px;
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
		justify-content: space-around;
		align-items: stretch;
		align-content: flex-start;
	}

	.item-card {
		min-width: 250px;
		max-width: 500px;
		padding: 12px;
		margin: 12px;
		flex: 1 0 28vw;
		background-color: white;
		box-shadow: 2px 2px 2px #888888;
		display: flex;
		flex-direction: column;
		background-color: #F3CA40;
	}

	.item-card > span {
		flex:1;
	}

	.price {
		padding: 0 8px;
	}

	.link-price {
		display: flex;
		flex-direction: row;
	}

	.link-price > span {
		flex:1;
	}

	.item-card > img{
		max-height: 250px;
		max-width: 200px;
		margin: 0 auto;
	}

	.badge {
	    background-color: #577590;
	    border-radius: 10px;
	    color: white;
	    display: inline-block;
	    font-size: 12px;
	    line-height: 1;
	    padding: 3px 7px;
	    text-align: center;
	    vertical-align: middle;
	    white-space: nowrap;
	}

	.shopping-cart {
		margin: 10px 0 0 10px;
		background: white;
		width: 320px;
		position: absolute;
		border-radius: 3px;
		padding: 20px;
		font-size: 11pt;
	}

	.shopping-cart-header {
		display: flex;
		flex-direction: row;
		padding: 10px
	}

	.shopping-cart-items {
		display: flex;
		flex-direction: row;
	}

	.shopping-cart-details {
		font-size: 10pt;
		padding: 20px;
		display: flex;
		flex-direction: column;
		align-items: stretch;
		width: 100%
	}

	.shopping-cart-image {
		height: 100px;
		width:100px;
	}

	.item-name {
		font-size: 14px;
	}

	.item-price {
		color: #577590
	}

	.item-quantity {
		margin-left: 10px;
		color: #ABB0BE;
		float: right;
	}

	.update-value {
		font-size: 8pt;
		max-width: 500px;		
	}

	.update-submit, .remove-submit {
		margin: 0;
		padding: 4px;
		font-size: 8pt;
		border:none;
		border-radius: 2px;
		background-color: #f08a4b;
		color: white;
		float: right;
		width: 45px;
		align-self: flex-end;
	}

	.update, .remove {
		width: 100%;
		margin: 2px;	
		align-self: right;
		display: flex;
		flex:1;
	}




</style>

<!DOCTYPE html>
<html>
<head>
	<title>Acme Co.</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<!-- Header -->
<nav>
	<?php 
	if (isset($_SESSION['cart']) && $totalItems > 0) {

		echo "<a href='#' id='cart'><i class='fa fa-shopping-cart'></i> Cart <span class='badge'>{$totalItems}</span></a>";
	}
	?>
	<span></span>
	<h1>Acme Co.</h1>
	<span></span>
	<?php if (isset($_SESSION)) {
		echo " <h4>Welcome - {$_SESSION['name']} </h4>";
	} ?>
	<a href="logout.php?logout=true">Log Out</a>
</nav>

<!-- cart -->

<?php 
if (isset($_SESSION['cart']) && $totalItems > 0){
$totalPrice = 0;
$cartItems = array();
foreach ($_SESSION['cart'] as $product => $quantity) {
	// get row info form sql
	$query = db_select("SELECT * FROM products WHERE product_id = '$product_id'");
	$productRow = $query[0];
	// get price times quantity add to total price
	$totalPrice += $productRow['product_price'] * $quantity;
}

setlocale(LC_MONETARY, 'en_US');
$totalPrice = money_format('%(#1n', $totalPrice);

echo <<<CARTH
<div class="shopping-cart" style="display: none;">
	<!-- cart head -->
	<div class="shopping-cart-header">
		<i class="fa fa-shopping-cart cart-icon"></i><span class="badge">$totalItems</span>
		<span style="flex:1;"></span>
    	<div class="shopping-cart-total">
			<span class="lighter-text">Total:</span>
			<span class="main-color-text">$totalPrice</span>
		</div>
    </div>
CARTH;

foreach ($_SESSION['cart'] as $product => $quantity) {
	// get row info form sql
	$query = db_select("SELECT * FROM products WHERE product_id = '$product_id'");
	$productRow = $query[0];
	//echo each shopping-cart-item for each entry.
	$itemTotalPrice = $productRow['product_price'] * $quantity;
	setlocale(LC_MONETARY, 'en_US');
	$itemTotalPrice = money_format('%(#1n', $itemTotalPrice);
	echo <<<ITEM

	<div class="shopping-cart-items">
		<img class="shopping-cart-image" src="res/{$product}.jpg">
		<div class="shopping-cart-details">
			<span class="item-name">{$product['product_name']}</span>
			<div>
				<span class="item-price">{$itemTotalPrice}</span>
				<span class="item-quantity">Quantity:&nbsp;{$quantity}</span>
			</div>
			<form  class="update" action="store" method="post">
				<input type="hidden" name="type" value="update">
				<input type="hidden" name="product" value="{$product}">
				<input class="update-value" type="number" name="quantity" min="1" max="999">
				<span style="flex:1;"></span>
				<input class="update-submit" type="submit" name="submit" value="update">
			</form>
			<form  class="remove" action="store" method="post">
				<span style="flex:1;"></span>
				<input type="hidden" name="type" value="remove">
				<input type="hidden" name="product" value="{$product}">
				<input class="remove-submit" type="submit" name="submit" value="remove">
			</form>
		</div>
	</div>

ITEM;
}
echo "</div>";
}
?>

<!-- catelog -->
<div class="catelog-wrapper">

<?php 
$colors = ['#F3CA40', '#F2A541', '#F08A4B'];
$products = db_query("SELECT * FROM products");
for ($i=0; $i < $products->num_rows; $i++) { 
	$row = mysqli_fetch_array($products);
	$rand = rand(0,2);
	$color = $colors[$rand];

echo <<<END
<div class="item-card" style="background-color:$color;">
	<h3>$row[product_name]</h3>
	<img src="res/{$row[product_id]}.jpg">
	<p>$row[product_description]</p>
	<span></span>
	<div class="link-price">
		<form  class="add-to-cart" action="store" method="post">
		<input type="hidden" name="type" value="add">
		<input type="hidden" name="product" value="$row[product_id]">
		<input type="number" name="quantity" min="1" max="999">
		<input type="submit" name="submit" value="Add to Cart &#x25B6;">
		</form>
		<span></span>
		<div class="price">$$row[product_price]</div>
	</div>
</div>
END;
}
?>

</div>
</body>
<script type="text/javascript">
	let navHeight = document.querySelector('nav').offsetHeight;
	console.log(navHeight);
	document.body.style.paddingTop = navHeight + 'px';

	(function(){
	 
	  $("#cart").on("click", function() {
	    $(".shopping-cart").fadeToggle( "fast");
	  });
	  
	})();
</script>
</html>