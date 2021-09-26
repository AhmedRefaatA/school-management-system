<?php
    require "../helper/db_connect.php";
    require "../helper/helper.php";
    //fireWall("admin");


    $class_sql = "SELECT classes.*, users.name, levels.title FROM classes INNER JOIN levels ON classes.level_id = levels.id INNER JOIN users ON classes.leader_id = users.id";
    $class_op = mysqli_query($connect, $class_sql);

    $std_sql = select("*", "users", "WHERE role_id = 3");
    $std_op = mysqli_query($connect, $std_sql);
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $class = ["class" => clean($_POST['class'])];
        $student = ["student" => clean($_POST['student'])];
        $validClass = validPattern($class["class"], "int");
        $validStudent = validPattern($student["student"], "int");
        $check = checkempty([$class, $student]); 

        if($validClass && $validStudent && $check){
            $class = $class["class"];
            $student = $student["student"];
            $std_check = select("*", "class_students", "where student_id = $student");
            $std_op = mysqli_query($connect, $std_check);
            if($std_op){
                if(mysqli_num_rows($std_op)){
                    $del_sql = delete("class_students", "where student_id = $student");
                    $del_op = mysqli_query($connect, $del_sql);
                    $sql = insert('class_students', ['class_id', 'student_id'], [(int)$class, (int)$student]);
                    $op = mysqli_query($connect, $sql);
                    if($op){
                        redirect('index.php');
                    } else{
                        echo messageAlert("Level data not inserted please try again");
                    }
                    
                }else{
                    $sql = insert('class_students', ['class_id', 'student_id'], [(int)$class, (int)$student]);
                    $op = mysqli_query($connect, $sql);
                }
                }

            }
            
        
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
            <h3>Add Region</h3>
            <ul>
                <li>
                    <a href="<?php echo $host?>index.php">Home</a>
                </li>
                <li>Class Students/Add Student</li>
            </ul>
        </div>
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Add New Student</h3>
                    </div>
                </div>
                <form class="new-added-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                
                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>class Name *</label>
                            <select name="class" class="form-control">
                                <?php while ($data = mysqli_fetch_assoc($class_op)) {?>
                                    <option value="<?php echo $data['id']?>"><?php echo 'ROOM : ' . $data['room'] . '***Level : ' . $data['title'] . '***Leader : ' . $data['name'];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Student Name *</label>
                            <select name="student" class="form-control">
                                <?php while ($std_data = mysqli_fetch_assoc($std_op)) {?>
                                    <option value="<?php echo $std_data['id']?>"><?php echo $std_data['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Add</button>
                        <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    
        <?php require "../layouts/footer.php"; ?>

</div>

</body>