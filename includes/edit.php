<?php
require_once '../includes/filter-wrapper.php';
require_once '../includes/db.php';

$errors = array();

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
	//if there's no id redriect to the homepage
	if(empty($id))
	{
		header('location: index.php');
		exit;
	}

//sanitize all the fields
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);

$release_date = filter_input(INPUT_POST, 'release_date', FILTER_SANITIZE_STRING);

$publisher = filter_input(INPUT_POST, 'publisher', FILTER_SANITIZE_STRING);

$system = filter_input(INPUT_POST, 'system', FILTER_SANITIZE_STRING);

$rating = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_NUMBER_INT);

$num_players = filter_input(INPUT_POST, 'num_players', FILTER_SANITIZE_NUMBER_INT);

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	//validate the form
	if(empty($title))
		$errors['title']=true;

	if(empty($release_date))
		$errors['release_date']=true;

	if(empty($publisher))
		$errors['publisher']=true;

	if(empty($system))
		$errors['system']=true;

	if(empty($rating))
		$errors['rating']=true;

	if(empty($num_players))
		$errors['num_players']=true;	

	//if there are no errors put data into database
	if(empty($errors))
	{
		$sql = $db->prepare('UPDATE games SET title = :title, release_date = :release_date, publisher = :publisher, system = :system, rating = :rating, num_players = :num_players WHERE id = :id');
		$sql->bindValue(':id', $id, PDO::PARAM_INT);
		$sql->bindValue(':title', $title, PDO::PARAM_STR);
		$sql->bindValue(':release_date', $release_date, PDO::PARAM_STR);
		$sql->bindValue(':publisher', $publisher, PDO::PARAM_STR);
		$sql->bindValue(':system', $system, PDO::PARAM_STR);
		$sql->bindValue(':rating', $rating, PDO::PARAM_INT);
		$sql->bindValue(':num_players', $num_players, PDO::PARAM_INT);

		$sql->execute();
		header('location: index.php');
		exit;
	}

}
else
{
	//display database information
	//shows the title in the value part
	$sql = $db->prepare('SELECT id, title, release_date, publisher, system, rating, num_players FROM games WHERE id = :id');
	$sql->bindValue(':id', $id, PDO::PARAM_INT);
	$sql->execute();
	$results = $sql->fetch(PDO::FETCH_OBJ);

	$title = $results->title;
	$release_date = $results->release_date;
	$publisher = $results->publisher;
	$system = $results->system;
	$rating = $results->rating;
	$num_players = $results->num_players;
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link href="styles/theme.css" rel="stylesheet"/>
<title>Edit</title>
</head>
<body>

	<div id="wrapper">

    <form action="edit.php?id=<?php echo $id; ?>" method="post">

        <div>
        	<label for="title">Title</label>
            <?php if(isset($errors['title'])): ?>
            <label for "title"><p class="error">Error! Enter Valid Title</p></label>
            <?php endif; ?>
            <input id="title" name="title" value="<?php echo $title; ?>">
        </div>

        <div>
        	<label for="release_date">Release Date</label>
            <?php if(isset($errors['release_date'])): ?>
            <label for "release_date"><p class="error">Error! Enter Valid Date (YYYY-DD-MM)</p></label>
            <?php endif; ?>
            <input id="release_date" name="release_date" value="<?php echo $release_date; ?>">
        </div>

        <div>
        	<label for="publisher">Publisher</label>
            <?php if(isset($errors['publisher'])): ?>
            <label for "publisher"><p class="error">Error! Enter Publisher</p></label>
            <?php endif; ?>
            <input id="publisher" name="publisher" value="<?php echo $publisher; ?>">
        </div>

        <div>
        	<label for="system">System</label>
            <?php if(isset($errors['system'])): ?>
            <label for "system"><p class="error">Error! Enter System</p></label>
            <?php endif; ?>
            <input id="system" name="system" value="<?php echo $system; ?>">
        </div>

        <div>
        	<label for="rating">Rating</label>
            <?php if(isset($errors['rating'])): ?>
            <label for "rating"><p class="error">Error! Enter Rating (1-10)</p></label>
            <?php endif; ?>
            <input id="rating" name="rating" value="<?php echo $rating; ?>">
        </div>

        <div>
        	<label for="num_players">Number Of Players</label>
            <?php if(isset($errors['num_players'])): ?>
            <label for "num_players"><p class="error">Error! Enter Number Of Players</p></label>
            <?php endif; ?>
            <input id="num_players" name="num_players" value="<?php echo $num_players; ?>">
        </div>

        <div>
            <button type="submit">Save</button>
        </div>

    </form>
  </div>

</body>
</html>