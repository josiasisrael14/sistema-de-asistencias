<?php

/**
 * 
 */

class Asistencia_model extends CI_Model 
{


	
	function __construct()
	{
		parent::__construct();
    //use CodeIgniter\I18n\Time;

	}

	public function select(){

 $res=$this->db->select("as.codigo_persona_as,us.nombre_usuario,dep.nombre,as.fecha_hora,as.tipo,as.fecha,as.TardeTemprano")
                   ->from("asistencia as")
                 

                   ->join("usuarios us","as.codigo_persona_as=us.codigo_persona")
                   ->join("departamento dep","dep.iddepartamento=us.iddepartamento")

                   ->where("us.estado",ST_ACTIVO)
               //   ->order_by("as.idasistencia","desc")
                  // ->orderBy("as.idasistencia","desc")
                   ->get()
                   ->result();
                 
              //var_dump($res);
     return $res;

	}


  public function select1($codigo_persona='',$tipo='',$tipo1=''){


      # code...
  $results=$this->db->query("call SP_TARDANZA('$codigo_persona')");
  $rss=$results->result();
$results->free_result();
$results->next_result();

  if($rss){
 foreach($rss as $indice){

   $id=$indice->idhorario;
   $codigo=$indice->codigo_persona;
   $horaingreso=$indice->horaentrada;
 }

//var_dump($id);
//var_dump($codigo);
//var_dump($horaingreso);


  }else{


    return false;
  }

    
 $res=$this->db->select("us.codigo_persona, us.nombre_usuario,dep.nombre")

// $res=$this->db->select("us.codigo_persona, us.nombre_usuario,dep.nombre,as.fecha_hora,as.tipo,as.fecha")

                     ->from("usuarios us")
                    // ->from("asistencia as")
                   //->join("asistencia as","as.codigo_persona_as=us.codigo_persona")
                   ->join("departamento dep","dep.iddepartamento=us.iddepartamento")
                   ->where("us.codigo_persona",$codigo_persona)
                   ->where("us.estado",ST_ACTIVO)
                   ->get()
                   ->row();

                
                 // var_dump($res);
              //$hora->format('G:a');
                 //$fechacon= new time('now');
                 //$fechacon->format('G');  
                $fechacon=date("H:i:s");

              // var_dump($fechacon);
              //var_dump($horaingreso);
              if ($res) {

                if($fechacon>$horaingreso){



                
               
                  $tipo='entrada';
                   $fecha=date('Y-m-d H:i:s');
               $fecha1=date('Y-m-d');
              $datas=['codigo_persona_as'=>$_POST['codigo_persona'],
                     'fecha_hora'=>$fecha,
                     'tipo'=>$tipo,
                     'fecha'=>$fecha1,
                     'TardeTemprano'=>'Tarde'
                      ];
             

                $mostrar=['codigo_persona_as'=>$_POST['codigo_persona'],
                     'fecha_hora'=>$fecha,
                     'tipo'=>$tipo,
                     'fecha'=>$fecha1,
                     'nombre_usuarioss'=>$res->nombre_usuario,
                     'TardeTemprano'=>'Tarde'
                      ];

                /*var_dump($mostrar);*/
    $this->db->insert("asistencia",$datas);
    //$this->session->set_flashdata('mensaje','inciando session');

     //$this->session->set_userdata($datas);
      return $mostrar; 

    }


    if($fechacon<=$horaingreso){

  $tipo='entrada';
                   $fecha=date('Y-m-d H:i:s');
               $fecha1=date('Y-m-d');
              $datas=['codigo_persona_as'=>$_POST['codigo_persona'],
                     'fecha_hora'=>$fecha,
                     'tipo'=>$tipo,
                     'fecha'=>$fecha1,
                     'TardeTemprano'=>'Temprano'
                      ];
             

                $mostrar=['codigo_persona_as'=>$_POST['codigo_persona'],
                     'fecha_hora'=>$fecha,
                     'tipo'=>$tipo,
                     'fecha'=>$fecha1,
                     'nombre_usuarioss'=>$res->nombre_usuario,
                     'TardeTemprano'=>'Temprano'
                      ];

                /*var_dump($mostrar);*/
    $this->db->insert("asistencia",$datas);
  
      return $mostrar; 







    }

                }
                 
                else{

                 return false;

              }


 

              }
            
  public function salida($codigo_persona='',$tipo='',$tipo1=''){

      //$res=$this->db->select("     us.codigo_persona,us.nombre_usuario,dep.nombre,as.fecha_hora,as.tipo,as.fecha")
      $res=$this->db->select("us.codigo_persona, us.nombre_usuario,dep.nombre")
                    ->from("usuarios us")
                     //->from(" asistencia as")
                  // ->join("asistencia as","as.codigo_persona=us.codigo_persona")
                   ->join("departamento dep","dep.iddepartamento=us.iddepartamento")
                   ->where("us.codigo_persona",$codigo_persona)
                   ->where("us.estado",ST_ACTIVO)
                   ->get()
                   ->row();
           

          



         if ($res) {
               
                  $tipo='salida';
                   $fecha=date('Y-m-d H:i:s');
        $fecha1=date('Y-m-d');
              $data=['codigo_persona_as'=>$_POST['codigo_persona'],
                     'fecha_hora'=>$fecha,
                     'tipo'=>$tipo,
                     'fecha'=>$fecha1
                      ];

             $mostrar=['codigo_persona_as'=>$_POST['codigo_persona'],
                     'fecha_horas'=>$fecha,
                     'tipos'=>$tipo,
                     'fecha'=>$fecha1,
                     'usuarios'=>$res->nombre_usuario
                      ];


     $this->db->insert("asistencia",$data);
     //$this->session->set_userdata($mostrar);
      return $mostrar; 

                }
                 
                else{

                 return false;

              }





  }




  public function UltimoRegistro($codigo_persona=''){


   $result=$this->db->query("call SP_ULTIMOREGISTROENTRADA('$codigo_persona')");

   if($result){

$rs=$result->result();
$result->free_result();
$result->next_result();

   }
                  
                   //->result(); 
              //  ->free_result();
                  
                   

                    return $rs;
                   
//var_dump($result);


  }



public function UltimoRegistroS($codigo_persona=''){


   $result=$this->db->query("call SP_ULTIMOREGISTROSALIDA('$codigo_persona')");

   if($result){

$rs=$result->result();
$result->free_result();
$result->next_result();

   }
                  
                   //->result(); 
              //  ->free_result();
                  
                   

                    return $rs;
                   
//var_dump($rs);


  }


             
  
              
       
     

  }


 /* public function select1(){
 $res=$this->db->select("as.codigo_persona,us.nombre,dep.nombre,as.fecha_hora,as.tipo,as.fecha")
                    ->from("asistencia as")
                   ->join("usuarios us","as.codigo_persona=us.codigo_persona")
                   ->join("departamento dep","dep.iddepartamento=us.iddepartamento")
                   ->get()
                   ->row();
  //var_dump($res);              
             


    if ($res->codigo_persona==$_POST['codigo_persona']) {

    	
        $fecha=date('Y-m-d H:i:s');
        $fecha1=date('Y-m-d');
    	$data=['codigo_persona'=>$_POST['codigo_persona'],
    	       //'nombre'=>$res->nombre,
    	       //'nombre'=>$res->nombre,
               'fecha_hora'=>$fecha,
               'tipo'=>$res->tipo,
               'fecha'=>$fecha1

              ];
     $this->db->insert("asistencia",$data);
     $this->session->set_userdata($data);
    

     return true; 

    }else{

     //$this->session->set_flashdata('mensaje','no existe ');
      
        $this->session->set_flashdata('mensaje','No podras entrar por tonto ');

                  return false;
    }
               


	}
*/








