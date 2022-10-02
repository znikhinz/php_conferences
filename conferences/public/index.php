<?php require_once('../private/init.php'); ?>

<?php 
  $page_title = "Main"; 

  $conferences = $db_conn->get_conferences();
  ?>
<?php include(SHARED_PATH . '/header.php'); ?>
    <a class="btn btn-success float-right mb-2" href="<?php echo url_for('/new.php') ?>">Create</a>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Conference Date</th>
          <th scope="col">Conference Name</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($conferences as $conf) : ?>
          <tr>
            <th scope="row"><?php echo h($conf["date"]) ?></th>
            <td><?php echo h($conf["title"]) ?></td>
            <td>
              <div class="btn-group" role="group">
                <a href="<?php echo WWW_ROOT . '/details.php?id=' . h(u($conf["id"]))?>" class="btn btn-primary">info</a>
                <button type="button" class="btn btn-danger" onclick="delete_conf('<?php echo h(u($conf['id']))?>')">delete</button>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>

<div class="modal fade" id="confirmation" tabindex="-1" aria-labelledby="confirmationLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmationLabel">Are you sure?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="confirmationForm" action="" method="POST">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>