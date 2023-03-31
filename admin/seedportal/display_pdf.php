<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Display PDF</title>
    
    <style>
  embed {
    width: 102%;
    height: 100vh;
    border: none;
    margin-top: -10px;
    margin-right:2px;
    margin-left:-8px;
    margin-bottom:-16px;
  }
</style>

  </head>
  <body>
    <div class="div1">
      <?php
include ('config.php');
      $sellerid=$_REQUEST['id'];
      $sql="SELECT pdf from sellerreg WHERE sellerid='$sellerid'";
      $query=mysqli_query($conn,$sql);
      while ($info=mysqli_fetch_array($query)) {
        ?>
      <embed type="application/pdf" src="../../../vs/admin/seedportal/pdf/<?php echo $info['pdf'] ; ?>" width="1300" height="850">
    <?php
      }

      ?>

    </div>

  </body>
</html>
