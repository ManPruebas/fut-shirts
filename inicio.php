<?php
require_once("funciones/php/funciones.php");

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel='stylesheet' type='text/css' media='screen' href='css/inicio.css'>

    <script src="funciones/js/inicio.js"></script>
	

</head>

<body onload="cargarImagen()">

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

    <div class="contenido" id="contenido">

   
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
