<?php

/**
 * 
 */
class Contar_model extends CI_Model 
{
	
	function __construct()
	{
		parent::__construct();
	}

	

/*
  public function contar(){

   $filas=$this->db->count_all_results('usuarios');
    //var_dump($filas);
      $cfilas=[
                'filas'=>$filas
                      ];


     $this->session->set_userdata($cfilas);

     $filass=$this->db->count_all_results('departamento');
    //var_dump($filas);
      $cfilasD=[
                'filasD'=>$filass
                      ];


     $this->session->set_userdata($cfilasD);

    
      $filasss=$this->db->count_all_results('tipousuario');
    //var_dump($filas);
      $cfilasT=[
                'filasT'=>$filasss
                      ];


     $this->session->set_userdata($cfilasT);

       return true; 

  }


*/






  public function contarD(){
  

   $res=$this->db->select("count(*) as total")
                 ->get("departamento")
                 ->row();

                 return $res;



  }
             
  
              

   public function contarT(){
  

   
$res=$this->db->select("count(*) as total")
                 ->get("tipousuario")
                 ->row();

                 return $res;



  }




  public function contarU(){

$res=$this->db->select("count(*) as total")
                 ->get("usuarios")
                 ->row();

                 return $res;




  }




  public function ContarTarde(){

    $res=$this->db->select("count(*) as total")
                    ->where("TardeTemprano='Tarde'")
                    ->get("asistencia")
                    ->row();


                    return $res;

  //con el procedimento almacenado no me salio , quizas iba a demorar mas y no tengo tiempo asi que de la otra forma nomas mas rapido me salio en 5 minutos
    /*$contartarde=array();
    $contartarde=$this->db->query("call SP_CONTARTARDE");
    $rs=$contartarde->result();
    $contartarde->free_result();
    $contartarde->next_result();
    


    return $rs;*/


  }


  public function ContarTemprano(){



    $res=$this->db->select("count(*) as total")
                  ->where("TardeTemprano='Temprano'")
                  ->get("asistencia")
                  ->row();


                  return $res;
/*
    $contartarde=$this->db->query("call SP_TEMPRANO");
    $res=$contartarde->result();
    $contartarde->free_result();
    $contartarde->next_result();
   
    return $res;
    */


  }
                 
       
     

  }


 