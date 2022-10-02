<div class="container" style="max-width: 300px;">
  <a href="<?php echo WWW_ROOT . '/index.php' ?>" class="btn btn-primary mb-5">Back to the list</a>
  <?php if (!empty($errors)) : ?>
  <div class="errors">
    <p>Following errors occured:</p>
    <ul>
      <?php foreach ($errors as $error) :?>
        <li><?php echo h($error) ?></li>
      <?php endforeach ?> 
    </ul>
  </div>
  <?php endif ?>
  <form method="post" autocomplete="off">
    <div class="mb-3 form-group">
      <label class="" for="title">Title</label>
      <input class="form-control" id="title" name="title" type="text" value="<?php echo h($conf["title"]) ?>" required <?php echo !$edit ? "disabled" : "" ?>>
    </div>  
    <div class="mb-3 form-group">
      <label class="" for="date">Conference Date</label>
      <input class="form-control" id="date" name="date" type="datetime-local" value="<?php echo h($conf["date"]) ?>" required <?php echo !$edit ? "disabled" : "" ?>>
    </div>
    <?php if ($edit) :?>
      <button class="btn btn-danger mb-4" type="button" onclick="deleteMarker()">Delete marker</button>
    <?php endif ?>
        <input class="form-control" type="text" value="<?php echo h(u($conf["lat"]))?>" id="lat" name="lat" <?php echo !$edit ? "disabled" : "" ?> hidden/>
        <input class="form-control" type="text" value="<?php echo h(u($conf["lng"]))?>" id="lng" name="lng" <?php echo !$edit ? "disabled" : "" ?> hidden/>
    <div id="map" style="height: 400px; width: 100%;" class="mb-4"></div>
    <div class="mb-3 form-group">
      <label class="" for="country">Country</label>
      <?php $lines = file(PRIVATE_PATH . '/countries.txt');?>
      <select class="form-control" id="country" name="country" value="<?php echo h(trim($conf["country"])) ?>" required <?php echo !$edit ? "disabled" : "" ?>>
        <?php foreach($lines as $line): ?>        
          <option value="<?php echo $line ?>" <?php if (h(trim($conf["country"])) == trim($line)) echo "selected" ?>><?php echo $line ?></option>
        <?php endforeach?>
      </select>
    </div>
    <div>
      <?php if (!$edit) : ?>
      <a href="<?php echo WWW_ROOT . '/edit.php?id=' . h(u($conf['id'])) ?>" class="btn btn-primary">Edit</a>
      <?php else : ?>
      <button type="submit" class="btn btn-primary">Save</button>
      <?php endif ?>
      <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#confirmation">Delete</button>
    </div>
  </form>
</div>
<div class="modal fade" id="confirmation" tabindex="-1" aria-labelledby="confirmationLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmationLabel">Are you sure?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo WWW_ROOT . '/delete.php?id=' .  h(u($conf['id'])) ?>" method="POST">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>