<?php
$db = @mysqli_connect(
    getenv('MYSQL_HOST' ),
	getenv('MSQL_USERNAME' ),
	getenv('MSQL_PASSWORD'),
    getenv('MYSQL_DATABASE')
)
		or die('Error connecting to database');
		//or die('Error connecting to database: ' . mysqli_connect_error()); // for debugging