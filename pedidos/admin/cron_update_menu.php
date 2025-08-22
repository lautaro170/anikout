<?php 

require_once("controller/funciones.php");
    
    
    $cdresult = false;
    $attempt = 0;
    while(!$cdresult || $attempt >= 10){
    
      $conn =conectar();   
      $cdquery="update producto set activo = activo_proxima_semana;";
    
      $cdresult=mysqli_query($conn,$cdquery);
      $attempt++;
      
    } 

?>