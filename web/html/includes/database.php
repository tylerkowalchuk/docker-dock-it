<?php

// variable name = connect      server                  username            password                database
$db = mysqli_connect( 'db',  'mchkhetia',  '000553239',  'adopt_pet')
or die('Unable to connect to the database');

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Successfully connected to the database.";
}
