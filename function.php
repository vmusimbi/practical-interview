<?php
include("index.php");


if (isset($_POST['submit'])) {
	$date = $_POST['date'];
	$productname = $_POST['name'];
	$Beginningbalance= $_POST['Beginningbalance'];
	$Quantitydispensed = $_POST['Quantity'];
	$ClosingBalance = $_POST['Closingbalance'];
	
	

	$result = mysqli_query($mysqli,"INSERT into productform values('','$date',
		'$productname',
		'$Beginningbalance',
		 )
");
	if ($result) {
		echo "success";
		# code...
	}
	else{
		echo "failed";
	}
}

?>