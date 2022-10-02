<?php 
  require_once('../private/init.php');

  if (!isset($_GET['id'])){
    redirect_to(url_for('/index.php'));
  }

  $id = $_GET['id'];
?>

<?php 
  if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $conf = [];
    $conf['id'] = $_GET['id'] ?? '';
    $conf['title'] = $_POST['title'] ?? '';
    $conf['date'] = $_POST['date'] ?? '';
    $conf['lat'] = $_POST['lat'] ?? '';
    $conf['lng'] = $_POST['lng'] ?? '';
    $conf['country'] = $_POST['country'] ?? '';

    $errors = validate_conf($conf);
    if (empty($errors)){
      $db_conn->update_conference($conf);
      redirect_to(url_for("/details.php?id=" . h(u($conf['id']))));
    }
  }
  else{
    $conf = $db_conn->get_conference($id);
  }
?>

<?php 
  $page_title = "Edit";
  $edit = true;
  include(SHARED_PATH . '/header.php');?>


<?php
  $edit = True;
  include(PRIVATE_PATH . '/details_form.php');
  ?>

<?php include(SHARED_PATH . '/footer.php')?>

