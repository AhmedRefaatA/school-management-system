<?php 
    require "../helper/db_connect.php";
    require "../helper/helper.php";
    require "../layouts/home_header.php";
    require "../layouts/nav.php";
    if(isset($_SESSION['user'])){
      fireWall('register');
    }
    
?>

<section class="about">
      <div class="container">
        <div class="section-title">
          <h2>Register AS : </h2><br><hr>
          <h3><a class="cta-btn" href="./teacher_register.php">Teacher</a></h3><hr>
          <h3><a class="cta-btn" href="./student_register.php">Student</a></h3><hr>
        </div>
</section>



<?php
    require "../layouts/home_footer.php"
?>