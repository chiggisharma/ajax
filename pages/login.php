<?php
include("../common/header.php");
include('../common/connection.php');
if(isset($_SESSION['id'])){
    header('location: ./dashboard.php');
}
session_destroy();
ob_start();
?>

<section class="black">
    <div class = "container">
        <div class = "row d-flex align-items-center" style="height:90vh">
            <div class = "col-12 d-flex justify-content-center">
                <form action="" method="post" class="w-25 border border-light rounded text-center p-4 login_form">
                    <div class="alert alert-danger unauthorizedMsg"></div>
                    <input type="text" name="login_email" placeholder="Enter your email" class="form-control">
                    <p class="emailErr text-danger"></p>
                    <input type="password" name="login_password" placeholder="Enter your password" class="form-control mt-3">
                    <p class="pwErr text-danger"></p>
                    <input type="submit" name="login" value="LogIn" class="btn btn-outline-light mt-3"><br><br>
                    <a href="/ajax">Sign Up Here</a>
                </form>
            </div>
        </div>

    </div>
</section>

<?php
include("../common/footer.php");
?>