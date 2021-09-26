<?php 
    require "../helper/db_connect.php";
    require "../helper/helper.php";



    
    $sql = "SELECT classes.* , levels.title, users.name FROM classes INNER JOIN levels ON classes.level_id = levels.id INNER JOIN users ON classes.leader_id = users.id";
    $op = mysqli_query($connect, $sql);
    
   
    



    require "../layouts/header.php"; 
?>



<body>
    
<?php 
    require "../layouts/header_menu.php";
    require "../layouts/sidebar.php";
    fireWall("admin");
?>
    <div class="dashboard-content-one">
        <!-- Breadcubs Area Start Here -->
        <div class="breadcrumbs-area">
            <h3>Display Classes Students</h3>
            <ul>
                <li>
                    <a href="<?php echo $host;?>index.php">Home</a>
                </li>
                <li>Classes Students</li>
            </ul>
        </div>
        <div class="col-8-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>All Classes</h3>
                        </div>
                    </div>
                    
                    
                    
                    <div class="table-responsive">
                        <table class="table display data-table text-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Class ID</th>
                                    <th>Room</th>
                                    <th>Level</th>
                                    <th>Leader Name</th>
                                    <th>Schdule</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i=0;
                                    while($data = mysqli_fetch_assoc($op)){
                                ?>
                                <tr>
                                    <td><?php echo ++$i ?></td>
                                    <td><?php echo $data['id']; ?></td>
                                    <td><?php echo $data['room']; ?></td>
                                    <td><?php echo $data['title']; ?></td>
                                    <td><?php echo $data['name']; ?></td>
                                    <td>
                                        <a href="../Media/schdules/<?php echo $data['schdule']?>" style="color:#fff" class="btn-lg bg-blue-dark btn-hover-yellow">Show Schdule</a>
                                    </td>
                                    <td>
                                        <a href="<?php echo $host?>Class_students/show_student.php?id= <?php echo $data['id']?>" style="color:#fff" class="btn-lg bg-blue-dark btn-hover-yellow">Show Students</a>  
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php require "../layouts/footer.php"; ?>

    
        </div>
</body>