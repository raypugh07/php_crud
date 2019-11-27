<?php

require_once 'includes/filter-wrapper.php';  //filter wrapper

require_once 'includes/db.php'; //connects to db

//selects all entries in db and sorts them
$sql = $db->query('SELECT id, title, release_date, publisher, rating, system, num_players, FROM videogames ORDER BY title ASC');

$results = $sql->fetchAll(PDO::FETCH_OBJ); //fetches and stores all entries

?>