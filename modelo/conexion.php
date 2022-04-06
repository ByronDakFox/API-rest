<?php 
class coneccion{
    private $server="localhost";
    private $database="practicaprograma";
    private $user="root";
    private $paswd="";


    private $conec;

    public function __construct(){

    $this->server="localhost";
    $this->database="practicaprograma";
    $this->user="root";
    $this->paswd="";

    }
    
    public function getConeccion()
    {
        //$this->conec = mysqli_connect($this->server, $this->user, $this->paswd, $this->database);
        try {
            $this->conec = new PDO("mysql:host=" . $this->server . ";dbname=" . $this->database, $this->user, $this->paswd);
            $this->conec->exec("set names utf8");
            
            //echo ("Conección exitosa");
            return $this->conec;
        } catch (PDOException $ex) {
            echo "Error en la coneccion: " . $ex->getMessage();
        }
    }


    /*public function getPersonas(){
        $consulta="Select*from personas;";
        //$resultado=mysqli_query($this->getConeccion(), $consulta) or die("Algo salio mal, no puede sacar los datos");
        $temp=$this->getConeccion()->prepare($consulta);
        $temp->execute();
        return $temp;
    }
    */
}