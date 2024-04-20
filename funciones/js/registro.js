	

function comprobarTipo(){


	let tipo=document.getElementById("tipoUsuario").value;
	
	
	if(tipo=="administrador"){
	
		mostrarCodigo();		
	
	} else{
	
		ocultarCodigo();
	}

}
	
	
function ocultarCodigo(){

	
	document.getElementById("codigo").style.display="none";





}



function mostrarCodigo(){


	document.getElementById("codigo").style.display="block";



}
