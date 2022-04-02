<?php
session_start();

if(!isset($_SESSION['fname']))
{
    header('location:studentlogin.php');
}

$pageTitle = 'Student Dashboard';
include "header.php"; 
include_once('Connection.php');
include_once('customcss.css');

?>
        <div class="sidebar">
          <a class="active" href="#home">Home</a>
          <a href="myaccountstudent.php">My Account Section</a>
        </div>


    <div class="content">

        <h4> All Teachers</h4>
        <table border="2">
            <tr>
            <td><b>ID</b></td>
            <td><b>firstname</b></td>
            <td><b>last name</b></td>
             <td><b>Message</b></td>
            </tr>
            
        <?php   
                error_reporting(E_ALL);
                ini_set("display_errors",1);

                $result = $obj1->connreturn();
                $sql = "select * from registration where role = 'teacher' ";
                $teachersData=mysqli_query($result,$sql);

                while($row= mysqli_fetch_array($teachersData))
                {
        ?>

            <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['fname']; ?></td>
            <td><?php echo $row['lname']; ?></td>
            <td><a href="chatboxstudent.php?id=<?php echo $row['id'];?>">Message</a></td>
            </tr> 

        <?php
        }
        ?>

        </table>
    </div>

<?php include('footer.php');  ?>  <!-- Including fotter file -->

