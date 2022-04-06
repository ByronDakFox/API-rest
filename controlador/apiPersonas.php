<?php

$tipoProtocolo=$_SERVER['REQUEST_METHOD'];
//echo($tipoProtocolo);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); // se puede cambiar a XML

include_once '../modelo/conexion.php';
include_once'../modelo/persona.php';

$objBDD=new coneccion();
$objCon=$objBDD->getConeccion();

$objPersona=new persona($objCon);

switch($tipoProtocolo){
/*case 'GET':
            $datosPersona=$objPersona->getPersonas();
            $numPersonas=$datosPersona->rowCount();

            if($numPersonas>0)
            {
                $vectorPersonas=array();

                while($fila=$datosPersona->fetch(PDO::FETCH_ASSOC))
                {
                    extract($fila);
                    $aux=array(
                        "idPersona"=>$fila['idPersona'],
                        "cedula"=>$fila['cedula'],
                        "nombre"=>$fila['nombre'],
                        "ciudad"=>$fila['ciudad']
                    );
                    array_push($vectorPersonas, $aux);
                }
                echo json_encode($vectorPersonas);
            }
    break;
    */
    case 'GET':          

        $vectorPersonas=array();
        if (isset($_GET['nombre'])) {
        
        $resul=$_GET['nombre'];
        $datosPersona=$objPersona->buscarPersonas($resul);
        $numPersonas=$datosPersona->rowCount();

            if($numPersonas>0)
            {

                while($fila=$datosPersona->fetch(PDO::FETCH_ASSOC))
                {
                    extract($fila);
                    $aux=array(
                        "idPersona"=>$fila['idPersona'],
                        "cedula"=>$fila['cedula'],
                        "nombre"=>$fila['nombre'],
                        "ciudad"=>$fila['ciudad']
                    );
                    array_push($vectorPersonas, $aux);
                }
                echo json_encode($vectorPersonas);
            }
        }else{
            $datosPersona=$objPersona->getPersonas();
            $numPersonas=$datosPersona->rowCount();

            if($numPersonas>0)
            {

                while($fila=$datosPersona->fetch(PDO::FETCH_ASSOC))
                {
                    extract($fila);
                    $aux=array(
                        "idPersona"=>$fila['idPersona'],
                        "cedula"=>$fila['cedula'],
                        "nombre"=>$fila['nombre'],
                        "ciudad"=>$fila['ciudad']
                    );
                    array_push($vectorPersonas, $aux);
                }
                echo json_encode($vectorPersonas);
            }
        }
            
    break;

    case 'POST':
    $_POST=json_decode(file_get_contents('php://input'),true);
    if (isset($_POST['cedula'],$_POST['nombre'],$_POST['ciudad'])) {

        $ci=$_POST['cedula'];
        $n=$_POST['nombre'];
        $c=$_POST['ciudad'];
        $num=$_POST['idM'];

        $datosPersona=$objPersona->insertMascota($ci,$n,$c,$num);
        $datosPersona=$objPersona->SelectP();
        $numPersonas=$datosPersona->rowCount();

            if($numPersonas>0)
            {
                $vectorPersonas=array();

                while($fila=$datosPersona->fetch(PDO::FETCH_ASSOC))
                {
                    extract($fila);
                    $aux=array(
                        "cedula"=>$fila['cedula'],
                        "nombre"=>$fila['nombre'],
                        "ciudad"=>$fila['ciudad'],
                        "especie"=>$fila['especie']
                    );
                    array_push($vectorPersonas, $aux);
                }
                echo json_encode($vectorPersonas);
            }
    }else{
        echo "Información no guardado";
    }
    
    break;

    case 'PUT':
        
        $_PUT=json_decode(file_get_contents('php://input'),true);
    if (isset($_PUT['cedula'],$_PUT['nombre'],$_PUT['ciudad'])) {

        $ci=$_PUT['cedula'];
        $n=$_PUT['nombre'];
        $c=$_PUT['ciudad'];
        $id=$_GET['id'];
        //echo "Actualizar".$ci."||".$id;
        $datosPersona=$objPersona->updatePersonas($ci,$n,$c,$id);
        $datosPersona=$objPersona->getPersonas();
        $numPersonas=$datosPersona->rowCount();
        if($numPersonas>0)
            {
                $vectorPersonas=array();

                while($fila=$datosPersona->fetch(PDO::FETCH_ASSOC))
                {
                    extract($fila);
                    $aux=array(
                        "idPersona"=>$fila['idPersona'],
                        "cedula"=>$fila['cedula'],
                        "nombre"=>$fila['nombre'],
                        "ciudad"=>$fila['ciudad']
                    );
                    array_push($vectorPersonas, $aux);
                }
                echo json_encode($vectorPersonas);
            }
    }else{
        echo "Datos no actualizados";
    }
    break;

    case 'DELETE':

    if (isset($_GET['ids'])) {
        
        $ids=$_GET['ids'];
        //echo "Datos eliminado".$resul;
        $datosPersona=$objPersona->deletePersonas($ids);
        $datosPersona=$objPersona->getPersonas();
        $numPersonas=$datosPersona->rowCount();

            if($numPersonas>0)
            {
                $vectorPersonas=array();

                while($fila=$datosPersona->fetch(PDO::FETCH_ASSOC))
                {
                    extract($fila);
                    $aux=array(
                        "idPersona"=>$fila['idPersona'],
                        "cedula"=>$fila['cedula'],
                        "nombre"=>$fila['nombre'],
                        "ciudad"=>$fila['ciudad']
                    );
                    array_push($vectorPersonas, $aux);
                }
                echo json_encode($vectorPersonas);
            }
    }else{
        echo "No se puedo eliminar"; 
    }
    
    break;

}