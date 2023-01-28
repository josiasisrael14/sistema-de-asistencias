  <?PHP
class Acceso extends CI_Controller
{	
	public function __construct()
	{
		parent::__construct();

    $this->load->model("empleados_model");
    $this->load->model("usuarios_model");
    $this->load->model("departamento_model");
    $this->load->model("tipos_usuarios_model");
    $this->load->model("asistencia_model");
     $this->load->model("contar_model");
   
		 
		
	}



public function index(){
    
 $this->load->view('templates/header_administrador');
  $this->load->view("acceso/login");
$this->load->view('templates/footer');


  

}


public function  validar(){
 
 $login=$_POST['login'];
 $password=$_POST['password'];

 

 if ($this->empleados_model->login($login,$password)) {

 	redirect(base_url(). "index.php/acceso/escritorio");
 }
 else{

 	redirect("acceso");
 }



}





public function escritorio(){



 $this->load->view("templates/header_administrador");
 $this->load->view("layouts1/header");

$resul['departamento']=$this->contar_model->contarD();
$resul['usuarios']=$this->contar_model->contarU();
$resul['tipousuario']=$this->contar_model->contarT();

$resul['tarde']=$this->contar_model->ContarTarde();
$resul['temprano']=$this->contar_model->ContarTemprano();
//var_dump($tarde);
//$resultD=$this->contar_model->contarD();
//$resultD=$this->contar_model->contarT();
$this->load->view("acceso/escritorio",$resul);
 $this->load->view("layouts1/footer");

}


public  function usuario(){

   

$this->load->view("templates/header_administrador");
 $this->load->view("layouts1/header");
 $data['usuario']=$this->usuarios_model->select();
$this->load->view("acceso/index",$data);
$this->load->view("layouts1/footer");

}


public  function nuevo(){
//$data['departamento']=$this->empleados_model->login();
$data['tipousuario']=$this->tipos_usuarios_model->select();  
//$data['usuarios']=$this->usuarios_model->select();
$data['departamento']=$this->departamento_model->select();
$data['titulo']='subir imagen';
	//$data=$this->usuarios_model->select1();
	//var_dump($data);exit;
 $this->load->view("acceso/modal_crear",$data);
 
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





public function cerrar(){
$this->session->sess_destroy();
  redirect("acceso");


}


public function tipousuario(){
$this->load->view("templates/header_administrador");
 $this->load->view("layouts1/header");
 $data['tipousuario']=$this->tipos_usuarios_model->select();
$this->load->view("tipo_usuario/index",$data);
$this->load->view("layouts1/footer");


} 


public  function nuevotipousuario(){

$this->load->view("tipo_usuario/modal_crear");

}

public function guardartipousuario(){

  $res=$this->tipos_usuarios_model->guardar_tipo();
  if ($res) {
  echo json_encode(['status'=>STATUS_OK]);
  exit();
  }else{

echo json_encode(['status'=>STATUS_FAIL]);
  exit();

  }
}

public  function modificar_tipousuario(){

$result=$this->uri->segment(3);
//var_dump($result);exit;
$data['idtipousuario']=$this->tipos_usuarios_model->select($result);

$this->load->view("tipo_usuario/modal_crear",$data);

}

public  function eliminar_tipousuario($idtipousuario){

$result=$this->tipos_usuarios_model->eliminar($idtipousuario);


if ($result) {
  echo json_encode(['status' => STATUS_OK]);
  exit();
}else{

  echo json_encode(['status' => STATUS_FAIL]);
  exit();
}

}

public function registro(){

$this->load->view("templates/header_administrador");

$this->load->view("acceso/registro");
$this->load->view('templates/footer');



}


public  function asistencia_g(){

 $fechass=date('Y-m-d');
 $fecha2=date('Y-m-d');
 
   $res=$this->input->post("codigo_persona");

  //$result=$this->asistencia_model->select1($res);
  $result1=$this->asistencia_model->UltimoRegistro($res);

   foreach($result1 as $inprimir){

    $fechaD=$inprimir->fecha;
    $tipo=$inprimir->tipo;
   
   }

   //var_dump($fecha2);
   //var_dump($result1);

   if($fechaD==$fecha2 && $tipo='entrada'){


  echo json_encode(['status'=>MENSAJE]);
  exit();

   }


   else{


   

  $result=$this->asistencia_model->select1($res);

   if($result){

    

     //echo json_encode($result);
     echo json_encode(['status' => STATUS_OK,$result]);
     exit();
    
   }else{

    echo json_encode(['status' => STATUS_FAIL]);
    exit();
   }




   }





  
}

public function asistencia_salida(){

 $fecha2=date('Y-m-d');


$res=$this->input->post("codigo_persona");
 $result1=$this->asistencia_model->UltimoRegistroS($res);

//var_dump($result1);

   foreach($result1 as $inprimir){

    $fechaD=$inprimir->fecha;
    $tipo=$inprimir->tipo;
   
   }

  if($fechaD==$fecha2 && $tipo='salida'){

 
//$data['mensaje']='usuario registro asistencia';


  echo json_encode(['status'=>MENSAJE]);
  exit();




   }else{



//var_dump($res);
$result=$this->asistencia_model->salida($res);



if ($result) {
     echo json_encode(['status' => STATUS_OK,$result]);
     exit();
   }else{

    echo json_encode(['status' => STATUS_FAIL]);
    exit();
   }





}



}

public function cerrarsesionregistro(){





//$this->session->sess_destroy();
//$this->load->view("templates/header_administrador");
//$this->load->view("acceso/registro");
//$this->load->view('templates/footer');
redirect('acceso/registro');       


//redirect('redirect/computer_graphics'); 

//$this->session->unset_userdata('codigo_persona_as');
//$this->session->unset_userdata('fecha_hora');
//$this->session->unset_userdata('tipo');



}



public function modificar_usuario(){
$usuarios=$this->uri->segment(3);
//var_dump($id);
$data['departamento']=$this->departamento_model->select();
$data['tipousuario']=$this->tipos_usuarios_model->select(); 
$data['usuarios']=$this->usuarios_model->select($usuarios);
//$this->load->view("templates/header_administrador");
$this->load->view("acceso/modal_crear",$data);
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