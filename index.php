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
?>  

<?php $pageTitle = 'Student Registartion Form'; ?>
<?php   include('header.php'); ?>  <!-- Including Header file -->
<?php include_once('customcss.css'); ?>

       <!-- Our Blog : Start -->
     

        <article>
            <h1 style="text-align: center;"  style="color:blue;"><b>Welcome</b></h1>
            <p class="paragraph"> This Web application is designed for the intraction between the teaher and the students through the in built chap application  </p>
            </p>
        </article>

        <article >
            <h1 style="text-align: center;"  style="color:blue;" >
            <b>How To Use</b></h1>
            <p class="paragraph" >
            First User has to register itself and select the role as he/she is a teacher or a student and then submit the registration form.
            <hr>
            <p class="paragraph" >Then the user has to login according to the cridentals EmailId and Password and then the Chat Box appears.<hr>

            <p class="paragraph" >If you logined in as a Student then whole Teacher list is fetched from the data base and a student can chat with any teacher just by &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;select his/her favourite Teacher .<br>

            &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;and same as for Teachers when they logedin as a teacher the lists shows all the students .... </p>  

                  
              
          </p>
            <!-- </p> -->
        </article>

         <!-- <img id='imageId'class="images" src='http://192.168.168.31/oct-batch/harsh/studentTeacher/image/collage.jpeg'> -->

      <!-- <section class="our-blog-wrapper">
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <div class="blog-box">
                <figure class="blog-img">
                  <img src="images/blog-img-1.jpg" class="img-fluid" alt="" />
                </figure>
                <div class="blog-text">
                  <div class="blog-date">Jan 02, 2020</div>
                  <h3 class="blog-heading"><a href="#">Student Kindly know about the exams </a></h3>
                  <a href="javascrpit:void(0);" class="read-more">Read More</a>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="blog-box">
                <figure class="blog-img">
                  <img src="images/blog-img-2.jpg" class="img-fluid" alt="" />
                </figure>
                <div class="blog-text">
                  <div class="blog-date">Jan 02, 2020</div>
                  <h3 class="blog-heading"><a href="#">Exams form are online.</a></h3>
                  <a href="javascrpit:void(0);" class="read-more">Read More</a>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="blog-box">
                <figure class="blog-img">
                  <img src="images/blog-img-3.jpg" class="img-fluid" alt="" />
                </figure>
                <div class="blog-text">
                  <div class="blog-date">Jan 02, 2020</div>
                  <h3 class="blog-heading"><a href="#">Submit all the assigment till last date</a></h3>
                  <a href="javascrpit:void(0);" class="read-more">Read More</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> -->
    </div>
<!-- <?php include('footer.php');  ?>  