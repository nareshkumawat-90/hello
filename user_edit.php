<?php
session_start();
if(!isset($_SESSION['username'])){
  header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include("includes/header.php") ?>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php include("includes/nav.php") ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include("includes/sidebar.php") ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Blank Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <?php
      include('security.php');
      ?>
      <div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> EDIT Admin Profile </h6>
    </div>
    <div class="card-body">
    <?php

        if(isset($_POST['edit_btn']))
        {
            $id = $_POST['edit_id'];
            
            $query = "SELECT * FROM register WHERE id='$id'";
            $query_run = mysqli_query($con, $query);

            foreach($query_run as $row)
            {
                ?>

                    <form action="code.php" method="POST">

                        <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">

                        <div class="form-group">
                            <label> Username </label>
                            <input type="text" name="edit_username" value="<?php echo $row['username'] ?>" class="form-control"
                                placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="edit_email" value="<?php echo $row['email'] ?>" class="form-control"
                                placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="edit_password" value="<?php echo $row['password'] ?>"
                                class="form-control" placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                          <label>Password</label>
                            <select class="form-control select2" name="edit_access" style="width: 100%;">
                              <option value="admin">Admin</option>
                              <option value="user">User</option>
                            </select>
                        </div>
                        <a href="user.php" class="btn btn-danger"> CANCEL </a>
                        <button type="submit" name="updatebtn" class="btn btn-primary"> Update </button>

                    </form>
                    <?php
            }
        }
    ?>
    </div>
</div>
</div>

</div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include("includes/footer.php") ?>
</body>
</html>