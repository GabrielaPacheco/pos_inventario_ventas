// CARGAR TABLA DINÁMICA DE LOS PRODUCTOS
// $.ajax({
//   url: "ajax/datatable-productos.ajax.php",
//   success: function (respuesta) {
//     console.log("respuesta", respuesta);
//   },
// });

$(".tablaProductos").DataTable({
  ajax: "ajax/datatable-productos.ajax.php",
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
