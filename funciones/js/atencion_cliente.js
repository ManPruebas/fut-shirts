
function conectar(){
	setInterval(cargarMensajes,1000);//intervalo para que esté constantemente cargando los mensajes del 	

}


//Función que enviará mensajes al chat
function enviarMensaje(){
			
			

	//Instanciamos la petición
	let xmlhttp=new XMLHttpRequest();
		
	//Programamos la respuesta
	xmlhttp.onreadystatechange= function(){
			
		if(this.readyState==4 && this.status==200){


			document.getElementById("msg").value="";
			cargarMensajes();
				
		}
	};
			
	//mensaje introducido
	let datos="";
	
	let msg=document.getElementById("msg").value;

	if(msg.trim()=""){

		let error=document.getElementById("errorMensaje").value;	
		error.innerHTML="Introuce un mensaje";
	} else{
	
	datos+="mensaje="+msg;
		
			

							
	//Indicamos donde hacemos la petición y con qué método
	xmlhttp.open("POST","enviarMensaje.php");
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
							
	//Enviamos la petición
	xmlhttp.send(datos);
	
	}
			
}


//Función que cargará todos los mensajes que hay en la base de datos
function cargarMensajes(){
			
			
	//Instanciamos la petición
	let xmlhttp=new XMLHttpRequest();
			
	//Programamos la respuesta
	xmlhttp.onreadystatechange= function(){
		
		if(this.readyState==4 && this.status==200){

			let conversacion=document.getElementById("conversacion");
			conversacion.innerHTML=this.responseText;

				
		}
	};



							
	//Indicamos donde hacemos la petición y con qué método
	xmlhttp.open("GET","cargarMensajes.php?enviado='si'");
							
	//Enviamos la petición
	xmlhttp.send();
			
	
}
