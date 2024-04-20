<?php
session_start();
//Clase chat donde estarán todas las funciones relacionadas con la base de datos
class futShirtsdb {

	public $host;
	public $port;
	public $db;
	public $user;
	public $pass;
	public $pdo;

	public function __construct(){
	
	$this->host="localhost";
	$this->port="3306";
	$this->db="FutShirts";
	$this->user="root";
	$this->pass="";
	$this->pdo= new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->db",$this->user,$this->pass);
	
	
	
	
	}


	function obtenerLigas(){
	
		$consulta= $this->pdo->prepare("select * from liga");
		
		
		$consulta->execute();
		
		$resultado= $consulta->fetchAll(PDO::FETCH_ASSOC);
	
		
		return $resultado;		
		
	}
	
	
	
	
	//Función que  irá cambiando las imágenes de forma dinámica
	function cambiarImagen($tipoDesplazamiento,$imagenActual,&$id_liga){

	    $ligas=$this->obtenerLigas();

	    $movimiento=1;
	    $moverAlternativa=0;//Posición del array alternativa en el caso de que no exista la posición x, es decir,
	    //si se avanza de posición y ya no quedan más imágenes, la posición alternativa en el caso de que se haya 
	    //seleccionado avanzar de imagen sería la primera posición del array de imágenes(de forma entándar estará
	    //como si se hubiera seleccionado avanzar)


	    $imagenDesplazada="";


	    //Si se ha decidido retroceder, la posición alternativa cambia ya que no sería la primera posición del array,
	    //siendo está la última
	    if($tipoDesplazamiento==-1){
	    	$movimiento=-1;
		$moverAlternativa=array_key_last($ligas);

	    }
		
	    //Bucle for que recorre todas las imágenes disponibles
	    for($i=0;$i<=array_key_last($ligas);$i++){

		//Si la imagen actual es igual a la imagen i habrá 2 opciones:
		
		
		if($imagenActual==$ligas[$i]["imagen"]){
			

		    //La primera opción es que la siguiente o anterior imagen del array de imágenes exista, en ese caso
		    //la establecerá como la actual
		    if(isset($ligas[$i+$movimiento]["imagen"])){
	
		        $imagenDesplazada=$ligas[$i+$movimiento]["imagen"];
   		        $id_liga=$ligas[$i+$movimiento]["id_liga"];
		    //La segunda opción es que la siguiente o anterior imagen del array de imágenes no exista, en ese caso
		    //se pondrá la imagen de la posición alternativa
		    } else{

		        $imagenDesplazada=$ligas[$moverAlternativa]["imagen"];
   		        $id_liga=$ligas[$moverAlternativa]["id_liga"];	        
		    }

		}

	    }


	     return $imagenDesplazada;


	}
	
	function obtenerEquipacionesLiga($id_liga){
	
		$consulta= $this->pdo->prepare("select * from equipacion where id_liga=:id_liga");
		
		$array=[
			
			":id_liga"=>$id_liga
			
			
		];
		
		
		$consulta->execute($array);
		
		$resultado= $consulta->fetchAll(PDO::FETCH_ASSOC);
	
		
		return $resultado;
		
	
	}
		
	function obtenerNombreLiga($id_liga){
	
		$consulta= $this->pdo->prepare("select nombre from liga where id_liga=:id_liga");
		
		$array=[
			
			":id_liga"=>$id_liga
			
			
		];
		
		
		$consulta->execute($array);
		
		$resultado= $consulta->fetchAll(PDO::FETCH_ASSOC);
	
		
		return $resultado[0]["nombre"];
		
	
	}	

	function obtenerEquipacion($id_equipacion){
	
		$consulta= $this->pdo->prepare("select * from equipacion where id_equipacion=:id_equipacion");
		
		$array=[
			
			":id_equipacion"=>$id_equipacion
			
			
		];
		
		
		$consulta->execute($array);
		
		$resultado= $consulta->fetchAll(PDO::FETCH_ASSOC);
	
		
		return $resultado[0];
		
	
	}
	
	function anadirAlCarrito($id_equipacion,$nombre,$dorsal,$talla){
	
	
		$consulta= $this->pdo->prepare("insert into carrito (id_equipacion,id_usuario,talla,nombre,dorsal) values (:id_equipacion,:id_usuario,:talla,:nombre,:dorsal)");
		
		$array=[
			
			"id_equipacion" => $id_equipacion,
			"id_usuario" => $_SESSION["cuenta"],
			"talla" => $talla,
			"nombre" => $nombre,
			"dorsal" => $dorsal
			
			
		];
		
		
		$consulta->execute($array);
		
		$resultado= $consulta->fetchAll(PDO::FETCH_ASSOC);
	
		

	
	}
	
	function obtenerUsuarios(){
	
	
		$consulta= $this->pdo->prepare("select * from usuario");

		
		
		$consulta->execute();
		
		$resultado= $consulta->fetchAll(PDO::FETCH_ASSOC);
	
		
		return $resultado;	
	
	}
	
	
	
	function validarUsuario(&$usuario,&$errorUsuario,&$bandera){
		
		$usuarios=$this->obtenerUsuarios();
		

		for($i=0;$i<=array_key_last($usuarios);$i++){
		
			if(isset($usuarios[$i]["usuario"])){

				if($usuarios[$i]["usuario"]==$usuario){
					
					$errorUsuario="<span>El nombre de usuario ya existe</span>";
					$bandera=true;
					$usuario="";
				}
			}
			
		
		}
	
	
	}
	
	function validarContrasena(&$contrasena,&$errorContrasena,&$bandera){
	
		if(strlen($contrasena)<8){
			$errorContrasena="<span>Mínimo de 8 caracteres</span>";
			$bandera=true;
			$contrasena="";			
			
		}
	
	}	
	
	
	//Función con paso por referencia que validará si el email cumple con las condiciones requeridas
	function validarCorreo(&$correo,&$errorCorreo,&$bandera){

	     //Si el email no tiene formato email no es válida, por lo que mostrará 
	     //un mensaje indicándolo junto al mensaje indicándolo
	    if(strlen($correo)!=0 && (filter_var($correo,FILTER_VALIDATE_EMAIL)==false)){
			
		//La bandera se activará ya que no es válido
			$bandera=true;
			$errorCorreo="<span>Introduce un correo válido.</span>";
		 //Se vaciará el email ya que no es válido
			$correo="";
			

			
	     }else{
	     
	     
		 $consulta = $this->pdo->prepare("select count(*) as cantidad from usuario where correo=:correo");
		 
		 $array=[
		 	

			":correo"=>$correo

		 
		 
		 ];
		 $consulta->execute($array);			
		
		 $resultado= $consulta->fetchAll(PDO::FETCH_ASSOC);			
		
		if($resultado[0]["cantidad"]>0){
		
			//La bandera se activará ya que no es válido
			$bandera=true;
			$errorCorreo="<span>Correo ya registrado.</span>";
		 	//Se vaciará el email ya que no es válido
			$correo="";			
		
		}	     
	     
	     }
	}

	
	function validarCodigo(&$codigo,&$errorCodigo,&$bandera){
		
		if($codigo!="manuelDAWTFG2024"){
			$codigo="";
			$errorCodigo="<span>El código es incorecto</span>";
			$bandera=true;		
		
		}
		
	
	
	}	
	
	
	//Función que dará de alta la cuenta mediante una consulta
	function anadirCuenta($usuario,$contrasena,$correo,$direccion,$codigo,$tipoUsuario){

		
		if($tipoUsuario=="administrador"){
			
			$tipoUsuario=1;
		
		}else{
		
			$tipoUsuario=0;
		}
		
		 //Guardará en el array de cuentas el nombre, contraseña y email
		 
		 $consulta = $this->pdo->prepare("insert into usuario(usuario,contrasena,direccion,correo,administrador) 
		 values(:usuario,:contrasena,:direccion,:correo,:administrador)");
		 
		 $array=[
		 	
			":usuario"=>$usuario,
			":contrasena"=>md5($contrasena),
			":direccion"=>$direccion,
			":correo"=>$correo,
			":administrador"=>$tipoUsuario
		 
		 
		 ];
		 $consulta->execute($array);

	 	
	}
	
	//Funcióm que buscará cuántas cuentas hay registradas y las devolverá
	function buscarUsuarios(){
	
	$consulta = $this->pdo->prepare("select count(*) as cantidad from usuario");

	$consulta->execute();
	
	$resultado= $consulta->fetchAll(PDO::FETCH_ASSOC);			
	
	return $resultado;	
	
	}

	//Función con paso por referencia que comprobará si al cuenta es válida
	function validarCuenta(&$usuario,&$contraseña,&$errorUsuario,&$errorContraseña,&$usuarioValido,&$contraseñaValida){

	    //Si el usuario o la contraseña están vacíos lo indicará y pedirá al usuario que
	    //introduzca lo que se ha dejado vacío
	    if($usuario=="" || $contraseña==""){

		//Usuario vacío
		if($usuario==""){
		
		$errorUsuario="<span>Introduce un nombre de usuario.</span>";
		}
		//Contraseña vacía
		if($contraseña==""){
		$errorContraseña="<span>Introduce una contraseña.</span>";
		}

	    //En caso contrario seguirá comprobando
	    }else{
		//Bucle doreach que recorrerá todas las cuentas


		    $consulta= $this->pdo->prepare("select count(*) as cantidad from usuario where usuario=:usuario");
		    
		    $array=[
		    
		    	":usuario"=>$usuario
		    ];
		    
		    $consulta->execute($array);
		    
		    $respuesta= $consulta->fetchAll(PDO::FETCH_ASSOC);			
		    
		    //Si el nombre de usuario está en el array dará al usuario como válido
		    if($respuesta[0]["cantidad"]>=1){
		        $usuarioValido=true;
		        
		     //Si en la contraseña de la misma cuenta también coincide la indicará como válida
		    $consulta= $this->pdo->prepare("select count(*) as cantidad from usuario 
		    where usuario=:usuario AND contrasena=:contrasena");
		    
		    $array=[
		    
		    	":usuario"=>$usuario,
		    	":contrasena"=>md5($contraseña)
		    ];
		    
		    $consulta->execute($array);
		    
		    $respuesta= $consulta->fetchAll(PDO::FETCH_ASSOC);			
		        
		        if($respuesta[0]["cantidad"]>=1){
		        $contraseñaValida=true;

		        }

		    
		}
		//Si la contraseña o el usuario no son válidos lo indicará
		if(!$usuarioValido || !$contraseñaValida){
		                        
		    //Si el usuario no es válido significará que esa cuenta no existe y lo indicará, provocando
		    //que no reste intentos y vaciará los huecos del usuario y de la contrasela
		    if(!$usuarioValido){
		        $usuario="";
		        $contraseña="";
		        $errorUsuario="<span>El usuario introducido no existe.</span>";

		    //En caso contrario significará que la contraseña del usuario no es correcta, provocando
		    //que reste 1 intento y vaciará el hueco de la contrasela
		    } else{
		    
		        if(!$contraseñaValida){
		    
		        
	
		            $errorContraseña="<span>La contraseña introducida es incorrecta.</span>";
		            $contraseña="";

		                
		        }

		    }
		}
	    }
	}
	
	//Función que iniciará la sesión de la cuenta introducida
	function iniciarSesion($usuario,$contraseña){
	
	$consulta= $this->pdo->prepare("select * from usuario where usuario=:usuario AND contrasena=:contrasena");

	$array = [
	
		":usuario"=>$usuario,
		":contrasena"=>md5($contraseña)
	
	];
	$consulta->execute($array);
	$resultado= $consulta->fetchAll(PDO::FETCH_ASSOC);			
	
	//Guardará el id de la cuenta iniciada en la sesión
	$_SESSION["cuenta"]=$resultado[0]["id_usuario"];
	
	}	
	
	
	
	
	
	
	//Función que obtiene todos los mensajes
	function getMensajes(){
	
		$consulta= $this->pdo->prepare("SELECT * from mensaje order by fecha asc");
		
		
		$consulta->execute();
		
		$resultado= $consulta->fetchAll(PDO::FETCH_ASSOC);
	
		
		return $resultado;		
	
	
	}
	//Función que inserta mensajes
	function insertarMensaje($id_usuario,$mensaje){
	
		$consulta=$this->pdo->prepare("insert into mensaje(id_usuario,mensaje) values (:id_usuario,:mensaje)");
		
		$array=[
			
			":id_usuario"=>$id_usuario,
			":mensaje"=>$mensaje
		
		];
		
		$res=$consulta->execute($array);
		
		return $res;
	
	}
	
	
	//Función que obtiene todos los datos del usuario introducido
	function getUsuario($id_usuario){
	
		$consulta=$this->pdo->prepare("select usuario from usuario where id_usuario=:id_usuario");
		
		
		$array=[
			
			":id_usuario"=>$id_usuario
		
		];
	
		$consulta->execute($array);
		
		$resultado= $consulta->fetchAll(PDO::FETCH_ASSOC);
	
		
		return $resultado[0];	
	}	
}


?>
