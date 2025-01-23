<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="css/login.css">
  <style type="text/css">
    #buttn {
      color: #fff;
      background-color: #5c4ac7;
    }
  </style>
  <?php include('./common/head.php') ?>
</head>

<body>
  <?php include('./common/header.php') ?>
  <div style="background-image: url('images/pimg.jpg');background-size: cover;background-repeat: no-repeat;background-position: center;">
    <div class="pen-title">
        <div class="module form-module">
          <div class="toggle">
          </div>
          <div class="form">
            <h2 class="register-h2">Login to your account</h2>
            <form action="" method="post">
              <input type="text" placeholder="Username" name="username" />
              <input type="password" placeholder="Password" name="password" />
              <input type="submit" id="buttn" name="submit" value="Login" />
            </form>
          </div>
        <div class="cta">Not registered?<a href="registration.php" style="color:#5c4ac7;"> Create an account</a></div>
    </div>
  </div>
  <?php include('./common/footer.php') ?>
</body>

</html>