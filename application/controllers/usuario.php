<?php 

/**
 * 
 */
class Usuario extends CI_Controller
{
	
	function __construct()
	{
	
   parent::__construct();
    $this->load->model("empleados_model");
    $this->load->model("usuarios_model");
    $this->load->model("departamento_model");
    $this->load->model("tipos_usuarios_model");
    $this->load->model("asistencia_model");
     $this->load->model("horarios_model");

	}

  public  function usuario(){
$this->load->view("templates/header_administrador");
 $this->load->view("layouts1/header");
 $data['usuario']=$this->usuarios_model->select();
$this->load->view("usuario/index",$data);
$this->load->view("layouts1/footer");

}


public  function nuevo(){
//$data['departamento']=$this->empleados_model->login();
$data['tipousuario']=$this->tipos_usuarios_model->select();  
//$data['usuarios']=$this->usuarios_model->select();
$data['departamento']=$this->departamento_model->select();
$data['horario']=$this->horarios_model->selecthorario();
$data['titulo']='subir imagen';
	//$data=$this->usuarios_model->select1();
	//var_dump($data);exit;
 $this->load->view("usuario/modal_crear",$data);
 
}


public function guardar(){

//var_dump ($_POST);
//var_dump ($_FILES);
$result=$this->usuarios_model->guardar();



if ($result) {
	echo  json_encode(['status'=>STATUS_OK]);
	exit();


}else{
   
   echo json_encode(['status'=>STATUS_FAIL]);
   exit();

}



}


public function modificar_usuario(){
$usuarios=$this->uri->segment(3);
//var_dump($id);
$data['departamento']=$this->departamento_model->select();
$data['tipousuario']=$this->tipos_usuarios_model->select(); 
$data['usuarios']=$this->usuarios_model->select($usuarios);
$data['horario']=$this->horarios_model->selecthorario();
//$this->load->view("templates/header_administrador");
$this->load->view("usuario/modal_crear",$data);
//$this->load->view('templates/footer');

/*$data['usuarios']=$this->usuarios_model->select($productos);  
$this->load->view("usuarios/modal_crear",$data);*/


}



public  function eliminar($idusuario){

//$idusuario=$this->uri->segment(3);

//var_dump($idusuario);exit();
$result=$this->usuarios_model->eliminar($idusuario);


if ($result) {
  echo json_encode(['status' => STATUS_OK]);
  exit();
}else{

  echo json_encode(['status' => STATUS_FAIL]);
  exit();
}

}



}