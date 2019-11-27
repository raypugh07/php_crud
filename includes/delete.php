<?php
require_once 'includes/db.php'; //connects to db

if( isset($_GET['id'])) //if statement to see if an id exists
{
	$sql = $db->prepare('DELETE FROM games WHERE id = :id'); //prepare statement prepares sql statement to be executed by pdo
	$sql->bindValue(':id', $_GET['id'], PDO::PARAM_INT); //binds id
	$sql->execute(); //executes sql statment
}

	header('Location: index.php'); //redirects user 
	exit;