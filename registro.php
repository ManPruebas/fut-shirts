<?php
require_once("funciones/php/funciones.php");
$funciones= new futShirtsdb();
$errorUsuario="";//mensaje de error si el usuario es incorreceto
$errorContrasena="";//mensaje de error si la contraseña es incorrecta
$errorConfirmarContraseña="";//mensaje de error si la confirmación de contraseña
$errorDireccion="";//mensaje de error si el email es incorrecto
$errorCorreo="";//mensaje de error si el email es incorrecto
$errorCodigo="";

$usuario="";
$contrasena="";
$direccion="";
$correo="";
$codigo="";
$bandera=false;
if(isset($_POST["volver"])){

	header("Location: inicioSesion.php");		
}



//Si ha sido enviado el registro de usuario comprobará todo lo introducido
if(isset($_POST["envio"])){

	
	$tipoUsuario=htmlentities($_POST["tipoUsuario"]);

	if(isset($_POST["usuario"])){
	
		$usuario=trim(htmlentities($_POST["usuario"]));
		

		
		if($usuario==""){
		
			$errorUsuario="</span>Introduce un nombre de usuario</span>";
			
			$bandera=true;
		} else{
		
			$funciones->validarUsuario($usuario,$errorUsuario,$bandera);		
		}
		


	}

	if(isset($_POST["contraseña"])){
	
		$contrasena=trim(htmlentities($_POST["contraseña"]));



		if($contrasena==""){
		
			$errorContrasena="</span>Introduce una contraseña</span>";
			
			$bandera=true;		
		} else{

			$funciones->validarContrasena($contrasena,$errorContrasena,$bandera);		
		
		}		


	}
	
	
	if(isset($_POST["direccion"])){
	
		$direccion=trim(htmlentities($_POST["direccion"]));
			
		if($direccion==""){
		
			$errorDireccion="</span>Introduce una dirección</span>";
			
			$bandera=true;				
		}
		
	}
	
	if(isset($_POST["correo"])){
	
		$correo=trim(htmlentities($_POST["correo"]));
		
		if(trim($correo)==""){
		
			$errorCorreo="</span>Introduce un correo</span>";
			
			$bandera=true;				
		} else{
		
			$funciones->validarCorreo($correo,$errorCorreo,$bandera);		
		}		
		

	
	}
	
	if($tipoUsuario=="administrador" && isset($_POST["codigoAdministrador"])){
	
		$codigo=trim(htmlentities($_POST["codigoAdministrador"]));
		

		
		if($codigo==""){
		
			$errorCodigo="</span>Introduce el código</span>";
			
			$bandera=true;				
		} else{
			$funciones->validarCodigo($codigo,$errorCodigo,$bandera);		
		
		}	
	}
	

}
//Si el formulario ha sido enviado y la bandera decreta que es válido el registro  aplicará la función de añadir 
//la cuenta y dirigirá a la página de bienvenida
if($bandera==false && isset($_POST["envio"])){

	
	
	$funciones->anadirCuenta($usuario,$contrasena,$correo,$direccion,$codigo,$tipoUsuario);
	
	
	header("Location:inicioSesion.php");

//Si el formulario ha sido enviado y la bandera decreta que no es válido el registro mostrará el registro de nuevo
} else{
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrarse</title>
        <link rel='stylesheet' type='text/css' media='screen' href='css/registro.css'>
    	<script src="funciones/js/registro.js"></script>
    </head>

    <body onload="comprobarTipo()">

        <div>
            <a href="inicio.php"><img src="img/fut-shirt_logo.png" alt="logo_fut-shirts" width="180" height="150"></a> 

        </div>




<div class="contenido">
	<form  action="<?= $_SERVER['PHP_SELF']?>"   method="POST" class="formulario">
                  	
		<div class="contenidoFormulario">
      			<div class="contenidoIzq">

			            <p>Tipo de usuario</p>
			            <br>
			            <select id="tipoUsuario" name="tipoUsuario" onchange="comprobarTipo()">
			                <option value="administrador">Administrador</option>
			                <option value="usuario">Usuario</option>

    
			            </select>


				            <p>Contraseña</p>
				            <?=$errorContrasena?><br>
				            <input type="password" name="contraseña" value="<?=$contrasena?>"/>
    
			    




					 <p>Correo</p>
					<?=$errorCorreo?><br>
					<input type="text" name="correo" value="<?=$correo?>"/>


		       </div>
    
    
		        <div  class="contenidoDer">


			            <p>Nombre de usuario</p>
			            <?=$errorUsuario?><br>
		                    <input type="text" name="usuario"  value="<?=$usuario?>"/>



			            <p>Dirección</p>
			            <?=$errorDireccion?><br>
            			    <input type="text" name="direccion" value="<?=$direccion?>"/>

				<div id="codigo">
					<p>Código de administrador</p>
					<?=$errorCodigo?><br>
					<input type="password" name="codigoAdministrador" value="<?=$codigo?>"/>
				</div>
    
  			</div>
		</div>
		
		
    <div class="botones">
        <input type="submit" class="boton" value="Registrarse" name="envio"/>	
    
</form>
<input type="submit" class="boton" value="Volver" name="volver"/>
        
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

