<?php
/**
 * 
 */
class Tipos_usuarios_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function select($idtipousuario=''){

    if ($idtipousuario=='') {
       $res=$this->db->from("tipousuario")
                  ->get()
                  ->result();

              return $res;    

    }
    else{
     $res=$this->db->from("tipousuario")
                  ->where("idtipousuario",$idtipousuario)
                  ->get()
                  ->row();

              return $res;    



    }

   


	}


	public function guardar_tipo(){
 
   if ($_POST['idtipousuario']=='') {
   	 $fecha=date('Y-m-d H:i:s');
   	 $datainsert=['nombre'=>$_POST['nombre'],
   	              'descripcion'=>$_POST['descripcion'],
   	              'fechacreada'=>$fecha,
   	              'idusuario'=>$this->session->userdata('idusuario')
             
                   ];
  
            $this->db->insert("tipousuario",$datainsert);
            return true;
   }else{
      $fecha=date('Y-m-d H:i:s');
      $datamodificar=['nombre'=>$_POST['nombre'],
                      'descripcion'=>$_POST['descripcion'],
                      'fechacreada'=>$fecha,
                      'idusuario'=>$this->session->userdata('idusuario')

                      ];
             $this->db->where("idtipousuario",$_POST['idtipousuario']);
             $this->db->update("tipousuario",$datamodificar);
             return true;


   }



	}


  public  function eliminar($idtipousuario=''){

   $this->db->where("idtipousuario",$idtipousuario);
   $this->db->delete("tipousuario");
   return  true;

  }


	
}