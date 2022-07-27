<?php 
    include('./common/connection.php');

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $fname= $_POST['f_name'];
        $lname=$_POST['l_name'];
        $dob=$_POST['dob'];
        $gender=$_POST['gender'];
        
        $sql= "SELECT * FROM ajax WHERE email = '$email'";
         $query1= mysqli_query($conn,$sql);
        
        if(mysqli_num_rows($query1)>0){
            echo "Email Already Exists";
        } else{
            $sql = "INSERT INTO ajax VALUES('','$fname','$lname','$email','$password',' $dob','$gender','')";
           
            $query = mysqli_query($conn, $sql);
            if($query){
                echo 'Data inserted successfully';
            }else{
                echo 'Failed to insert data';
            }
        }
    }
    if(isset($_POST['login'])){
        $email = $_POST['login_email'];
        $password = md5($_POST['login_password']);
        
        $sql= "SELECT * FROM ajax WHERE email = '$email' and password = '$password'";
        $query = mysqli_query($conn,$sql);
        if(mysqli_num_rows($query)>0){
            $fetch = mysqli_fetch_assoc($query);
            $getid = $fetch['id'];
            $_SESSION['id'] = $getid;
            echo 'success';
        }else{
            echo 'failed';        
        }

    }

        if(isset($_POST['logout'])){
                unset($_SESSION['id']);
                echo 'destroyed';
            }
            // echo 'in ajax';


// uload buttton clicked
    // $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
    // $path = 'uploads/'; // upload directory
    // if(!$_FILES['image'])
    // {
    //     $img = $_FILES['image']['name'];
    //     return $img;
    //     $tmp = $_FILES['image']['tmp_name'];
    //     // get uploaded file's extension
    //     $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    //     // can upload same image using rand function
    //     $final_image = rand(1000,1000000).$img;
    //     // check's valid format
    //     if(in_array($ext, $valid_extensions)) 
    //     { 
    //     $path = $path.strtolower($final_image); 
    //     if(move_uploaded_file($tmp,$path)) 
    //     {
    //     echo "<img src='$path' />";
    //     $name = $_POST['name'];
    //     $email = $_POST['email'];
    //     //include database configuration file
    //     include_once 'db.php';
    //     //insert form data in the database
    //     $insert = $db->query("INSERT uploading (name,email,file_name) VALUES ('".$name."','".$email."','".$path."')");
    //     //echo $insert?'ok':'err';
    //     }
    // } 
    // else 
    // {
    // echo 'invalid';
    // }
    // } 


    // $file= $_FILES['image']['name'];

    // $output ="";
    // $query = "INSERT INTO ajax(image) VALUES('$file')";
    // $res = mysqli_query($conn,$query);
    // if($res){
    //     more_uploaded_files($_FILES['image']['tmp_name'],'$file');
    //     $output ='done';
    // }else{
    //     $output ='failed';
    // }
    // $resp = array{
    //     'output'=>$outpuut
    // };
    // echo json_encode($resp);
    $target_directory ="files/";
    $target_files = $target_directory.basename($_FILES["file"]["name"]);
    $filetype = strtolower(pathinfo($target_fle,PATHINFO_EXTENSION));
    $newfilename = $target_directory.$filename.".".$filetype;


    if(move.uploaded_file($_FILES["file"]["tmp_name"],$rowfilename)) echo 1;
    else echo 0;
    

?>