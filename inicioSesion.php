<?php
require_once("funciones/php/funciones.php");
$funciones= new futShirtsdb();

if(isset($_POST["registrarse"])){

	header("Location: registro.php");		
}


$usuario="";//nombre de usuario
$contraseña="";//contraseña
$errorUsuario="";//mensaje de error si el usuario es incorrecto
$errorContraseña="";//mensaje de error si la contraseña es incorrecta
$usuarioValido=false;//validación de si el usuario ha sido váldo
$contraseñaValida=false;//validación de si la contraseña ha sido válda




//Si se ha enviado el inicio de sesión irá comprobar si hay cuentas registradas
if(isset($_POST["envio"])){

	//Variable que guardará la cantidad de usuarios que hay registrados, si hay mínimo 1
	//comprobará si el usuario introducido existe

	$cantidad= $funciones->buscarUsuarios();	
	
	if($cantidad[0]["cantidad"]>0){


		//Si se han enviado las opciones de usuario y contraseña las guardará en variables y
		//posteriormente las validará con la respectiva función
		if(isset($_POST["usuario"])&&isset($_POST["contraseña"])){

			$usuario=htmlentities($_POST["usuario"]);
			$contraseña=htmlentities($_POST["contraseña"]);

			$funciones->validarCuenta($usuario,$contraseña,$errorUsuario,$errorContraseña,$usuarioValido,$contraseñaValida);


			}
	    

	//En caso contrario saldrá un mensaje indicando que no hay cuentas registradas
	}else{

		$errorUsuario="	<span>No se ha registrado a ningún usuario, registrese</span>";


	}

}

//Si no se dan por buenas las validaciones volverá a mostrar el menú de inicio de sesión
if((!$usuarioValido || !$contraseñaValida)){

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inicio de sesión</title>
        <link rel='stylesheet' type='text/css' media='screen' href='css/inicioSesion.css'>

    </head>

    <body>

        <div>
            <a href="inicio.php"><img src="img/fut-shirt_logo.png" alt="logo_fut-shirts" width="180" height="150"></a> 

        </div>

        <div class="contenido">
            <form  action="<?= $_SERVER['PHP_SELF']?>"   method="POST" class="formulario">


                <p>Nombre de usuario</p>
                <?=$errorUsuario?><br>
                <input type="text" name="usuario" class="barra" value="<?=$usuario?>"/>
                <br><br>
                <p>Contraseña</p>
                <?=$errorContraseña?><br>
                <input type="password" name="contraseña"class="barra" value="<?=$contraseña?>"/>
                <br><br>
                <div class="botones">
                    <input type="submit" class="boton" value="Iniciar sesión" name="envio"/>	

            </form>                    
		    <input type="submit" class="boton" value="Registrarse" name="registrarse"/>
                

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
//Si ambas validaciones dan el visto bueno iniciará sesión y permitirá añadir productos al carrito
} else{

	$funciones->iniciarSesion($usuario,$contraseña);


	//Enlace que dirige a la página principal
	header("Location:inicio.php");


}
?>

