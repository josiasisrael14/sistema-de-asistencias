<?php

/**
 * 
 */
class Reporte extends CI_Controller
{
	
	function __construct()
	{
	    parent::__construct();

	     $this->load->model("usuarios_model");
	     $this->load->model("reportes_model");
	}

	public function index(){
  $this->load->view("templates/header_administrador");
 $this->load->view("layouts1/header");
 $data ['usuario']=$this->usuarios_model->select();
 $this->load->view("reporte/index",$data);
 $this->load->view("layouts1/footer");


	}

	public  function mostrar(){

  $fecha_inicio=$this->input->post("fecha_inicio");
 $fecha_fin=$this->input->post("fecha_fin");
 $idusuario=$this->input->post("idusuario");

$datas=$this->reportes_model->select($fecha_inicio,$fecha_fin,$idusuario);

   
  //$data=array();

  /*while ($tere=mysqli_fetch_object($datas)) {
   $data[]=array(
        "0"=>$tere->fecha,
        "1"=>$tere->nombre_usuario,
        "2"=>$tere->tipo,
        "3"=>$tere->fecha_hora,
        "4"=>$tere->codigo_persona_as
        );
  
    # code...
  }*/
      
foreach ($datas as $value) {

  $data1=array();

  $data1["fecha"]=$value->fecha;
  $data1["nombre_usuario"]=$value->nombre_usuario;
  $data1["tipo"]=$value->tipo;
  $data1["fecha_hora"]=$value->fecha_hora;
  $data1["codigo_persona_as"]=$value->codigo_persona_as;

  $data[]=$data1;
}

$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
    echo json_encode($results);

     }

//var_dump($data);
//$data=Array();

   /*foreach ($reporte as $value) {

     $data=array();

     $array['fecha']=$value['fecha'];
      $array['nombre_usuario']=$value['nombre_usuario'];
       $array['tipo']=$value['tipo'];
         $array['fecha_hora']=$value['fecha_hora'];
          $array['codigo_persona_as']=$value['codigo_persona_as'];
  
          $data[]=$array;

         }*/

      
    /*$data=['fecha'=>$reporte->fecha,
           'nombre_usuario'=>$reporte->nombre_usuario,
           'tipo'=>$reporte->tipo,
           'fecha_hora'=>$reporte->fecha_hora,
            'codigo_persona_as'=>$reporte->codigo_persona_as 
          ];*/


      //var_dump($data);





  



   /*while ($jairo=$datas->mysqli_fetch_object()) {

  $data=array('fecha'=>$jairo->fecha,
              'nombre_usuario'=>$jairo->nombre_usuario,
               'tipo'=>$jairo->tipo,
                'fecha_hora'=>$jairo->fecha_hora,
                'codigo_persona_as'=>$jairo->codigo_persona_as
                        );
         }*/
       
        	# code...
      
        	# code...
        
    /*$data=['fecha'=>$reporte->fecha,
           'nombre_usuario'=>$reporte->nombre_usuario,
           'tipo'=>$reporte->tipo,
           'fecha_hora'=>$reporte->fecha_hora,
            'codigo_persona_as'=>$reporte->codigo_persona_as 
          ];*/

     

 // var_dump($data);
/*while ($jairo=mysqli_fetch_object($datas)) {

	$data[]=array(
		    '0'=>$jairo->fecha,
		    '1'=>$jairo->nombre_usuario,
		    '2'=>$jairo->tipo,
		    '3'=>$jairo->fecha_hora,
		    '4'=>$jairo->codigo_persona_as
	             );
               }*/

//var_dump($data);

               

 

}




          



/*if ($this->input->is_ajax_request()) {

  $fecha_inicio=$this->input->post("fecha_inicio");
 $fecha_fin=$this->input->post("fecha_fin");
 $idusuario=$this->input->post("idusuario");

$data['reporte']=$this->reportes_model->select($fecha_inicio,$fecha_fin,$idusuario);


//var_dump($data);

//echo json_encode($data['reporte']);

	# code...
}
else{
	show_404();
}*/



 /*$fecha_inicio=$this->input->post("fecha_inicio");
 $fecha_fin=$this->input->post("fecha_fin");
 $idusuario=$this->input->post("idusuario");

$data['reporte']=$this->reportes_model->select($fecha_inicio,$fecha_fin,$idusuario);*/
//$data=$this->reportes_model->select();
//var_dump($data);
//$this->load->view("templates/header_administrador");
 //$this->load->view("layouts1/header");
//$this->load->view("templates/header_administrador");
 //$this->load->view("reporte/index",$data);
 // $this->load->view('templates/footer');
     //$this->load->view("layouts1/footer");  

		//var_dump ($data);
		//var_dump ($fin);
		//var_dump ($usuario);

	