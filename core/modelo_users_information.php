<?php
	require_once("modelo_configuracion.php");

	class Users_Information extends DBAbstractModel{

	private $id;
	private $first_name;
	private $last_name;
	private $email;
	
	public function obtenerInformacionUsuario($users_information_id){
    	$this->query = "SELECT * FROM users_information WHERE id=".$users_information_id.";";
    	$this->get_results_from_query();
	    if(count($this->rows)>0){
	      foreach ($this->rows[0] as $propiedad=>$valor):
	        $this->$propiedad = $valor;
	      endforeach;
	      return true;
	    }else{
	      return false;
	    }
  	}
  	public function obtenerDatosUsuario($idUsuario){
    	$this->query = "SELECT * FROM users WHERE password=".$password.";";
    	$this->get_results_from_query();
	    if(count($this->rows)>0){
	      foreach ($this->rows[0] as $propiedad=>$valor):
	        $this->$propiedad = $valor;
	      endforeach;
	      return $this->rows[0]["id"];
	    }else{
	      return false;
	    }
  	}

  	public function guardarDatosUsuario($first_name,$last_name,$email){
  			//Ya existe el correo
  			$this->query = "SELECT * FROM users_information WHERE email = '".$email."';";
			$this->get_results_from_query();
			if(count($this->rows)>0){
				return -1;
			}
			//Flujo normal
			$this->query = "INSERT INTO users_information(first_name,last_name,email) VALUES('".$first_name."','".$last_name."','".$email."');";
			$this->execute_single_query();

			//Comprobacion de inseción
			$this->query = "SELECT * FROM users_information WHERE email='".$email."'";
			$this->get_results_from_query();
		if( count($this->rows) > 0){
			foreach ($this->rows[0] as $propiedad => $valor) {
				$this->$propiedad = $valor;
			}
			return $this->id;
		}
		return false;

	}

  	public function getFirstName(){
  		return $this->first_name;
  	}
  	public function getLastName(){
  		return $this->last_name;
  	}
  	public function getEmail(){
  		return $this->email;
  	}
}
