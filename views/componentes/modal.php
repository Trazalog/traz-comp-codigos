<div class='modal fade' id='modalCodigos' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' onclick='cierraModalImpresion()' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <h4 class='modal-title' id='myModalLabel'>Impresion de Etiqueta</h4>
      </div>
      <div class='modal-body modalBodyCodigos' id='modalBodyCodigos'>

          <div id="infoEtiqueta"></div>

          <div class="center-block" id="contenedorCodigo">
              <!-- <img class="center-block" id="codigoImage" src="" alt="codigo qr" width="100" height="100"> -->
          </div>

      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-default' onclick='cierraModalImpresion()'>Cancelar</button>
        <button type='button' class='btn btn-primary' onclick='imprimirInfoQR()'>Imprimir</button>
      </div>
    </div>
  </div>
</div>

<script>

  // levanta el modal
  function verModalImpresion(titulo){
      // levanto modal con img de Codigo
      $("#modalCodigos").modal('show');
  }
  // trae codigo QR con los datos recibidos y agrega en modal
  function getQR(config, data){

      $.ajax({
          type: 'POST',
          dataType: 'json',
          data:{config, data},
          url: 'index.php/<?php echo COD ?>Codigo/generarQR',
          success: function(result) {

                if(result != null){
                    var qr = '<img class="center-block" id="codigoImage" src="'+result.filename+'" alt="codigo qr" width="100" height="100">';
                    // agrego codigo Qr al modal
                    $('#contenedorCodigo').append(qr);
                    //$('#codigoImage').attr('src', result.filename);
                }
          },
          error: function(result){

          },
          complete: function(){

          }
      });
  }
  // impresion de etiqueta
  function imprimirInfoQR(){
      var base = "<?php echo base_url()?>";
      $('.modalBodyCodigos').printThis(
          {
            // debug: true,
            // importCSS: true,
            // importStyle: true,
            pageTitle : "TRAZALOG TOOLS",
            //header: "<h1 style='text-align: center;'>Reporte Articulos Vencidos</h1>",
            loadCSS: "<?php echo base_url('lib/bower_components/bootstrap/dist/css/bootstrap.min.css')?>",
            //copyTagClasses: true,
            base: base

          }
      );


  }
  // cerrar modal
  function cierraModalImpresion(){
      // levanto modal con img de Codigo
      $("#modalCodigos").modal('hide');
  }

</script>
