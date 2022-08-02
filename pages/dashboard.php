<?php 
    include('../common/header.php');
    include('../common/connection.php');
    if(empty($_SESSION['id'])){
        header('location: /ajax/pages/login.php');
    }
    $id = $_SESSION['id'];

    //Get User Details
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
    //Get all posts\
    $sql2 = "SELECT * FROM posts";
    $query=mysqli_query($conn, $sql2);
    if(mysqli_num_rows($query) > 0){
        $fetch2 = mysqli_fetch_all($query);
       
        // $count = count($fetch2);
        
    }
    
    
    //Upload profile picture
    $message =''; 
    if(isset($_POST['upload_image']) && isset($_FILES['my_image'])){
        $img_name = $_FILES['my_image']['name'];  
        $img_size = $_FILES['my_image']['size'];    
        $tmp_name = $_FILES['my_image']['tmp_name'];   
        $error = $_FILES['my_image']['error'];
     if($error === 0 ){
            if($img_size > 1250000){
                $em =" sorry, your file is too large.";
            }else{
                $img_ex =  pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpg","jpeg","png");
                if(in_array($img_ex_lc,$allowed_exs)){
                    $new_img_name = uniqid("IMG-",true).'.'.$img_ex_lc;
                    // echo $new_img_name;
                    $img_upload_path ='../images/'.$new_img_name;
                    move_uploaded_file($tmp_name,$img_upload_path);
                    $sql ="UPDATE ajax SET images = '$new_img_name'WHERE id = '$id'";
                    $query = mysqli_query($conn,$sql);
                    if($query){
                        $message = "Profile Updated";
                    }
                }else{
                    $em = "You cant upload file odf this type";
                }
            }
        }    
        }else{
            
    }

    //Upload Post
        if(isset($_POST['postsubmit']) && isset($_FILES['post_image'])){
            $description = $_POST['description'];
            $img_name = $_FILES['post_image']['name'];  
            $img_size = $_FILES['post_image']['size'];   
            $tmp_name = $_FILES['post_image']['tmp_name']; 
            $error = $_FILES['post_image']['error'];
            if($error === 0 ){
                if($img_size > 1250000){
                    $em =" sorry, your file is too large.";
                }else{
                    $img_ex =  pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);
                    $allowed_exs = array("jpg","jpeg","png");
                    if(in_array($img_ex_lc,$allowed_exs)){
                        $new_img_name = uniqid("IMG-",true).'.'.$img_ex_lc;
                        $img_upload_path ='../images/'.$new_img_name;
                        move_uploaded_file($tmp_name,$img_upload_path);
                        $sql = "INSERT INTO posts VALUES('','$id','$description','$new_img_name')";
                        $query = mysqli_query($conn,$sql);
                        if($query){
                            echo 'Post Uploaded';
                        }else{
                            echo 'failed to upload post';
                        }
                    }
                }
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
                    <img src ="../images/<?php echo $photo;?>" class="w-100 h-100">
                </div>
                <div class="text-center"><span class="alert-success"><?php echo $message; ?></span></div>
                <div class="text-center mt-4 mb-4"><button class ="flip">Upload <i class="fa-solid fa-arrow-up-from-bracket"></i></button></div>
               <div class = "text-center profile_form panel"> 
                    <form action="" method ="POST" enctype ="multipart/form-data">
                            <input type="file" name="my_image" class="file_input">
                            <input type="submit" name = "upload_image" value ="upload"  class = "btn btn-primary">
                    </form>
                </div>
             <div class="text-center">   
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <form action="" method="post" enctype="multipart/form-data" class="w-25 p-3">
                    <input type="text" name="description" placeholder="Type Here" class="form-control">
                    <input type="file" name="post_image" class="form-control mt-3">
                    <input type="submit" name="postsubmit" value="Upload Post" class="form-control mt-3">
                </form>
            </div>
        </div>
    </div>
</section>

<?php
foreach($fetch2 as $key=>$value){
    $sql = "SELECT * FROM ajax WHERE id = '$value[1]'";
    $query = mysqli_query($conn,$sql);
    if(mysqli_num_rows($query)>0){
        $get = mysqli_fetch_assoc($query);
        $name = $get['f_name'];
    }
    ?>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-primary"><?php echo $name; ?></h4>
                <p class="text-success">Description: <?php echo $value[2]; ?></p>
                <img src="../images/<?php echo $value[3]; ?>" alt="" class="w-50">
            </div>
        </div>
    </div>
    <?php
}
?>

<?php   
    include('../common/footer.php');
?>