<?php
require_once("funciones/php/funciones.php");

if(isset($_GET["enviado"])){

	$funciones= new futShirtsdb();

	$ligas=$funciones->obtenerLigas();



	if(($ligas!=null)){
	?>

		<img src="img/retroceder.png" onclick="desplazarImagen(-1,'<?=$ligas[0]['imagen']?>')" alt="retroceder"  class="flechas">
		<a href="equipaciones.php?liga=<?=$ligas[0]['id_liga']?>"><img src="<?=$ligas[0]['imagen']?>" alt="liga_logo" width="40%" height="30%" class="liga"></a>
		<img src="img/avanzar.png" onclick="desplazarImagen(1,'<?=$ligas[0]['imagen']?>')" alt="avanzar"  class="flechas">
	<?php
	}else{
	?>

		<p>No hay ligas</p>
	<?php
	}
} else{

	header("Location: inicio.php");


}

?>

