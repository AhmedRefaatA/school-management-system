
<!-- Page Area Start Here -->
<div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
               <div class="mobile-sidebar-header d-md-none">
                    <div class="header-logo">
                        <a href="index.html"><img src="img/logo1.png" alt="logo"></a>
                    </div>
               </div>
                <div class="sidebar-menu-content">
                    <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                        <?php 
                            if($_SESSION['user']['role_id'] == 4){?>
                                
                                
                                
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-dashboard"></i><span>Admins</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo $host?>Users/Admin/index.php" class="nav-link"><i class="fas fa-angle-right"></i>All Admins</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $host?>Users/Admin/create.php" class="nav-link"><i
                                            class="fas fa-angle-right"></i>Add Admin</a>
                                </li>
                            </ul>
                        </li>
                        <?php
                            }
                        ?>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-classmates"></i><span>Students</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo $host?>Users/Student/index.php" class="nav-link"><i class="fas fa-angle-right"></i>All
                                        Students</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i
                                    class="flaticon-multiple-users-silhouette"></i><span>Teachers</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo $host?>Users/Teacher/index.php" class="nav-link"><i class="fas fa-angle-right"></i>All
                                        Teachers</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-books"></i><span>Courses</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo $host?>Courses/index.php" class="nav-link"><i class="fas fa-angle-right"></i>All
                                    Courses</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-technological"></i><span>Levels</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo $host?>Levels/index.php" class="nav-link"><i class="fas fa-angle-right"></i>All Levels</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $host?>Levels/create.php" class="nav-link"><i
                                            class="fas fa-angle-right"></i>Add Level</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i
                                    class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Classes</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo $host?>Classes/index.php" class="nav-link"><i class="fas fa-angle-right"></i>All
                                        Classes</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $host?>Classes/create.php" class="nav-link"><i class="fas fa-angle-right"></i>Add New
                                        Class</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i
                                    class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Subjects</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo $host?>Subjects/index.php" class="nav-link"><i class="fas fa-angle-right"></i>All
                                    Subjects</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $host?>Subjects/create.php" class="nav-link"><i class="fas fa-angle-right"></i>Add New
                                    Subject</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i
                                    class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Roles</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo $host?>Roles/index.php" class="nav-link"><i class="fas fa-angle-right"></i>All
                                    Roles</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $host?>Roles/create.php" class="nav-link"><i class="fas fa-angle-right"></i>Add New
                                    Role</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i
                                    class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Class Students</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo $host?>Class_students/index.php" class="nav-link"><i class="fas fa-angle-right"></i>All
                                    Students</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $host?>Class_students/create.php" class="nav-link"><i class="fas fa-angle-right"></i>Add New
                                    Student</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i
                                    class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Address</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo $host?>Address/Regions/index.php" class="nav-link"><i class="fas fa-angle-right"></i>All
                                    Regions</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $host?>Address/Regions/create.php" class="nav-link"><i class="fas fa-angle-right"></i>Add
                                    Region</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $host?>Address/Cities/index.php" class="nav-link"><i class="fas fa-angle-right"></i>
                                    All Cities</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $host?>Address/Cities/create.php" class="nav-link"><i class="fas fa-angle-right"></i>Add
                                    City</a>
                                </li>
                              
                            </ul>
                        </li>
                       
                    </ul>
                </div>
            </div>
            <!-- Sidebar Area End Here -->