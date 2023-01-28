<?php

/**
 * 
 */
class Asistencia extends CI_Controller
{
	
	function __construct()
	{
	
   parent::__construct();
   $this->load->model("asistencia_model");

	}

	public function index(){
   
  $this->load->view("templates/header_administrador");
 $this->load->view("layouts1/header");
  $data['asistencia']=$this->asistencia_model->select();
 //var_dump($data);
 $this->load->view("asistencia/index",$data);
 $this->load->view("layouts1/footer");



	}


	
}