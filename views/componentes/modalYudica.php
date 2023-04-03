<div class='modal fade' id='modalCodigos' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' onclick='cierraModalImpresion()' aria-label='Close'><span
                        aria-hidden='true'>&times;</span></button>
                <h4 class='modal-title' id='myModalLabel'>Impresión de Etiqueta</h4>
            </div>
            <div class='modal-body modalBodyCodigos' id='modalBodyCodigos'>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12" id="contenedorCodigo"></div>
                        <div class="col-md-12" id="infoEtiqueta"></div>
                    </div>
                    <!-- Info qe va abajo del QR -->
                    <div id="infoFooter"></div>
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
// levanta el modal con código armado
function verModalImpresion(titulo) {
    $("#modalCodigos").modal('show');
}
// trae codigo QR con los datos recibidos y agrega en modal
function getQR(config, data, direccion) {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        data: {
            config,
            data,
            direccion
        },
        url: 'index.php/<?php echo COD ?>Codigo/generarQR',
        success: function(result) {

            if (result != null) {
                var qr = '<img  id="codigoImage" src="' + result.filename + '" alt="codigo qr" >';

                // agrego codigo Qr al modal
                $('#contenedorCodigo').append(qr);
            }
        },
        error: function(result) {

        },
        complete: function() {

        }
    });
}
// impresion de etiqueta
function imprimirInfoQR() {
    var base = "<?php echo base_url()?>";
    $('#modalCodigos #modalBodyCodigos').printThis({
        debug: false,
        importCSS: false,
        importStyle: true,
        pageTitle: "TRAZALOG TOOLS",
        printContainer: true,
        removeInline: true,
        printDelay: 3000,
        loadCSS: "<?php  echo base_url('lib/props/codigos-impresiones/alm-proc-yudica/yudica.css')?>",
        // copyTagClasses: true,
        afterPrint: function() {
            cierraModalImpresion();
            const confirm = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });

            confirm.fire({
               title: 'Impresión de etiqueta',
                text: "Finalizando impresión",
                type: 'success',
                showCancelButton: false,
                confirmButtonText: 'Hecho'
            }).then((result) => {
                //solamente recargo en caso de estar en la pantalla pedido de trabajo
                // if($("#miniView").length == 0){
                //     linkTo();
                // }
            });

        },
        base: base
    });

}
// cierra modal y el backdrop del mismo
function cierraModalImpresion() {
    $("#modalCodigos").modal('hide');
    $('.modal-backdrop').remove();
    // if($("#miniView").length == 0){
    //    linkTo();
    // }
}
</script>