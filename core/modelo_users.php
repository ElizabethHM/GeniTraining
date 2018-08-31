<?php
	require_once("modelo_configuracion.php");

	class Users extends DBAbstractModel{

	private $id;
	private $username;
	private $password;
	private $users_information_id;
	private $status;

	public function obtenerUsuario($id){
    	$this->query = "SELECT * FROM users WHERE id='".$id."';";
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

	public function comprobarUsuario($username){
    	$this->query = "SELECT id FROM users WHERE username='".$username."';";
    	$this->get_results_from_query();
	    if(count($this->rows)>0){
	      return $this->rows[0]["id"];
	    }else{
	      return false;
	    }
  	}

  	public function comprobarConstrasenia($password){
    	$this->query = "SELECT password FROM users WHERE password=".$password.";";
    	$this->get_results_from_query();
	    if(count($this->rows)>0){
	      return true;
	    }else{
	      return false;
	    }
  	}

  	public function guardarDatosUsuario($username, $password, $users_information_id){
  		//Usuario existente
  		$this->query = "SELECT * FROM users WHERE username = '".$username."';";
		$this->get_results_from_query();
		if(count($this->rows)>0){
			return -1;
		}
		//Flujo normal
		$this->query = "INSERT INTO users(username, password, users_information_id) VALUES('".$username."','".$password."',".$users_information_id.");";
		$this->execute_single_query();

		//Comprobación de inseción
		$this->query = "SELECT * FROM users WHERE username='".$username."'";
		$this->get_results_from_query();

		if( count($this->rows) > 0){
			return $this->rows[0]["id"];
		}
			
		return false;

	}
	public function getId(){
  		return $this->id;
  	}
  	public function getUsername(){
  		return $this->username;
  	}
  	public function getPassword(){
  		return $this->password;
  	}
  	public function getUserInformation_Id(){
  		return $this->users_information_id;
  	}
  	public function getStatus(){
  		return $this->status;
  	}

  	public function setPassword($password){
	    $this->query="UPDATE users SET password = '".$password."' WHERE id = $this->id";
	    $this->execute_single_query();
	    $this->query="SELECT password FROM users WHERE id = $this->id";
	    $this->get_results_from_query();
	    if($this->rows[0]['password'] == $password){return 1;}
	    else{return 0;}
	}
}
