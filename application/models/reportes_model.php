<?php

/**
 * 
 */
class Reportes_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function select($fecha_inicio,$fecha_fin,$idusuario){
$res=$this->db->select("as.fecha,as.tipo,as.fecha_hora,as.codigo_persona_as,us.nombre_usuario")
               ->from("asistencia as")
               ->join("usuarios us","as.codigo_persona_as=us.codigo_persona")
               //->where("")
               ->where("fecha >='$fecha_inicio' and fecha <='$fecha_fin'")
            //->where("fecha BETWEEN '$fecha_inicio' and '$fecha_fin'")
            ->where("idusuario",$idusuario)
               ->get()
               ->result();

             return $res;
  //var_dump($res);
           



	}
}