<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
  <?php
  include 'db.php';
  if(isset($_POST['submit'])){
    $email = $_POST['email'];
        $password = $_POST['password'];

        $select = mysqli_query($con, "SELECT * FROM register WHERE email = '$email' AND password = '$password'");
        $row = mysqli_fetch_array($select);

        $status =$row['status'];
        echo $status;
        $select2 = mysqli_query($con, "SELECT * FROM register WHERE email = '$email' AND password = '$password'");
        $check_user=mysqli_num_rows($select2);
        if($check_user==1){
            $email_pass = mysqli_fetch_assoc($select2);
            $db_pass = $email_pass['password'];
            $_SESSION["status"]=$row['status'];
            $_SESSION["email"]=$row['email'];
            $_SESSION["password"]=$row['password'];
            $pass_decode = password_verify($password,  $db_pass);

            if($status=="approved"){
                echo '<script type  = "text/javascript">';
                echo 'alert("Login Success!");';
                echo 'window.location.href = "user-dashboard.php"';
                echo '</script>';
            }
            elseif($status=="pending"){
                echo '<script type  = "text/javascript">';
                echo 'alert("Your account is still pending for approval!");';
                echo 'window.location.href = "log.php"';
                echo '</script>';
            }else{
                echo "Incorrect email or password!";
            }
        }

    }
?>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      
      <?php
      if(isset($_SESSION['status']) && $_SESSION['status'] !='') 
      {
        ?>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?php  echo $_SESSION['status']; ?>
        </div>
        <?php
        unset($_SESSION['status']);
      }
      ?>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <div class="row">
          
          <!-- /.col -->
          <div class="col-4 ">
            <button type="submit" name="submit"  class="btn btn-primary btn-block ">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
      <!-- /.social-auth-links -->

      
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
