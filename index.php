<?php

session_start();
if (!isset($_SESSION['user'])){
  header("location:login.php");
  exit();
}
echo "welcome" . $_SESSION['user']['firstname'] ;
    // $get_db = new PDO("mysql:localhost dbneme:mero", "root" , "");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>

<h1>hello mr: user you are in a main profile in this site</h1>
<img  src="images/male.png" alt="image">
<a href="logout.php">log out</a>

<style>
  img{
  width:100px;
  height: auto;
  display: flex;
  margin: auto;
}

</style>

</body>

</html>