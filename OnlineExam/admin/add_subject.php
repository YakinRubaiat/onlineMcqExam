<?php require_once 'header.php'; ?>
<?php require_once 'config.php'; ?>
<?php
if(isset($_POST['submitForm']))
{
	try
	{
		if(empty($_POST['subject_name']))
		{
			throw new Exception("Subject Name can not be empty");
			
		}
		if(empty($_POST['class_id']))
		{
			throw new Exception("Please Select a class");
			
		}
		
		
		$statement = $db->prepare("SELECT * FROM tbl_subject WHERE subject_name=? AND class_id=?");
        $statement->execute(array($_POST['subject_name'], $_POST['class_id']));
        $total = $statement->rowCount();

        if ($total > 0) {
            throw new Exception("Subject name  is already existed By this class");
        }
     

	$statement = $db->prepare("INSERT INTO tbl_subject(subject_name, class_id) VALUES(?, ?)");
		$statement->execute(array($_POST['subject_name'], $_POST['class_id']));
		
      

	$success_message = "Data has been inserted successfully";


	}  



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
		
		if(empty($_POST['subject_name'])) {
			throw new Exception("subject_name Name can not be empty.");
		}
		if(empty($_POST['class_id'])) {
			throw new Exception("Please Select a class.");
		}
		
		$statement = $db->prepare("UPDATE tbl_subject SET subject_name=?, class_id=? WHERE subject_id=?");
		$statement->execute(array($_POST['subject_name'], $_POST['class_id'], $_POST['subject_id']));
		
		$success_message1 = "Data has been updated successfully.";
		
	}
	catch(Exception $e) {
		$error_message1 = $e->getMessage();
	}
		
}

if(isset($_REQUEST['id'])) 
{
	$id = $_REQUEST['id'];
	
	$statement = $db->prepare("DELETE FROM tbl_subject WHERE subject_id=?");
	$statement->execute(array($id));
	
	$success_message2 = "Subject Name has been deleted successfully.";
	
}

?>
<!-- index -->
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
    echo '<div class="alert alert-success">' . $error_message1 . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
}
?>
          <h1 class="page-header">Add your class</h1>


          <form action="" method="post" class="form-horizontal" role="form">
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="subject_name">Subject Name</label>
			    <div class="col-sm-10">
			      <input type="name" class="form-control" name="subject_name" id="subject_name" placeholder="Enter subject_name">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2">Select a class</label>
			    <div class="col-sm-10">
			      <select name="class_id"  class="form-control">
                    <option value="" selected>Select</option>
                     
                     <?php
    $statement = $db->prepare("SELECT * FROM tbl_class ORDER BY class_name ASC");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) 
    {
    	$class_id = $row['class_id'];
    	$class_name = $row['class_name'];
    ?>	
    <option value="<?= $class_id; ?>"><?= $class_name; ?></option>
    <?php
          }
    	?>
              </select>
              
			    </div>
			  </div>

			  <div class="form-group"> 
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-success btn-large" name="submitForm" >Save</button>
			    </div>
			  </div>
			</form>


<h2>View Subject List By Class</h2>

<table class="table" width="100%">
	<tr>
		<th width="5%">Serial</th>
		<th width="40%">Subject Name</th>
		<th width="40%">Class Name</th>
		<th width="15%">Action</th>
	</tr>
	
	<?php
	$i=0;
	$statement = $db->prepare("SELECT * FROM tbl_subject");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row)
	{
		$i++;

    $statement1 = $db->prepare("SELECT * FROM tbl_class WHERE class_id=?");
	$statement1->execute(array($row['class_id']));
	$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
	foreach($result1 as $row1)
	{
          $class_name = $row1['class_name'];
	}		
		?>
			
		<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $row['subject_name']; ?></td>
		<td><?php echo $class_name; ?></td>
		<td>
			<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal<?= $row['subject_id']?>">Edit</button>

			<!-- Modal -->
			<div id="editModal<?= $row['subject_id']?>" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Edit <?= $row['subject_name'] ?></h4>
			      </div>
			      <div class="modal-body">
			        <form method="post" action="">
			        	<input type="text" class="form-control" name="subject_name" value="<?= $row['subject_name'] ?>" />
				        <input type="hidden" class="form-control" name="subject_id"  value="<?= $row['subject_id'] ?>" />

                           

				        <br />
				        <?php echo $row['class_id']; ?>
				        <br />
                            <select name="class_id" class="form-control">
    
                     
                     <?php
					    $statement3 = $db->prepare("SELECT * FROM tbl_class ORDER BY class_name ASC");
					    $statement3->execute();
					    $result3 = $statement3->fetchAll(PDO::FETCH_ASSOC);
					    foreach ($result3 as $row3) 
					    {
					    	$class_id3 = $row3['class_id'];
					    	$class_name3 = $row3['class_name'];
					    	if($class_id3 == $row['class_id']){ ?>
					    		  <option value="<?= $class_id3; ?>" selected><?= $class_name3; ?></option>
					    	<?php }
					    	else{ ?>
					    		 <option value="<?= $class_id3; ?>"><?= $class_name3; ?></option>
					    	<?php }
					   
					        }
					    	?>
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

			<a onclick='return confirmDelete();' href="add_subject.php?id=<?php echo $row['subject_id']; ?>">Delete</a>


			</td>
		</tr>
		
		<?php
	}
	?>
	
	
	
	
</table>

<!-- end index -->
<?php require_once 'footer.php'; ?>
