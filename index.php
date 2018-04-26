<?php
include_once 'service.php';

if ($_GET){
  $id_note = $_GET['id'];
  if (!empty($_GET['delete'])) {
    deleteNote($id_note);
    header("Location: index.php");
  }
}

if ($_POST){
  $id_note = $_POST['id'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $color = $_POST['color'];

  if (!empty($_POST['add'])){
    if (!empty($title) && !empty($description) && !empty($color)) {
      insertNote($title, $description, $color);
    }
  }else if (!empty($_POST['edit'])){
    if (!empty($title) && !empty($description) && !empty($color)) {
      updateNote($id_note, $title, $description, $color);
    }
  }
  header("Location: index.php");
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!--d meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <title>PHP - MyNotes</title>
  </head>
  <body class="container mt-4">
    <div class="row">

      <div class="col-md-6">
        <h1 class="mb-3">MyNotes</h1>
        <hr>
        <div>
          <?php foreach(getAllNotes() as $note): ?>
            <div class="alert alert-<?php echo getColorClassOfNote($note['id']) ?> border border-<?php if (getColorClassOfNote($note['id'])=="white"){echo "secondary";}else {echo getColorClassOfNote($note['id']);}?>" role="alert">
              <div class="alert-heading d-flex">
                <h4>
                  <?php echo $note['title'] ?>
                </h4>
                <div class="ml-auto">
                  <a href="index.php?id=<?php echo $note['id'] ?>" class="btn btn-warning">Update</a>
                  <a href="index.php?delete=yes&id=<?php echo $note['id'] ?>" class="btn btn-danger">Delete</a>
                </div>
              </div>
              <hr>
              <p> <?php echo $note['description'] ?> </p>
            </div>
          <?php endforeach ?>
        </div> 
      </div>

      <div class="col-md-6">
        <?php if(!$_GET): ?>
          <form action="index.php" method="POST">
            <h1 class="mb-3">Add Note</h1>
            <hr>
            <div class="form-group">
              <label>Title</label>
              <input type="text" class="form-control" name="title">
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea class="form-control" name="description"></textarea>
            </div>
            <div class="form-group">
              <label>Color of note</label>
              <select class="form-control" name="color">
                <option selected disabled hidden>Choose one</option>
                <?php foreach(getAllColors() as $color):?>
                  <option value=<?php echo $color['id']?>>
                    <?php echo $color['color'] ?>
                  </option>
                  <?php endforeach ?>
              </select>
            </div>
            <input type="hidden" name="id">
            <input type="hidden" name="add" value="add">
            <div class="row m-0 p-0 justify-content-end">
              <a href="index.php" class="btn btn-secondary col-md-4">Cancel</a>
              <input type="submit" class="btn btn-success col-md-4" value="Add note">
            </div>              
          </form>
        <?php endif ?>

        <?php if($_GET): ?>
          <form action="index.php" method="POST">
            <h1 calss="mb-3">Update Note</h1>
            <hr>
            <div class="form-group">
              <label>Title</label>
              <input type="text" class="form-control" name="title" value="<?php echo getNoteById($id_note)['title'] ?>">
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea class="form-control" name="description"><?php echo getNoteById($id_note)['description'] ?></textarea>
            </div>
            <div class="form-group">
              <label>Color of note</label>
              <select class="form-control" name="color">
                <?php foreach(getAllColors() as $color):?>
                <option value="<?php echo $color['id']?>" <?php if($color['id']==getColorIdOfNote($id_note)) echo "selected" ?>>
                  <?php echo $color['color'] ?>
                </option>
                <?php endforeach ?>
              </select>
            </div>
            <input type="hidden" name="id" value="<?php echo $id_note ?>">
            <input type="hidden" name="edit" value="edit">
            <div class="row m-0 p-0">
              <a href="index.php?delete=yes&id=<?php echo $id_note ?>" class="btn btn-danger col-md-4">Delete</a>
              <a href="index.php" class="btn btn-secondary col-md-4">Cancel</a>
              <input type="submit" class="btn btn-success col-md-4" value="Update">
            </div>
          </form>
        <?php endif ?>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </body>
</html>