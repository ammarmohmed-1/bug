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
  session_start();
  if (isset($_SESSION['email'])) {
      header("location:index.php");
  }

    if(isset($_POST["submit"])){
        $email = filter_var( $_POST["emaill"], FILTER_VALIDATE_EMAIL);
        $pwd = filter_var( $_POST["pwd"], FILTER_SANITIZE_STRING);
        $getdb -> setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION); // this is for error mode in PDO
        $getdb -> setAttribute(PDO::ATTR_EMULATE_PREPARES , false);

        // if a user get a mistake  
        $errors = [];
        if(empty($email) || filter_var($email , FILTER_VALIDATE_EMAIL) === false){
            $errors[]= "you must be input the email";
        }
        elseif(empty($pwd)){
            $errors[]= "you must be input the password";
        }

  // if the email is here
  $check_email = $getdb->prepare("SELECT * FROM loginn WHERE email = :value ");
  $check_email->bindParam("value", $_POST["emaill"]);
  $check_email->execute();
  $count = $check_email->rowCount();

  if($count === 1){
    echo "the email is here you are right";
    $fetch = $check_email -> fetch(PDO::FETCH_ASSOC);
    $pwd_hash = $fetch['pwd'];

    if(password_verify($pwd,$pwd_hash)){
      echo "<div class='alert alert-success'>you are login</div>";
      // session_start();
      $_SESSION['user']['email'] = $email;
      header("location:index.php");
    }else { echo "<br>" . "the password is woring";}
  }else{echo "<br>" . "the email does not exit";}
}
  ?>



<!-- this is form  -->
<form class="m-auto col-8" action="login.php" method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name="emaill" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="pwd" class="form-control" id="exampleInputPassword1">
  </div>
  
  <button name="submit" class="btn btn-primary">log in</button>
</form>
</body>
</html>