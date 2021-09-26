<?php 
    require "../helper/db_connect.php";
    require "../helper/helper.php";
    fireWall("teacher");



    $id = $_SESSION['user']['id'];
    $sql = "SELECT classes.*, classes.id as class_id, levels.title as level, users.*, users.id as uid FROM classes INNER JOIN levels ON classes.level_id = levels.id INNER JOIN users ON users.id = classes.leader_id WHERE classes.leader_id = $id";
    $op = mysqli_query($connect, $sql);
    
    



    require "../layouts/home_header.php";
    require "../layouts/nav.php"; 
?>



<body>
    

    <div class="dashboard-content-one" style="margin-top: 150px;">
        <!-- Breadcubs Area Start Here -->
        <div class="breadcrumbs-area">
            <h6>Display My Classes</h6>
            <ul>
                <li>
                    <a href="<?php echo $host;?>index.php">Home</a> /My Classes
                </li>
            </ul>
        </div>
        <div class="col-8-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>All Regions</h3>
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
                                    <th>Schdule</th>
                                    <th>Leader</th>
                                    <th>Description</th>
                                    <th>Students</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    
                                    $i=0;
                                    while($data = mysqli_fetch_assoc($op)){
                                ?>
                                <tr>
                                    <td><?php echo ++$i ?></td>
                                    <td><?php echo $data['class_id']; ?></td>
                                    <td><?php echo $data['room']; ?></td>
                                    <td><?php echo $data['level']; ?></td>
                                    <td>
                                    <a href="../Media/schdules/<?php echo $data['schdule']; ?>" style="background-color:#4ccab6" class="btn">Check Schdule</a>
                                        
                                    </td>
                                    <td><?php echo $data['name']; ?></td>
                                    <td><?php echo $data['description']; ?></td>
                                    <td>
                                    <a href="./show_std.php?id=<?php echo $data['class_id']; ?>" style="background-color:#4ccab6" class="btn">Show Students</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php require "../layouts/home_footer.php"; ?>

    
        </div>
</body>