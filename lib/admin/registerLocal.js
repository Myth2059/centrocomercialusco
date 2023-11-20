function registerLocal() {
    var nombre = document.getElementById("nombrelocal");
    var cedula = document.getElementById("cedulapropietario");
    var direccion = document.getElementById("direccion");
    var estado = document.getElementById("estado");
    var tipoLocal = document.getElementById("tipoLocal");
    var imgUrl = document.getElementById("imgUrl");

    var errorText = document.getElementById("errorL");

    if (nombre.value != "" && cedula.value != "" && direccion.value != "" && estado.value != "" && tipoLocal.value != "" && imgUrl.value != "") {

var categorias = categorizar(tipoLocal.value);

var categoria = categorias[0];
var subcategoria = categorias[1];

        var xhr = new XMLHttpRequest();

        xhr.open("POST", "..\\lib\\admin\\registerLocal.php", true);

        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var respuesta = JSON.parse(xhr.responseText);
                mostrarRespuesta(respuesta,errorText);
                respuesta.itsOk == 1 ? cleanInputs() : null;
            }
        };
        var datos =
            "nombre=" +
            encodeURIComponent(nombre.value) +
            "&cedula=" +
            encodeURIComponent(cedula.value) +
            "&direccion=" +
            encodeURIComponent(direccion.value) +
            "&estado=" +
            encodeURIComponent(estado.value) +
            "&tipoLocal=" +
            encodeURIComponent(tipoLocal.value) +
            "&categoria=" +
            encodeURIComponent(categoria) +
            "&subcategoria=" +
            encodeURIComponent(subcategoria) +
            "&imgUrl=" +
            encodeURIComponent(imgUrl.value);

        xhr.send(datos);

        // xhr = null;

        const cleanInputs = () => {
            console.log("a limpiar");
            cedula.value = "";
            nombre.value = "";
            direccion.value = "";
            estado.value = "";
            tipoLocal.value = "";
            imgUrl.value = "";
        };


    } else {
        errorL.value = "Rellena todos los campos";
    }

}

function mostrarRespuesta(respuesta,errorText) {
    if (respuesta.itsOk == 0) {
        errorText.innerText = respuesta.msg;
    }
    if (respuesta.itsOk == 1) {
        alert(respuesta.msg);
        errorText.innerText = "&nbsp";
    }
    if (respuesta.itsOk == 2) {
        window.history.replaceState({}, '', '/nueva-url');
    }
    if (respuesta.itsOk == 3) {
        errorText.innerText = "Error en bd ver log";
        console.log(respuesta.msg);
    }

    console.log(respuesta);
}


function categorizar(text) {
    const separatedCat = text.split(">");
    console.log(separatedCat);
    separatedCat[0] = separatedCat[0].trim();
    separatedCat[1] = separatedCat[1].trim();
    return separatedCat;
}