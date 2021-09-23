<?php
    require "../helper/db_connect.php";
    require "../helper/helper.php";


    $lead_sql = select("*", "users", "where role_id = 2");
    $lead_op = mysqli_query($connect, $lead_sql);
    $level_sql = select("*", "levels");
    $level_op = mysqli_query($connect, $level_sql);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $level = ["title" => clean($_POST['title'])];
        $validLevel = validPattern($level["title"], "level");
        

        if($validLevel && !empty($level['title'])){
            $level = $level["title"];
            $sql = insert('levels', ['title'], [$level]);
            $op = mysqli_query($connect, $sql);
            if($op){
                redirect('index.php');
            } else{
                echo messageAlert("Level data not inserted please try again");
            }
            
        }else{
            echo messageAlert('please insert valid title for level');
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
            <h3>Add Class</h3>
            <ul>
                <li>
                    <a href="<?php echo $host?>dashboard.php">Home</a>
                </li>
                <li>Classes/Add Class</li>
            </ul>
        </div>
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Add New Class</h3>
                    </div>
                </div>
                <form class="new-added-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Class Room *</label>
                            <input type="number" name="room" placeholder="Class Room" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Description *</label>
                            <textarea name="desc" placeholder="class description ..." class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Class schdule*</label>
                            <input type="file" name="schdule" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Class  Leader *</label>
                            <select name="lead" class="form-control">
                                <?php while ($lead_data = mysqli_fetch_assoc($lead_op)) {?>
                                    <option value="<?php echo $lead_data['id']?>"><?php echo $lead_data['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Level Class *</label>
                            <select name="level" class="form-control">
                                <?php while ($level_data = mysqli_fetch_assoc($level_op)) {?>
                                    <option value="<?php echo $level_data['id']?>"><?php echo $level_data['title']?></option>
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