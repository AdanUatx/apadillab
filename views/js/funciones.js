document.addEventListener("DOMContentLoaded", function () {
  var datosUsuario = sessionStorage.getItem('usuario');
  console.log(datosUsuario);
  if (datosUsuario) {
    var usuario = JSON.parse(datosUsuario);
    if (usuario.rol === 'Administrador') {
      document.getElementById('btn_agregar_empleado').style.display = 'inline';
    } else {
      document.getElementById('btn_agregar_empleado').style.display = 'none';
    }
  } else {
    document.getElementById('btn_agregar_empleado').style.display = 'none';
  }

  $(document).on("click", ".btn_guardar_empleado", function () {
      var actualizar = $('#id_empleado').length != 0 ? true : false;
      Empleados.guardarEmpleado(actualizar);
  });

  $(document).on("click", ".btn_visualizar_empleado", function () {
    // Muestra la información del empleado en un modal o una nueva vista
    var empleado = $(this).data("str_empleado");
    var empleadoDecodificado = atob(empleado);
    var empleado_data = JSON.parse(empleadoDecodificado);

    Empleados.mostrarInformacionEmpleado(empleado_data);
  });

  $(document).on('click','.btn_modificar_empleado',function() {
    //obtener el empleado codificador y convertirlo a un objeto json
    var empleado = JSON.parse(atob($(this).data('str_empleado')));
    //setear los datos del empleado al formulario de registro
    var id_empleado = '<input type="hidden" id="id_empleado" name="id_empleado" value="' + empleado.id_empleado + '">';
    $('#formAgregarEmpleado').append(id_empleado);
    $('#nombre').val(empleado.nombre);
    $('#apellido_paterno').val(empleado.apellido_paterno);
    $('#apellido_materno').val(empleado.apellido_materno);
    $('#edad').val(empleado.edad);
    $('#fecha_nacimiento').val(empleado.fecha_nacimiento);
    $('#sueldo_base').val(empleado.sueldo_base);
    $('#puesto').val(empleado.detalleEmpleado[0].puesto);
    $('#experiencia_profesional').val(empleado.detalleEmpleado[0].experiencia_profesional);


    $("#modalAgregarEmpleado").modal("show");
  });

  $(document).on("click", ".btn_eliminar_empleado", function () {
    // Obtener el ID del empleado desde el atributo data
    var idEmpleado = $(this).data('id');

    // Mostrar un cuadro de diálogo de confirmación antes de proceder con la eliminación
    var confirmacion = confirm('¿Estás seguro de que deseas eliminar este empleado?');

    if (confirmacion) {
      Empleados.eliminarEmpleado(idEmpleado);

    }
  });

  $('#modalAgregarEmpleado').on('hidden.bs.modal', function () {
    // Restablecer el formulario
    $('#id_empleado').remove();
    $('#formAgregarEmpleado').trigger('reset');
  });

  // Reglas de formulario Edad y Fecha Nacimiento / Sueldo
  document.getElementById('edad').addEventListener('input', calcularFechaNacimiento);

  document.getElementById('sueldo_base').setAttribute('min', 1);

  document.getElementById('sueldo_base').addEventListener('input', function() {
    var sueldoBaseInput = document.getElementById('sueldo_base');
    if (sueldoBaseInput.value < 0) {
      sueldoBaseInput.value = Math.abs(sueldoBaseInput.value); // Convertir el valor a su valor absoluto
    }
  });


  Empleados.listado_empleados();
});

function calcularFechaNacimiento() {
  var edad = document.getElementById('edad').value;
  var fechaNacimiento = new Date();
  fechaNacimiento.setFullYear(fechaNacimiento.getFullYear() - edad);
  var dia = fechaNacimiento.getDate();
  var mes = fechaNacimiento.getMonth() + 1; // Se agrega 1 porque en JavaScript los meses van de 0 a 11
  var anio = fechaNacimiento.getFullYear();
  var fechaFormateada = anio + '-' + (mes < 10 ? '0' + mes : mes) + '-' + (dia < 10 ? '0' + dia : dia); // Formato YYYY-MM-DD
  document.getElementById('fecha_nacimiento').setAttribute('max', fechaFormateada);
  document.getElementById('fecha_nacimiento').value = '';
}




let chartPesos;
let chartDolares;
var Empleados = {
  listado_empleados: function () {
    $("#tbodyTableroEmpleados").html(
      '<tr><td colspan="5" style="text-align: center"><span class="spinner-border"></span>Procesando Datos</td></tr>'
    );
    $.ajax({
      type: "POST",
      url: URL_BACKEND + "peticion=empleado&funcion=listado", // url de consumo del servicio
      data: {},
      dataType: "json",
      success: function (respuestaAjax) {
        if (respuestaAjax.success) {
          var html_listado_empleados = "";
          respuestaAjax.data.empleados.forEach(function (empleado) {
            var stringEmpleado = btoa(JSON.stringify(empleado)); //almacenar en una cadena de string y codificarla
            html_listado_empleados +=
              "<tr>" +
              "<td>" +
              empleado.clave_empleado +
              "</td>" +
              "<td>" +
              empleado.nombre +
              " " +
              empleado.apellido_paterno +
              " " +
              empleado.apellido_materno +
              "</td>" +
              "<td>" +
              empleado.fecha_nacimiento +
              "</td>" +
              "<td>" +
              empleado.edad +
              " años" +
              "</td>" +
              "<td>" +  '<button type="button" data-str_empleado="' +
                stringEmpleado +
                '" class="btn btn-outline-dark btn-sm btn_visualizar_empleado">Ver</button>\n';
            "</td>" + "</tr>";

            var datosUsuario = sessionStorage.getItem('usuario');
            if (datosUsuario) {
              var usuario = JSON.parse(datosUsuario);
              if (usuario.rol === 'Administrador') {
                html_listado_empleados +=
                    '<button type="button" data-str_empleado="' +
                    stringEmpleado +
                    '" class="btn btn-outline-warning btn-sm btn_modificar_empleado">Editar</button>\n' +
                    '<button type="button" data-id="' +
                    empleado.id_empleado +
                    '" class="btn btn-outline-danger btn-sm btn_eliminar_empleado">Eliminar</button> \n';
              }
            }

            html_listado_empleados += "</td>" + "</tr>";

          });
          $("#tbodyTableroEmpleados").html(html_listado_empleados);
        } else {
          var html_msg_error = '<div class="alert alert-warning">';
          respuestaAjax.msg.forEach(function (elemento) {
            html_msg_error += "<li>" + elemento + "</li>";
          });
          html_msg_error += "</div>";
          $("#mensajes_sistema").html(html_msg_error);
          setTimeout(function () {
            $("#mensajes_sistema").html("");
          }, 5000);
        }
      },
      error: function (error) {
        console.log(error);
        alert("error en el catalogo");
      },
    });
  },

  guardarEmpleado: function (actualizar = false) {
    var urlPeticion = actualizar ? URL_BACKEND + 'peticion=empleado&funcion=actualizar' : URL_BACKEND + 'peticion=empleado&funcion=agregar';

    // Enviar los datos mediante AJAX
    $.ajax({
      type: "POST",
      url: urlPeticion,
      data: $('#formAgregarEmpleado').serialize(),
      dataType: "json",
      success: function (respuesta) {
        if (respuesta.success) {
          alert(respuesta.msg);
          // Si el servidor devuelve éxito, cierra el modal y actualiza la tabla de empleados
          $('#formAgregarEmpleado').trigger('reset');

          $("#modalAgregarEmpleado").modal("hide");

          Empleados.listado_empleados(); // Esta función debería actualizar la tabla de empleados con la información más reciente
        } else {
          // Si hay un error, muestra un mensaje al usuario
          alert("Error al agregar empleado: " + respuesta.msg.join('\n'));
        }
      },
      error: function(xhr, status, error) {
        console.log("XHR:", xhr);
        console.log("Status:", status);
        console.log("Error:", error);
        console.log("Response Text:", xhr.responseText);
        alert("Error en la solicitud AJAX");
      }

    });
  },

  mostrarInformacionEmpleado: function (empleado) {
    // Llamar al WebService para obtener el tipo de cambio de dólares a pesos
    $.ajax({
      type: "GET",
      url: URL_BACKEND + "peticion=tipoCambio&funcion=obtener",
      data: {},
      dataType: "json",
      success: function (respuesta) {
        if (respuesta.success) {
          var tipoCambio = parseFloat(respuesta.tipo_cambio);

          // Calcular el sueldo en dólares
          var sueldoBaseDolares = parseFloat(empleado.sueldo_base) / tipoCambio;

          // Construir el contenido del modal con los detalles del empleado
          var modalContent =
            '<div class="modal-dialog">' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<h5 class="modal-title">' +
            empleado.nombre +
            " " +
            empleado.apellido_paterno +
            " " +
            empleado.apellido_materno +
            "</h5>" +
            '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
            "</button>" +
            "</div>" +
            '<div class="modal-body">' +
            "<p><strong>Clave Empleado:</strong> " +
            empleado.clave_empleado +
            "</p>" +
            "<p><strong>Fecha de Nacimiento:</strong> " +
            empleado.fecha_nacimiento +
            "</p>" +
            "<p><strong>Edad:</strong> " +
            empleado.edad +
            " años</p>" +
            "<p><strong>Fecha de Ingreso:</strong> " +
            empleado.fecha_ingreso +
            "</p>" +
              "<p><strong>Puesto:</strong> " +
              empleado.detalleEmpleado[0].puesto +
              "</p>" +
              "<p><strong>Experiencia Profesional:</strong> " +
              empleado.detalleEmpleado[0].experiencia_profesional +
              "</p>" +
            "<p><strong>Sueldo en Pesos Mexicanos (MXN):</strong> $" +
            empleado.sueldo_base +
            "</p>" +
            "<p><strong>Sueldo en Dólares (USD):</strong> $" +
            sueldoBaseDolares.toFixed(2) +
            "</p>" +
            "<p><strong>Sueldos Proyectados:</strong></p>" +
            '<ul id="sueldosProyectadosList"></ul>' +
            // Agrega más detalles del empleado según lo necesites
            '<div id="graficaSueldoPesosContainer"><canvas id="graficaSueldoPesos" width="400" height="200"></canvas></div>' +
            '<div id="graficaSueldoDolaresContainer"><canvas id="graficaSueldoDolares" width="400" height="200"></canvas></div>' +
            "</div>" +
            "</div>" +
            "</div>";

          // Eliminar el contenido anterior del modal
          $("#modalDetallesEmpleado").empty();

          // Agregar el contenido del modal al body del documento
          $("#modalDetallesEmpleado").append(modalContent);

          // Calcular los sueldos proyectados en pesos y dólares
          var sueldoBase = parseFloat(empleado.sueldo_base);
          var sueldosProyectadosPesos = [sueldoBase];
          var sueldosProyectadosDolares = [sueldoBaseDolares];
          var meses = 18; // 1 año y medio
          var incrementoPorMes = 0.04; // 4% de incremento cada 4 meses

          for (var i = 1; i <= meses; i++) {
            if (i % 4 === 0) {
              // Incrementar el sueldo cada 4 meses
              sueldoBase *= 1 + incrementoPorMes;
              sueldoBaseDolares *= 1 + incrementoPorMes;
            }
            sueldosProyectadosPesos.push(sueldoBase);
            sueldosProyectadosDolares.push(sueldoBaseDolares);
          }

          // Mostrar la proyección del sueldo en una gráfica
          Empleados.mostrarGraficaSueldo(
            "graficaSueldoPesos",
            "Sueldo Proyectado (MXN)",
            sueldosProyectadosPesos,
            "MXN",
            empleado.fecha_ingreso
          );
          Empleados.mostrarGraficaSueldo(
            "graficaSueldoDolares",
            "Sueldo Proyectado (USD)",
            sueldosProyectadosDolares,
            "USD",
            empleado.fecha_ingreso
          );
        } else {
          // Si hay un error, muestra un mensaje al usuario
          alert("Error al agregar empleado: " + respuesta.msg);
        }
      },
      error: function (error) {
        console.error("Error en la solicitud al WebService:", error);
      },
    });
  },

  mostrarGraficaSueldo: function (canvasID, label, sueldosProyectados, moneda , fechaInicial) {
    var meses = [];
    var fecha = new Date(fechaInicial); // Convertir la fecha inicial a objeto Date
    var mesesDelAnio = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];

    // Agregar la fecha inicial
    meses.push(mesesDelAnio[fecha.getMonth()] + " " + fecha.getFullYear().toString().substr(-2));

    // Calcular los siguientes 17 meses
    for (var i = 1; i < 18; i++) {
        fecha.setMonth(fecha.getMonth() + 1); // Avanzar al siguiente mes
        meses.push(mesesDelAnio[fecha.getMonth()] + " " + fecha.getFullYear().toString().substr(-2));
    }

    if (moneda == "MXN") {
      var datos = {
        labels: meses,
        datasets: [
          {
            label: label,
            data: sueldosProyectados,
            backgroundColor: "rgba(54, 162, 235, 0.2)",
            borderColor: "rgba(54, 162, 235, 1)",
            borderWidth: 1,
          },
        ],
      };
    }

    if (moneda == "USD") {
      var datos = {
        labels: meses,
        datasets: [
          {
            label: label,
            data: sueldosProyectados,
            backgroundColor: "rgba(255, 99, 132, 0.2)",
            borderColor: "rgba(255, 99, 132, 1)",
            borderWidth: 1,
          },
        ],
      };
    }

    // Configurar las opciones de la gráfica
    var opciones = {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    };

    // Agregar el código para dibujar la gráfica dentro del evento 'shown.bs.modal'
    $("#modalDetallesEmpleado").on("shown.bs.modal", function () {
      // Obtener el contexto del canvas dentro del modal después de que se muestra el modal
      var canvas = document.getElementById(canvasID);
      var ctx = canvas.getContext("2d");

      if (moneda === "MXN") {
        if (chartPesos) {
          chartPesos.destroy();
        }
        chartPesos = new Chart(ctx, {
          type: "bar",
          data: datos,
          options: opciones,
        });
      } else if (moneda === "USD") {
        if (chartDolares) {
          chartDolares.destroy();
        }
        chartDolares = new Chart(ctx, {
          type: "bar",
          data: datos,
          options: opciones,
        });
      }
    });

    // Mostrar el modal
    $("#modalDetallesEmpleado").modal("show");
  },

  eliminarEmpleado :function (idEmpleado) {
    $.ajax({
      type: 'POST',
      url: URL_BACKEND + 'peticion=empleado&funcion=eliminar', // Ruta a tu script PHP que maneja la eliminación
      dataType: "json",
      data: { id_empleado: idEmpleado }, // Enviar el ID del empleado como datos
      success: function(response) {
        // Manejar la respuesta del servidor
        if (response.success) {
          // Si la eliminación fue exitosa, actualizar la interfaz de usuario según sea necesario
          alert('Empleado eliminado correctamente');
          // Por ejemplo, podrías recargar la página o actualizar la lista de empleados
          Empleados.listado_empleados(); // Recargar la página
        } else {
          // Si hubo un error en la eliminación, mostrar un mensaje de error
          alert('Error al eliminar empleado: ' + response.message);
        }
      },
      error: function(xhr, status, error) {
        // Manejar errores de la solicitud AJAX
        alert('Error en la solicitud AJAX: ' + error);
      }
    });
  }
};
