/**
 * Para darle un efecto dinámico a los hint cuando se selecciona uno de los dos campos (usuario,contraseña)
 * en el CSS vienen definidos los estilos cuando se selecciona
 */
const inputs = document.querySelectorAll(".input");

function addcl(){
	let parent = this.parentNode.parentNode;
	parent.classList.add("focus");
}

function remcl(){
	let parent = this.parentNode.parentNode;
	if(this.value == ""){
		parent.classList.remove("focus");
	}
}

inputs.forEach(input => {
	input.addEventListener("focus", addcl);
	input.addEventListener("blur", remcl);
});