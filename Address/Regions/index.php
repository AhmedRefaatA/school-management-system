<?php 
    require "../../helper/db_connect.php";
    require "../../helper/helper.php";



    
    $sql = "SELECT regions.*, cities.name as city FROM regions INNER JOIN cities ON regions.city_id = cities.id";
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
            <h3>Display Regions</h3>
            <ul>
                <li>
                    <a href="dashboard.php">Home</a>
                </li>
                <li>Regions</li>
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
                                    <th>Region ID</th>
                                    <th>Name</th>
                                    <th>City</th>
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
                                    <td><?php echo $data['name']; ?></td>
                                    <td><?php echo $data['city']; ?></td>
                                    <td>
                                        <div class="col-12 form-group mg-t-8">
                                            <a href="edite.php?id=<?php echo $data['id']?>" style="color:#fff" class="btn-lg btn-gradient-yellow btn-hover-bluedark"><i class="fa fa-pencil"></i>Edite</a>
                                            <a href="delete.php?id=<?php echo $data['id']?>" style="color:#fff" class="btn-lg bg-blue-dark btn-hover-yellow"><i class="fa fa-trash"></i>Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php require "../../layouts/footer.php"; ?>

    
        </div>
</body>