<?php  
session_start();
include('config.php');

    if(isset($_POST['sub'])) 
    {  

     $username=$_POST['username'];
     $lastname=$_POST['lastname'];
     $email=$_POST['email'];
     $password_2=$_POST['password_2'];
     
     $sql="select * from login where (email='$email');";

      $res=mysqli_query($conn,$sql);

      if (mysqli_num_rows($res) > 0) {
        
        $row = mysqli_fetch_assoc($res);
        if(($email==isset($row['email'])))
        {
            $_SESSION['status'] = "You already have an account.Login to continue";
          
        }
	
		}
    else{
    $sql2 = "INSERT INTO login (email,password,role,status) VALUES ('$email','$password_2','user',1)";
		$result = $conn->query($sql2);
		
	if($result)
		{
		$logid= $conn->insert_id;
		$sql1 = "INSERT INTO userreg (firstname,lastname,logid) VALUES ('$username','$lastname','$logid')";  
		$result = $conn->query($sql1);
        $_SESSION['msg'] = "Account created successfully";
        header("location:shopping/category.php");
	} 
  else{
		$message = "error";
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
  <form  action="register.php" method="POST">
    <div class="container">
        <h2>Create Your Account</h2>
        <button type="reset" value="reset"style="font-size:11px;position:relative;top:12px;right:1px;width:100px;height:30px;">RESET</button>
    
          <button style="font-size:11px;position:relative;top:-40px;right:-150px;width:100px;height:30px;"><a style="color:white;" href="index.html">HOME</a></button>
      
      
        <div class="input-section">
          <label>First Name <span class="required-color">*</span></label>
          <input
            type="text"
            placeholder="Enter First Name"
            id="first-name-input"
            name="username"
            required
          />
          <span id="first-name-error" class="hide required-color error-message"
            >Input must be a character of length more than 2</span
          >
          <span id="empty-first-name" class="hide required-color error-message"
            >First Name Cannot Be Empty</span
          >
        </div>
        <div class="input-section">
          <label>Last Name <span class="required-color">*</span></label>
          <input
            type="text "
            placeholder="Enter Last Name"
            id="last-name-input"
            name="lastname"
            required
          />
          <span id="last-name-error" class="hide required-color error-message"
            >Input must be a character of length more than 2</span
          >
          <span id="empty-last-name" class="hide required-color error-message">
            Last Name Cannot Be Empty
          </span>
        </div>

        <div class="input-section">
          <label>Email <span class="required-color">*</span></label>
          <input type="email" placeholder="Enter Email" id="email"name="email" required />
          <span id="email-error" class="hide required-color error-message"
            >Invalid Email</span
          >
          <span id="empty-email" class="hide required-color error-message"
            >Email Cannot Be Empty</span
          >
        </div>

        <div class="input-section">
          <label>Password <span class="required-color">*</span></label>
          <input
            type="password"
            placeholder="Enter Password"
            id="password"
            name="password_2"
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
        </div><br>
        <CENTER><p><a href="login.php">ALREADY HAVE AN ACCOUNT? LOGIN TO CONTINUE</a></p></CENTER>
        <button id="submit-button"name="sub"value="sub">Signup</button>
    </div>
    </form>
    <!-- Script -->
    <script src="script.js"></script>
    <script>
      <?php
         /**********************index.php**/
         if(isset($_SESSION['status']))
           { 
        ?>
          alertify.set('notifier','position', 'top-center');
           alertify.success('<?= $_SESSION['status'];?>');
              <?php
          unset($_SESSION['status']);
            //if user refresh index.php after 1st time it will not see the message
            }
            ?>
          </script>
          <script>
      <?php
         /**********************index.php**/
         if(isset($_SESSION['msg']))
           { 
        ?>
          alertify.set('notifier','position', 'top-center');
           alertify.success('<?= $_SESSION['msg'];?>');
              <?php
          unset($_SESSION['msg']);
            //if user refresh index.php after 1st time it will not see the message
            }
            ?>
          </script>
  </body>
</html>