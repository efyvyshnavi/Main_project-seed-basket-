<?php
    session_start(); 
    include '../config.php';
    $email = $_SESSION['email'];
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST['add_to_cart'])){
            $pid= $_POST['product_id'];
            $cid= $_POST['cid'];
            $quantity=$_POST['quantity'];
            $sqlq="SELECT logid from login where email='$email'";
            $resu = mysqli_query($conn, $sqlq);
            $row = mysqli_fetch_assoc($resu);
            $logid= $row['logid'];
           
            $sql_already_exist = mysqli_query($conn,"SELECT quantity FROM tbl_cart WHERE pid = $pid AND logid= $logid");
            if($sql_already_exist && mysqli_num_rows($sql_already_exist) > 0){
                $row = mysqli_fetch_array($sql_already_exist);
                $quantity = $quantity + $row["quantity"];
                
                
                $update_cart_item = mysqli_query($conn, "UPDATE `tbl_cart` SET `quantity`= '$quantity' WHERE pid='$pid' AND `logid` = $logid");
                if($update_cart_item){
                    echo "<script>
                    alert('Product added to cart successfully.');
                        window.href=location='category.php?cid=$cid';
                    </script>";      
                }
            }else{
        
                $addtocart_res= mysqli_query($conn,"INSERT INTO tbl_cart VALUES(null,$pid,$logid,$quantity)");
                if(mysqli_insert_id($conn) >= 0){
                    echo "<script>
                        alert('Product added to cart successfully.');
                        window.href=location='category.php?cid=$cid';
                    </script>";
                
            }
        
        }
        }

        if(isset($_POST['update_Item']))
         {
            $pid= $_POST['product_id'];
            $quantity= $_POST['quantity'];
            $sqlq="SELECT logid from login where email='$email'";
            $resu = mysqli_query($conn, $sqlq);
            $row = mysqli_fetch_assoc($resu);
            $logid= $row['logid'];


            $update_cart_item_res= mysqli_query($conn, "UPDATE `tbl_cart` SET `quantity`='$quantity' WHERE pid='$pid '");
            if($update_cart_item_res){
                echo "<script>
                    alert('Item updated successfully.');
                    window.location.href='my-cart.php';
                </script>";
            }
            else{
                echo "<script>
                    alert('Unable to update item !! Please try again');
                    // window.location.href='../cart/mycart.php';
                </script>";
            }
       }

       if(isset($_POST['Remove_Item']))
        {
            $pid= $_POST['product_id'];
            $sqlq="SELECT logid from login where email='$email'";
            $resu = mysqli_query($conn, $sqlq);
            $row = mysqli_fetch_assoc($resu);
            $logid= $row['logid'];

            $del_cart_item_res= mysqli_query($conn,"DELETE FROM tbl_cart WHERE pid=$pid AND logid=$logid");
            if($del_cart_item_res){
                echo "<script>
                    alert('Item deleted from cart successfully.');
                    window.location.href='my-cart.php';
                </script>";
            }
            else{
                echo "<script>
                    alert('Unable to delete item !! Please try again');
                    window.location.href='my-cart.php';
                </script>";
            }
        }

        
        if(isset($_POST['wishlist']))
         {
            $pid= $_POST['product_id'];
            $cid= $_POST['cid'];
            $sqlq="SELECT logid from login where email='$email'";
            $resu = mysqli_query($conn, $sqlq);
            $row = mysqli_fetch_assoc($resu);
            $logid= $row['logid'];

          
	$sql="select * from tbl_wishlist where pid='$pid' and logid='$logid'";

	$res=mysqli_query($conn,$sql);

	if (mysqli_num_rows($res) > 0) {
	  $row = mysqli_fetch_assoc($res);
	  if ($pid == $row['pid'])
	  {
        echo "<script>
        alert('Product already in wishlist');
        window.href=location='wishlist.php';
        </script>";

	  }
	  }
   else{
           
    $addtocart_res= mysqli_query($conn,"INSERT INTO tbl_wishlist VALUES(null,$pid,$logid,'1')");
    if(mysqli_insert_id($conn) >= 0){
        echo "<script>
            alert('Product added to wishlist successfully.');
            window.href=location='category.php?cid=$cid';
        </script>";
}

	   } 




    }
        
        
    }
?>