<?php
session_start();

if(!isset($_SESSION['fname']))
{
    header('location:teacherlogin.php');
}

$pageTitle = 'Teacher Dashboard';
include "header.php"; 
include_once('Connection.php');
include_once('customcss.css');

?>
        <div class="sidebar">
            <a class="active" href="teacherDashboard.php">Home</a>
            <a href="myaccountteacher.php">My Account Section</a>
        </div>


    <div class="content">
        <h2><b>Welcome <?php echo $_SESSION['fname']; ?></h2>

        <?php   
            $result = $obj1->connreturn();

            $sql = "select * from registration where id= '".$_SESSION['id']."'";

            $res=mysqli_query($result,$sql);
            while($a= mysqli_fetch_array($res))
            {
        ?>      
                <h4><img id='imageId'class="image" src='http://192.168.168.31/oct-batch/harsh/studentTeacher/image/<?php echo $a['image']; ?>'></h4>
                    
                    <h4>Your Name is :<b><?php echo $a['fname']; echo $a['lname'];?></b></h4>
                    <h4>Your Mail Id is :<b> <?php echo $a['email'];  ?></b></h4>
                    <h4>Your Phone No is :<b> <?php echo $a['phone']; ?></b></h4>          
        <?php
            }
        ?>

        <hr class="horizontal">
        <div class="rounded-lg">
            <h5><a style="color: blue;" href="logoutteacher.php">Logout</a></h5>

            <!-- <h5><a style="color: blue" href="edit.php?id=<?php echo $_SESSION['id'];?>">edit info.</a></h5> -->
        </div>

    </div>

<?php include('footer.php');  ?>  <!-- Including fotter file -->

