<?php require_once 'header.php'; ?>
<?php require_once 'config.php'; ?>

<?php
if (isset($_GET['test_id'])) {
	$test_id = $_GET['test_id'];
	$statement = $db->prepare("SELECT * FROM tbl_test WHERE id = ?");
	$statement->execute(array($test_id));
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row)
	{
		$test_name = $row['test_name'];
	}


}else{
	header("location: add_test.php");
}
?>


<h2>View All Question For Test - <mark><?= $test_name ?></mark></h2>

<?php
$i=0;
$statement = $db->prepare("SELECT * FROM tbl_question WHERE test_id = ?");
$statement->execute(array($test_id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $row){ ?>


<div class="well">
	<h4><?= $row['question_title'] ?></h4>
	<strong>Options</strong> <br />
	<input type="radio"> <?= $row['option_1'] ?> <br />
	<input type="radio"> <?= $row['option_2'] ?> <br />
	<?php if (!is_null($row['option_3'])) { ?>
	<input type="radio"> <?= $row['option_3'] ?> <br />
	<?php } ?>
	<?php if (!is_null($row['option_4'])) { ?>
	<input type="radio"> <?= $row['option_4'] ?> <br />
	<?php } ?>
</div>

<?php } ?>
<!-- end index -->
<?php require_once 'footer.php'; ?>
