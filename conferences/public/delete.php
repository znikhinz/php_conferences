<?php 
  require_once('../private/init.php');

  if (!isset($_GET['id'])){
    redirect_to(url_for('/index.php'));
  }

  $id = $_GET['id'];

  if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $db_conn->delete_conference($id);
  }

  redirect_to(url_for('/index.php'));
