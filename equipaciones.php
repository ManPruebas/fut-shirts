<?php

require_once("funciones/php/funciones.php");
$funciones= new futShirtsdb();	
$anadido=0;
if(isset($_POST["datos"])){



	if(isset($_SESSION["cuenta"])){
	
		$nombre=htmlentities($_POST["nombre"]);
	
	
		$dorsal=htmlentities($_POST["dorsal"]);
		
		$id_equipacion=$_POST["id_equipacion"];
		
		$id_equipacion=$_POST["talla"];		
		
		$funciones->anadirAlCarrito($id_equipacion,$nombre,$dorsal,$talla);
		
		$anadido=1;	
	
	} else {
	
		header("Location: inicioSesion.php");	
	
	}
	

} else {

	if(!isset($_GET["liga"])){

		header("Location: inicio.php");

	} else{


		
		$id_liga=$_GET["liga"];

		$equipaciones=$funciones->obtenerEquipacionesLiga($id_liga);
		
		$nombreLiga=$funciones->obtenerNombreLiga($id_liga);
		?>

		<!DOCTYPE html>
		<html>
		<head>
		    <meta charset='utf-8'>
		    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		    <title>Equipaciones</title>
		    <link rel='stylesheet' type='text/css' media='screen' href='css/equipaciones.css'>

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
	<div class="contenido"><!--Body-->
			<p><?=$nombreLiga?></p>

			
			<?php
			if($anadido==1){
				?>
				<p>Producto añadido al carrito</p>
				<?php
			
			}
			
			if($equipaciones==null){
				?>
				<p>No hay equipaciones registradas en esta liga</p>
				<?php
			} else{
			?>
		<div class="filas">

			<?php
			$equipacionesPorFila=3;
			$numeroFilas=ceil(array_key_last($equipaciones)/$equipacionesPorFila);
			$posicionEquipacionActual=0;
			
			for($i=0;$i<$numeroFilas;$i++){
			?>
			<div class="fila"><!--Fila-->
			    <?php
			    for($j=0;$j<$equipacionesPorFila;$j++){

			    ?>
						    
				<div class="contenedor_equipacion"><!--Elemento-->
				    <a href="equipacion.php?equipacion=<?=$equipaciones[$posicionEquipacionActual]['id_equipacion']?>">
				    <img src="<?=$equipaciones[$posicionEquipacionActual]['imagen']?>" 
				    alt="<?=$equipaciones[$posicionEquipacionActual]['nombre']?>" width="205" height="226" class="equipacion">
				    </a>

				    <div>

				        <p class="caracteristica"><?=$equipaciones[$posicionEquipacionActual]['nombre']?></p>
				        <p class="caracteristica">Temporada: <?=$equipaciones[$posicionEquipacionActual]['temporada']?></p>
				        <p class="caracteristica">Precio: <?=$equipaciones[$posicionEquipacionActual]['precio']?> €</p>
				    </div>
				</div>
				</a>
			    <?php
				$posicionEquipacionActual++;
			    }
			    ?>
				

			</div>
			<?php
			}
			?>					       		
		</div>
		<?php
			}
		?>
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
}

?>





