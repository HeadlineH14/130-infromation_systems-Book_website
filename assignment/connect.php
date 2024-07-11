<?php // connect.php allows connection to the database
    $hn='mysql';
	$db = '22db126';
	$un = '22usr126';
	$pw = 'JYNMVXMIL92';
	
	$conn = new mysqli($hn, $un,$pw,$db);
	
	if ($conn->connect_error)
		{ die($conn->connect_error);
		echo '<br>';
		echo 'Unfortunately you could not be connected to the database
		      please check you have the correct credentials';
	}
	else 
	{	
		echo '<br>';
		echo 'You have connected to the databse successfully <br><br>';
		
	};

   ?>
  