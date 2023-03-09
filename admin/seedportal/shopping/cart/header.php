<?php
  include '../connect1.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">


  <div class="container-fluid">
  <!-- <style>
            .container-fluid{
                background-color:lightgreen;
            }
            </style> -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
           
          <a class="nav-link active" aria-current="page" href="../menu1.php">FOODSTORE</a>
          
        </li>
        
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index1.php">Home</a>
        </li> 
        <!-- <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../login.php">Login</a>
        </li>  -->
        <!-- <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
        </li>  -->
      </ul>
     <div>
        <?php
        // if(isset($_SESSION['cart']))
        // {
        //     $count=count($_SESSION['cart']);
        // }
        // else{
        // $count=0;
        // }
        $sql = "SELECT COUNT(*) AS count FROM tbl_cart ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$count = $row['count'];

// display the notification badge

        ?>
      <a href="mycart.php" class="btn btn-outline-success">My Cart(<?php echo $count;?>)</a>
     </div>
    </div>
  </div>
 
</nav>  

</body>
</html>