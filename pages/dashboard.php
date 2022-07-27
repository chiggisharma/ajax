<?php 
    include('../common/header.php');
    include('../common/connection.php');
    if(empty($_SESSION['id'])){
        header('location: /ajax/pages/login.php');
    }
    $id = $_SESSION['id'];
    $sql="SELECT * FROM ajax WHERE id =$id ";
    $query= mysqli_query($conn,$sql);
    if(mysqli_num_rows($query)>0){
        $fetch = mysqli_fetch_assoc($query);
        foreach($fetch as $key=>$value){
          $f_name=$fetch['f_name'];
          $l_name=$fetch['l_name'];
          $gmail=$fetch['email'];
          $dob=$fetch['dob'];
          $gender=$fetch['gender'];
          $photo=$fetch['images'];
        }
       
   
    }
   
?>
<section class = "banner">
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-md-12 text-end">
                <button class="btn btn-outline-danger logout">Logout</button>
            </div>
        </div>
        <div >
            <div class = "banner_img">
                <div class="profile">
                    <div class=" fit">
                    <form action="" method="POST" enctype = "mutipart/form-data" class="myform" >
                        <input type="file" name ="image" class ="fileToUpload form-control" >
                        <input type="submit" name="submit" value="upload"  classs="btn btn-success" onclick="uploadfile()">
                    </form>
                    </div>
                    
                </div>
             <div class="text-center pt-3 pb-3 ">   
                    <h1><?php echo $f_name. ' ' . $l_name?></h1>
                    <p class="m-0"><?php echo  $gmail ?></p>
                    <p class="m-0"><?php echo "D.O.B -". $dob ?></p>
                    <p class="m-0"><?php echo $gender ?></p>
                </div>  
             </div>   

        </div>
    </div>

</section>
<section>
    <div class="container-fluid mt-5">
        <div><h2><?php echo $f_name . $l_name; ?></h2></div>
        <div>  <?php echo '<img src="data:image/png;base64,'.base64_encode($photo).'"/>'?></div>
    </div>
</section>

<?php   
    include('../common/footer.php');
?>