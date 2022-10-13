<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $host="localhost";
    $usuario="root";
    $pass="";
    $base_datos="form";
    
    $conexion= new mysqli($host,$usuario,$pass, $base_datos);
    if($conexion->connect_error){
        echo"error de conexion";
        exit();
    }
    ?>
</body>
</html>