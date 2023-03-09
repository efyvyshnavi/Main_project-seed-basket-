<?php
session_start();
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
    <link rel="stylesheet" href="log.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
		<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    
  </head>
  <body>
  <form action="log.php" method="POST">
    <div class="container">
        <h2>Login to continue</h2>
        <button type="reset" value="reset"style="font-size:11px;position:relative;top:12px;right:1px;width:100px;height:30px;">RESET</button>
    
          <button style="font-size:11px;position:relative;top:-40px;right:-150px;width:100px;height:30px;"><a style="color:white;" href="index.html">HOME</a></button>
      
      
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
            Invalid input
          </span>
          <span id="empty-password" class="hide required-color error-message">
            Password Cannot Be Empty
          </span>
        </div><BR>
        <CENTER><p><a href="register.php">CREATE ACCOUNT</a></p></CENTER>
        <button id="submit-button"name="subm"value="subm">Signup</button>
        <CENTER><p><a href="forgotpass.php">FORGOT PASSWORD</a></p></CENTER>
    </div>
    </form>
    <!-- Script -->
    <script src="log.js"></script>
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
