(function ($) {
    "use strict";
    
    // Sidebar Toggler
    $('.sidebar-toggler').click(function () {
        $('.sidebar, .content').toggleClass("open");
        return false;
    });

})(jQuery);


document.addEventListener("DOMContentLoaded", function () {
    const inputs = document.querySelectorAll(".upper"); // Cambia ".input" por la clase que estés utilizando
    inputs.forEach((input) => {
        input.addEventListener("input", function () {
            this.value = this.value.toUpperCase();
        });
    }); 

    const inputs2 = document.querySelectorAll("[type='email']"); // Cambia ".input" por la clase que estés utilizando
    inputs2.forEach((input2) => {
        input2.addEventListener("input", function () {
            this.value = this.value.toLowerCase();
        });
    });

    if (window.location.pathname == "/FUNDEY/app/views/login.php") {
        const passw = document.getElementById("ojo");
        passw.addEventListener("click", function () {
            const pas = document.getElementById("pass");
            if (pas.type == "password") {
                pas.type = "text";
            } else {
                pas.type = "password";
            }
        });
    } else if (window.location.pathname == "/FUNDEY/app/views/usuarios/usuarios.php") {
        const passwe2 = document.getElementById("ojo2");
        passwe2.addEventListener("click", function () {
            const passw3 = document.getElementById("password3");
            if (passw3.type == "password") {
                passw3.type = "text";
            } else {
                passw3.type = "password";
            }
        });
    }

    // Selecciona tu textarea
    var textarea = document.querySelectorAll('textarea');

    // Ajusta el textarea automáticamente al cargar la página
    textarea.forEach((textar) => {
        textar.addEventListener('input', function () {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        })
    });
});

if (window.location.pathname == "/FUNDEY/app/views/atleta/agregar_atleta.php" || window.location.pathname == "/FUNDEY/app/views/atleta/propietario_cuenta.php") {
    let btn_back = document.querySelector(".atras");
    btn_back.addEventListener('click', function(e){
        e.preventDefault();
        window.history.back();
    });
}
