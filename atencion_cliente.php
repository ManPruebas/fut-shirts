<?php
require_once("funciones/php/funciones.php");


if(!isset($_SESSION["cuenta"])){

	header("Location: inicioSesion.php");

}else{

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Atención al cliente</title>
        <link rel='stylesheet' type='text/css' media='screen' href="css/atencio_cliente.css">
	<script src="funciones/js/atencion_cliente.js"></script>
    </head>

    <body onload="conectar()">

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
        </div>


            <div class="contenido">
                <div class="conversacion" id="conversacion">
                </div>
                <br/><br/>
                <span id="errorMensaje">/<span>
                <input  type="text" class="escribir" id="msg" placeholder="Escribe tus dudas aquí" />
                <button  onclick="enviarMensaje()"  class="boton">Enviar</button>
                <br><br/>
        
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
