function enviarFormulario() {
    var usuario = document.getElementById('usuario').value;
    var password = document.getElementById('contraseña').value;

    $.ajax({
        type: 'POST',
        url: URL_BACKEND + 'peticion=login&funcion=autenticar',
        data: {
            usuario: usuario,
            password: password
        },
        dataType: 'json',
        success: function(respuesta) {
            if (respuesta.success) {
                alert(respuesta.msg);
                // Desencriptar los datos del usuario si es necesario
                var datosUsuario = JSON.parse(respuesta.user);

                // Almacenar los datos del usuario en sessionStorage
                sessionStorage.setItem('usuario', JSON.stringify(datosUsuario));
                window.location.href='listadoEmpleados';
            } else {
                document.getElementById('mensaje-error').style.display = 'block';
                document.getElementById('mensaje-error').innerHTML = respuesta.msg;
            }
        },
        error: function(error) {
            console.log(error);
            alert('Error en la solicitud');
        }
    });
}

