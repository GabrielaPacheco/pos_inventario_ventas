// SUBIENDO FOTO  DEL USUARIO

$(".nuevaFoto").change(function () {
  var imagen = this.files[0];

  //   VALIDANDO FORMATO DE IMAGEN JPG O PNG
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $(".nuevaFoto").val("");
    swal({
      type: "error",
      text: "¡La imagen debe ser formato JPG o PNG!",
      title: "¡Error al subir la imagen!",
      confirmButtonText: "¡Cerrar!",
    });
    //VALIDANDO QUE FOTO SEA COMO MÁXIMO 2 MB CON SIZE EN BYTES
  } else if (imagen["size"] > 2000000) {
    swal({
      type: "error",
      text: "¡La imagen no debe pesar más de 2MB!",
      title: "¡Error al subir la imagen!",
      confirmButtonText: "¡Cerrar!",
    });
  } else {
    // REEMPLAZANDO FOTO DE DEFAULT POR LA QUE SELECCIONE EL USUARIO
    var datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);

    $(datosImagen).on("load", function (event) {
      var rutaImagen = event.target.result;
      $(".previsualizar").attr("src", rutaImagen);
    });
  }
});
// EDITAR USUARIO
$(".btnEditarUsuario").click(function () {
  var idUsuario = $(this).attr("idUsuario");

  //EXTRAYENDO EL ID DEL USUARIO A EDITAR PARA MAS FACILIDAD
  var datos = new FormData();
  datos.append("idUsuario", idUsuario);

  //CARGANDO LOS VALORES A LAS CAJAS DE TEXTO DEL USUARIO SELECCIONADO AL MODAL DE EDITAR USUARIO
  $.ajax({
    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#editarNombre").val(respuesta["nombre"]);
      $("#editarUsuario").val(respuesta["usuario"]);
      $("#editarPerfil").html(respuesta["perfil"]);
      $("#editarPerfil").val(respuesta["perfil"]);
      $("#fotoActual").val(respuesta["foto"]);

      $("#passwordActual").val(respuesta["password"]);
//CARGANDO FOTO AL MODAL DE EDITAR USUARIO QUE TIENE EN BASE DE DATOS
      if (respuesta["foto"] != "") {
        $(".previsualizar").attr("src", respuesta["foto"]);
      }
    },
  });
});
