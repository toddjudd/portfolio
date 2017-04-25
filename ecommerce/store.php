<!-- This is a git test -->

<?php 
require_once 'php/db_functions.php';
session_start();
if (isset($_SESSION['username'])) {
	header("location: store");
}
?>

<style type="text/css">
	
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

</style>


<!DOCTYPE html>
<html>
<head>
	<title>ToddJudd - Assignments</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<!-- Header -->
<nav>
	<span></span>
	<h1>Acme Co.</h1>
	<span></span>
	<a href="toddjudd.com/ecommerce/logout.php">Log Out</a>
</nav>

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
		<form  class="add-to-cart" action="php/addtocart.php" method="post">
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
</script>
</html>

