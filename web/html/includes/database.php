<?php
$db = @mysqli_connect(
	'db',
    getenv('MYSQL_HOSt:'),
	getenv('MYSQL_USER:'),
	getenv('MYSQL_PASSWORD'),
    getenv('MYSQL_DATABASE'),
	'world')
		or die('Error connecting to database');
		//or die('Error connecting to database: ' . mysqli_connect_error()); // for debugging