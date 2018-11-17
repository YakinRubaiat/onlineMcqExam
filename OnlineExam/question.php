<?php require_once 'header_q.php'; ?>

<?php



if(isset($_POST['formans']))
{
// 	foreach ($result as $row){
	$solution = $_POST['solution'];

// }


		   		// $ans1 = $_POST['ans1'];
		   	 // print_r($solution). '<br />';
		   	 // print_r($ans1). '<br />';
	$correct = 0;

				// if (isset($_POST['ans1'])) {
				// 	$ans1 = $_POST['ans1'];
				// }else{
				// 	$ans1 = null;
				// }
				// if (isset($_POST['ans2'])) {
				// 	$ans2 = $_POST['ans2'];
				// }else{
				// 	$ans2 = null;
				// }

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


		   		// if ($ans1[0] == $solution[0]) {
		   		// 	$correct++;
		   		// }
		   		// if ($ans2[0] == $solution[1]) {
		   		// 	$correct++;
		   		// }

	// ($ans1 == $solution[0]) ? $correct = $correct+1 : $correct = $correct;
	// ($ans2 == $solution[1]) ? $correct = $correct+1 : $correct = $correct;
	// 	   		($ans3[0] == $solution[3]) ? $correct = $correct+1 : $correct = $correct;
		   		// ($ans4[0] == $solution[4]) ? $correct = $correct+1 : $correct = $correct;
		   		// ($ans5[0] == $solution[5]) ? $correct = $correct+1 : $correct = $correct;
		   		// ($ans6[0] == $solution[6]) ? $correct = $correct+1 : $correct = $correct;
		   		// ($ans7[0] == $solution[7]) ? $correct = $correct+1 : $correct = $correct;
		   		// ($ans8[0] == $solution[8]) ? $correct = $correct+1 : $correct = $correct;
		   		// ($ans9[0] == $solution[9]) ? $correct = $correct+1 : $correct = $correct;
		   		// ($ans10[0] == $solution[10]) ? $correct = $correct+1 : $correct = $correct;



		   		 // for($i = 0; $i <= count($ans); $i++)
		   		 // 	{
		   		 // 		if (isset($ans[$i])) {
		   		 // 			$given_answer[] = $_POST['ans'];
		   		 // 		}
		   		 // 		// if (isset($_POST['ans'])) {
		   		 // 		// 	$given_answer[] = $_POST['ans'];
		   		 // 		// }

		   		 // 	}

		   		 // 	for($i = 0; $i <= count($given_answer); $i++)
		   		 // 	{
		   		 // 		if ($given_answer[$i] == $solution[$i]) {
		   		 // 			$correct = $correct+1;
		   		 // 		}
		   		 // 	}



         //           $q_id[] = $_POST['q_id'];

         //            $ans[] = $_POST['ans'];
         //            $ans[] = $_POST['ans'];
         //            $ans[] = $_POST['ans'];

         //            $correct = 0;
		   		 	// for($i = 0; $i <= count($q_id); $i++)
		   		 	// {
		   		 	// 	if($ans1[$i] == $solution[$i])
		   		 	// 	{
		   		 	// 		$correct = $correct+1;
		   		 	// 	}
		   		 	// 	if($ans2[$i] == $solution[$i])
		   		 	// 	{
		   		 	// 		$correct = $correct+1;
		   		 	// 	}if($ans3[$i] == $solution[$i])
		   		 	// 	{
		   		 	// 		$correct = $correct+1;
		   		 	// 	}if($ans4[$i] == $solution[$i])
		   		 	// 	{
		   		 	// 		$correct = $correct+1;
		   		 	// 	}
		   		 	// }
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

		if(isset($_GET['idc']))
{
	$i = 0;
	$class_id = $_SESSION['class_id'];
	$subject_id = $_SESSION['subject_id'];
	//$Q_limit = $_GET['limit'];
	$chapter_id = $_GET['idc'];
	$statement = $db->prepare("SELECT  q_id, q_title, q1, q2, q3, q4,solution  FROM tbl_question WHERE class_id=? AND subject_id=? AND chapter_id=? ORDER BY RAND() LIMIT 40");
$statement->execute(array($class_id, $subject_id, $chapter_id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);



			foreach ($result as $row)
			{
				//$solution[] = $row['solution'];
				$i++;
				?>

				<tr>
					<td>Question No.(<?php echo $i; ?>) :</td>
					<td><?php echo $row['q_title']; ?></td>
				</tr>
				<tr>
					<td>Option :</td>
					<td>
						<input type="radio" name="ans<?= $i ?>" value="1"><?php echo $row['q1']; ?><br>
						<input type="radio" name="ans<?= $i ?>" value="2"><?php echo $row['q2']; ?><br>
						<input type="radio" name="ans<?= $i ?>" value="3"><?php echo $row['q3']; ?> <br>
						<input type="radio" name="ans<?= $i ?>" value="4"><?php echo $row['q4']; ?>
					</td>


					<input type="hidden" name="solution[]" value="<?php echo $row['solution']; ?>">
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
