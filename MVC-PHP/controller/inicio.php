<?php
require_once("../db/connection.php");
session_start();
if($_POST["inicio"]){
	// inicia sesion para los usuarios
	$usuario = $_POST["usuario"];
	$clave = $_POST["clave"];
	
	
	/// consultamos el usuario segun el usuario y la clave
	$con="select * from usuario where identificacion = '$usuario' and password = '$clave'"; 	
	$query=mysqli_query($mysqli, $con);
	$fila=mysqli_fetch_assoc($query);
	
	if($fila){		
		/// si el usario y la clave son correctas, creamo las sessiones 
			
		$_SESSION['id_usuario'] = $fila['id_usuario']; 
		$_SESSION['nombre'] = $fila['nombre']; 
		$_SESSION['tipo'] = $fila['id_tipo_usuario'];
		$_SESSION['usuario'] = $fila['identificacion'];
		
				/// dependiendo del tipo de usuario lo redireccinamos a una pagina
		/// si es un client
		if($_SESSION['tipo'] == 1){
			header("Location: ../model/admin1/index.php"); 
			exit();
		}
		/// si es un funcionario
		elseif($_SESSION['tipo'] == 2){
			header("Location: ../model/funcionario/index.php"); 
			exit();		
		}
		elseif($_SESSION['tipo'] == 5){
			header("Location: ../model/propietario_mascota/index.php"); 
			exit();		
		}
		
	}else{
		/// si el usuario y la clave son incorrectas lo lleva a la pagina de inio y se muestra un mensaje
		header("Location: ../errorlog.html"); 
		exit();
	}
	
}	
?>