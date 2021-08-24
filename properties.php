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
            <h1>Add Properties</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Properties</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <?php
 include 'db.php';
if(isset($_POST['save']))
{
    $title = $_POST['title'];
    $price = $_POST['price'];
    $short_description = $_POST['short_description'];
    $long_description = $_POST['long_description'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $price = $_POST['price'];
    $feature_image = $_FILES["feature_image"]["name"];
    move_uploaded_file($_FILES["feature_image"]["tmp_name"],"image/".$_FILES["feature_image"]["name"]);
    $query = "INSERT INTO properties (title, price, short_description, long_description, feature_image, city, state, country) VALUES ('$title','$price','$short_description','$long_description','$feature_image','$city','$state','$country')";
    $query_run = mysqli_query($con, $query);
    if($query_run)
    {   
        
        $last_id = $con->insert_id;
        echo "New record created successfully. Last inserted ID is: " . $last_id;
        ?>
        <script>
            alert("success");
        </script>
        <?php
    }
    else 
    {
        ?>
        <script>
            alert("unsuccess");
        </script>
        <?php
    }
          

}      
?>
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Add Properties</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label> Title </label>
                        <input type="text" name="title"  class="form-control" placeholder="Enter Title">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" name="price"  class="form-control" placeholder="Enter Price">
                    </div>
                    <div class="form-group">
                        <label>Short Description</label>
                        <input type="text" name="short_description" class="form-control" placeholder="Enter Short Description">
                    </div>
                    <div class="form-group">
                        <label>Long Description</label>
                        <input type="text" name="long_description" class="form-control" placeholder="Enter Long Description">
                    </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Feature Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" id="feature_image" name="feature_image" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Gallery Image </label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" id="Gallery_image" name="Gallery_image[]" class="custom-file-input" multiple>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                            <label>City</label>
                            <input type="text" name="city" 
                                class="form-control" placeholder="Enter City">
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" name="state" 
                                class="form-control" placeholder="Enter State">
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" name="country" 
                                class="form-control" placeholder="Enter Country">
                        </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="save" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
        </div>
      </div>
    </section>      
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include("includes/footer.php") ?>
  <!-- jquery-validation -->
<script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="assets/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <script>
$(function () {
  $('#quickForm').validate({
    rules: {
      title: {
        required: true,
      },
      price: {
        required: true,
      },
      short_description: {
        required: true,
      },
      long_description: {
        required: true,
      },
    //   feature_image: {
    //     required: true,
    //   },
      city: {
        required: true,
      },
      state: {
        required: true,
      },
      country: {
        required: true,
      },
    },
    messages: {
      title: {
        required: "Please enter a title",
      },
      price: {
        required: "Please enter a pirce",
      },
      short_description: {
        required: "Please enter a short description",
      },
      long_description: {
        required: "Please enter a long description",
      },
    //   feature_image: {
    //     required: "Please upload image",
    //   },
      city: {
        required: "Please enter a city",
      },
      state: {
        required: "Please enter a state",
      },
      country: {
        required: "Please enter a country",
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>