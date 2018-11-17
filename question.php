<?php require_once 'header.php'; ?>

<?php

if (isset($_GET['test_id'])) {
	$test_id = $_GET['test_id'];
	//echo $test_id;
	$statement = $db->prepare("SELECT * FROM tbl_test WHERE id = ?");
	$statement->execute(array($test_id));
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row)
	{
		$test_name = $row['test_name'];
		$max_number_of_question = $row['max_question'];
	}

}else{
	header("location: index.php");
}



if(isset($_POST['formans']))
{
	$solution = $_POST['solution'];
	$correct = 0;

	(isset($_POST['ans1']) ? ($_POST['ans1'] == $solution[0]) ? $correct = $correct+1 : '' : '');
	(isset($_POST['ans2']) ? ($_POST['ans2'] == $solution[1]) ? $correct = $correct+1 : '': '');
	(isset($_POST['ans3']) ? ($_POST['ans3'] == $solution[2]) ? $correct = $correct+1 : '': '');
	(isset($_POST['ans4']) ? ($_POST['ans4'] == $solution[3]) ? $correct = $correct+1 : '': '');
	(isset($_POST['ans5']) ? ($_POST['ans5'] == $solution[4]) ? $correct = $correct+1 : '': '');
	(isset($_POST['ans6']) ? ($_POST['ans6'] == $solution[5]) ? $correct = $correct+1 : '': '');
	(isset($_POST['ans7']) ? ($_POST['ans7'] == $solution[6]) ? $correct = $correct+1 : '': '');
	(isset($_POST['ans8']) ? ($_POST['ans8'] == $solution[7]) ? $correct = $correct+1 : '': '');
	(isset($_POST['ans9']) ? ($_POST['ans9'] == $solution[8]) ? $correct = $correct+1 : '': '');
	(isset($_POST['ans10']) ? ($_POST['ans10'] == $solution[9]) ? $correct = $correct+1 : '': '');
	(isset($_POST['ans11']) ? ($_POST['ans11'] == $solution[10]) ? $correct = $correct+1 : '': '');
	(isset($_POST['ans12']) ? ($_POST['ans12'] == $solution[11]) ? $correct = $correct+1 : '': '');
	(isset($_POST['ans13']) ? ($_POST['ans13'] == $solution[12]) ? $correct = $correct+1 : '': '');
	(isset($_POST['ans14']) ? ($_POST['ans14'] == $solution[13]) ? $correct = $correct+1 : '': '');
	(isset($_POST['ans15']) ? ($_POST['ans15'] == $solution[14]) ? $correct = $correct+1 : '': '');
	(isset($_POST['ans16']) ? ($_POST['ans16'] == $solution[15]) ? $correct = $correct+1 : '': '');
	(isset($_POST['ans17']) ? ($_POST['ans17'] == $solution[16]) ? $correct = $correct+1 : '': '');
	(isset($_POST['ans18']) ? ($_POST['ans18'] == $solution[17]) ? $correct = $correct+1 : '': '');
	(isset($_POST['ans19']) ? ($_POST['ans19'] == $solution[18]) ? $correct = $correct+1 : '': '');
	(isset($_POST['ans20']) ? ($_POST['ans20'] == $solution[19]) ? $correct = $correct+1 : '': '');

	(isset($_POST['ans21']) ? ($_POST['ans21'] == $solution[20]) ? $correct = $correct+1 : '': '');
	(isset($_POST['ans22']) ? ($_POST['ans22'] == $solution[21]) ? $correct = $correct+1 : '': '');

	//enter upto 50 ans

	?>

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h2>Result Information</h2>
		</div>
		<div class="panel-body">
			<h3>Correct Answer - <mark><?= $correct ?></mark></h3>
			<h3>Incorrect Answer - <mark><?= count($solution) - $correct ?></mark></h3>
		</div>
	</div>
	

	<?php }else{ ?>



	<h1 class="page-header">Question</h1>
	<?php
	?>

	<form action="" method="POST">
		<table>  <?php

		if($test_id != "")
		{
			$i = 0;
			$statement = $db->prepare("SELECT  id, question_title, option_1, option_2, option_3, option_4, correct_option  FROM tbl_question WHERE test_id=?  ORDER BY RAND() LIMIT $max_number_of_question");
			$statement->execute(array($test_id));
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);

			

			foreach ($result as $row) 
			{
				//$solution[] = $row['solution'];
				$i++;
				?> 

				<tr>
					<td>Question No.(<?php echo $i; ?>) :</td>
					<td><?php echo $row['question_title']; ?></td>
				</tr>
				<tr>
					<td>Option :</td>
					<td> 
						<input type="radio" name="ans<?= $i ?>" value="1"><?php echo $row['option_1']; ?><br>
						<input type="radio" name="ans<?= $i ?>" value="2"><?php echo $row['option_2']; ?><br>
						<input type="radio" name="ans<?= $i ?>" value="3"><?php echo $row['option_3']; ?> <br>
						<input type="radio" name="ans<?= $i ?>" value="4"><?php echo $row['option_4']; ?>
					</td>


					<input type="hidden" name="solution[]" value="<?php echo $row['correct_option']; ?>">
				</tr>


				<?php  }
			}
			?>



			<?php
			if ($statement->rowCount() == 0) { ?>

			<div class="alert alert-success">
				<strong>Sorry !! </strong> There is no question has added yet there....
			</div>

			<?php }else{ ?>
			<tr><td> &nbsp; </td>
			</tr>
			<tr>
				<td>Submit your answer.</td>
				<td><input type="submit" name="formans" value="Check Result"></td>
			</tr>
			<?php } ?>

		</table>
	</form>
	<?php } ?> 
	<!-- end index -->

	<?php require_once 'footer.php'; ?>