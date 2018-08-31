<?php
require_once("../core/modelo_users_information.php");

 	$user_information  = new Users_Information;
	$accion 	= $_POST["accion"];	
	$arreglo 	= extract($_POST);
    $exito      = 0;

	switch ($accion) {
		
		case 'registrarUsuario':
			$exito = $user_information->guardarDatosUsuario($first_name,$last_name,$email);
            if ($exito){
            	$id		= $exito;
            	$exito	= 1;
            }	
            $respuesta = array("exito" => $exito, "id"=>$id);
        break;
        	
	}

  echo json_encode($respuesta);
?>