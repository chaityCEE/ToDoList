<?php

session_start();
$connection = mysqli_connect('localhost','root','','todolist');

$id=0;
$title='';
$detail='';
$update= false;
$_SESSION['message'] = null;


if(isset($_POST['submit'])){
    $title= $_POST['title'];
    $detail= $_POST['detail'];

    $query= " INSERT INTO usertask(task_title, task_detail) VALUES('$title','$detail')";
    mysqli_query($connection, $query);
    
    $_SESSION['message']= "Task Added";
    header('location: index.php');
}


$showquery= "SELECT * FROM usertask ORDER BY task_id ";
$show = mysqli_query($connection, $showquery);

if(isset($_GET['done'])){
    $id= $_GET['done'];

    $completed= "DELETE FROM usertask WHERE task_id= '$id' ";
    mysqli_query($connection, $completed);

    $_SESSION['message']= "Task Completed ^_^ ";
    header('location: index.php');
}

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
  
  $_SESSION['message']= "Task Updated!!";
  header('location: index.php');

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
    
    <script src="https://kit.fontawesome.com/79b4d43060.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title> TO DO LIST </title>
</head>
<body>

<div class="jumbotron text-center">
   <h1>Welcome to your Daily task </h1>
   <small> Let's see what you are up to  !!! </small>
 </div>

 <?php

 if(isset($_SESSION['message'])): ?>
 <div class="msg">
 <?php
   echo $_SESSION['message'];
   unset($_SESSION['messahe']);
 ?>
 </div>

 <?php endif ?>


<div class="text-center">
 <a href="addform.php" class="btn btn-outline-primary mb-5 " role="button" > Add a Task <i class="fa fa-plus"></i></a>
</div>

<div class="container">
<div class="row">
<?php 
   while($rows=mysqli_fetch_assoc($show)) {
?>
  <div class=" col-md-12">
    <div class="card mb-2">
      <div class="card-body">
        <h3 class="card-title font weight bold"><?php echo "Title: {$rows['task_title']}"; ?></h3>
        <p class="card-text font-italic"><?php echo "Details: {$rows['task_detail']}"; ?></p>
        
        <div class="text-right">
        <a href="addform.php?edit=<?php echo "{$rows['task_id']}"; ?>" class="btn btn-outline-warning"><i class="fa fa-pencil-square-o"></i> Edit </a>
        <a href="index.php?done=<?php echo "{$rows['task_id']}"; ?>" class="btn btn-outline-success"><i class="fa fa-check-circle"></i> Done </a>
        </div>

      </div>
    </div>
  </div>
  <?php } ?>
</div>
</div>
  

    
</body>
</html>