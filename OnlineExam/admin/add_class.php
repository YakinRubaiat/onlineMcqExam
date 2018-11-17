<?php require_once 'header.php'; ?>
<?php require_once 'config.php'; ?>
<?php
if(isset($_POST['submitForm']))
{
	try
	{
		if(empty($_POST['class_name']))
		{
			throw new Exception("Class Name can not be empty");
			
		}
		
		$statement = $db->prepare("SELECT * FROM tbl_class WHERE class_name=?");
        $statement->execute(array($_POST['class_name']));
        $total = $statement->rowCount();

        if ($total > 0) {
            throw new Exception("Class is already existed");
        }
     

	$statement = $db->prepare("INSERT INTO tbl_class(class_name) VALUES(?)");
		$statement->execute(array($_POST['class_name']));
		
      

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
		
		if(empty($_POST['class_name'])) {
			throw new Exception("class_name Name can not be empty.");
		}
		
		$statement = $db->prepare("UPDATE tbl_class SET class_name=? WHERE class_id=?");
		$statement->execute(array($_POST['class_name'],$_POST['class_id']));
		
		$success_message1 = "Class Name has been updated successfully.";
		
	}
	catch(Exception $e) {
		$error_message1 = $e->getMessage();
	}
		
}

if(isset($_REQUEST['id'])) 
{
	$id = $_REQUEST['id'];
	
	$statement = $db->prepare("DELETE FROM tbl_class WHERE class_id=?");
	$statement->execute(array($id));
	
	$success_message2 = "Class Name has been deleted successfully.";
	
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
			    <label class="control-label col-sm-2" for="class_name">Class Name</label>
			    <div class="col-sm-10">
			      <input type="name" class="form-control" name="class_name" id="class_name" placeholder="Enter class_name">
			    </div>
			  </div>

			  <div class="form-group"> 
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-success btn-large" name="submitForm" >Save</button>
			    </div>
			  </div>
			</form>


<h2>View Class</h2>

<table class="table" width="100%">
	<tr>
		<th width="5%">Serial</th>
		<th width="75%">Class Name</th>
		<th width="15%">Action</th>
	</tr>
	
	<?php
	$i=0;
	$statement = $db->prepare("SELECT * FROM tbl_class");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row)
	{
		$i++;
		?>
			
		<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $row['class_name']; ?></td>
		<td>
			<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal<?= $row['class_id']?>">Edit</button>

			<!-- Modal -->
			<div id="editModal<?= $row['class_id']?>" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Edit <?= $row['class_name'] ?></h4>
			      </div>
			      <div class="modal-body">
			        <form method="post" action="">
			        	<input type="text" class="form-control" name="class_name" value="<?= $row['class_name'] ?>" />
				        <input type="hidden" class="form-control" name="class_id"  value="<?= $row['class_id'] ?>" />
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

			<a onclick='return confirmDelete();' href="add_class.php?id=<?php echo $row['class_id']; ?>">Delete</a>


			</td>
		</tr>
		
		<?php
	}
	?>
	
	
	
	
</table>

<!-- end index -->
<?php require_once 'footer.php'; ?>
