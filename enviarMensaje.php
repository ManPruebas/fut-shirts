<?php
require_once("funciones/php/funciones.php");

$db= new futShirtsdb();

if(isset($_POST["mensaje"])){

$mensaje=$_POST["mensaje"];//mensaje recibido por post desde ajax
$usuario=$_SESSION["cuenta"];//sesión del usuario que desea insertar el mensaje
$res=$funciones->insertarMensaje($usuario,$mensaje);//resultado de si se ha podido insertar el mensaje

//Si la respuesta es 1 nostrará que se ha insertado correctamente, en caso contrario indicará que ha habido un error
if($res==1){
	echo "Se ha insertado correctamente";

}  else{

	echo "Ha habido un error";

}


} else{

	header("Location: inicio.php");
}


?>
