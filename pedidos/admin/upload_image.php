<?php

$hasFiles = true;
if(count($_FILES['file']['name']) >= 1 && $_FILES['file']['name'][0] != "")
{ 


    $path = "";
    $errorfile = false;             
    $target_path_root = "uploads/";     

   


        $validextensions = array("jpeg", "jpg", "png","JPEG", "JPG", "PNG");     
        $ext = explode('.', basename($_FILES['file']['name']));  
        
        $file_extension = end($ext);

        $target_path = $target_path_root . md5(uniqid()) . "." . $ext[count($ext) - 1];    
    
        if (($_FILES["file"]["size"][$i] < 100000000) && in_array($file_extension, $validextensions)) 
        {       
           
            if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) 
            {

                $path = $target_path;
            } 
            else 
            {     

                $errorfile = true;

            }
        } 
        else 
        {    
            $errorfile = true;


        }
   


    $response = new StdClass;
    $response->link = "http://localhost:8080/mujeres/admin/" . $path;
    echo stripslashes(json_encode($response));
}
?>



