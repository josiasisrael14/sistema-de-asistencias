<?php

/**
 * 
 */
class Departamento extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	   $this->load->model("departamento_model");
	}

  public function index(){

 $this->load->view("templates/header_administrador");
 $this->load->view("layouts1/header");
 $data['departamento']=$this->departamento_model->select();
 $this->load->view("acceso/departamento",$data);
 $this->load->view("layouts1/footer");

  //var_dump($data);

  }


  public  function nuevo(){
 
 $this->load->view("departamento/modal_crear");
  }


  public function guardar(){
     
  	$res=$this->departamento_model->guardar();

  	if ($res) {
  	  echo json_encode(['status'=>STATUS_OK]);
  	  exit();

  	}else{

  		echo json_encode(['status'=>STATUS_FAIL]);
  		exit();
  	}
  }

public function modificar(){

  $iddepartamento=$this->uri->segment(3);
   //var_dump($departamento);exit;
  $data['departamento']=$this->departamento_model->select($iddepartamento);

  $this->load->view("departamento/modal_crear",$data);


}


public function eliminar($iddepartamento){

$result=$this->departamento_model->eliminar($iddepartamento);

if ($result) {
  echo json_encode(['status' => STATUS_OK]);
  exit();
}else{

  echo json_encode(['status' => STATUS_FAIL]);
  exit();
}



}



  



}