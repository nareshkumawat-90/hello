<?php
session_start();
$_SESSION['access'];
if(!isset($_SESSION['username'])){
  header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include("includes/header.php") ?>
<!-- DataTables -->
<link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
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
            <h1>User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
<?php
 include 'db.php';
if(isset($_POST['registerbtn']))
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
        // header('Location: user.php');  
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
    }
    else
    {
      if(empty($username) || empty($email) || empty($password)){
            if(empty($username)){
              $_SESSION['user'] = "Enter The Username";
              
            }
            if(empty($email)){
              $_SESSION['email'] = "Enter The email";
             
            }
            if(empty($password)){
              $_SESSION['pass'] = "Enter The password";
            }
          }else{
            $query = "INSERT INTO register (username,email,password,access) VALUES ('$username','$email','$pass','$access')";
            $query_run = mysqli_query($con, $query);
            if($query_run)
            {
              $_SESSION['success'] = "Admin Profile Added";
            }
            else 
            {
              $_SESSION['error'] = "Admin Profile Not Added";
            }
          }
            
        
        
    }

}      
?>
<!-- add user -->
<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Admin Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <div class="modal-body">
              <div class="form-group">
                <label> Username </label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
              </div>
              
            <?php
            if(isset($_SESSION['user']) && $_SESSION['user'] !='')
            {
              ?>
              <div></div>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php  echo $_SESSION['user']; ?>
              </div>
              <?php
              unset($_SESSION['user']);
            }
            ?>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control checking_email" placeholder="Enter Email">
                <small class="error_email" style="color: red;"></small>
                
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
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                <small class="error_email" style="color: red;"></small>
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
            <div class="form-group">
                <label>User Type</label>
                <select class="form-control select2" name="access" style="width: 100%;">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                  </select>
            </div>
            </div>
            
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button  type="submit" name="registerbtn" class="btn btn-primary">Save</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <!-- /.card -->
      <!-- show user list -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Admin 
           <?php if($_SESSION['access'] =='admin'){ ?>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            Add Admin Profile
            </button>
            <?php } ?>
            </h6>
            <div class="md-4">
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
            <?php
            if(isset($_SESSION['upmsg']) && $_SESSION['upmsg'] !='')
            {
              ?>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php  echo $_SESSION['upmsg']; ?>
              </div>
              <?php
              unset($_SESSION['upmsg']);
            }
            ?>
            <?php
            if(isset($_SESSION['success']) && $_SESSION['success'] !='')
            
            {
              ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php  echo $_SESSION['success']; ?>
              </div>
              <?php
              unset($_SESSION['success']);
            }
            ?>
            <?php
            if(isset($_SESSION['error']) && $_SESSION['error'] !='')
            
            {
              ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php  echo $_SESSION['error']; ?>
              </div>
              <?php
              unset($_SESSION['error']);
            }
            ?>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <?php
                $query = "SELECT * FROM register WHERE status = 'approved' ORDER BY id ASC";
                $query_run = mysqli_query($con, $query);
            ?>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> Username </th>
                            <th>Email </th>
                            <th>Password</th>
                            <th>
                              
                              Action
                            </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(mysqli_num_rows($query_run) > 0)        
                        {
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                        ?>
                        
                            <tr>
                                <td><?php  echo $row['id']; ?></td>
                                <td><?php  echo $row['username']; ?></td>
                                <td><?php  echo $row['email']; ?></td>
                                <td>
                                <?php if($_SESSION['access'] =='admin'){ ?>
                                  <?php  echo $row['password']; ?>
                                  <?php } ?>
                                </td>
                                
                                <td>
                                <?php if($_SESSION['access'] =='admin'){ ?>
                                    <form action="user_edit.php" method="post">
                                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="edit_btn" class="btn btn-success"><i class="fas fa-edit"></i></button>
                                  
                                    </form>
                                    <form action="code.php" method="post">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="delete_btn" class="btn btn-danger"> <i class="fas fa-trash"></i></button>
                                    </form>
                                   <?php } ?>
                                </td>
                             
                              
                            </tr>
                        <?php
                            } 
                        }
                        else {
                            echo "No Record Found";
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include("includes/footer.php") ?>
  <!-- SweetAlert2 -->
<script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="assets/plugins/toastr/toastr.min.js"></script>
  <!-- DataTables  & Plugins -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/jszip/jszip.min.js"></script>
<script src="assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- Page specific script -->

</body>
</html>
