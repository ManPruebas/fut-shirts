
<?php
require_once("funciones/php/funciones.php");

if(!isset($_GET["equipacion"])){

	header("Location: inicio.php");

} else{



	$funciones= new futShirtsdb();	
	
	$id_equipacion=$_GET["equipacion"];
	
	$equipacion=$funciones->obtenerEquipacion($id_equipacion);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipación</title>
    <link rel='stylesheet' type='text/css' media='screen' href='css/equipacion.css'>

</head>

<body>

     <div class="cabecera">
            <a href="inicio.php"><img src="img/fut-shirt_logo.png" alt="logo_fut-shirts" width="180" height="150"></a> 

        <div class="menu">
       	<?php
       	if(isset($_SESSION["cuenta"])){
       	?>
            <p>Cerrar sesión</p>       	
       	<?php
       	} else{
       	?>
            <p>Iniciar sesión</p>       	
        <?php    
       	}
       	?>
            <p>Carrito</p>
            <p>Panel de administrador</p>
        </div>
    </div>

    <div class="contenido">
        <img src="<?=$equipacion["imagen"]?>" alt="logo_Empresa" width="17%" height="400" class="equipacion">

        <div class="caracteristicas"><!--Caracteristicas-->

            <p class="nombre_temporada"><?=$equipacion["nombre"]?></p>
            <p class="nombre_temporada">Temporada: <?=$equipacion["temporada"]?></p>
		
		<?php
		
		if($equipacion["stock"]==0){
		?>
            <p class="disponibilidad_precio">Disponibilidad: no disponible</p>		
            	<?php
		} else{
		?>		
		
            <p class="disponibilidad_precio">Disponibilidad: disponible</p>
            	<?php
            	}
            	?>
            
            <p class="disponibilidad_precio">Precio: <?=$equipacion["precio"]?> €</p>
	
            <form  action="equipaciones.php"   method="POST" name="datos">
		   
		   
		   <input type="hidden" name="id_equipacion" value="<?=$equipacion["id_equipacion"]?>"/>	    


		    <div class="dorsal_contenedor">
		        <p class="caracteristica">Dorsal</p>
		        <input type="number" min="1" max="99" class="inputDorsal" name="dorsal">
		    </div>

		    <div class="nombre_contenedor">
		        <p class="caracteristica">Nombre</p>
		        <input type="text"  name="nombre" class="inputNombre">

		    </div>  
		    <div class="contenedor_talla">
		        <p class="caracteristica">Talla</p>
		        <select  class="opciones_talla" name="talla">
		            <option value="XS" name="XS">XS</option>
		            <option value="S" name="S">S</option>
		            <option value="M"name="M">M</option>
		            <option value="L" name="L">L</option>
		            <option value="XL" name="XL">XL</option>
		        </select>
		    </div>

            <?php
            if($equipacion["stock"]!=0){
            ?>

                <input type="submit" class="boton" name="datos" value="Añadir al carrito"/>
       	    </form>	            

            <?php
            }else{
                ?>
            <form  action="inicio.php"   method="POST">
                <input type="submit" class="boton" name="datos" value="Volver al inicio"/>

            </form>
                <?php
            }
            ?>


        </div>



    </div>


    <footer>

        <div class="contacto">
            <p>Formas de contacto</p>

            <p>Servicio de atención al cliente</p>
            <p>Correo de contacto: futshirts2024@gmail.com</p>
        </div>
        
        <div class="rrss">
            <p>Redes sociales</p>
            <div class="divRedSocial">
                <img  src="img/x_logo.png" alt="x_logo" width="1.7%" height="1%">
                <p class="redSocial">Twitter: @futshirts2024</p>
            </div>
            <div class="divRedSocial">
                <img src="img/insta_logo.png" alt="insta_logo" width="1.7%" height="1%">
                <p class="redSocial">Instagram: @futshirts2024</p>
            </div>    
            <div class="divRedSocial">
                <img src="img/facebook_logo.png" alt="facebook_logo" width="1.4%" height="1%">
                <p class="redSocial">Facebook: futshirts2024</p>
            </div>
        </div>
    </footer>
    
</body>


</html>
<?php

}
?>

