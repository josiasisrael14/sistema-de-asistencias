<?php

class Horarios extends CI_Controller{

function __construct()
	{
		parent::__construct();
	   $this->load->model("horarios_model");
	}

public function index(){

$this->load->view("templates/header_administrador");
 $this->load->view("layouts1/header");
$data['horario']=$this->horarios_model->select();


//var_dump($data->horaentrada);
 $this->load->view("tiempo/horario",$data);
 $this->load->view("layouts1/footer");




}


public  function nuevo(){
 $this->load->view("layouts1/timeestilos");
 $this->load->view("tiempo/modal_crear");
 $this->load->view("layouts1/time");
  }


public function guardar(){
$res=$this->horarios_model->guardar();

  	if ($res) {
  	  echo json_encode(['status'=>STATUS_OK]);
  	  exit();

  	}else{

  		echo json_encode(['status'=>STATUS_FAIL]);
  		exit();
  	}


}





}
