<?php require_once 'header.php'; ?>
<!-- index -->
<h1 class="page-header">All Tests</h1>

<div class="row placeholders">

  <?php 
  $statement = $db->prepare("SELECT * FROM tbl_test WHERE is_published=1 ORDER BY id DESC");
  $statement->execute();
  $tests = $statement->fetchAll(PDO::FETCH_ASSOC);
  $i = 0;
  foreach ($tests as $test) {
    $i++;
    ?>

    <?php 
    if ($i == 1) { ?>
    <div class="well well-large">
      <h3>Test - <mark><?= $test['test_name']?></mark></h3>
      <h3>Test Start - <?= $test['exam_date'] ?></h3>
      <a href="question.php?test_id=<?= $test['id']?>" class="btn btn-primary btn-large">Enter Into Exam </a>
    </div>
    <?php }else{ ?>
      <div class="well">
      <h3>Test - <mark><?= $test['test_name']?></mark></h3>
      <h3>Test Start - <?= $test['exam_date'] ?></h3>
      <a href="question.php?test_id=<?= $test['id']?>" class="btn btn-primary btn-large">Enter Into Exam </a>
    </div>
    <?php } ?>



    <?php } ?>


  </div>

  <!-- end index -->
  <?php require_once 'footer.php'; ?>
