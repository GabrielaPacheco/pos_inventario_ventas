// EDITAR CLIENTE

$(".btnEditarCliente").click(function () {
    var idCliente = $(this).attr("idCliente");
  
    //EXTRAYENDO EL ID DEL CLIENTE A EDITAR PARA MAS FACILIDAD
    var datos = new FormData();
    datos.append("idCliente", idCliente);
  
    //CARGANDO LOS VALORES A LA CAJA DE TEXTO DEL CLIENTE SELECCIONADO AL MODAL DE EDITAR CLIENTE
    $.ajax({
      url: "ajax/clientes.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        $("#idCliente").val(respuesta["id"]);
        $("#editarCliente").val(respuesta["nombre"]);
        $("#editarDocumentoId").val(respuesta["documento"]);
        $("#editarEmail").val(respuesta["email"]);
        $("#editarTelefono").val(respuesta["telefono"]);
        $("#editarDireccion").val(respuesta["direccion"]);
        $("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);
      },
    });
  });

  // ELIMINAR CLIENTE

$(".btnEliminarCliente").click(function () {
    var idCliente = $(this).attr("idCliente");
  
    swal({
      type: "warning",
      text: "¡Si no lo está puede cancelar la acción!",
      title: "¿Está seguro de borrar el cl iente?",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, borrar cliente!",
    }).then(function (result) {
      if (result.value) {
        //OCUPANDO VARIABLES GET PARA ENVIAR ID PARA SU ELIMINACION
        window.location = "index.php?ruta=clientes&idCliente=" + idCliente;
      }
    });
  });