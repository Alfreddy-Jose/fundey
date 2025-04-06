const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
	usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[a-zA-ZÀ-ÿ]{1,40}$/, // pueden llevar Letras y acentos.
	contraseña:/^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	cedula: /^\d{7,8}$/, // Digitos de 7 a 8.
	apellido: /^[a-zA-ZÀ-ÿ]{1,40}$/,
	cuenta: /^\d{20,20}$/,
	modalidad: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
	edad: /^\d{1,2}$/,
	monto: /^\d{1,10}$/,
	rango: /^\d{1,10}$/,
	competencia: /^[a-zA-ZÀ-ÿ\s\d]{1,40}$/
}

const campos = {
	usuario: false,
	nombre: false,
	contraseña: false,
	cedula: false,
	apellido: false,
	cuenta: false,
	modalidad: false,
	rango: false,
}

const validarFormulario = (e) => {
	switch (e.target.name) {
		case "usuario":
			validarCampo(expresiones.usuario, e.target, 'usuario');
		break;
		case "rango":
			validarCampo(expresiones.rango, e.target, 'rango');
		break;
		case "nombre":
			validarCampo(expresiones.nombre, e.target, 'nombre');
		break;
		case "contraseña":
			validarCampo(expresiones.contraseña, e.target, 'contraseña');
			validarPassword2();
		break;
		case "contraseña2":
			validarPassword2();
		break;
		case "cedula":
			validarCampo(expresiones.cedula, e.target, 'cedula');
		break;
		case "cedulaP":
			validarCampo(expresiones.cedula, e.target, 'cedulaP');
		break;
		case "nombreP":
			validarCampo(expresiones.nombre, e.target, 'nombre');
		break;
		case "apellidoP":
			validarCampo(expresiones.apellido, e.target, 'apellido');
		break;
		case "apellido":
			validarCampo(expresiones.apellido, e.target, 'apellido');
		break;
		case "nombreC":
			validarCampo(expresiones.apellido, e.target, 'apellido');
		break;
		case "modalidad":
			validarCampo(expresiones.modalidad, e.target, 'modalidad');
		break;
		case "numeroC":
			validarCampo(expresiones.cuenta, e.target, 'cuenta');
		break;
		case "edad":
			validarCampo(expresiones.edad, e.target, 'edad');
		break;
		case "edadm":
			validarCampo(expresiones.edad, e.target, 'edadm');
		break;
		case "monto":
			validarCampo(expresiones.monto, e.target, 'monto');
		break;
		case "nivel":
			validarCampo(expresiones.nombre, e.target, 'nombre');
		break;
		case "pais":
			validarCampo(expresiones.nombre, e.target, 'nombre');
		break;
		case "estado":
			validarCampo(expresiones.nombre, e.target, 'nombre');
		break;
		case "disciplina1":
			validarCampo(expresiones.modalidad, e.target, 'disciplina');
		break;
		case "competencia":
			validarCampo(expresiones.competencia, e.target, 'competencia');
		break;
		case "lugar":
			validarCampo(expresiones.competencia, e.target, 'modalidad');
		break;
	}
}

const validarCampo = (expresion, input, campo) => {
	if(expresion.test(input.value)){
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos[campo] = true;
		if (campo == "cedulaP") {
			document.getElementById("cedula").addEventListener("keyup", getCodigos)
		}
	} else {
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos[campo] = false;
	}
}

const validarPassword2 = () => {
	const inputcontraseña1 = document.getElementById('password3');
	const inputcontraseña2 = document.getElementById('contraseña2');

	if(inputcontraseña1.value !== inputcontraseña2.value){
		document.getElementById(`grupo__contraseña2`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__contraseña2`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__contraseña2 i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__contraseña2 i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__contraseña2 .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['contraseña'] = false;
	} else {
		document.getElementById(`grupo__contraseña2`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__contraseña2`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__contraseña2 i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__contraseña2 i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__contraseña2 .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['contraseña'] = true;
	}
}

inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});

function getCodigos() {

    let inputC = document.getElementById("cedula").value
    let lista = document.getElementById("lista")
    let button = document.getElementById("buscar")

        let url = "../../controllers/propietarioController.php"
        let formData = new FormData()
        formData.append("cedula", inputC)

        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors" //Default cors, no-cors, same-origin
        }).then(response => response.json())
            .then(data => {
                if (data) {
                    lista.style.display = 'block'
                    button.style.display = 'block'
                }else{
                    lista.style.display = 'none'
                    button.style.display = 'none'
                }
            })
            .catch(err => console.log(err))	
}
function values(){
	let inputC = document.getElementById("cedula").value
    let lista = document.getElementById("lista")
    let button = document.getElementById("buscar")

        let url = "../../controllers/propietarioController.php"
        let formData = new FormData()
        formData.append("cedula", inputC)

        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors" //Default cors, no-cors, same-origin
        }).then(response => response.json())
            .then(data => {
				console.log(data);
				data.forEach(function (values){
					document.getElementById('nacionalidad').setAttribute('value', values[6]);
					document.getElementById('nacionalidad').setAttribute('readonly', true);
					document.getElementById('nombre').setAttribute('value', values[0]);
					document.getElementById('nombre').setAttribute('readonly', true);
					document.getElementById('apellido').setAttribute('value', values[1]);
					document.getElementById('apellido').setAttribute('readonly', true);
					document.getElementById('cuenta').setAttribute('value', values[4]);
					document.getElementById('cuenta').setAttribute('readonly', true);
					let tipoC = `<input class='form-control border-0 input formulario__input' name='tipoC' value=${values[5]} readonly>`
					document.getElementById('inp').innerHTML = tipoC;
					let banco = `<option readonly value='${values[2]}'>${values[3]}</option>`
					document.getElementById('banco').innerHTML = banco;
					let registrar = "<input type='text' value='registrar' name='asignar' hidden>"
					document.getElementById('registrarP').innerHTML = registrar;
					document.getElementById('cedula').setAttribute('readonly', true);
					document.getElementById('limpiar').setAttribute('hidden', true);
				});
				lista.style.display = 'none'
                button.style.display = 'none'
            })
            .catch(err => console.log(err))	
}









