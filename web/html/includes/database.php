<?php
$db = @mysqli_connect(
	'db',
	'example',
	'example',
	'world')
		or die('Error connecting to database');
		//or die('Error connecting to database: ' . mysqli_connect_error()); // for debugging