<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
    <?php
 include 'db.php';
if(isset($_POST['register']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $access = $_POST['access'];
    $pass = password_hash($password,PASSWORD_DEFAULT);
    $email_query = "SELECT * FROM register WHERE email='$email' ";
    $email_query_run = mysqli_query($con, $email_query);
    if(mysqli_num_rows($email_query_run) > 0)
    {
        
        // $_SESSION['status_code'] = "error";
        // header('Location: user.php');  
        $_SESSION['status'] = "Email Already Taken.";
    }
    else
    {
      if(empty($username) || empty($email) || empty($password)){
            if(empty($username)){
              $_SESSION['username'] = "Enter The Username";
            //   $_SESSION['status_code'] = "error";
            }
            if(empty($email)){
              $_SESSION['email'] = "Enter The email";
            }
            if(empty($password)){
              $_SESSION['pass'] = "Enter The password";
            }
          }else{
            $query = "INSERT INTO register (username,email,password,access,status) VALUES ('$username','$email','$pass','$access','pending')";
            $query_run = mysqli_query($con, $query);
            
            if($query_run)
            {
              $_SESSION['status'] = "Admin Profile Added";
            ?>
          <script>
            location.replace("login.php")
          </script>
          <?php
            }
          }    
    }

}      
?>   
      <p class="login-box-msg">Register a new membership</p>
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
          <input type="text" name="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div> 
        </div>
        <?php
          if(isset($_SESSION['username']) && $_SESSION['username'] !='')
          {
              ?>
              <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php  echo $_SESSION['username']; ?>
                </div>
                <?php
                unset($_SESSION['username']);
            }
            ?>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <?php
          if(isset($_SESSION['email']) && $_SESSION['email'] !='')
          {
              ?>
              <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php  echo $_SESSION['email']; ?>
                </div>
                <?php
                unset($_SESSION['email']);
            }
         ?>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <?php
          if(isset($_SESSION['pass']) && $_SESSION['pass'] !='')
          {
              ?>
              <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php  echo $_SESSION['pass']; ?>
                </div>
                <?php
                unset($_SESSION['pass']);
            }
            ?>
          <div class="input-group mb-3">
          <select class="form-control select2" name="access" style="width: 100%;">
            <option value="admin">Admin</option>
            <option value="user">User</option>
          </select>
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="register" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      

      <a href="login.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
