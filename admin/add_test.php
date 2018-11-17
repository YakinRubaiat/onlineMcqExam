<?php require_once 'header.php'; ?>
<?php require_once 'config.php'; ?>


<?php
//Insert test

if(isset($_POST['submitForm']))
{
	try
	{
		if(empty($_POST['test_name']))
		{
			throw new Exception("Test Name can not be empty");
		}
		if(empty($_POST['test_date']))
		{
			throw new Exception("Date Name can not be empty");
		}
		
		$statement = $db->prepare("SELECT * FROM tbl_test WHERE test_name=?");
		$statement->execute(array($_POST['test_name']));
		$total = $statement->rowCount();

		if ($total > 0) {
			throw new Exception("Test is already existed");
		}


		$test_date = $_POST['test_date'];
		//2017-12-13
		$e_y = substr($test_date, 0, 4);
		$e_m = substr($test_date, 5, 2);
		$e_d = substr($test_date, 8, 2);

		(((!isset($_POST['test_hour'])) || ($_POST['test_hour'] == ""))? $test_hour = "00" : $test_hour = $_POST['test_hour']);

		(((!isset($_POST['test_minute'])) || ($_POST['test_minute'] == "")) ? $test_minute = "00" : $test_minute = $_POST['test_minute']);
		(((!isset($_POST['test_second'])) || ($_POST['test_second'] == "")) ? $test_second = "00" : $test_second = $_POST['test_second']);



		//$exam_date = "2017-12-15 06:22:28";

		$exam_date = $e_y."-".$e_m."-".$e_d." ".$test_hour.":". $test_minute.":" .$test_second;

		$statement = $db->prepare("INSERT INTO tbl_test(test_name, exam_date) VALUES(?, ?)");
		$statement->execute(array($_POST['test_name'], $exam_date));

		$success_message = "Test has been inserted successfully";

	}  

	catch(Exception $e)
	{
		$error_message = $e->getMessage();
	}
}

?>



<?php
//Edit test data
if(isset($_POST['form2']))
{
	try {
		
		if(empty($_POST['test_name'])) {
			throw new Exception("test_name Name can not be empty.");
		}
		
		$statement = $db->prepare("UPDATE tbl_test SET test_name=? WHERE id=?");
		$statement->execute(array($_POST['test_name'],$_POST['id']));
		
		$success_message = "Test Name has been updated successfully.";
		
	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}

//Delete test
if(isset($_REQUEST['test_id'])) 
{
	$id = $_REQUEST['test_id'];
	
	$statement = $db->prepare("DELETE FROM tbl_test WHERE id=?");
	$statement->execute(array($id));
	$success_message = "Test Name has been deleted successfully.";
	header("location:add_test.php");
}



//Publish or unpublish Test
if (isset($_POST['publish_test'])) {

	//header("location:view_test.php?test_id=12");

	$is_published = $_POST['is_published'];

	//Publish it
	if ($is_published == 1) {
		$statement = $db->prepare("UPDATE tbl_test SET is_published=? WHERE id=?");
		$statement->execute(array(0, $_POST['id']));
	}else
	{
		$statement = $db->prepare("UPDATE tbl_test SET is_published=? WHERE id=?");
		$statement->execute(array(1, $_POST['id']));
	}
	//header("location:add_test.php");
}

?>
<!-- index -->
<?php
if (isset($success_message)) {
	echo '<div class="alert alert-success">' . $success_message . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
}
if (isset($error_message)) {
	echo '<div class="alert alert-danger">' . $error_message . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
}
?>
<h1 class="page-header">Add your class</h1>


<form action="" method="post" class="form-horizontal" role="form">
	<div class="form-group">
		<label class="control-label col-sm-2" for="test_name">Test Name</label>
		<div class="col-sm-10">
			<input type="name" class="form-control" name="test_name" id="test_name" placeholder="Enter test name" required="">
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-sm-2" for="exam_date">Test Time</label>
		<div class="col-sm-10">

			<div class="form-group">
				<label class="control-label col-sm-2" for="test_date">Test Date</label>
				<div class="col-sm-10">
					<input type="date" class="form-control" name="test_date" id="test_date" required="">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="test_hour">Test Hour</label>
				<div class="col-sm-10">
					<input type="number" class="form-control" name="test_hour" id="test_hour" >
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="test_minute">Test Minute</label>
				<div class="col-sm-10">
					<input type="number" class="form-control" name="test_minute" id="test_minute" >
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="test_second">Test Seconds</label>
				<div class="col-sm-10">
					<input type="number" class="form-control" name="test_second" id="test_second" >
				</div>
			</div>

		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-sm-2" for="test_name">Maximum Show</label>
		<div class="col-sm-10">
			<input type="name" class="form-control" name="test_name" id="test_name" placeholder="Enter test name" max="50">
		</div>
	</div>

	<div class="form-group"> 
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-success btn-large" name="submitForm" >Save</button>
		</div>
	</div>
</form>


<h2>View Tests</h2>

<table class="table" width="100%">
	<tr>
		<th width="5%">Serial</th>
		<th width="50%">Test Name</th>
		<th width="10%">Total Questions</th>
		<th width="20%">Publication Status</th>
		<th width="25%">Action</th>
	</tr>
	
	<?php
	$i=0;
	$statement = $db->prepare("SELECT * FROM tbl_test");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row)
	{
		$i++;
		?>

		<tr>
			<td><?php echo $i; ?></td>
			<td><a href="view_test.php?test_id=<?= $row['id']; ?>"><?= $row['test_name']; ?></td>

				<?php 
				$statement = $db->prepare("SELECT * FROM tbl_question WHERE test_id = ?");
				$statement->execute(array($row['id']));
				$total_question = $statement->rowCount();
				?>

				<td><?php echo $total_question; ?></td>
				<td>

					<?php 

					if ($row['is_published'] == 1) { ?>
					<form onsubmit="return confirm('Do you really unpublish it ?')" action="add_test.php" method="post">
						<input type="submit" class="btn btn-danger" value="Unpublished it ?" name="publish_test" /> 
						<input type="hidden" name="is_published" value="0">
						<input type="hidden" name="id" value="<?= $row['test_id'] ?>">
					</form>

					<?php }else{ ?>

					<form action="add_test.php" method="post">
						<input type="submit"  class="btn btn-success" value="Publish Now"  name="publish_test"/> 
						<input type="hidden" name="is_published" value="1">
						<input type="hidden" name="id" value="<?= $row['test_id'] ?>">
					</form>

					<?php }?>
					

				</td>
				<td>
					<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal<?= $row['id']?>">Edit</button>

					<!-- Modal -->
					<div id="editModal<?= $row['id']?>" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Edit <?= $row['test_name'] ?></h4>
								</div>
								<div class="modal-body">
									<form method="post" action="add_test.php?edit=<?= $row['id']; ?>">
										<input type="text" class="form-control" name="test_name" value="<?= $row['test_name'] ?>" />
										<input type="hidden" class="form-control" name="id"  value="<?= $row['id'] ?>" />
										<br />
										<input type="submit" class="btn btn-success" name="form2" value="Save" />
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>

						</div>
					</div>

					<a onclick='return confirmDelete();' href="add_test.php?test_id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>


				</td>
			</tr>

			<?php
		}
		?>




	</table>

	<!-- end index -->
	<?php require_once 'footer.php'; ?>
