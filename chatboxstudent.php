<?php
session_start();

if(!isset($_SESSION['fname']))
{
    header('location:studentlogin.php');
}

    $pageTitle = 'Chat Box Student';
    include "header.php"; 
    include_once('Connection.php');
    include_once('customcss.css');

    $flag = false;

    if(empty($_POST["messages"])) {
        $flag = true;
    }
    else {
        $messages= ($_POST["messages"]);
    }    

    
    if(isset($_GET['id'])) {

        $id =  $_GET['id']; // Teacher Id
        $_SESSION['id']; // Student Id

        $obj = new Connection("localhost","root","","harshchatbox");
        $result = $obj1->connreturn();
        $senderid = $id;
        $receiverid = $_SESSION['id'];

        if($flag == false) {
            if(isset($_POST['messages'])) {
                $messages = $_POST['messages'];
    
                $obj->insert('messages',['messages'=>$messages,'senderid'=>$senderid,'receiverid'=>$receiverid]);
                $resultmessages = $obj->getResult();
                if(!$resultmessages){
                        echo "Failed";
                }
            }       
        }        
    }

?>
    <!-- Side Bar -->
    <div class="sidebar">
        <a class="active" href="studentDashboard.php">Home</a>
        <a href="myaccountstudent.php">My Account Section</a>
    </div>

    <!-- Main Content -->
    <div class="content">

        <div style="text-align: center;">

            <?php   

                $sql = "select * from registration where id='".$id."'";

                $resultUsers=mysqli_query($result,$sql);

                while($data= mysqli_fetch_array($resultUsers))
                {
            ?>      
                    <h4><img id='imageId'class="image" src='http://192.168.168.31/oct-batch/harsh/studentTeacher/image/<?php echo $data['image']; ?>'></h4>
                    
                    <h4>Chat With: <?php echo $data['fname'];?> Sir</h4>
                    <hr style="height:20px">
            <?php
                }
            ?> 

        </div>

        <?php   

            $result = $obj1->connreturn();
            $sql = "select * from messages where senderid='".$senderid."' and receiverid ='".$receiverid."' or senderid='".$receiverid."' and receiverid ='".$senderid."'     ";

            $res=mysqli_query($result,$sql);
            $array = $res;

            foreach ($array as $key => $value) {

                if($value['senderid'] == $senderid ){
                    echo ' <h6><span  style="color:blue;" style="float:left;" class="senderid">'.$value['messages'].'</span></h6><br>';
                }

                elseif($value['senderid'] == $receiverid){
                    echo ' <h6><span  style="color:red;" class="senderid">'.$value['messages'].'</span></h6><br>';    
                }

                elseif($value['receiverid'] == $receiverid ){   
                    echo '<h6><span style="color:blue;" style="float:left;" class="receiverid">'.$value['messages'].'</span></h6>';
                }

                elseif($value['receiverid'] == $senderid ){
                    echo '<h6><span style="color:red;" class="receiverid">'.$value['messages'].'</span></h6>';
                }  
            }
        ?> 

            <form method="post">
                <div class="chat-message clearfix">
                        <div class="input-group mb-0">
                            <input type="text" class="form-control" name="messages" id="messages" placeholder="Enter text here...">
                            <span ><i class="fa fa-send"><input type="submit" id="send" name="send" value="send" style="font-size: 20px;"  onclick="return foo();"></i></span>
                        </div>
                </div>
            </form>    

    </div>

<?php include('footer.php');  ?>  <!-- Including fotter file -->
