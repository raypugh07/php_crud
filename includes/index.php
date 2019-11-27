

<?php

//require_once '../includes/filter-wrapper.php';  //doesn't exist

require_once '../includes/db.php';   // must use ../ before file location

$sql = $db->query('SELECT id, title, release_date, publisher, rating,

system, num_players FROM videogames ORDER BY title ASC');

$results = $sql->fetchAll(PDO::FETCH_OBJ);

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<link href="styles/theme.css" rel="stylesheet"/>
<title>PHP & MySQL</title>
</head>
<body>

    <div id="wrapper">
    <table>
    	<thead>
            <th>Title</th>
            <th>Release Date</th>
            <th>Publisher</th>
            <th>System</th>
            <th>Rating</th>
            <th>Number Of Players</th>
            <th>Tools</th>
        </thead>
        <tbody>
        	<?php foreach($results as $entry): ?>
            <tr>
            	<td><?php echo $entry->title; ?></td>
                <td><?php echo $entry->release_date; ?></td>
                <td><?php echo $entry->publisher; ?></td>
                <td><?php echo $entry->system; ?></td>
                <td><?php echo $entry->rating; ?></td>
                <td><?php echo $entry->num_players; ?></td>
                <td><a href="edit.php?id=<?php echo $entry->id; ?>">Edit</a> <a href="delete.php?id=<?php echo $entry->id; ?>">Delete</a></td>
            </tr>
            <?php endforeach; ?>
            <tr>
            	<td class="create"><a href="add.php">Add New Game</a></td>
            </tr>
        </tbody>
    </table>
    </div>

</body>
</html>
