<?php
    date_default_timezone_set('Asia/Manila');
    include ('config.php');
 
    if(isset($_POST['submit'])){
        
        $file_name = $_FILES['video']['name'];
        $file_temp = $_FILES['video']['tmp_name'];
        $file_size = $_FILES['video']['size'];
       $description=$_POST['description'];
       $video_type=$_POST['video_type'];
       $heading=$_POST['heading'];


        if($file_size < 50000000){
            $file = explode('.', $file_name);
            $end = end($file);
            $allowed_ext = array('avi', 'flv', 'wmv', 'mov', 'mp4');
            if(in_array($end, $allowed_ext)){
                $name = date("Ymd").time();
                $location = $name.".".$end;
                if(move_uploaded_file($file_temp, $location)){
                    mysqli_query($conn, "INSERT INTO `video`(type,video_name,location,heading,description) VALUES('$video_type','$name', '$location','$heading','$description')");
                    echo "<script>alert('Video Uploaded')</script>";
                    echo "<script>window.location = 'index.php'</script>";
                }
            }else{
                echo "<script>alert('Wrong video format')</script>";
                echo "<script>window.location = 'index.php'</script>";
            }
        }else{
            echo "<script>alert('File too large to upload')</script>";
            echo "<script>window.location = 'index.php'</script>";
        }
    }
?>