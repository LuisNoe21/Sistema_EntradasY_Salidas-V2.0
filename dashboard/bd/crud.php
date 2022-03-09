<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$identidad = (isset($_POST['identidad'])) ? $_POST['identidad'] : '';
$caracteristicas = (isset($_POST['caracteristicas'])) ? $_POST['caracteristicas'] : '';
$placa = (isset($_POST['placa'])) ? $_POST['placa'] : '';
$referencia = (isset($_POST['referencia'])) ? $_POST['referencia'] : '';
$fentrada = (isset($_POST['fentrada'])) ? $_POST['fentrada'] : '';
$hentrada = (isset($_POST['hentrada'])) ? $_POST['hentrada'] : '';
$hsalida = (isset($_POST['hsalida'])) ? $_POST['hsalida'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO personas (nombre,identidad,caracteristicas, placa, referencia, fentrada, hentrada, hsalida) VALUES('$nombre', '$identidad', '$caracteristicas', '$placa', '$referencia','$fentrada','$hentrada', '$hsalida') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id, nombre, identidad, caracteristicas, placa, referencia, fentrada,hentrada, hsalida FROM personas ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE personas SET nombre='$nombre', identidad='$identidad', caracteristicas= '$caracteristicas', placa='$placa', referencia='$referencia', fentrada='$fentrada', hentrada='$hentrada', hsalida='$hsalida' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, nombre, identidad, caracteristicas, placa, referencia, fentrada,hentrada,hsalida FROM personas WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM personas WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
