<?php

// $name = $_POST["name"] ; 
// $fileName = $_FILES["image"]["name"] ; 
// $fileSize = $_FILES["image"]["size"] ; 
// $tmpName = $_FILES["image"]["tmp_name"] ; 

// $validIamegExt = ['jpg','jpeg','png'] ; 
// $imageExt = explode('.',$fileName) ;
// $imageExt = strtolower(end($imageExt)) ; 
// if(!in_array($imageExt,$validIamegExt))
// {
//     echo "<script> alert('Invalid Image Ext'); </script> " ; 
// }
// else if ($fileSize > 100000)
// {
//     echo "<script> alert('Size Tooo BIG'); </script> " ; 
// }
// else
// {
//     $newImage = uniqid() ; 
//     $newImage .= '.' . $imageExt ; 
//     move_uploaded_file($tmpName , '../img/'. $newImage) ; 
// }
if(isset($_FILES['image'])){
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
    $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
    
    $extensions= array("jpeg","jpg","png");
    
    if(in_array($file_ext,$extensions)=== false){
       $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
    
    if($file_size > 2097152){
       $errors[]='File size must be excately 2 MB';
    }
    
    if(empty($errors)==true){
       move_uploaded_file($file_tmp,"images/".$file_name);
       echo "Success";
    }else{
       print_r($errors);
    }
 }

?>
