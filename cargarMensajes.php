<?php

require_once("funciones/php/funciones.php");

if(isset($_GET["enviado"])){

$funciones= new futShirtsdb();	
//Función que recibe todos los mensajes
$res=$funciones->getMensajes();


//Bucle for uqe recorrerá a todos los usuarios
foreach($res as $r){



	$usuario=$funciones->getUsuario($r["id_usuario"]);//Función que recibe al usuario que haya escrito el mensaje


	//Si el usuario introducido existe en la base de datos lo mostrará en el chat
	if(!empty($usuario)){


	//Mostrará en el chat la foto de perfil junto al nombre del usuario con su repectivo color y el mensaje correspondiente
	echo "<div class='contenedorUsuario'>";
		echo "<div id='user'>".$usuario["usuario"]."</span>: ".$r["mensaje"]."</div></div><br/>";
	}
}


} else{


	header("Location: inicio.php");

}

?>
