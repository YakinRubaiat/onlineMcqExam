<?php require_once 'header.php'; 
require_once 'config.php';


if(isset($_POST['submitForm']))
{
	try
	{
		if(empty($_POST['test_id']))
		{
			throw new Exception("Select a Test Name First");
			
		}
		if(empty($_POST['question_title']))
		{
			throw new Exception("Question title can not be empty.");
			
		}
		if(empty($_POST['option_1']))
		{
			throw new Exception("Option A can not be empty");
			
		}
		if(empty($_POST['option_2']))
		{
			throw new Exception("Option B can not be empty");
			
		}
		if(empty($_POST['option_3']))
		{
			throw new Exception("Option C can not be empty");
			
		}
		if(empty($_POST['option_4']))
		{
			throw new Exception("Option D can not be empty");
			
		}
		if(empty($_POST['correct_option']))
		{
			throw new Exception("Correct Option can not be empty");
			
		}
		
		$statement = $db->prepare("INSERT INTO tbl_question(test_id, question_title, option_1, option_2, option_3, option_4, correct_option) VALUES(?, ?, ?, ?, ?, ?, ?)");
		$statement->execute(array($_POST['test_id'], $_POST['question_title'], $_POST['option_1'], $_POST['option_2'], $_POST['option_3'], $_POST['option_4'], $_POST['correct_option']));
		


		$success_message = "Question has inserted successfully";
	}  

//delete


	catch(Exception $e)
	{
		$error_message = $e->getMessage();
	}
	
}
?>
<?php
if (isset($success_message)) {
	echo '<div class="alert alert-success">' . $success_message . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
}

if (isset($error_message)) {
	echo '<div class="alert alert-danger">' . $error_message . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
}

?>


<!-- index -->
<h1 class="page-header">Add Question</h1>

<form action="" method="post" class="form-horizontal" role="form">
	<div class="form-group">
		<label class="control-label col-sm-2">Select a Chapter</label>
		<div class="col-sm-10">

			<select class="form-control" name="test_id">
				<option value="" selected>Select a Test</option>
				<?php
				$statement = $db->prepare("SELECT * FROM tbl_test ORDER BY test_name ASC");
				$statement->execute();
				$result = $statement->fetchAll(PDO::FETCH_ASSOC);
				foreach ($result as $row){  ?>
						<option value="<?php echo $row['id']; ?>"><?php echo $row['test_name']; ?></option>
						<?php }  ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="question_title">Question Title</label>
				<div class="col-sm-10">
					<textarea type="text" class="form-control" name="question_title" id="question_title" placeholder="Write Question"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="option_1">Option A</label>
				<div class="col-sm-10">
					<input type="name" class="form-control" name="option_1" id="option_1" placeholder="Enter a option">
				</div>
			</div> 
			<div class="form-group">
				<label class="control-label col-sm-2" for="option_2">Option B</label>
				<div class="col-sm-10">
					<input type="name" class="form-control" name="option_2" id="option_2" placeholder="Enter a option">
				</div>
			</div> 
			<div class="form-group">
				<label class="control-label col-sm-2" for="option_3">Option C</label>
				<div class="col-sm-10">
					<input type="name" class="form-control" name="option_3" id="option_3" placeholder="Enter a option">
				</div>
			</div> 
			<div class="form-group">
				<label class="control-label col-sm-2" for="option_4">Option D</label>
				<div class="col-sm-10">
					<input type="name" class="form-control" name="option_4" id="option_4" placeholder="Enter a option">
				</div>
			</div> 
			<div class="form-group">
				<label class="control-label col-sm-2" for="option_1">Select correct option</label>
				<div class="col-sm-10">
					<select class="form-control" name="correct_option">
						<option value="">Select a correct_option</option>
						<option value="1">Option A</option>
						<option value="2">Option B</option>
						<option value="3">Option C</option>
						<option value="4">Option D</option>
					</select>
				</div>
			</div> 


			<div class="form-group"> 
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-success btn-large" name="submitForm" >Save</button>
				</div>
			</div>
		</form>
		<!-- end index -->
		<?php require_once 'footer.php'; ?>
