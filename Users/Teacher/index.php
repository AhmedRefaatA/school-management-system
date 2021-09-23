<?php 
    require "../../helper/db_connect.php";
    require "../../helper/helper.php";
    
    $sql = "SELECT users.*,address.id as add_id, cities.name as city, regions.name as region, subjects.title as subject, teacher_data.salary FROM users INNER JOIN address ON users.address_id = address.id INNER JOIN cities on address.city_id = cities.id INNER JOIN regions on address.city_id = regions.id INNER JOIN teacher_data ON teacher_data.teacher_id = users.id INNER JOIN subjects ON teacher_data.subject_id = subjects.id WHERE role_id = 2";
    $op = mysqli_query($connect, $sql);
    
    



    require "../../layouts/header.php"; 
?>



<body>
    
<?php 
    require "../../layouts/header_menu.php";
    require "../../layouts/sidebar.php";
?>
    <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Teachers</h3>
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>Users/Teacher/All Teachers</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Student Table Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>All Teachers Data</h3>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                    aria-expanded="false">...</a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i
                                            class="fas fa-times text-orange-red"></i>Close</a>
                                    <a class="dropdown-item" href="#"><i
                                            class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i
                                            class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                </div>
                            </div>
                        </div>
                        <form class="mg-b-20">
                            <div class="row gutters-8">
                                <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                                    <input type="text" placeholder="Search by Roll ..." class="form-control">
                                </div>
                                <div class="col-4-xxxl col-xl-4 col-lg-3 col-12 form-group">
                                    <input type="text" placeholder="Search by Name ..." class="form-control">
                                </div>
                                <div class="col-4-xxxl col-xl-3 col-lg-3 col-12 form-group">
                                    <input type="text" placeholder="Search by Class ..." class="form-control">
                                </div>
                                <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                                    <button type="submit" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table display data-table text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Gender</th>
                                        <th>Date Of Birth</th>
                                        <th>Specialization</th>
                                        <th>Salary</th>
                                        <th>Verification</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                        $i=0;
                                        while($data = mysqli_fetch_assoc($op)){?>
                                    <tr>
                                        <td><?php echo ++$i;?></td>
                                        <td><?php echo $data['id'];?></td>
                                        <td class="text-center"><img src="../../Media/profiles/<?php echo $data['profile'];?>" alt="profile"></td>
                                        <td><?php echo $data['name'];?></td>
                                        <td><?php echo $data['email'];?></td>
                                        <td><?php echo $data['city'] . ' - ' . $data['region'];?></td>
                                        <td><?php echo $data['gender'];?> </td>
                                        <td><?php echo $data['dateofbirth'];?></td>
                                        <td><?php echo $data['subject'];?></td>
                                        <td><?php echo $data['salary'];?></td>
                                        <td>
                                        <?php 
                                            if($data['verified']){?>
                                                    <a class="btn btn-success m-r-1em" href='verified.php?id=<?php echo $data['id']?>&&verified=<?php echo $data['verified'];?>'>Click To unverify</a>
                                                <?php }else{?>
                                                    <a class="btn btn-danger m-r-1em" href='verified.php?id=<?php echo $data['id']?>&&verified=<?php echo $data['verified'];?>'>Click To verify</a>
                                                    <?php }?>
                                                
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <span class="flaticon-more-button-of-three-dots"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="delete.php?id= <?php echo $data['id']?>"><i
                                                            class="fas fa-times text-orange-red"></i>Delete</a>
                                                    <a class="dropdown-item" href="edite.php?id= <?php echo $data['id']?>"><i
                                                            class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        <?php require "../../layouts/footer.php"; ?>

    
        </div>
</body>