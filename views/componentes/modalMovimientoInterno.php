<div class='modal fade' id='modalCodigosMovimientoInterno' tabindex='-1' role='dialog' aria-labelledby='myModalLabelMovimientoInterno'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header bg-blue'>
                <button type='button' class='close' onclick='cierraModalImpresionMovimientoInterno()' aria-label='Close'>
                    <span aria-hidden='true' style='color:white;'>&times;</span>
                </button>
                <h4 class='modal-title' id='myModalLabelMovimientoInterno'>Código QR Movimiento Interno</h4>
            </div>
            <div class='modal-body modalBodyCodigosMovimientoInterno' id='modalBodyCodigosMovimientoInterno'>

                <div class="container-fluid text-center">

                    <!-- QR centrado -->
                    <div id="contenedorCodigoQrMovimientoInterno" style="display: inline-block; min-height: 20px; margin-bottom: 12px;"></div>

                    <!-- Remito - Fecha - Origen / Destino -->
                    <div id="infoQrMovimientoInterno" style="font-family: Arial, sans-serif; font-size: 13px; line-height: 1.6; text-align: center;"></div>

                </div>

            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-default' onclick='cierraModalImpresionMovimientoInterno()'>Cancelar</button>
                <button type='button' class='btn btn-primary' onclick='imprimirInfoQRMovimientoInterno()'>Imprimir</button>
            </div>
        </div>
    </div>
</div>
<script>
    // levanta el modal
    function verModalImpresionMovimientoInterno() {
        $("#modalCodigosMovimientoInterno").modal('show');
    }

    // impresion de etiqueta
    function imprimirInfoQRMovimientoInterno() {
        var base = "<?php echo base_url()?>";
        $('.modalBodyCodigosMovimientoInterno').printThis({
            debug: false,
            importCSS: false,
            importStyle: true,
            pageTitle: "TRAZALOG TOOLS",
            printContainer: true,
            loadCSS: "",
            copyTagClasses: true,
            afterPrint: function() {
                cierraModalImpresionMovimientoInterno();
            },
            base: base
        });
    }

    // cerrar modal
    function cierraModalImpresionMovimientoInterno() {
        $("#modalCodigosMovimientoInterno").modal('hide');
    }
</script>
