<?php
    include("./common/header.php");
?>
<section class="black">
    <div class="text-end">
    <a class="text-decoration-none text-white" href="./pages/login.php"><button class="btn btn-outline-danger mt-3 me-3">Login Here</button></a>
    </div>
    <div class="container">
        <div class="row d-flex align-items-center" style="height:90vh">
            <div class="col-12 d-flex justify-content-center">
                <form action="" method="post" class="w-25 border border-light rounded text-center p-4 chiggi-form">
                    <div class="alert alert-success successMsg"></div>
                    <input type="text" name="f_name" placeholder="Enter First Name" class="form-control">
                    <p class="f_nameErr text-danger"></p>
                    <input type="text" name="l_name" placeholder="Enter Last Name" class="form-control">
                    <p class="l_nameErr text-danger"></p>
                    <input type="text"name="email" placeholder="Enter Email Address" class="form-control">
                    <p class="emailErr text-danger"></p>
                    <input type="password" name="password" placeholder="Enter Password" class="form-control mt-3">
                    <p class="pwErr text-danger"></p>
                    <input type="date" name="dob" placeholder="Enter dob" class="form-control">
                    <p class="dobErr text-danger"></p>
                    <input type="radio" name="gender" value="Male" checked="checked"> Male
                    <input type="radio" name="gender" value="Female"> Female
                    <input type="radio" name="gender" value="Other"> Other
                    <input type="submit" value="Sign Up" class="btn btn-outline-light mt-3">
                </form>
            </div>
        </div>
    </div>
</section>

<?php
include("./common/footer.php");
?>