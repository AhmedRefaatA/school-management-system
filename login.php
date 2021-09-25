



<?php 
  require "helper/db_connect.php";
  require "helper/helper.php";
  if(isset($_SESSION['user'])){
    fireWall('register');
  }


if($_SERVER["REQUEST_METHOD"] == "POST"){
  

  $email = ["email" => filter_var(clean($_POST["email"]), FILTER_VALIDATE_EMAIL)];
  $password = ["password" => clean($_POST["password"])];

  $checkEmpty = checkempty([$email, $password]);
  $checkPass = validPattern($password['password'], "len", 8);

  if($checkEmpty && $checkPass){
    $password = md5($password['password']);
    $email = $email['email'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $op = mysqli_query($connect, $sql);
   if(mysqli_num_rows($op) == 1){
      $data = mysqli_fetch_assoc($op);
      $_SESSION['user'] = $data;
   }else{
     echo messageAlert("error login please try again");
   }
  }
    
    if(isset($_SESSION['user'])){
      switch ($_SESSION['user']['role_id']) {
        case 1:
            $title = "Admin : ". $_SESSION['user']['name'];
            if($_SESSION['user']['verified'] == 1){
              redirect($host . "dashboard.php");
            }elseif($_SESSION['user']['verified'] == 0){
              redirect($host . "errors/waiting.php");
            }
            
            break;
        case 2:
            $title = "Teacher : ". $_SESSION['user']['name'];
            if($_SESSION['user']['verified'] == 1){
              redirect($host);
            }elseif($_SESSION['user']['verified'] == 0){
              redirect($host . "errors/waiting.php");
            }
            break;
        case 3:
            $title = "Student : ". $_SESSION['user']['name'];
            if($_SESSION['user']['verified'] == 1){
              redirect($host);
            }elseif($_SESSION['user']['verified'] == 0){
              redirect($host . "errors/waiting.php");
            }
            break;
        case 4:
            $title = "Super Admin : ". $_SESSION['user']['name'];
            if($_SESSION['user']['verified'] == 1){
              redirect($host . "dashboard.php");
            }elseif($_SESSION['user']['verified'] == 0){
              redirect($host . "errors/waiting.php");
            }

            break;
        
    }
    }

  }


?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Template</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="assets/images/login.jpg" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper offset-4">
                <img src="assets/images/logo.jpg" alt="logo" class="logo">
              </div>
              <p class="login-card-description">Sign into your account</p>
              <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>"  enctype ="multipart/form-data">
                  <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email address">
                  </div>
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="***********">
                  </div>
                  <button type="submit" class="btn btn-block login-btn mb-4">Login</button>
                  
                </form>
                <a href="#!" class="forgot-password-link">Forgot password?</a>
                <p class="login-card-footer-text">Don't have an account? <a href="<?php echo $host;?>Register/register.php" class="text-reset">Register here</a></p>
               
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
