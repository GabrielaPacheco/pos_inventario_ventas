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

//ARREGLANDO LA ACCIÓN EDITAR USUARIO CUANDO EL DATATABLE ESTE EN OTRA RESOLUCIÓN
// QUE REQUIERA EXPANDIR EL BOTÓN MÁS DEL USUARIO

//CUANDO EL DOCUMENTO ESTÉ CARGADO VA A BUSCAR LA CLASE BTN
// Y CUANDO LA ENCUENTRE CARGUE LOS VALORES DEL USUARIOA AL FORMULARIO DEL USUARIO
$(document).on("click", ".btnEditarUsuario", function () {
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

//ACTIVAR USUARIO

//ARREGLANDO LA ACCIÓN ACTIVAR USUARIO CUANDO EL DATATABLE ESTE EN OTRA RESOLUCIÓN
// QUE REQUIERA EXPANDIR EL BOTÓN MÁS DEL USUARIO

//CUANDO EL DOCUMENTO ESTÉ CARGADO VA A BUSCAR LA CLASE BTN
// Y CUANDO LA ENCUENTRE ACTIVE EL USUARIO QUE ESTÁ DESACTIVADO Y VICEVERSA
$(document).on("click", ".btnActivar", function (){

  var idUsuario = $(this).attr("idUsuario");
  var estadoUsuario = $(this).attr("estadoUsuario");

  var datos = new FormData();
  datos.append("activarId", idUsuario);
  datos.append("activarUsuario", estadoUsuario);
  $.ajax({
    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      //ARREGLANDO BOTON ACTIVAR/DESACTIVAR USUARIO EN UNA RESOLUCION PEQUEÑA 
      //MAXIMA DE 767 PX(DISPOSITIVOS MÓVILES)
      if(window.matchMedia("(max-width:767px)").matches){

        swal({
          type: "success",
          title: "¡El usuario ha sido editado correctamente!",
          confirmButtonText: "Cerrar",

        }).then(function (result) {
          if(result.value){
              window.location= "usuarios";
          }
      });

      }
    },
  });
  if (estadoUsuario == 0) {
    $(this).removeClass("btn-success");
    $(this).addClass("btn-danger");
    $(this).html("Desactivado");
    $(this).attr("estadoUsuario", 1);
  } else {
    $(this).removeClass("btn-danger");
    $(this).addClass("btn-success");
    $(this).html("Activado");
    $(this).attr("estadoUsuario", 0);
  }
});

// REVISAR SI EL USUARIO QUE SU NICKNAME DE USUARIO NO SEA REPETIDO
$("#nuevoUsuario").change(function () {
  $(".alert").remove();
  var usuario = $(this).val();
  var datos = new FormData();
  datos.append("validarUsuario", usuario);
  $.ajax({
    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        $("#nuevoUsuario")
          .parent()
          .after(
            '<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>'
          );
        $("#nuevoUsuario").val("");
      }
    },
  });
});

// ELIMINAR USUARIOS
//ARREGLANDO LA ACCIÓN ELIMINAR USUARIO CUANDO EL DATATABLE ESTE EN OTRA RESOLUCIÓN
// QUE REQUIERA EXPANDIR EL BOTÓN MÁS DEL USUARIO

//CUANDO EL DOCUMENTO ESTÉ CARGADO VA A BUSCAR LA CLASE BTN
// Y CUANDO LA ENCUENTRE ELIMINE EL USUARIO 
$(document).on("click", ".btnEliminarUsuario", function () {
  var idUsuario = $(this).attr("idUsuario");
  var fotoUsuario = $(this).attr("fotoUsuario");
  var usuario = $(this).attr("usuario");
  swal({
    type: "warning",
    text: "¡Si no lo está puede cancelar la acción!",
    title: "¿Está seguro de borrar el usuario?",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Si, borrar usuario!",
  }).then(function (result) {
    if (result.value) {
      //OCUPANDO VARIABLES GET PARA ENVIAR ID Y RUTA DE FOTO PARA SU ELIMINACION
      window.location =
        "index.php?ruta=usuarios&idUsuario=" +
        idUsuario +
        "&usuario=" +
        usuario +
        "&fotoUsuario=" +
        fotoUsuario;
    }
  });
});
