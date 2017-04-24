<!DOCTYPE html>
<html>
<head>
	<title>Who Am I? Assignment: 1</title>
		<style type="text/css">
	/*sets up background collors bassed on gender*/
		body {
			display: flex;
			justify-content: center;
			align-content: center;
			color: white;
			font-size: 20px;
			height: 100vh;
			flex-direction: column;
			/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#481c3c+0,3f1132+100 */
			background: #481c3c; /* Old browsers */
			background: -moz-radial-gradient(center, ellipse cover,  #481c3c 0%, #3f1132 100%); /* FF3.6-15 */
			background: -webkit-radial-gradient(center, ellipse cover,  #481c3c 0%,#3f1132 100%); /* Chrome10-25,Safari5.1-6 */
			background: radial-gradient(ellipse at center,  #481c3c 0%,#3f1132 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#481c3c', endColorstr='#3f1132',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */


			font-family: helvetica;
		}
		p, form {
			max-width: 600px;
			margin: auto;
		}
		input, label {
			margin: 8px;
			padding: 4px;
		}
		input[type=submit] {
		    border-radius: 5px;
		    border: 0;
		    width: 80px;
		    height:25px;
		    font-family: inherit;
		    color: #4B1D3F;
		    background: #ffffff;
		    /* Old browsers */
		    background: -moz-linear-gradient(top, #ffffff 1%, #ededed 100%);
		    /* FF3.6+ */
		    background: -webkit-gradient(linear, left top, left bottom, color-stop(1%, #ffffff), color-stop(100%, #ededed));
		    /* Chrome,Safari4+ */
		    background: -webkit-linear-gradient(top, #ffffff 1%, #ededed 100%);
		    /* Chrome10+,Safari5.1+ */
		    background: -o-linear-gradient(top, #ffffff 1%, #ededed 100%);
		    /* Opera 11.10+ */
		    background: -ms-linear-gradient(top, #ffffff 1%, #ededed 100%);
		    /* IE10+ */
		    background: linear-gradient(to bottom, #ffffff 1%, #ededed 100%);
		    /* W3C */
		    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#ededed', GradientType=0);
		    /* IE6-9 */
		}
		.male {
			background-color: #17BEBB;
		}
		.female {
			background-color: #D62246;
		}
	</style>
</head>
<body>

<form action="whoareyou.php" method="post">
	<label>Name:</label><input type="text" name="name" required><br>
	<label>Age:</label><input type="number" name="age" required><br>
	<label>Address:</label><input type="text" name="address" required><br>
	<label>State:</label><input type="text" name="state" required><br>
	<label>Gender:</label> Male<input type="radio" name="gender" value="male" checked>Female<input type="radio" name="gender" value="female"><br>
	<input class="submit" type="submit" name="submit">
</form>
</body>
</html>