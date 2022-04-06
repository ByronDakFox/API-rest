<?php
class persona{

    private $idPersona;
    private $cedula;
    private $nombre;
    private $ciudad;

    private $con;

    function __construct($con){
        $this->con=$con;
    }

    function getIdPersonas(){
        return $this->idPersona;
    }

    function setIdPersonas($idPersona){
    $this->idPersona=$idPersona;
    }

    //* metodos de CRUD a la base

    public function getPersonas(){
        $consulta="SELECT * FROM personas";
        $temp=$this->con->prepare($consulta);
        $temp->execute();
        return $temp;
    }

    public function buscarPersonas($nom){
        //$n="Juan";
        $consulta="SELECT * FROM personas WHERE nombre= ?";
        $temp=$this->con->prepare($consulta);
        $temp->execute(array($nom));
        return $temp;
    }

    //SELECT * FROM personas ORDER BY personas.idPersona DESC LIMIT 1

    public function SelectP(){
        //$n="Juan";
        $consulta="SELECT P.cedula, P.nombre, P.ciudad, M.especie FROM mascota M JOIN personas P ON M.idm= P.idM";
        $temp=$this->con->prepare($consulta);
        $temp->execute();
        return $temp;
    }


    public function insertPersonas($ci,$nom,$c){

        $consulta="INSERT INTO personas(cedula, nombre, ciudad, idM) VALUES (?,?,?,?)";
        $temp=$this->con->prepare($consulta);
        $temp->execute(array($ci, $nom, $c, $idM));
    }

    //INSERT INTO mascota( especie, nombreM, idP) VALUES ()

    public function insertMascota($ci,$nom,$c,$idM){

        $consulta="INSERT INTO personas(cedula, nombre, ciudad, idM) VALUES (?,?,?,?)";
        $temp=$this->con->prepare($consulta);
        $temp->execute(array($ci, $nom, $c, $idM));
        //return $temp;
    }

    public function updatePersonas($ci,$nom,$c,$id){

        $consulta="UPDATE personas SET cedula= ?,nombre= ?,ciudad= ? WHERE idPersona= ?";
        $temp=$this->con->prepare($consulta);
        $temp->execute(array($ci, $nom, $c, $id));
        //return $temp;
    }

    public function deletePersonas($id){

        $consulta="DELETE FROM personas WHERE idPersona= ?";
        $temp=$this->con->prepare($consulta);
        $temp->execute(array($id));
        return $temp;
    }
}