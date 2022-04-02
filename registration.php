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
   

$pageTitle = 'Student Registartion Form'; 
include('header.php');   //Including Header file 
include_once('customcss.css');

?>

<script>

    // Custom Validation for Strong Password 
    $.validator.addMethod('passwordCheck',function(value){
            return /^[a-zA-Z0-9!@#$%^&*]{8,16}$/.test(value) 
    },
            'Enter strong Password formate and has minimum 8 value '    
    );
    
  // Jquery Validation    
    $(document).ready(function() {

        $("#form").validate({
                rules: {
                    fname: {
                        required: true
                    },
                    lname: {
                        required: true
                    },
                    password: {
                        required: true,
                        // Custom Validation
                        passwordCheck :true
                    },
                    confirmpassword: {
                        required: true,
                        equalTo: "#password"
                    },
                    image:{
                        required:true,
                        // accept: "jpg|jpeg|png|JPG|JPEG|PNG"
                        extension: "jpg|jpeg|png"
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone:{
                        required:true,
                        number: true,
                        minlength: 10,
                        maxlength: 10           
                    },
                    role:{
                        required:true
                    }
                },

                messages: {

                    fname: 'Please enter firstname.',
                    lname: 'Please enter lastname.',
                    email: {
                        required: 'Please enter Email Address.',
                        email: 'Please enter a valid Email Address.'
                    },
                    password: {
                        required: 'Please enter Password.',
                    },
                    confirmpassword: {
                        required: 'Please enter Confirm Password.',
                        equalTo: 'Confirm Password do not match with Password.'
                    },
                    image:{
                        required:"Please select image",
                        extension:"Please select a valid Image format jpg,jpeg,png"
                    },
                    phone:{
                        required:'Please enter your phone number',
                        number: 'Please enter only numbers ',
                        minlength:'Please enter minimum 10 numbers',
                        maxlength:'Only 10 numbers are allowed'
                    }
                },    
        });

        // Checking  email already exist or not
            $('#email').blur(function() {   
                var email = $('#email').val();
                // Ajax 
                $.ajax({

                    type: "POST",
                    url: "checkemail.php",
                    data: { 'email':email }

                }).done(function( result ) {

                    var myArr = JSON.parse(result);

                    if(myArr.state == "1") {
                        jQuery('#emailerr').text('User already exists try new email id..');
                        $('#email').val('');
                        
                    } 
                    else {
                        jQuery('#emailerr').text('');
                    }
                });
            });
    });


    // Sending Form Data to usersDb
    $(document).ready(function (e) {
        $("#form").on('submit',(function(e) {
        e.preventDefault();

            // Ajax function to send searalize data 
            $.ajax({
                url: "usersDb.php",
                type: "POST",
                dataType: "json",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                    
                })  
                .done(function(result) {
                    $.each( result,function( key , value ) {
                    $( "."+key+'_error').html(value);
                    if(key == "empty"){
                        document.getElementById("form").reset();
                    }
                });
                })
        }));
    });

</script>

    <!-- User Registration Form -->
    <div class="row mt-3">
    <div class="col-md-6">
    <h4 class="mb-3"><b>Registration Form </b></h4>

    <form id="form" enctype="multipart/form-data">

        <div class="form-group">
            <label for="fname"> First Name</label>
            <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter first name">
        </div>

        <div class="form-group">
            <label for="lname"> Last Name</label>
            <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter last name">
        </div>

         <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder=" Enter your Password">
        </div>

        <div class="form-group">
            <label for="confirmpassword">Confirm Password</label>
            <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Confirm your password">
        </div>

        <div class="form-group">
             <label for="image">Profile Image</label>
            <input type="file" name="image" id="image">
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Enter yours email id">
           <span class="email_error" id="emailerr"></span>
        </div>

        <div class="form-group">
            <label for="phone">Phone number</label>
            <input type="tel" class="form-control" name="phone" id="phone" placeholder="0123456789"> 
        </div>

        <div class="form-group">
            <label for="role">Roles:</label>
                <select name="role" id="role">
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                </select> 
        </div> 

        <div>  
            <input type="submit" name="submit" value="submit" class="btn btn-primary" >
        </div> 
        <br>   
        <div class="status_error" id="status_error"></div> 
        <br> 
    </form>
    </div>
    </div>

<?php include('footer.php');  ?>  <!-- Including fotter file -->
