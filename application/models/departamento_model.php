<?php

/**
 * 
 */
class Departamento_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('America/Lima');
	}

	public function select($iddepartamento=''){

		if ($iddepartamento=='') {

			 $res=$this->db->from("departamento")
                   ->get()
                   ->result();
                 return $res;  
		
		}else{

        $res=$this->db->from("departamento")
                   ->where("iddepartamento",$iddepartamento)
                   ->get()
                   ->row();
                 return $res;  


		}
    



	}



	public function  guardar(){

		if ($_POST['iddepartamento']=='') {
		 $fecha=date('Y-m-d H:i:s');
		 $datainsert=['nombre'=>$_POST['nombre'],
                      'descripcion'=>$_POST['descripcion'],
                      'fechacreada'=>$fecha,
                      'idusuario'=>$this->session->userdata('idusuario')
		           ];	

           $this->db->insert("departamento",$datainsert);
           return true;

		}else{
            $fecha=date('Y-m-d H:i:s');
            $datamodificar=['nombre'=>$_POST['nombre'],
                            'descripcion'=>$_POST['descripcion'],
                            'fechacreada'=>$fecha,
                            'idusuario'=>$this->session->userdata('idusuario')

                     ];

                     
           $this->db->where("iddepartamento",$_POST['iddepartamento']);
           $this->db->update("departamento",$datamodificar);

           return true;

		}



   


	}


	public function eliminar($iddepartamento=''){

    $this->db->where("iddepartamento",$iddepartamento);
    $this->db->delete("departamento");
    return true;
   

	}




	
}