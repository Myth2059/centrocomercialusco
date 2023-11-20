function registerUser() {
  var cedula = document.getElementById("cedula");
  var nombre = document.getElementById("nombre");
  var apellido = document.getElementById("apellido");
  var telefono = document.getElementById("telefono");
  var usuario = document.getElementById("usuario");
  var contraseña = document.getElementById("password");
  var rol = document.getElementById("rol");

  var errorText = document.getElementById("errorP");

  if (
    cedula.value != "" &&
    nombre.value != "" &&
    apellido.value != "" &&
    telefono.value != "" &&
    usuario.value != "" &&
    contraseña.value != "" &&
    rol.value != ""
  ) {
    var xhr = new XMLHttpRequest();

    xhr.open("POST", "..\\lib\\admin\\registerUser.php", true);

    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        console.log(xhr.responseText);
        var respuesta = JSON.parse(xhr.responseText);
        mostrarRespuesta(respuesta,errorText);
        respuesta.itsOk == 1 ? cleanInputs() : null;        
      }
    };

    var datos =
      "cedula=" +
      encodeURIComponent(cedula.value) +
      "&nombre=" +
      encodeURIComponent(nombre.value) +
      "&apellido=" +
      encodeURIComponent(apellido.value) +
      "&telefono=" +
      encodeURIComponent(telefono.value) +
      "&usuario=" +
      encodeURIComponent(usuario.value) +
      "&password=" +
      encodeURIComponent(contraseña.value) +
      "&rol=" +
      encodeURIComponent(rol.value);

    xhr.send(datos);


    const cleanInputs = () => {
        console.log("a limpiar");
      cedula.value = "";
      nombre.value = "";
      apellido.value = "";
      telefono.value = "";
      usuario.value = "";
      contraseña.value = "";
      rol.value = "";
    };

  } else {
    errorText.innerText = "Rellena todos los campos";
  }
  return false;
}

function mostrarRespuesta(respuesta,errorText) {
  if (respuesta.itsOk == 0) {
    errorText.innerText = respuesta.msg;
  }
  if (respuesta.itsOk == 1) {
    alert(respuesta.msg);
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
