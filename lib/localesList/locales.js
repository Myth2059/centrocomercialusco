function goToLocal(id){
    window.location.href = '..\\public\\local.php?id=' + id;
}
function deleteLocal(id){
    var resultado = window.confirm("¿Deseas eliminar este local?");
    if (resultado) {
        var card = document.getElementById(id);
        console.log(card);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "..\\lib\\localesList\\deleteLocal.php", true);
    
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var respuesta = JSON.parse(xhr.responseText);
           if (respuesta.itsOk == 1) {
            card.style.display = "none";
            alert(respuesta.msg);
           }else{
            console.log(respuesta.msg);
           }
            }
        };
        var datos ="id=" +
        encodeURIComponent(id) +
          "&cedula=" +
        encodeURIComponent(cedula);
    console.log(datos);

        xhr.send(datos);
    }
 
}
