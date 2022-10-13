<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="formulario">
<form  method="POST" class="form-interno">
 documento <input type="text" name="docu" id="documento">
 <br> <br>
 nombre <input type="text" name="nomb" id="nombre">
 <br> <br>
 Telefono <input type="text" name="tele" id="telefono">
 <br> <br>
 Direccion <input type="text" name="direc" id="direccion">
 <br> <br>
 <input type="submit" value ="registrar" name="btn-registrar">
 <br> <br>
 <input type="submit" value ="buscar" name="btn-buscar">
 <br> <br>
 <input type="submit" value ="actualizar" name="btn-actualizar">
 <br> <br>
 <input type="submit" value ="eliminar" name="btn-eliminar">
 

<?php

include('abrir_conexion.php');
$doc="";
$nom="";
$tel="";
$dir="";
if(isset($_POST["btn-registrar"])){
$doc=$_POST['docu'];
$nom=$_POST['nomb'];
$tel=$_POST['tele'];
$dir=$_POST['direc'];

if($doc==""||$nom==""||$tel==""||$dir==""){
    echo"campos obligatorios";
}else{
    $result=$conexion->prepare("insert into datos(documento,nombre,telefono,direccion)value(?,?,?,?);");
    $result->bind_param("isis",$doc,$nom,$tel,$dir);
}$result->execute();
}

if(isset($_POST['btn-buscar'])){
    $doc=$_POST['docu'];
    $existe=0;
    if($doc==""){
    echo"campos vacios";
    }else{
        $resultado=mysqli_query($conexion,"select*from datos where documento='$doc'");
        while($consulta=mysqli_fetch_array($resultado)){
            $consultaNombre = $consulta['nombre'];
            $consultaDoc = $consulta['documento'];
            $consultaTel = $consulta['telefono'];
            $consultaDirec = $consulta['direccion'];
            echo "<script> 
            document.getElementById('nombre').value = `{$consultaNombre}`
            document.getElementById('documento').value =`{$consultaDoc}`
            document.getElementById('telefono').value =`{$consultaTel}`
            document.getElementById('direccion').value =`{$consultaDirec}`</script>";
        $existe++;
        }                              
    }   
}
if(isset($_POST["btn-actualizar"])){
    $doc=$_POST['docu'];
    $nom=$_POST['nomb'];
    $tel=$_POST['tele'];
    $dir=$_POST['direc'];
    
    if($doc==""||$nom==""||$tel==""||$dir==""){
        echo"campos obligatorios";
    }else{
        $existe=0;
        $resultado=mysqli_query($conexion,"SELECT * FROM datos where documento='$doc'");
        while($consulta=mysqli_fetch_array($resultado))
        {
            $existe++;
        }
    if($existe==0){
        echo "El documento no existe";
    }else{
        $_UPDATE_SQL="UPDATE datos SET
        documento='$doc',
        nombre='$nom',
        telefono='$tel',
        direccion='$dir'
        WHERE documento='$doc'";
        mysqli_query($conexion,$_UPDATE_SQL);
        }
    }
}

if(isset($_POST["btn-eliminar"])){
    $doc=$_POST['docu'];
    $existe=0;
    if($doc==""){
        echo"Debes escribir el documento";
    }else{
        $resultado=mysqli_query($conexion,"SELECT*FROM datos where documento='$doc'");
        while($consulta=mysqli_fetch_array($resultado))
        {
            $existe++;
        }
        if($existe==0){
            echo "El documento no existe";
        }else{
            $_DELETE_SQL="DELETE FROM datos WHERE documento='$doc'";
            mysqli_query($conexion,$_DELETE_SQL);
        }
    }
}
mysqli_close($conexion);
?>




</body>
</html>