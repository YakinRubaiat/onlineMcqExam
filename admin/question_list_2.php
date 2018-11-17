<?php require_once 'header.php'; 
require_once 'config.php';
session_start();

 $class_id = $_SESSION['class_id'];
 $subject_id = $_SESSION['subject_id'];

if(isset($_POST['submitForm']))
{
	try
	{
		if(empty($_POST['chapter_id']))
		{
			throw new Exception("Select a Chapter Name");
			
		}
		
	$success_message = "Your requesting data is bellow.";

       // echo $_POST['chapter_name']." ".$_POST['subject_id']."".$_POST['class_id'];
	}  

//delete


	catch(Exception $e)
	{
		$error_message = $e->getMessage();
	}
	
}

 ?>
 <?php
if(isset($_POST['form2']))
{
	try {
		
		if(empty($_POST['q_title'])) {
			throw new Exception("Question Title  can not be empty.");
		}
		if(empty($_POST['q1'])) {
			throw new Exception("Option A can not be empty");
		}
		if(empty($_POST['q2'])) {
			throw new Exception("Option B can not be empty");
		}
		if(empty($_POST['q3'])) {
			throw new Exception("Option C can not be empty");
		}
		if(empty($_POST['q4'])) {
			throw new Exception("Option D can not be empty");
		}
		
		$statement = $db->prepare("UPDATE tbl_question SET q_title=?, q1=?, q2=?, q3=?, q4=?, solution=? WHERE q_id=?");
		$statement->execute(array($_POST['q_title'], $_POST['q1'], $_POST['q2'], $_POST['q3'], $_POST['q4'], $_POST['solution'], $_POST['q_id']));
		
		$success_message1 = "Data has been updated successfully.";
		
	}
	catch(Exception $e) {
		$error_message1 = $e->getMessage();
	}
		
}

if(isset($_REQUEST['id'])) 
{
	$id = $_REQUEST['id'];
	
	$statement = $db->prepare("DELETE FROM tbl_question WHERE q_id=?");
	$statement->execute(array($id));
	
	$success_message2 = "Subject Name has been deleted successfully.";
	
}

?>
<?php
if (isset($success_message)) {
    echo '<div class="alert alert-success">' . $success_message . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
}
if (isset($success_message1)) {
    echo '<div class="alert alert-success">' . $success_message1 . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
}
if (isset($success_message2)) {
    echo '<div class="alert alert-success">' . $success_message2 . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
}

if (isset($error_message)) {
    echo '<div class="alert alert-danger">' . $error_message . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
}
if (isset($error_message1)) {
    echo '<div class="alert alert-danger">' . $error_message1 . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
}

?>


<!-- index -->
          <h1 class="page-header">Add Question</h1>

           <form action="" method="post" class="form-horizontal" role="form">
			   <div class="form-group">
			    <label class="control-label col-sm-2">Select a Chapter</label>
			    <div class="col-sm-10">
			      
                      <select class="form-control" name="chapter_id">
                         <option value="" selected>Select a chapter</option>
             <?php
             $statement = $db->prepare("SELECT * FROM tbl_chapter WHERE subject_id=? AND class_id=? ORDER BY chapter_name ASC");
             $statement->execute(array($subject_id, $class_id));
             $result = $statement->fetchAll(PDO::FETCH_ASSOC);
             foreach ($result as $row) 
    				{  ?>
                     	<option value="<?php echo $row['chapter_id']; ?>"><?php echo $row['chapter_name']; ?></option>
		   <?php }  ?>

   					 </select>
                     
			      
			    </div>
			  </div>
			    
			  <div class="form-group"> 
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-success btn-large" name="submitForm" >Save</button>
			    </div>
			  </div>
			</form>
          
          <?php
        
if(isset($_POST['submitForm']))
{    
	$chapter_id = $_POST['chapter_id'];

	$statement = $db->prepare("SELECT * FROM tbl_class WHERE class_id=?");
    $statement->execute(array($class_id));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) 
    {
    	$class_name = $row['class_name'];
    }
    $statement = $db->prepare("SELECT subject_name FROM tbl_subject WHERE subject_id=?");
    $statement->execute(array($subject_id));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) 
    {
    	$subject_name = $row['subject_name'];
    }

    $statement = $db->prepare("SELECT * FROM tbl_chapter WHERE chapter_id=?");
    $statement->execute(array($chapter_id));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) 
    {
    	$chapter_name = $row['chapter_name'];
    }
     
      ?>
<table class="table">
	<tr>
		<th width="30%">Class Name</th>
		<th width="30%">Subject Name</th>
		<th width="40%">Chapter Name</th>
	</tr>
	<tr>
		<td><?php echo $class_name; ?></td>
		<td><?php echo $subject_name; ?></td>
		<td><?php echo $chapter_name; ?></td>
	</tr>
</table>
<table>
<?php
$i = 0;
    $statement = $db->prepare("SELECT * FROM tbl_question WHERE class_id=? AND subject_id=? AND chapter_id=? ORDER BY q_id desc");
    $statement->execute(array($class_id, $subject_id, $chapter_id));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) 
    {
    	$i++;  ?>
	<tr>
		<td width="15%">Question No: <?php echo $i; ?> :</td>
		<td><?php echo $row['q_title']; ?></td>
	</tr>
	<tr>
		<td>Option: </td>
		<td>
				<ul>
					<li><?php echo $row['q1']; ?></li>
					<li><?php echo $row['q2']; ?></li>
					<li><?php echo $row['q3']; ?></li>
					<li><?php echo $row['q4']; ?></li>
				</ul>
		</td>
		<td>Solution: </td>
		<td> <?php echo $row['solution']; ?></td>
		<td>
			<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal<?= $row['q_id']?>">Edit</button>

			<!-- Modal -->
			<div id="editModal<?= $row['q_id']?>" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Edit <?= $row['q_title'] ?></h4>
			      </div>
			      <div class="modal-body">
			        <form method="post" action="">
			        	<input type="text" class="form-control" name="q_title" value="<?= $row['q_title'] ?>" />
				        <input type="hidden" class="form-control" name="q_id"  value="<?= $row['q_id'] ?>" />
				        <input type="text" class="form-control" name="q1"  value="<?= $row['q1'] ?>" />
				        <input type="text" class="form-control" name="q2"  value="<?= $row['q2'] ?>" />
				        <input type="text" class="form-control" name="q3"  value="<?= $row['q3'] ?>" />
				        <input type="text" class="form-control" name="q4"  value="<?= $row['q4'] ?>" />
				        <select class="form-control" name="solution">
				        	<?php 
                                 if($row['solution'] == 1)
                                 { ?>
                                 	<option value="1" selected>Option A</option>

                               <?php  }
                               elseif($row['solution'] == 2)
                                 {  ?>
                                 	<option value="2" selected>Option B</option>

                           <?php }
                           elseif($row['solution'] == 3)
                                 {  ?>
                                 	<option value="3" selected>Option C</option>

                           <?php }
                             elseif($row['solution'] == 4)
                                 {  ?>
                                 	<option value="4" selected>Option D</option>

                           <?php } ?>
									<option value="1">Option A</option>
                                 	<option value="2">Option B</option>
                                 	<option value="3">Option C</option>
                                 	<option value="4">Option D</option>
                            </select>
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

			<a onclick='return confirmDelete();' href="question_list_2.php?id=<?php echo $row['q_id']; ?>">Delete</a>


			</td>
		
	</tr>
	<?php } ?>
</table>


 <?php  

  }


          ?>

<!-- end index -->
<?php require_once 'footer.php'; ?>
