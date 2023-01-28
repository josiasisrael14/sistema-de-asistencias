<?php

/**
 * 
 */
class Empleados_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public  function login($login,$password){

  $res=$this->db->select("u.codigo_persona,u.idusuario,u.nombre_usuario,u.password, tip.nombre,u.apellidos,u.login,u.idtipousuario,u.iddepartamento,u.email,u.imagen")
                 ->from('usuarios u')
                 ->join('tipousuario tip','tip.idtipousuario=u.idtipousuario')
                 ->where('u.login',$login)
                 ->where('u.password',$password)
                 ->where('u.estado',ST_ACTIVO)
                 ->get()
                 ->row();

    if($res){

  $data=['codigo_persona'=>$res->codigo_persona,
         'idusuario'=>$res->idusuario,
         'nombre_usuario'=>$res->nombre_usuario,
         'apellidos'=>$res->apellidos,
         'login'=>$res->login,
         'idtipousuario'=>$res->idtipousuario,
         'iddepartamento'=>$res->iddepartamento,
         'email'=>$res->email,
         'imagen'=>$res->imagen
        
      ];

      $this->session->set_userdata($data);
      $this->session->set_flashdata('mensaje','iniciando session');
      return $res->idtipousuario;

    }else{


      $this->session->set_flashdata('mensaje','error');
      return false;
    }

}

}