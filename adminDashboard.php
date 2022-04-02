<?php
    session_start();

    if(!isset($_SESSION['firstname']))
    {
        header('location:adminLogin.php');
    }

    $pageTitle = 'Admin Dashboard'; 
    include('header.php'); 
?>    
<h4 style="text-align: center;">All registrations</h4>

<table class="table">
    <tr class="table">
    <td><b>ID</b></td>
    <td><b>firstname</b></td>
    <td><b>last name</b></td>
    <td><b>Email</b></td>
    <td><b>Image</b></td>
    <td><b>Phone</b></td>
    <td><b>Role</b></td>
    <td><b>Status</b></td>
    <td><b>View</b></td>
    <td><b>Edit</b></td>
    <td><b>Delete</b></td>
    </tr>
    
    <?php   

        error_reporting(E_ALL);
        ini_set("display_errors",1);

        include_once('Connection.php');
        $userData = $obj1->select('registration', '*');

        while($row= mysqli_fetch_array($userData))
        {

    ?>

    <tr  class="table">
    <td><?php echo $row['id']; ?></td> 
    <td><?php echo $row['fname']; ?></td>
    <td><?php echo $row['lname']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><img  id='imageId'src='http://192.168.168.31/oct-batch/harsh/studentTeacher/image/<?php echo $row['image']; ?>' class="image"></td>
    <td><?php echo $row['phone']; ?></td>
    <td><?php echo $row['role']; ?></td>
    <td><?php
                    if ($row['status']==0) {
                        echo "unactive";
                    } else{
                        echo "active";
                    }
    ?></td>

    <td><i data="<?php echo $row['id'];?>" class="status_checks btn  
            <?php echo ($row['status'])?  
            'btn-success': 'btn-danger'?>"><?php echo ($row['status'])? 'Active' : 'Inactive'?></i>
    </td>  

    <td><a href="edit.php?id=<?php echo $row['id'];?>">Edit</a></td>
        
    <td><a href="deleteuser.php?id=<?php echo $row['id'];?>" onclick="return confirm('Are you sure you want to delete this item')">Delete</a></td>
    </tr> 
    </tr> 

    <?php
        }
    ?>

</table>
<br>
<div>
    <button onclick="window.location.href='adminLogout.php';" class="btn btn-success">Logout</button>

    <button onclick="window.location.href='registration.php';" class="btn btn-success">Add Student Or Teacher</button>
</div>
<br><br>

 <!-- // Change the status of user -->
<script>

    $(document).on('click','.status_checks',function(){
        var status = ($(this).hasClass("btn-success")) ? '0' : '1';
        var msg = (status=='0')? 'Deactivate' : 'Activate';

        if(confirm("Are you sure to "+ msg)){
            var current_element = $(this);
            
            $.ajax({
                type:"POST",
                url: "ajax.php",
                data: {id:$(current_element).attr('data'),status:status},
                success: function(data)
                {   
                    location.reload();
                }
            });
        }      
    });
</script>
<?php  include('footer.php');  ?>  <!-- Including fotter file -->
