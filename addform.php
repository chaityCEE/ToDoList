<?php

$connection = mysqli_connect('localhost','root','','todolist');

$id=0;
$title='';
$detail='';
$update= false;


if(isset($_GET['edit'])){
    $id= $_GET['edit'];
    $update = true;
    $edit= mysqli_query($connection, "SELECT * FROM usertask WHERE task_id='$id' ");
  
    $rows = mysqli_fetch_assoc($edit);
    $title= $rows['task_title'];
    $detail= $rows['task_detail'];
  }
  
  
  if(isset($_POST['update'])){
    $id= $_POST['id'];
    $title= $_POST['title'];
    $detail= $_POST['detail'];
  
    $updatequery= mysqli_query($connection, "UPDATE usertask SET task_title='$title',task_detail='$detail' WHERE task_id='$id'  ");
  }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    
    <title>ADD TASK</title>
</head>
<body>

<h2 class="jumbotron text-center"> Add your task </h2>

<form class="container" action="index.php" method="post">
  <div class="form-group">
     
     <input type="hidden" name="id" value="<?php echo $id; ?>">

      <label >Title </label>
      <input type="text" class="form-control mb-5 border-top-0 border-right-0 border-left-0" placeholder="Add a title..." name="title"
      value="<?php echo $title; ?>">
      
      <label>Details</label>
      <input type="text" class="form-control mb-5 border-top-0 border-right-0 border-left-0" placeholder="Add your work..." name="detail"
      value="<?php echo $detail; ?>">
    
    
     <div class="text-center ">

     <?php if($update==true): ?>
     <button name="update" type="submit" class="btn btn-outline-info">Update</button>
     <?php else: ?>
     <button type="submit" class="btn btn-outline-info" name="submit">Submit</button>
     <?php endif; ?>

     <a href="index.php" class="btn btn-light">Back To Previous Page</a>
     </div>
  </div>
</form>

    
</body>
</html>