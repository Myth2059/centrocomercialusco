var nombre, apellido, telefono, nombreLocal, ubicacion, estado, tipoLocal, categoria, subcategoria;
var buttonU, buttonL;
document.addEventListener("DOMContentLoaded", function () {
    nombre = document.getElementById("nombre");
    apellido = document.getElementById("apellido");
    telefono = document.getElementById("telefono");
    nombreLocal = document.getElementById("nombreLocal");
    ubicacion = document.getElementById("ubicacion");
    estado = document.getElementById("estado");
    tipoLocal = document.getElementById("tipoLocal");
    buttonU = document.getElementById("buttonU");
    buttonL = document.getElementById("buttonL");


});

function enableDisableEditU() {
    nombre.disabled = !nombre.disabled;
    apellido.disabled = !apellido.disabled;
    telefono.disabled = !telefono.disabled;
    buttonU.style.display = buttonU.style.display == "block" ? "none" : "block";


}
function enableDisableEditL() {
    nombreLocal.disabled = !nombreLocal.disabled;
    ubicacion.disabled = !ubicacion.disabled;
    estado.disabled = !estado.disabled;
    tipoLocal.disabled = !tipoLocal.disabled;
    buttonL.style.display = buttonL.style.display == "block" ? "none" : "block";

}



function updateU() {
    var xhr = new XMLHttpRequest();

    xhr.open("POST", "..\\lib\\local\\updateUser.php", true);

    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var respuesta = JSON.parse(xhr.responseText);
            if (respuesta.itsOk == 1) {
                alert(respuesta.msg);
            } else {
                alert("No se pudo actualizar");
            }
            // mostrarRespuesta(respuesta,errorText);
        }
    };
    var datos =
        "nombre=" +
        encodeURIComponent(nombre.value) +
        "&apellido=" +
        encodeURIComponent(apellido.value) +
        "&telefono=" +
        encodeURIComponent(telefono.value) +
        "&cedula=" +
        encodeURIComponent(cedula);

    xhr.send(datos);

}


function updateL() {

    var categorias = categorizar(tipoLocal.value);

    categoria = categorias[0];
    subcategoria = categorias[1];
    var xhr = new XMLHttpRequest();

    xhr.open("POST", "..\\lib\\local\\updateLocal.php", true);

    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log("->" + xhr.responseText);
            var respuesta = JSON.parse(xhr.responseText);
            if (respuesta.itsOk == 1) {
                alert(respuesta.msg);
            } else {
                alert("No se pudo actualizar");
            }
            // mostrarRespuesta(respuesta,errorText);
        }
    };
    var datos =
        "nombreLocal=" +
        encodeURIComponent(nombreLocal.value) +
        "&ubicacion=" +
        encodeURIComponent(ubicacion.value) +
        "&estado=" +
        encodeURIComponent(estado.value) +
        "&categoria=" +
        encodeURIComponent(categoria) +
        "&subcategoria=" +
        encodeURIComponent(subcategoria) +
        "&cedula=" +
        encodeURIComponent(cedula) +
        "&id=" +
        encodeURIComponent(id);

    xhr.send(datos);

}


function categorizar(text) {
    const separatedCat = text.split(">");
    console.log(separatedCat);
    separatedCat[0] = separatedCat[0].trim();
    separatedCat[1] = separatedCat[1].trim();
    return separatedCat;
}

// function mostrarRespuesta(respuesta,errorText) {
//     if (respuesta.itsOk == 0) {
//         errorText.innerText = respuesta.msg;
//     }
//     if (respuesta.itsOk == 1) {
//         alert(respuesta.msg);
//         errorText.innerText = "&nbsp";
//     }
//     if (respuesta.itsOk == 2) {
//         window.history.replaceState({}, '', '/nueva-url');
//     }
//     if (respuesta.itsOk == 3) {
//         errorText.innerText = "Error en bd ver log";
//         console.log(respuesta.msg);
//     }

//     console.log(respuesta);
// }