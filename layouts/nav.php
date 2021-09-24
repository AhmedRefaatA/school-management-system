




<?php 
    if(isset($_SESSION['user'])){
        $action = "login";
        $name = $_SESSION['user']['name'];
        switch ($_SESSION['user']['role_id']) {
            case 1:
                $title = "Admin : ". $_SESSION['user']['name'];
                $role = "admin";
                break;
            case 2:
                $title = "Teacher : ". $_SESSION['user']['name'];
                $role = "teacher";
                break;
            case 3:
                $title = "Student : ". $_SESSION['user']['name'];
                $role = "student";
                break;
            case 4:

                break;
            
        }
    } else{
        $action = "Logout";
        $role = '';
        $title = '';
    }

?>


<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1 class="text-light"><a href="index.html"><span>School Me</span></a></h1>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
            <?php if($role == "admin"){?>
                <li><a class="nav-link scrollto active" href="<?php echo $host;?>index.php">Home</a></li>
                <li><a class="nav-link scrollto active" href="<?php echo $host;?>index.php">Dashboard</a></li>
                <li><a class="nav-link scrollto active" href="<?php echo $host;?>logout.php">Logout</a></li>
                <?php }elseif($role == "teacher"){?>
                    <li><a class="nav-link scrollto active" href="<?php echo $host;?>index.php">Home</a></li>
                    <li><a class="nav-link scrollto" href="<?php echo $host;?>index.php#about">Classes</a></li>
                    <li><a class="nav-link scrollto" href="<?php echo $host;?>index.php#activity">Courses</a></li>
                    <li><a class="nav-link scrollto" href="<?php echo $host;?>logout.php">Logout</a></li>
                    <?php }elseif($role == "student"){?>
                        <li><a class="nav-link scrollto active" href="<?php echo $host;?>index.php">Home</a></li>
                        <li><a class="nav-link scrollto" href="<?php echo $host;?>index.php#about">Class</a></li>
                        <li><a class="nav-link scrollto" href="<?php echo $host;?>index.php#activity">Courses</a></li>
                        <li><a class="nav-link scrollto" href="<?php echo $host;?>index.php#activity">Level</a></li>
                        <li><a class="nav-link scrollto" href="<?php echo $host;?>index.php#activity">Profile</a></li>
                        <li><a class="nav-link scrollto" href="<?php echo $host;?>logout.php">Logout</a></li>
                    <?php }else{?>
                        <li><a class="nav-link scrollto active" href="<?php echo $host;?>index.php">Home</a></li>
                        <li><a class="nav-link scrollto" href="<?php echo $host;?>index.php#about">Abote Us</a></li>
                        <li><a class="nav-link scrollto" href="<?php echo $host;?>index.php#activity">Activity</a></li>
                        <li><a class="nav-link scrollto" href="<?php echo $host;?>index.php#team">Team</a></li>
                        <li><a class="nav-link scrollto" href="<?php echo $host;?>login.php">Login</a></li>
                        <?php }?>
                        <li><a class="nav-link scrollto"><?php echo $title;?></a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->