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
	
		if(empty($_POST['class_id']))
		{
			throw new Exception("Please Select a class");
			
		}
		if(empty($_POST['subject_id']))
		{
			throw new Exception("Please Select a Subject");
			
		}
		
		session_start();
		$_SESSION['class_id'] = $_POST['class_id'];
		$_SESSION['subject_id'] = $_POST['subject_id'];

		header("location: question_list_2.php");

       // echo $_POST['chapter_name']." "."".;
	}  

	catch(Exception $e)
	{
		$error_message = $e->getMessage();
	}
	
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
          <h1 class="page-header">Select data for Editing/Deleting Question</h1>
<!-- end index -->

          <form action="" method="post" class="form-horizontal" role="form">
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




<?php require_once 'footer.php'; ?>
