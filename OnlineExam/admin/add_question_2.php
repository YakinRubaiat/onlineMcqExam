<?php require_once 'header.php'; 
require_once 'config.php';
session_start();

echo $class_id = $_SESSION['class_id'];
echo $subject_id = $_SESSION['subject_id'];


if(isset($_POST['submitForm']))
{
	try
	{
		if(empty($_POST['chapter_id']))
		{
			throw new Exception("Select a Chapter Name");
			
		}
		if(empty($_POST['q_title']))
		{
			throw new Exception("Question title can not be empty.");
			
		}
		if(empty($_POST['q1']))
		{
			throw new Exception("Option A can not be empty");
			
		}
		if(empty($_POST['q2']))
		{
			throw new Exception("Option B can not be empty");
			
		}
		if(empty($_POST['q3']))
		{
			throw new Exception("Option C can not be empty");
			
		}
		if(empty($_POST['q4']))
		{
			throw new Exception("Option D can not be empty");
			
		}
		
		$statement = $db->prepare("INSERT INTO tbl_question(class_id, subject_id, chapter_id, q_title, q1, q2, q3, q4, solution) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$statement->execute(array($class_id, $subject_id, $_POST['chapter_id'], $_POST['q_title'], $_POST['q1'], $_POST['q2'], $_POST['q3'], $_POST['q4'], $_POST['solution']));
		
      

	$success_message = "Data has been inserted successfully";

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
			    <label class="control-label col-sm-2" for="q_title">Question Title</label>
			    <div class="col-sm-10">
			      <textarea type="text" class="form-control" name="q_title" id="q_title" placeholder="Write Question"></textarea>
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="q1">Option A</label>
			    <div class="col-sm-10">
			      <input type="name" class="form-control" name="q1" id="q1" placeholder="Enter a option">
			    </div>
			 	   </div> 
			 	    <div class="form-group">
			    <label class="control-label col-sm-2" for="q2">Option B</label>
			    <div class="col-sm-10">
			      <input type="name" class="form-control" name="q2" id="q2" placeholder="Enter a option">
			    </div>
			 	   </div> 
			 	    <div class="form-group">
			    <label class="control-label col-sm-2" for="q3">Option C</label>
			    <div class="col-sm-10">
			      <input type="name" class="form-control" name="q3" id="q3" placeholder="Enter a option">
			    </div>
			 	   </div> 
			 	    <div class="form-group">
			    <label class="control-label col-sm-2" for="q4">Option D</label>
			    <div class="col-sm-10">
			      <input type="name" class="form-control" name="q4" id="q4" placeholder="Enter a option">
			    </div>
			 	   </div> 
			 	    <div class="form-group">
			    <label class="control-label col-sm-2" for="q1">Selctc a Solution</label>
			    <div class="col-sm-10">
			      <select class="form-control" name="solution">
			      	<option value="" selected>Select a solution</option>
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
