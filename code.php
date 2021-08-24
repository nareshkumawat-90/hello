<?php
include('security.php');

// if(isset($_POST['registerbtn']))
// {
//     $username = $_POST['username'];
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $cpassword = $_POST['confirmpassword'];
//     // $password = password_hash($password, PASSWORD_DEFAULT);
//     // $cpassword = password_hash($cpassword, PASSWORD_DEFAULT);
//     $email_query = "SELECT * FROM register WHERE email='$email' ";
//     $email_query_run = mysqli_query($con, $email_query);
//     if(mysqli_num_rows($email_query_run) > 0)
//     {
//         // $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
//         // $_SESSION['status_code'] = "error";
//         // header('Location: user.php');  
//         echo "Email Already Taken. Please Try Another one.";
//     }
//     else
//     {
//         if($password === $cpassword)
//         {   
//             if(empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"])){
//                 $_SESSION['status'] = "enter the values";
//                 $_SESSION['status_code'] = "error";
//                 header('Location: user.php');  
//             }
//             else{
//                 $query = "INSERT INTO register (username,email,password) VALUES ('$username','$email','$password')";
//             $query_run = mysqli_query($con, $query);
            
//             if($query_run)
//             {
//                 // echo "Saved";
//                 $_SESSION['status'] = "Admin Profile Added";
//                 $_SESSION['status_code'] = "success";
//                 header('Location: user.php');
//             }
//             else 
//             {
//                 $_SESSION['status'] = "Admin Profile Not Added";
//                 $_SESSION['status_code'] = "error";
//                 header('Location: user.php');  
//             }
//             }
//         }
//         else 
//         {
//             $_SESSION['status'] = "Password and Confirm Password Does Not Match";
//             $_SESSION['status_code'] = "warning";
//             header('Location: user.php');  
//         }
//     }

// }
if(isset($_POST['updatebtn']))
{ 
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];
    $access = $_POST['edit_access'];
    $pass = password_hash($password,PASSWORD_DEFAULT);
    echo $id;
    $query = "UPDATE register SET username='$username', email='$email', password='$pass',access='$access' WHERE id='$id' ";
    echo $query;
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        header('Location: user.php');
        $_SESSION['upmsg'] = "Your Data is Updated";
         
    }
    else
    {
        header('Location: user.php'); 
        $_SESSION['uperror'] = "Your Data is NOT Updated";       
        
    }
}

if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM register WHERE id='$id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: user.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: user.php'); 
    }    
}

if(isset($_POST['login_btn']))
{
    $email_login = $_POST['emaill']; 
    $password_login = $_POST['passwordd']; 

    $query = "SELECT * FROM register WHERE email='$email_login' AND password='$password_login' LIMIT 1";
    $query_run = mysqli_query($con, $query);

    

   if(mysqli_fetch_array($query_run))
   {
        $_SESSION['username'] = $email_login;
        header('Location: dashboard.php');
   } 
   else
   {
        $_SESSION['status'] = "Email / Password is Invalid";
        header('Location: log.php');
   }
    
}
?>