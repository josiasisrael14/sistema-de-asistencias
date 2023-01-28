<?php
/**
 * 
 */
class Usuarios_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
    date_default_timezone_set('America/Lima');
	}

  public function select($usuarios=''){

  	    if($usuarios==''){
      $res=$this->db->select("u.idusuario,u.nombre_usuario ,u.apellidos, d.nombre,u.email,u.imagen,h.horaentrada,h.horasalida")
                    ->from("usuarios u")
                    ->join("departamento d","u.iddepartamento=d.iddepartamento")
                    ->join("horarios h","h.idhorario=u.idhorario")
                    ->where("estado",ST_ACTIVO)
                    ->get()
                     ->result();

                return $res; 


  	}else{

  		 $res=$this->db->from("usuarios")
  		                ->where("idusuario",$usuarios)
                       ->get()
                       ->row();

                return $res; 

  	}
  

  }









  public  function select1(){

  $result=$this->db->from("usuarios us")                 
                    ->join("departamento dep","us.iddepartamento=dep.iddepartamento")
                    ->get()
                    ->row();
             return $result;   
             //var_dump($result);exit;   

  }


  public function guardar(){


  $carpeta='imagenes1/';
  opendir($carpeta);
  $destino=$carpeta.$_FILES['archivoImagen']['name'];
 //  copy($_FILES['archivoImagen']['tmp_name'],$destino);


  if ($_POST['idusuario']=='') {
$fecha=date('Y-m-d H:i:s');
$datainsert= array(
            'idusuario' => $_POST['idusuario'],
            'idtipousuario'=>$_POST['idtipousuario'],
            'iddepartamento'=>$_POST['iddepartamento'],
            'nombre_usuario' =>$_POST['nombre'],
            'apellidos' => $_POST['apellidos'],
            'login'=>$_POST['login'],
            'email'=>$_POST['email'],
            'imagen'=>$_FILES['archivoImagen']['name'],
            'password'=>$_POST['password'],
            'codigo_persona'=>$_POST['codigo_persona'],
            'idhorario'=>$_POST['idhorario'],
            'fechacreado'=>$fecha,
            'estado'=>ST_ACTIVO
          );
     $this->db->insert("usuarios",$datainsert);
     // si pongo la session cada ves que agrego un usuario se va actualizar automaticamente y eso no quiero 
     //$this->session->set_userdata($datainsert);

     return true;
  }else{
      if ($_FILES['archivoImagen']['tmp_name']=='') {

        $fecha=date('Y-m-d H:i:s');
$datamodificar= array(
            'idusuario' => $_POST['idusuario'],
           'idtipousuario'=>$_POST['idtipousuario'],
            'iddepartamento'=>$_POST['iddepartamento'],
            'nombre_usuario' =>$_POST['nombre'],
            'apellidos' => $_POST['apellidos'],
            'login'=>$_POST['login'],
            'email'=>$_POST['email'],
           // 'imagen'=>$_FILES['archivoImagen']['name'],
            'password'=>$_POST['password'],
            'codigo_persona'=>$_POST['codigo_persona'],
            'idhorario'=>$_POST['idhorario'],
            'fechacreado'=>$fecha,
            'estado'=>ST_ACTIVO
          );

    $this->db->where("idusuario",$_POST['idusuario']);
    $this->db->update("usuarios",$datamodificar);

    return  true;

        # code...
      }else{

    $fecha=date('Y-m-d H:i:s');
$datamodificar= array(
            'idusuario' => $_POST['idusuario'],
           'idtipousuario'=>$_POST['idtipousuario'],
            'iddepartamento'=>$_POST['iddepartamento'],
            'nombre_usuario' =>$_POST['nombre'],
            'apellidos' => $_POST['apellidos'],
            'login'=>$_POST['login'],
            'email'=>$_POST['email'],
            'imagen'=>$_FILES['archivoImagen']['name'],
            'password'=>$_POST['password'],
            'codigo_persona'=>$_POST['codigo_persona'],
            'idhorario'=>$_POST['idhorario'],
            'fechacreado'=>$fecha,
            'estado'=>ST_ACTIVO
          );

    $this->db->where("idusuario",$_POST['idusuario']);
    $this->db->update("usuarios",$datamodificar);

    return  true;

  }
  }


  }


public  function eliminar($idusuario){

$idusuarios =[
            "estado"=>ST_ELIMINADO

              ];
           $this->db->where("idusuario",$idusuario);
           $this->db->update("usuarios",$idusuarios);
           return true;

}


  
    



}