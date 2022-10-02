<?php 
  require_once('../private/init.php');

  $conf = [];
  $conf['title'] = $_POST['title'] ?? '';
  $conf['date'] = $_POST['date'] ?? '';
  $conf['lat'] = $_POST['lat'] ?? '';
  $conf['lng'] = $_POST['lng'] ?? '';
  $conf['country'] = $_POST['country'] ?? '';
?>


<?php 
  if ($_SERVER["REQUEST_METHOD"] === "POST"){

    $errors = validate_conf($conf);
    if (empty($errors)){
      $uuid = $db_conn->create_conference($conf);
      $uuid = $uuid['@uuid'];
      redirect_to(url_for('/details.php?id=' . $uuid));
    }
  }
  ?>

<?php 
  $page_title = "New";
  $edit = True;
  include(SHARED_PATH . '/header.php');
  ?>


<?php
  include(PRIVATE_PATH . '/details_form.php');
  ?>

<?php include(SHARED_PATH . '/footer.php')?>