// REVISAR SI LA CATEGORIA NO SEA REPETIDA
$("#nuevaCategoria").change(function () {
  $(".alert").remove();
  var categoria = $(this).val();
  var datos = new FormData();
  datos.append("validarCategoria", categoria);
  $.ajax({
    url: "ajax/categorias.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        $("#nuevaCategoria")
          .parent()
          .after(
            '<div class="alert alert-warning">Esta categoría ya existe en la base de datos</div>'
          );
        $("#nuevaCategoria").val("");
      }
    },
  });
});

// EDITAR CATEGORIA

$(".btnEditarCategoria").click(function () {
  var idCategoria = $(this).attr("idCategoria");

  //EXTRAYENDO EL ID DE LA CATEGORIA A EDITAR PARA MAS FACILIDAD
  var datos = new FormData();
  datos.append("idCategoria", idCategoria);

  //CARGANDO LOS VALORES A LA CAJA DE TEXTO DE LA CATEOGIRA SELECCIONADA AL MODAL DE EDITAR CATEGORIA
  $.ajax({
    url: "ajax/categorias.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#editarCategoria").val(respuesta["categoria"]);
      $("#idCategoria").val(respuesta["id"]);
    },
  });
});

// ELIMINAR CATEGORIA

$(".btnEliminarCategoria").click(function () {
  var idCategoria = $(this).attr("idCategoria");

  swal({
    type: "warning",
    text: "¡Si no lo está puede cancelar la acción!",
    title: "¿Está seguro de borrar la categoría?",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Si, borrar categoría!",
  }).then(function (result) {
    if (result.value) {
      //OCUPANDO VARIABLES GET PARA ENVIAR ID PARA SU ELIMINACION
      window.location = "index.php?ruta=categorias&idCategoria=" + idCategoria;
    }
  });
});
