<?php

$dbinfo = 'mysql:dbname=mygames;host=localhost';

$user = 'root';

$pass = '';  //password should be blank instead of root

//If you need to change database information, just change values above.

$db = new PDO($dbinfo, $user, $pass);

$db->exec('SET CHARACTER SET utf8');