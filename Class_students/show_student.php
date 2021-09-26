<?php 
    require "../helper/db_connect.php";
    require "../helper/helper.php";
    fireWall("admin");


    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $id = clean(validPattern(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT), 'int'));
        $sql = "SELECT users.*,users.id as uid, class_students.*, classes.* from users inner join class_students on users.id = class_students.student_id inner join classes on classes.id = class_students.class_id where class_students.class_id = $id";
        $op = mysqli_query($connect, $sql);
        
        }
   
    



    require "../layouts/header.php"; 
?>



<body>
    
<?php 
    require "../layouts/header_menu.php";
    require "../layouts/sidebar.php";
   
?>
   <div class="dashboard-content-one">
        <!-- Breadcubs Area Start Here -->
        <div class="breadcrumbs-area">
            <h3>Display My Classes</h3>
            <ul>
                <li>
                    <a href="<?php echo $host;?>index.php">Home</a> /My Classes/students
                </li>
            </ul>
        </div>
        <div class="col-8-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>All Students</h3>
                        </div>
                    </div>
                    <div class="table-responsive">
                            <table class="table display data-table text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Date Of Birth</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                        $i=0;
                                        while($data = mysqli_fetch_assoc($op)){?>
                                    <tr>
                                        <td><?php echo ++$i;?></td>
                                        <td><?php echo $data['uid'];?></td>
                                        <td class="text-center"><img src="../../Media/profiles/<?php echo $data['profile'];?>" alt="Admin" style="max-width: 100px; max-height:100px;"></td>
                                        <td><?php echo $data['name'];?></td>
                                        <td><?php echo $data['email'];?></td>
                                        <td><?php echo $data['gender'];?> </td>
                                        <td><?php echo $data['dateofbirth'];?></td>
                                        <td>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
        <?php require "../layouts/footer.php"; ?>

    
        </div>
</body>