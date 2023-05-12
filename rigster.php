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
  
  
  
  
  <?php

    $getdb = new PDO("mysql:host=localhost; dbname=test" , "root" , "");

    if(isset($_POST["send"])){
        $first_name = filter_var( $_POST["first_name"], FILTER_SANITIZE_STRING);
        $last_name = filter_var( $_POST["last_name"], FILTER_SANITIZE_STRING);
        $email = filter_var( $_POST["emaill"], FILTER_VALIDATE_EMAIL);
        $pwd = filter_var( $_POST["pwd"], FILTER_SANITIZE_STRING);
        // $pwd = password_hash($pwd,PASSWORD_DEFAULT);
        

        // if a user get a mistake  
        $errors = [];
        if(empty($first_name)){
            $errors[]= "you must be input the firstname";
        }
        elseif(empty($last_name) || strlen($last_name) > 100){
            $errors[]= "this is not right in lastname";
        }elseif(empty($email) || filter_var($email , FILTER_VALIDATE_EMAIL) === false){
            $errors[]= "you must be input the email";
        }
        elseif(empty($pwd)){
            $errors[]= "you must be input the password";
        }
        // if the email is here in database
        // validate email
   if(empty($email)){
    $errors[]="يجب كتابة البريد الاكترونى";
   }elseif(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
    $errors[]="البريد الاكترونى غير صالح";
   }

  // $stm=;
  $check = $getdb->prepare("SELECT email FROM loginn WHERE email = email ");
  $check->execute();
  $checkk = mysqli_fetch_all($checkk);

  var_dump($check);
  print_r($checkk);
  echo "<br>";
  echo "<h1>" . $checkk['email'] . "</h1>";
  echo "<br>";

   // validate password
  //  if($check_data){
  //       echo "the email is not right";
  //  }


        // if user make everything right 
        if(empty($errors)){
            $pwd = password_hash($pwd,PASSWORD_DEFAULT);
            $datauser = $getdb->prepare(
              "INSERT INTO 
            loginn(first_name,lastname,email,pwd) 
            VALUES('$first_name' , '$last_name','$email' , '$pwd' );");
          echo "everything is right";
          echo "<br>";
          $datauser->execute();
        }
        else{
          var_dump($errors);
        }
    }
  ?>



<!-- this is form  -->
<form class="m-auto col-8" action="rigster.php" method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">first name</label>
    <input type="text" name="first_name" value="<?php if(isset($_POST['first_name'])){echo $_POST['first_name'];} ?>" class="form-control" aria-describedby="emailHelp" >
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">last name</label>
    <input type="text" name="last_name" value="<?php if(isset($_POST['last_name'])){echo $_POST['last_name'];} ?>" class="form-control" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name="emaill" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="pwd" class="form-control" id="exampleInputPassword1">
  </div>
  
  <button name="send" class="btn btn-primary">send now</button>
</form>
</body>
</html>