<?php 
  require_once('../private/init.php');

  if (!isset($_GET['id'])){
    redirect_to(url_for('/index.php'));
  }

  $id = $_GET['id'];

  $conf = $db_conn->get_conference($id);
?>

<?php 
  $page_title = "Details";
  $edit = False;
  include(SHARED_PATH . '/header.php');
  ?>


<?php  
  $edit = False;
  include(PRIVATE_PATH . '/details_form.php');
  ?>

<?php include(SHARED_PATH . '/footer.php')?>