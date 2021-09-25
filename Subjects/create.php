<?php
    require "../helper/db_connect.php";
    require "../helper/helper.php";
    fireWall("admin");




    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $subject = ["title" => clean($_POST['title'])];
        $validSubject = validPattern($subject["title"], "string");
        

        if($validSubject && !empty($subject['title'])){
            $subject = $subject["title"];
            $sql = insert('subjects', ['title'], [$subject]);
            $op = mysqli_query($connect, $sql);
            if($op){
                redirect('index.php');
            } else{
                echo messageAlert("subject data not inserted please try again");
            }
            
        }else{
            echo messageAlert('please insert valid title for subject');
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
            <h3>Add Subjects</h3>
            <ul>
                <li>
                    <a href="<?php echo $host?>index.php">Home</a>
                </li>
                <li>Subjects/Add Subjects</li>
            </ul>
        </div>
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Add New Subject</h3>
                    </div>
                </div>
                <form class="new-added-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Subject Name *</label>
                            <input type="text" name="title" placeholder="Subject Name" class="form-control">
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