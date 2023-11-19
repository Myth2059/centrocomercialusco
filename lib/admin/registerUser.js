function registerUser() {

    var cedula = document.getElementById("cedula").value;
    var nombre = document.getElementById("nombre").value;
    var apellido = document.getElementById("apellido").value;    
    var telefono = document.getElementById("telefono").value;
    var usuario = document.getElementById("usuario").value;
    var contraseña = document.getElementById("password").value;
    var rol = document.getElementById("rol").value;

    var errorText = document.getElementById("errorP");


    if (cedula != "" && nombre != "" && apellido != "" && telefono != "" && usuario != "" && contraseña != "" && rol != "") {

        var xhr = new XMLHttpRequest();

        xhr.open("POST", "..\\lib\\admin\\registerUser.php", true);

        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var respuesta = JSON.parse(xhr.responseText);
                if (respuesta.itsOk == 0) {
                    errorText.innerText = respuesta.msg;
                }
                if (respuesta.itsOk == 3) {
                    errorText.innerText = "Error en bd";
                 console.log(respuesta.msg);   
                }


                console.log(respuesta);
                // mostrarRespuesta(respuesta);
            }
        };

        var datos = "cedula=" + encodeURIComponent(cedula) +
            "&nombre=" + encodeURIComponent(nombre) +
            "&apellido=" + encodeURIComponent(apellido) +
            "&telefono=" + encodeURIComponent(telefono) +
            "&usuario=" + encodeURIComponent(usuario) +
            "&password=" + encodeURIComponent(contraseña) +
            "&rol=" + encodeURIComponent(rol);

        xhr.send(datos);
    } else {
        errorText.innerText = "Rellena todos los campos"
    }
    return false;
}

function mostrarRespuesta(respuesta) {
    var respuestaRegistro = document.getElementById("respuestaRegistro");

    if (respuesta.exito) {
        // Mostrar un dibujo de "ok" o cualquier otro mensaje
        respuestaRegistro.innerHTML = "<img src='ok.png' alt='Registro exitoso'>";
    } else {
        // Mostrar un mensaje de error u otra indicación de fallo
        respuestaRegistro.innerHTML = "<p>Error en el registro: " + respuesta.mensaje + "</p>";
    }
}