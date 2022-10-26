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
  }
  else{
    // REEMPLAZANDO FOTO DE DEFAULT POR LA QUE SELECCIONE EL USUARIO
    var datosImagen = new FileReader;
    datosImagen.readAsDataURL(imagen);

    $(datosImagen).on("load", function(event){
        var rutaImagen = event.target.result;
        $(".previsualizar").attr("src", rutaImagen);
    })
  }
});
