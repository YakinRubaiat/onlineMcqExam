<?php require_once 'header.php'; ?>
<?php require_once 'config.php'; ?>

<?php
  
    $statement = $db->prepare("SELECT * FROM tbl_class");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) 
    {
    	$categories[] = array("id" => $row['class_id'], "val" => $row['class_name']);
    }
   
    $statement = $db->prepare("SELECT * FROM tbl_subject");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) 
    {
    	$subcats[$row['class_id']][] = array("id" => $row['subject_id'], "val" => $row['subject_name']);
    }
  
  $jsonCats = json_encode($categories);
  $jsonSubCats = json_encode($subcats);


?>
<?php
if(isset($_POST['submitForm']))
{
	try
	{
		if(empty($_POST['chapter_name']))
		{
			throw new Exception("Chapter Name can not be empty");
			
		}
		if(empty($_POST['class_id']))
		{
			throw new Exception("Please Select a class");
			
		}
		if(empty($_POST['subject_id']))
		{
			throw new Exception("Please Select a Subject");
			
		}
		
		
		$statement = $db->prepare("SELECT * FROM tbl_chapter WHERE chapter_name=? AND class_id=? AND subject_id=?");
        $statement->execute(array($_POST['chapter_name'], $_POST['class_id'], $_POST['subject_id']));
        $total = $statement->rowCount();

        if ($total > 0) {
            throw new Exception("Chapter name  is already existed By this class");
        }
     

	$statement = $db->prepare("INSERT INTO tbl_chapter(chapter_name, subject_id, class_id) VALUES(?, ?, ?)");
		$statement->execute(array($_POST['chapter_name'], $_POST['subject_id'], $_POST['class_id']));
		
      

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
        //delete
        if(isset($_REQUEST['id'])) 
{
	$id = $_REQUEST['id'];
	
	$statement = $db->prepare("DELETE FROM tbl_chapter WHERE chapter_id=?");
	$statement->execute(array($id));
	
	$success_message2 = "chapter Name has been deleted successfully.";
	
} 
   ?>
 <script type='text/javascript'>
      <?php
        echo "var categories = $jsonCats; \n";
        echo "var subcats = $jsonSubCats; \n";
      ?>
      function loadCategories(){
        var select = document.getElementById("categoriesSelect");
        select.onchange = updateSubCats;
        for(var i = 0; i < categories.length; i++){
          select.options[i] = new Option(categories[i].val,categories[i].id);          
        }
      }
      function updateSubCats(){
        var catSelect = this;
        var catid = this.value;
        var subcatSelect = document.getElementById("subcatsSelect");
        subcatSelect.options.length = 0; //delete all options if any present
        for(var i = 0; i < subcats[catid].length; i++){
          subcatSelect.options[i] = new Option(subcats[catid][i].val,subcats[catid][i].id);
        }
      }
    </script>
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

<?php   ?>
          <h1 class="page-header">Add chapter name</h1>
<!-- end index -->

          <form action="" method="post" class="form-horizontal" role="form">
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="chapter_name">Chapter Name</label>
			    <div class="col-sm-10">
			      <input type="name" class="form-control" name="chapter_name" id="chapter_name" placeholder="Enter chapter_name">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2">Select a class</label>
			    <div class="col-sm-10">
			      
                      <select id='categoriesSelect'  class="form-control" name="class_id">

   					 </select>

			      
			    </div>
			  </div>
			   <div class="form-group">
			    <label class="control-label col-sm-2">Select a Subject</label>
			    <div class="col-sm-10">
			     <select id='subcatsSelect'  class="form-control" name="subject_id">

				</select>
			    
			      
			    </div>
			  </div>

					    

			  <div class="form-group"> 
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-success btn-large" name="submitForm" >Save</button>
			    </div>
			  </div>
			</form>


<h2>View Chapter List By Class and subject</h2>

<table class="table" width="100%">
	<tr>
		<th width="5%">Serial</th>
		<th width="40%">Chapter Name</th>
		<th width="25%">Subject Name</th>
		<th width="25%">Class Name</th>
		<th width="5%">Action</th>
	</tr>
	
	<?php
	$i=0;
	$statement = $db->prepare("SELECT * FROM tbl_chapter ORDER BY chapter_id DESC");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row)
	{
		$i++;

    $statement1 = $db->prepare("SELECT * FROM tbl_subject WHERE subject_id=?");
	$statement1->execute(array($row['subject_id']));
	$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
	foreach($result1 as $row1)
	{
          $subject_name = $row1['subject_name'];
	}

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
		<td><?php echo $row['chapter_name']; ?></td>
		<td><?php echo $subject_name; ?></td>
		<td><?php echo $class_name; ?></td>
		<td>
			
			<a onclick='return confirmDelete();' href="add_chapter.php?id=<?php echo $row['chapter_id']; ?>">Delete</a>


			</td>
		</tr>
		
		<?php
	}
	?>
	
	
	
	
</table>


<?php require_once 'footer.php'; ?>
