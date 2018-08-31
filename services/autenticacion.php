<?php
require_once("../core/modelo_users.php");

$user   	= new Users;
$exito 		= 0;
$idUsuario 	= 0;
$accion 	= $_POST["accion"];

extract($_POST);

	switch ($accion) {

		case'guardarDatosUsuario':
			//
			$exito = $user->guardarDatosUsuario($username, md5($password), $users_information_id);
			if($exito){
				$idUsuario = $exito;
				$exito =1;
			}
			$respuesta = array("exito" => $exito, "idUsuario"=>$idUsuario);
		break;

		case 'comprobarUsuario':
			//
			$exito = $user->comprobarUsuario($username);
			
			if($exito){
				$user->obtenerUsuario($exito);
				$idUsuario= $user->getId();
				$exito = 1;
			}

			$respuesta = array("exito" => $exito, "idUsuario"=>$idUsuario);
		break;

		case 'comprobarContraseña':
			//
			$user->obtenerUsuario($idUsuario);
			
			if(md5($password)===$user->getPassword())
				$exito = 1;
			$respuesta = array("exito" => $exito);
		break;

		case 'cambiarContraseña':
			//
			$cambioExitoso 		= 0;
			$exito 				= $user->obtenerUsuario($idUsuario);
			if ($exito){
				$contraseñaAnterior = $user->getPassword();
				if ($contraseñaAnterior == md5($changePassword)){
					$cambioExitoso 	= 0;
				}
				else{
					$cambioExitoso = $user->setPassword(md5($changePassword));
				}
			}
			$respuesta = array("exito"=>$exito, "cambioExitoso"=>$cambioExitoso);
		break;
	}

  echo json_encode($respuesta);
?>