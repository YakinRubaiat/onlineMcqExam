<?php require_once 'header.php'; ?>
<?php require_once 'config.php'; 

?>
<!-- index -->
          <h1 class="page-header">All Classes</h1>

          <div class="row placeholders">
        
          <?php
         // $i = 0;

          if(empty($_GET['id']))
          {
           
            $statement = $db->prepare("SELECT * FROM tbl_class");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) 
    {
       $class_name = $row['class_name'];      
       $class_id = $row['class_id']; 
      // $_SESSION['class_id'] = $row['class_id'];     
   ?>
             <div class="col-xs-6 col-sm-3 placeholder">
             <a href="index.php?id=<?php echo $class_id; ?>"/>

                <?php
                //Choose a random image from images/demo_profiles/ -> if the student has no image
              $imagesDir = './images/';
              $images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
              
              $random_img = basename($images[array_rand($images)]);
              ?>


              <img src="./images/<?= $random_img; ?>" width="200" height="200" class="img-responsive" alt="">

              <h4><?php echo $class_name; ?></h4>
              </a>
              
            </div>
   <?php }
          ?>
          
          </div>
       <?php   }  ?>
    
    <?php  if(isset($_GET['id']))
              { 
               
                $class_id = $_GET['id'];
                 $_SESSION['class_id'] = $_GET['id'];
    
    $statement = $db->prepare("SELECT * FROM tbl_subject WHERE class_id=?");
    $statement->execute(array($class_id));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) 
    {
       $subject_name = $row['subject_name'];      
       $subject_id = $row['subject_id'];  
       $_SESSION['subject_id'] = $row['subject_id'];     
   ?>
             <div class="col-xs-6 col-sm-3 placeholder">
             <a href="question.php?idc=1&id=<?php echo $subject_id; ?>"/>
              <?php
                //Choose a random image from images/demo_profiles/ -> if the student has no image
              $imagesDir = './images/';
              $images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
              
              $random_img = basename($images[array_rand($images)]);
              ?>


              <img src="./images/<?= $random_img; ?>" width="200" height="200" class="img-responsive" alt="">
              <h4><?php echo $subject_name; ?></h4>
              </a>
              
            </div>
   <?php }
          ?>
          
          </div>



         <?php     }   ?>
<!-- end index -->
<?php require_once 'footer.php'; ?>
