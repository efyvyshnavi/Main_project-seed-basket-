<?php
session_start();
include('config.php');
$targetDir="fimages/";
if(isset($_POST['subm']))
{
    $fname=$_POST['fname']; 
    $lname=$_POST['lname'];
    $password=($_POST['password']);
    $email=$_POST['email'];
    $images=$_FILES["images"]["name"];
    $phone=$_POST['phoneno'];
    $targetFilePath = $targetDir. $images;
    move_uploaded_file($_FILES["images"]["tmp_name"],$targetFilePath);
    $sql="select * from login  where (email='$email');";

    

    $res=mysqli_query($conn,$sql);

    if (mysqli_num_rows($res) > 0) {
      
      $row = mysqli_fetch_assoc($res);
      if($email==isset($row['email']))
      {
        $_SESSION['seller'] = "This Seller account already exists. Login to continue";
      }
  
      }
  else{
    
    $sql3 = "INSERT INTO login (email,password,role,status) VALUES ('$email','$password','seller',0) ";
    $result = $conn->query($sql3);
   if($result)
   {
     $logid = $conn->insert_id;
     $sql4 = "INSERT INTO sellerreg (fname,lname,phoneno,file_name,logid,status) VALUES ('$fname','$lname','$phone','$images','$logid',1) ";
     $result = $conn->query($sql4);
     echo "<script type='text/javascript'>alert('Wait for admin approval.Try again after a while and login to continue');
	window.location='sellerreg.php';
	</script>";
   }
}
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Form Validation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap"
      rel="stylesheet"
    />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="register.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
		<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  </head>
  <body>
    <div class="container">
        <form action="sellerreg.php"method="POST" enctype="multipart/form-data">
        <h4>Create Seller Account</h4>
        <button type="reset" value="reset"style="font-size:11px;position:relative;top:12px;right:1px;width:100px;height:30px;">RESET</button><br>
    
      
        <div class="input-section">
          <label>First Name <span class="required-color">*</span></label>
          <input
            type="text"
            placeholder="Enter First Name"
            id="first-name-input"
            name="fname"
            required
          />
          <span id="first-name-error" class="hide required-color error-message"
            >Input must be a character of length 2</span
          >
          <span id="empty-first-name" class="hide required-color error-message"
            >First Name Cannot Be Empty</span
          >
        </div>
        <div class="input-section">
          <label>Last Name<span class="required-color">*</span></label>
          <input
            type="text "
            placeholder="Enter Last Name"
            id="last-name-input"
            name="lname"
            required
          />
          <span id="last-name-error" class="hide required-color error-message"
            >Input must be a character of length 2</span
          >
          <span id="empty-last-name" class="hide required-color error-message">
            Last Name Cannot Be Empty
          </span>
        </div>

        <div class="input-section">
          <label>Email <span class="required-color">*</span></label>
          <input type="email" placeholder="Enter Email" id="email" name="email"required />
          <span id="email-error" class="hide required-color error-message"
            >Invalid Email</span
          >
          <span id="empty-email" class="hide required-color error-message"
            >Email Cannot Be Empty</span
          >
        </div>

        <div class="input-section">
          <label>Phone <span class="required-color">*</span></label>
          <input
            type="text"
            placeholder="Enter Phone Number"
            id="phone"
            name="phoneno"
            required
          />
          <span id="phone-error" class="hide required-color error-message"
            >Phone Number Should Have 10 Digits</span
          >
          <span id="empty-phone" class="hide required-color error-message">
            Phone cannot be empty
          </span>
        </div>

        
        <div class="input-section">
          <label>Aadhar Number <span class="required-color">*</span></label>
          <input type="file" class="form-control" accept="image/gif" name="images" required/>
        </div>


        <div class="input-section">
          <label>Password <span class="required-color">*</span></label>
          <input
            type="password"
            placeholder="Enter Password"
            id="password"
            name="password"
            required
          />
          <span id="password-error" class="hide required-color error-message">
          Must contain at least one number,one uppercase,lowercase letter and aleast 5 characters
          </span>
          <span id="empty-password" class="hide required-color error-message">
            Password Cannot Be Empty
          </span>
        </div>

        <div class="input-section">
          <label>Confirm Password <span class="required-color">*</span></label>
          <input
            type="password"
            id="verify-password"
            placeholder="Confirm Password"
            required
          />
          <span
            id="verify-password-error"
            class="hide required-color error-message"
            >Should Be Same As Previous Password</span
          >
          <span
            id="empty-verify-password"
            class="hide required-color error-message"
            >Password Cannot Be Empty</span
          >
        </div>
        <center><a href="login.php"style="color:red;">Click here to Login</a></center>
        <button name="subm"value="subm"id="submit-button">Signup</button>
      </form>
    </div>
    <!-- Script -->
    <script src="sell.js"></script>
    <script>
      <?php
         /**********************index.php**/
         if(isset($_SESSION['seller']))
           { 
        ?>
          alertify.set('notifier','position', 'top-center');
           alertify.success('<?= $_SESSION['seller'];?>');
              <?php
          unset($_SESSION['seller']);
            //if user refresh index.php after 1st time it will not see the message
            }
            ?>
          </script>

  </body>
</html>