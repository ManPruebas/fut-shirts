  
    function cargarImagen(){
    
			
	//Instanciamos la petición
	let xmlhttp=new XMLHttpRequest();

	//Programamos la respuesta
	xmlhttp.onreadystatechange= function(){
			
		if(this.readyState==4 && this.status==200){


			let contenido=document.getElementById("contenido");
			contenido.innerHTML=this.responseText;

				
		}
	};
		
			

							
	//Indicamos donde hacemos la petición y con qué método
	xmlhttp.open("GET","cargarLiga.php?enviado='si'");

							
	//Enviamos la petición
	xmlhttp.send();
			
    
    
    
    }
    
    function desplazarImagen(tipoDesplazamiento,imagenActual){

	

	//Instanciamos la petición
	let xmlhttp=new XMLHttpRequest();
			
	//Programamos la respuesta
	xmlhttp.onreadystatechange= function(){
			
		if(this.readyState==4 && this.status==200){


			let contenido=document.getElementById("contenido");
			contenido.innerHTML=this.responseText;
				
		}
	};
			
		
	let datos="tipoDesplazamiento= "+tipoDesplazamiento+"&imagenActual="+imagenActual;
							
	//Indicamos donde hacemos la petición y con qué método
	xmlhttp.open("POST","desplazarLiga.php");
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
							
	//Enviamos la petición
	xmlhttp.send(datos);
			
    
    
    }
    
    
    
    
