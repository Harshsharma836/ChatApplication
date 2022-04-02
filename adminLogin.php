<?php
session_start();

if(($_SESSION['role']) == 'teacher')
{
    header('location:teacherDashboard.php');
}
elseif(isset($_SESSION['firstname']))
{
    header('location:adminDashboard.php');
}


$pageTitle = 'Admin Login Page';
include_once "header.php";


    $UserIdError =  $PasswordError = $loginerr =  "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["email"])) {
            $UserIdError = "User id  is required";
        } 

        if (empty($_POST["password"])) {
            $PasswordError = "Password is required";
        } 

        $email = $_POST["email"];
        $password = $_POST["password"];
        $loginerr = "";
    }
?>
<?php
    // Connecting with database
    include_once "Connection.php";
    if(isset($_POST["submit"])) {
            $obj = new Connection("localhost","root","","harshchatbox");
            $result = $obj1->connreturn();

            $sql = "select * from admin where email= '".$email."'
            and password = '".$password."' ";

                if(!$res=mysqli_query($result,$sql)) {
                    echo "Query Execution Failed";
                }

                $rows = mysqli_num_rows($res);
                if(!empty($rows)) {
                    header("location:adminDashboard.php"); 
                    // Fetch first name and store it in Session..
                    $fetch = mysqli_fetch_assoc($res);
                    $_SESSION['firstname'] = $fetch['firstname'];
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
    <h2 class="text-black bg-light text-center"><b>Login here</b></h2>
    <div>
        <form method="post">
            <div class="form-group">
                <label class="label">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" class="form-control">
                <span
                    class="errors">
                    <?php echo $UserIdError?>
                </span>
            </div>
            <div class="form-group">
                <label class="label">Password</label>
                <input type="password" name="password" placeholder="Enter your password" class="form-control">
                <span class="errors">
                    <?php echo $PasswordError?>
                </span>
            </div>
            <div>
                <span class="errors">
                    <?php echo $loginerr?>  
                </span>
            </div><br>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>

<?php include('footer.php');  ?>  <!-- Including fotter file -->