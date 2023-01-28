<?php

class Horarios_model extends CI_Model{


function __construct()
	{
		parent::__construct();
		//date_default_timezone_set('America/Lima');
	}


public function select($idhorario=''){

		if ($idhorario=='') {
			//$res=$this->db->select("TIME_FORMAT('horaentrada', '%T')")
			    //->from("horarios")
			    //->get()
			      //->result();

			$res=$this->db->from("horarios")
                ->get()
                 ->result();
                 return $res;



                  //var_dump($res);
          // $res=$this->db->query("call jjj()")
            //            ->result();
              //   return $res;

           
		
		}else{

        $res=$this->db->from("horarios")
                   ->where("idhorario",$idhorario)
                   ->get()
                   ->row();
                 return $res;  


		}
    



	}


 public function selecthorario($idhorario='')
{

	if($idhorario==''){
	// code...
		$res=$this->db->from("horarios")
                ->get()
                 ->result();
                 return $res;


               }else{
         $res=$this->db->from("horarios")
                   ->where("idhorario",$idhorario)
                   ->get()
                   ->row();
                 return $res;  

             


               }
}




	public function guardar(){
      
      if ($_POST['idhorario']=='') {

      
     
	
		 $datainsert=['horaentrada'=>$_POST['horaentrada'],
                      'horasalida'=>$_POST['horasalida']
                     
		           ];	
                     


		           //var_dump($ver);

           $this->db->insert("horarios",$datainsert);
           return true;

		}else{
           
            $datamodificar=['horaentrada'=>$_POST['horaentrada'],
                            'horasalida'=>$_POST['horasalida']
                           
                     ];

                     
           $this->db->where("idhorario",$_POST['idhorario']);
           $this->db->update("ho
           	rarios",$datamodificar);

           return true;
		}






	}





}