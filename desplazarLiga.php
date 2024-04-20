<?php
require_once("funciones/php/funciones.php");

$funciones= new futShirtsdb();

if(isset($_POST["tipoDesplazamiento"])){

$tipoDesplazamiento=$_POST["tipoDesplazamiento"];
$imagenActual=$_POST["imagenActual"];
$id_liga=0;

$imagenDesplazada=$funciones->cambiarImagen($tipoDesplazamiento,$imagenActual,$id_liga);




?>

        <img src="img/retroceder.png" onclick="desplazarImagen(-1,'<?=$imagenDesplazada?>')" alt="retroceder" class="flechas">
        <a href="equipaciones.php?liga=<?=$id_liga?>"><img src="<?=$imagenDesplazada?>" alt="liga_logo"  width="40%" height="30%" class="liga"></a>
        <img src="img/avanzar.png" onclick="desplazarImagen(1,'<?=$imagenDesplazada?>')" alt="avanzar"  class="flechas">
        
<?php

}else{

	header("Location: inicio.php");
}

?>
