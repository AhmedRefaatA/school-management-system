<?php 
    require "../../helper/db_connect.php";
    require "../../helper/helper.php";
    require "../../layouts/home_header.php";
    require "../../layouts/nav.php";
    fireWall("auth");


$id = $_SESSION['user']['id'];
$sql = "SELECT users.*,users.id as user_id, roles.title FROM users
         INNER JOIN roles on roles.id = users.role_id where users.id = $id";
$op = mysqli_query($connect, $sql);

?>


<div class="card" style="margin-top: 100px;">
  <div class="card-body">
    <h2 class="card-title">Student Profile</h2>

    <table class="table">
  <thead>
      <?php $i = 0; while ($data = mysqli_fetch_assoc($op)) {
          ?>
        <tr>
            <th scope="col">#</th>
            <th scope="col"><?php echo ++$i; ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="col">ID</th>
                <th scope="col"><?php echo $data['id']; ?></th>
            </tr>
            <tr>
                <th scope="col">Name</th>
                <th scope="col"><?php echo $data['name']; ?></th>
            </tr>
            <tr>
                <th scope="col">EMAIL</th>
                <th scope="col"><?php echo $data['email']; ?></th>
            </tr>
            <tr>
                <th scope="col">GENDER</th>
                <th scope="col"><?php echo $data['gender']; ?></th>
            </tr>
            <tr>
                <th scope="col">DATAOFBIRTH</th>
                <th scope="col"><?php echo $data['dateofbirth']; ?></th>
            </tr>
            <tr>
                <th scope="col">ROLE</th>
                <th scope="col"><?php echo $data['title']; ?></th>
            </tr>
            <tr>
                <th scope="col">STATUS</th>
                <th scope="col"><?php if($data['verified'] == 1 ){echo "USER VERIFIED";}else{echo "USER UNVERIFIED";}; ?></th>
            </tr>

      
    
  </tbody>
</table>
  </div>
</div>
  <img class="card-img-bottom" style="max_width:150px; max_height:150px" src="<?php echo $host?>Media/profiles/<?php echo $data['profile'];?>" alt="<?php echo $data['name']; ?>">
</div>
<?php }?>
<?php
    require "../../layouts/home_footer.php"
?>