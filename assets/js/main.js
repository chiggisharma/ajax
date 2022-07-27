
$(document).ready(function(){
    //jquery started
    //Sign up methods
    $('.chiggi-form').submit(function(e){
        e.preventDefault();
        var f_name = $(this).find('input[name="f_name"]').val();
        var l_name = $(this).find('input[name="l_name"]').val();
        var email = $(this).find('input[name="email"]').val();
        var password = $(this).find('input[name="password"]').val();
        var dob = $(this).find('input[name="dob"]').val();
        var gender = $(this).find('input[name="gender"]:checked').val();
        if(f_name == ''){
            $('.f_nameErr').text("First Name is required")
        }else if(l_name == ''){
            $('.l_nameErr').text("Last Name is required")
        }
        else if(email == ''){
            $('.emailErr').text("Email field Cannot Be Empty")
        }
        else if(IsEmail(email) == false){
            $('.emailErr').text("Incorrect Email Format")
        }
        else if(password == ''){
            $('.pwErr').text("Password field Cannot Be Empty")
        }else{
            var dataToSend ={
                'f_name' : f_name,
                'l_name' : l_name,
                'email' : email,
                'password' : password,
                'dob': dob,
                'gender': gender,
                'submit' : 'submit'
            }
            $.ajax({
                url : '/ajax/ajax.php',
                method: 'post',
                // type : 'json',
                data : dataToSend,
                success: function(response){
                    $('.successMsg').text(response)
                    $('.successMsg').css('display','block')  
                },
                error: function(err){
                    console.log(err)
                }
            });
        }
    })
    


    //login methods

    $('.login_form').submit(function(e){
        e.preventDefault();
        // console.log("checked")
        var login_email = $(this).find('input[name="login_email"]').val();
        var login_password = $(this).find('input[name="login_password"]').val();
        if(login_email == '' ){
            $('.emailErr').text("Email field Cannot Be Empty")
        }else if(login_password ==''){
        $('.pwErr').text("Password field Cannot Be Empty")
        }else{
        var dataTologin = {
            'login_email' : login_email,
            'login_password' : login_password,
            'login': 'login',
        }
        $.ajax({
            url : '/ajax/ajax.php',
            method : 'post',
            data: dataTologin,
            success:function(response){
                if(response == 'success'){
                    window.location.href = "../pages/dashboard.php";
                }else{
                    $('.unauthorizedMsg').css('display','block')
                    $('.unauthorizedMsg').text('Invalid Login Details');
                } 
            },
            error: function(err){
                console.log(err)
            }
            })
        }
    })
    
    //logout method

    $('.logout').click(function(){
        var dataToLogout = {
            'logout' : 'logout'
        }
        $.ajax({
            url: '/ajax/ajax.php',
            method: 'post',
            data: dataToLogout,
            success: function(response){
                if(response){
                    window.location.href = "../pages/login.php";
                }
            },
            error: function(err){
                console.log(err)
            }
        })
    })
    
    // image upload
  function uploadfile(){
    var filename = $('.filename').val();
    var file_data =$('.fileToUpload').prop('files')[0];
    form_data.append("file",file_data);
    form_dara.append("filename",filename);
    $.ajax({
        url:"./ajx.php",
        type: "POST",
        cache: false,
        contentType:false,
        processData:false,
        data:form_data,
        success:function(dar2){
            if(dat2==1)alert("successful");
            else alert("unable to upload");
        }

    })

  }
    //jquery end
})

//vanilla js
function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test(email)) {
      return false;
    }else{
      return true;
    }
  }



