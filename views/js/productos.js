// CARGAR TABLA DINÁMICA DE LOS PRODUCTOS
// $.ajax({
//   url: "ajax/datatable-productos.ajax.php",
//   success: function (respuesta) {
//     console.log("respuesta", respuesta);
//   },
// });

var perfilOculto = $("#perfilOculto").val();

$(".tablaProductos").DataTable({
  ajax: "ajax/datatable-productos.ajax.php?perfilOculto="+perfilOculto,
  deferRender: true,
  retrieve: true,
  processing: true,
  language: {
    sProcessing: "Procesando ...",
    sLengthMenu: "Mostrar _MENU_ registros",
    sZeroRecords: "¡Sin datos! Por favor cambie su término de búsqueda.",
    sEmptyTable: "Datos no disponibles en tabla",
    sInfo: "Mostrar registros del _START_ al _END_ de _TOTAL_ entradas",
    sInfoEmpty: "Mostrar del 0 al 0 de 0 entradas",
    sInfoFiltered: "(Filtrado de un total de _MAX_ entradas)",
    sInfoPostFix: "",
    sSearch: "Buscar:",
    sUrl: "",
    sInfoThousands: ",",
    sLoadingRecords: "Por favor espere - cargando datos...",
    oPaginate: {
      sFirst: "Primero",
      sLast: "Último",
      sNext: "Siguiente",
      sPrevious: "Anterior",
    },
    oAria: {
      sSortAscending: ": Activar para ordenar la columna en orden ascendente",
      sSortDescending: ": Activar para ordenar la columna en orden descendente",
    },
  },
});

// CAPTURANDO LA CATEGORIA PARA ASIGNAR CODIGO
$("#nuevaCategoria").change(function () {
  var idCategoria = $(this).val();
  var datos = new FormData();
  datos.append("idCategoria", idCategoria);

  //CARGANDO LOS VALORES DE LOS PRODUCTOS DE ACUERDO A LO QUE COINCIDA CON EL ID CATEGORIA
  //SELECCIONADO Y PODER CREAR LOS CODIGOS DE LOS PRODUCTOS AUTOMÁTICAMENTE
  $.ajax({
    url: "ajax/productos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (!respuesta) {
        //SI AL AGREGAR NUEVA CATEGORIA QUE NO POSEE PRODUCTOS
        // SE GENERARÁ EL NUEVO CÓDIGO DE PRODUCTO DE ACUERDO
        // AL ID DE LA CATEGORÍA SELECCIONADA
        var nuevoCodigo = idCategoria + "01";
        $("#nuevoCodigo").val(nuevoCodigo);
      } else {
        // SI LA CATEGORIA YA TIENE PRODUCTOS PUES SE
        // TOMA EL ÚLTIMO CÓDIGO DEL PRODUCTO Y LE SUMA 1
        var nuevoCodigo = Number(respuesta["codigo"]) + 1;
        $("#nuevoCodigo").val(nuevoCodigo);
      }
    },
  });
});

// AGREGANDO PRECIO DE VENTA SI ESTA HABILITADO EL CHECKBOX
$("#nuevoPrecioCompra, #editarPrecioCompra").change(function () {
  // VALIDANDO QUE EL CHECKBOX SEA TRUE
  if ($(".porcentaje").prop("checked")) {
    var valorPorcentaje = $(".nuevoPorcentaje").val(); // VALOR DE PORCENTAJE QUE INGRESEN EN EL FORMULARIO

    //OBTENIENDO EL PORCENTAJE AL PRECIO DE COMPRA
    // Y SUMANDO AL PRECIO DE VENTA FINAL
    var porcentaje =
      Number(($("#nuevoPrecioCompra").val() * valorPorcentaje) / 100) +
      Number($("#nuevoPrecioCompra").val());

    var editarPorcentaje =
      Number(($("#editarPrecioCompra").val() * valorPorcentaje) / 100) +
      Number($("#editarPrecioCompra").val());

    $("#nuevoPrecioVenta").val(porcentaje); // ASIGNANDOLE EL PRECIO DE VENTA
    $("#editarPrecioVenta").val(editarPorcentaje); // ASIGNANDOLE EL PRECIO DE VENTA

    // HABILITANDO PROPIEDAD READONLY AL PRECIO DE VENTA MIENTRAS EL CHECKBOX ESTE
    // EN TRUE Y NO PUEDA MODIFICAR EL PRECIO
    $("#nuevoPrecioVenta").prop("readonly", true);
    $("#editarPrecioVenta").prop("readonly", true);
  }
});

// CAMBIANDO EL PORCENTAJE DE PRECIO DE VENTA
$(".nuevoPorcentaje").change(function () {
  // VALIDANDO QUE EL CHECKBOX SEA TRUE
  if ($(".porcentaje").prop("checked")) {
    var valorPorcentaje = $(this).val(); // VALOR DE PORCENTAJE QUE INGRESEN EN EL FORMULARIO

    //OBTENIENDO EL PORCENTAJE AL PRECIO DE COMPRA
    // Y SUMANDO AL PRECIO DE VENTA FINAL
    var porcentaje =
      Number(($("#nuevoPrecioCompra").val() * valorPorcentaje) / 100) +
      Number($("#nuevoPrecioCompra").val());

    var editarPorcentaje =
      Number(($("#editarPrecioCompra").val() * valorPorcentaje) / 100) +
      Number($("#editarPrecioCompra").val());

    $("#nuevoPrecioVenta").val(porcentaje); // ASIGNANDOLE EL PRECIO DE VENTA
    $("#editarPrecioVenta").val(editarPorcentaje); // ASIGNANDOLE EL PRECIO DE VENTA

    // HABILITANDO PROPIEDAD READONLY AL PRECIO DE VENTA MIENTRAS EL CHECKBOX ESTE
    // EN TRUE Y NO PUEDA MODIFICAR EL PRECIO
    $("#nuevoPrecioVenta").prop("readonly", true);
    $("#editarPrecioVenta").prop("readonly", true);
  }
});
// PLUGIN ICHECK DE JQUERY

//CUANDO EL CHECKBOX SEA FALSE
// QUE SE PUEDA EDITAR EL PRECIO DE VENTA
$(".porcentaje").on("ifUnchecked", function () {
  $("#nuevoPrecioVenta").prop("readonly", false);
  $("#editarPrecioVenta").prop("readonly", false);
});

//CUANDO EL CHECKBOX SEA TRUE
// QUE SE NO PUEDA EDITAR EL PRECIO DE VENTA
$(".porcentaje").on("ifChecked", function () {
  $("#nuevoPrecioVenta").prop("readonly", true);
  $("#editarPrecioVenta").prop("readonly", true);
});

// SUBIENDO FOTO  DEL PRODUCTO

$(".nuevaImagen").change(function () {
  var imagen = this.files[0];

  //   VALIDANDO FORMATO DE IMAGEN JPG O PNG
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $(".nuevaImagen").val("");
    swal({
      type: "error",
      text: "¡La imagen debe ser formato JPG o PNG!",
      title: "¡Error al subir la imagen!",
      confirmButtonText: "¡Cerrar!",
    });
    //VALIDANDO QUE FOTO SEA COMO MÁXIMO 2 MB CON SIZE EN BYTES
  } else if (imagen["size"] > 2000000) {
    $(".nuevaImagen").val("");
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

// EDITAR PRODUCTO

//CUANDO EL DOCUMENTO ESTÉ CARGADO VA A BUSCAR LA CLASE BTN
// Y CUANDO LA ENCUENTRE CARGUE LOS VALORES DEL PRODUCTO AL FORMULARIO PARA EDITAR
$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function () {
  var idProducto = $(this).attr("idProducto");

  var datos = new FormData();
  datos.append("idProducto", idProducto);

  // MUESTRA LOS DATOS CARGADOS EN  EL MODAL DE EDITAR PRODUCTO
  $.ajax({
    url: "ajax/productos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      var datosCategoria = new FormData();
      datosCategoria.append("idCategoria", respuesta["id_categoria"]);

      // MUESTRA LAS CATEGORIAS CARGADAS EN EL SELECT DEL MODAL DE EDITAR PRODUCTO
      $.ajax({
        url: "ajax/categorias.ajax.php",
        method: "POST",
        data: datosCategoria,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
          $("#editarCategoria").val(respuesta["id"]);
          $("#editarCategoria").html(respuesta["categoria"]);
        },
      });

      $("#editarCodigo").val(respuesta["codigo"]);
      $("#editarDescripcion").val(respuesta["descripcion"]);
      $("#editarStock").val(respuesta["stock"]);
      $("#editarPrecioCompra").val(respuesta["precio_compra"]);
      $("#editarPrecioVenta").val(respuesta["precio_venta"]);

      //CARGANDO FOTO AL MODAL DE EDITAR PRODUCTO QUE TIENE EN BASE DE DATOS
      if (respuesta["imagen"] != "") {
        $("#imagenActual").val(respuesta["imagen"]);
        $(".previsualizar").attr("src", respuesta["imagen"]);
      }
    },
  });
});

$(".tablaProductos tbody").on(
  "click",
  "button.btnEliminarProducto",
  function () {
    var idProducto = $(this).attr("idProducto");
    var codigo = $(this).attr("codigo");
    var imagen = $(this).attr("imagen");
    swal({
      type: "warning",
      text: "¡Si no lo está puede cancelar la acción!",
      title: "¿Está seguro de borrar el producto?",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, borrar producto!",
    }).then(function (result) {
      if (result.value) {
        //OCUPANDO VARIABLES GET PARA ENVIAR ID Y RUTA DE FOTO PARA SU ELIMINACION
        window.location =
          "index.php?ruta=productos&idProducto=" +
          idProducto +
          "&codigo=" +
          codigo +
          "&imagen=" +
          imagen;
      }
    });
  }
);
