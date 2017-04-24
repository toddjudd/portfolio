<?php 

// parameterize  POST variables
$name = $_POST["name"];
$age = $_POST["age"];
$address = $_POST["address"];
$state = $_POST["state"];
$gender = $_POST["gender"];

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Who Are you?</title>
	<style type="text/css">
		body {
			display: flex;
			justify-content: center;
			align-content: center;
			color: white;
			font-size: 20px;
			height: 100vh;
			flex-direction: column;
		}
		p, form {
			max-width: 600px;
			margin: auto;
		}
		a {
			text-decoration: none;
			background-color: white;
			border-radius: 4px;
			padding: 8px;
		}
		.male a {
			color: #17BEBB;
		}
		.female a {
			color: #D62246;
		}
	/*sets up background collors bassed on gender*/
		.male {
			background-color: #17BEBB;
		}
		.female {
			background-color: #D62246;
		}
	</style>
</head>
<body class="<?php echo $gender; //echos gender for body class?>">

<?php 

//get date => convert to year
$date = getdate();
$year = $date["year"];
//initiate yearslived to keep track of all years sence born till current date
$yearslived = $year;
//index for while loop
$i = 1;

while ($i <= $age) {
	//while index is less then age subtarct index from age => add the new year to the list of yearslived => increment index
	$difference = $year - $i;
	$yearslived = $yearslived . ", " . $difference;
	$i++;
}

//format print out all variables in a form that makes sense.
//printf("format"arg,arg,...);
$readout = sprintf("Hello %s, looks like you are %u. Your address is %s, %s. and you are a %s, yes genders are binary. Here is a list of years you have lived: %s ",$name,$age,$address,$state,$gender,$yearslived);
printf("<p>%s</p><p><a href='postpage.txt' download>Download Who You Are!</a></p>",$readout);


//if statemente checks if postpage.txt exists. 
if (file_exists(postpage.txt)) {
	//opesn files and writes to it
	$file = fopen(postpage.txt, w) or die('Oops! We made and error! Sorry bout that, try again in a bit.');
	fwrite($file, $readout);
	fclose($file);

} else {
	//creates file and writes to it.
	$file = fopen($_SERVER['DOCUMENT_ROOT'] . "/assignments/whoami/postpage.txt", wb);
	fwrite($file, $readout);
	fclose($file);
}

 ?>

</body>
</html>