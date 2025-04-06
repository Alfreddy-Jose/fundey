if (window.location.pathname == "/FUNDEY/app/views/competencia/competencia.php"){

const cbxEstado = document.getElementById('pais')
cbxEstado.addEventListener("change", getpaises)

const cbxMunicipio = document.getElementById('estado')

function fetchAndSetData(url, formData, targetElement) {
    return fetch(url, {
        method: "POST",
        body: formData,
        mode: 'cors'
    })
        .then(response => response.json())
        .then(data => {
            targetElement.innerHTML = data;
        })
        .catch(err => console.log(err));
}

function getpaises() {
    let pais = cbxEstado.value;
    let url = '../../controllers/competenciaController.php';
    let formData = new FormData();
    formData.append('codigo_pais', pais);

    fetchAndSetData(url, formData, cbxMunicipio)
    }


    let filas = JSON.parse(json);

    let i = 1;
    for(row in filas){
        
        const cbxEstadoModificar = document.getElementById(`pais${i}`)
        cbxEstadoModificar.addEventListener("change", getpaisesModificar)
        
        const cbxMunicipioModificar = document.getElementById(`estado${i}`)
        
        function Modificar(url, formData, targetElement) {
            return fetch(url, {
                method: "POST",
                body: formData,
                mode: 'cors'
            })
            .then(response => response.json())
            .then(data => {
                targetElement.innerHTML = data;
            })
            .catch(err => console.log(err));
        }
        
        function getpaisesModificar() {
            let pais = cbxEstadoModificar.value;
            let url = '../../controllers/competenciaController.php';
            let formData = new FormData();
            formData.append('codigo_pais', pais);
            
            Modificar(url, formData, cbxMunicipioModificar)
        }
        i++;
    }
}


if (window.location.pathname == "/FUNDEY/app/views/listaBecados/listaBecados.php" || window.location.pathname == "/FUNDEY/app/views/atleta/agregar_atleta.php"){
    
    const cbxDisciplina = document.getElementById('disciplina')
    cbxDisciplina.addEventListener("change", getcategoria)

        const categoria = document.getElementById('categoria')

        function fetchAndSetData(url, formData, targetElement) {
            return fetch(url, {
                method: "POST",
                body: formData,
                mode: 'cors'
            })
                .then(response => response.json())
                .then(data => {
                    targetElement.innerHTML = data;
                })
                .catch(err => console.log(err));
        }

        function getcategoria() {
            let disciplina = cbxDisciplina.value;
            let url = '../../controllers/categoriaController.php';
            let formData = new FormData();
            formData.append('disciplina', disciplina);
        
            fetchAndSetData(url, formData, categoria)
    } 
}



if (window.location.pathname == "/FUNDEY/app/views/atleta/atleta.php") { 

    let filas = JSON.parse(json);
    let i = 1;
    for(row in filas){ 

        const cbxDisciplinaModificar = document.getElementById(`disciplina${i}`)
        cbxDisciplinaModificar.addEventListener("change", getCategoriaModificar)

        const categoriaModificar = document.getElementById(`categoria${i}`)

        function fetchAndSetData(url, formData, targetElement) {
            return fetch(url, {
                method: "POST",
                body: formData,
                mode: 'cors'
            })
            .then(response => response.json())
            .then(data => {
                targetElement.innerHTML = data;
            })
            .catch(err => console.log(err));
        }

        function getCategoriaModificar() {
            let disciplinaModificar = cbxDisciplinaModificar.value;
            let url = '../../controllers/categoriaController.php';
            let formData = new FormData();
            formData.append('disciplina', disciplinaModificar);

            fetchAndSetData(url, formData, categoriaModificar)
        } 
        i++; 
    }
} 

if (window.location.pathname == "/FUNDEY/app/views/atleta/propietario_cuenta.php") {
    const banco = document.getElementById('banco')
    banco.addEventListener('change', atributo)

    function atributo() {
        let id_banco = banco.value;
        document.getElementById('cuenta').setAttribute('value', id_banco);
    }
}