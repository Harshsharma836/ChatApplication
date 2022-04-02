<?php
session_start();

// if(($_SESSION['role']) == 'teacher')
// {
//     header('location:teacherDashboard.php');
// }
// elseif(($_SESSION['role']) == 'student')
// {
//     header('location:studentDashboard.php');
// }
// elseif(isset($_SESSION['firstname']))
// {
//     header('location:adminDashboard.php');
// }
?>

<?php
$pageTitle = 'Student Login Page';
include_once "header.php";
//include_once('customcss.css');

$StudentIdError =  $PasswordError = $loginerr =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["email"])) {
        $StudentIdError = "User id  is required";
    } 
    if (empty($_POST["password"])) {
        $PasswordError = "Password is required";
    } 

    $email1 = $_POST["email"];
    $password1 = $_POST["password"];
}
?>

<?php
  // Connecting with database
  include_once "Connection.php";
  if(isset($_POST["submit"])) {
  $obj = new Connection("localhost","root","","harshchatbox");
  $result = $obj1->connreturn();


    // Student Login 
    $sql = "select * from registration where email= '".$email1."'
       and password = '".$password1."' and role = 'student' ";

    if(!$res=mysqli_query($result,$sql)){
        echo "Query Execution Failed";
    }

    $rows = mysqli_num_rows($res);
    if(!empty($rows)){

        $fetch = mysqli_fetch_assoc($res);
        $_SESSION['status'] = $fetch['status'];

        // Checking the status is 0 or 1
        if($_SESSION['status'] == 0){
            echo "<b>Yours Authorization is suspended</b>";
        }
        else{
            header("Location: studentDashboard.php");
            $_SESSION['id'] = $fetch['id'];
            $_SESSION['fname'] = $fetch['fname'];
            $_SESSION['role'] = $fetch['role']; 
        }
    ?>
    <?php
    }
    else
    {
    $loginerr="<b>Invalid Login!</b>";
    }
}
?>

<div class="container">
    <h2 class="text-black bg-light text-center"><b>Student Login here</b></h2>
    <div>
        <form method="post">
            <div class="form-group">
                <label class="label">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" class="form-control"><span
                    class="errors">
                    <?php echo $StudentIdError?>
                </span>
            </div>

            <div class="form-group">
                <label class="label">Password</label>
                <input type="password" name="password" placeholder="Enter your password" class="form-control">
                <span class="errors">
                     <?php echo $PasswordError?>
                </span>
            </div>

            <div class="errors">
                    <?php  echo $loginerr?>  
                </span>
            </div><br>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-success">
            </div>

            <div>
                <span>Don't have a account<a class="nav-link" href="registration.php">sign up now</a></span>
            </div>
        </form>
    </div>
</div>


<?php include('footer.php');  ?>  <!-- Including fotter file -->