<div class='modal fade' id='modalCodigosHerramienta' tabindex='-1' role='dialog' aria-labelledby='myModalLabelHerramienta'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' onclick='cierraModalImpresionHerramienta()' aria-label='Close'><span
                        aria-hidden='true'>&times;</span></button>
                <h4 class='modal-title' id='myModalLabelHerramienta'>Código QR Herramienta</h4>
            </div>
            <div class='modal-body modalBodyCodigosHerramienta' id='modalBodyCodigosHerramienta'>

                <div class="container-fluid text-center">

                    <!-- QR centrado -->
                    <div id="contenedorCodigoQr" style="display: flex; justify-content: center; margin-bottom: 12px;"></div>

                    <!-- Codigo - Descripcion - Marca -->
                    <div id="infoQrHerramienta" style="font-family: Arial, sans-serif; font-size: 14px; line-height: 1.6; text-align: center; margin-bottom: 10px;"></div>

                    <!-- Tipos con color -->
                    <div id="tiposQrHerramienta" style="text-align: center;"></div>

                </div>

            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-default' onclick='cierraModalImpresionHerramienta()'>Cancelar</button>
                <button type='button' class='btn btn-primary' onclick='imprimirInfoQRHerramienta()'>Imprimir</button>
            </div>
        </div>
    </div>
</div>
<script>
    // Guarda config (desde BD), datos y direccion para generar el QR
    var __qrHerramientaConfig = null;
    var __qrHerramientaData = null;
    var __qrHerramientaDireccion = null;

    // levanta el modal
    function verModalImpresionHerramienta(titulo) {
        $("#modalCodigosHerramienta").modal('show');
    }

    // Guarda config base (titulo, pixel, level, framSize), datos y direccion; luego genera el QR
    function setDatosQrHerramienta(config, data, direccion) {
        __qrHerramientaConfig = config || {};
        __qrHerramientaData = data || null;
        __qrHerramientaDireccion = direccion || 'codigosQR/traz-comp-pan/herramientas';
        getQRHerramienta();
    }

    // genera el QR con la configuracion guardada (valor fijo desde base de datos)
    function getQRHerramienta() {

        if (__qrHerramientaData == null) return;

        var config = {
            titulo: __qrHerramientaConfig.titulo || '',
            pixel: __qrHerramientaConfig.pixel || '7',
            level: __qrHerramientaConfig.level || 'L',
            framSize: __qrHerramientaConfig.framSize || '2'
        };

        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {
                config,
                data: __qrHerramientaData,
                direccion: __qrHerramientaDireccion
            },
            url: 'index.php/<?php echo COD ?>Codigo/generarQR',
            success: function(result) {
                if (result != null) {
                    var qr = '<img id="codigoImageHerramienta" src="' + result.filename + '" alt="codigo qr">';
                    $('#contenedorCodigoQr').empty();
                    $('#contenedorCodigoQr').append(qr);
                }
            },
            error: function(result) {

            },
            complete: function() {

            }
        });
    }

    // impresion de etiqueta
    function imprimirInfoQRHerramienta() {
        var base = "<?php echo base_url()?>";
        $('.modalBodyCodigosHerramienta').printThis({
            debug: false,
            importCSS: false,
            importStyle: true,
            pageTitle: "TRAZALOG TOOLS",
            printContainer: true,
            loadCSS: "",
            copyTagClasses: true,
            afterPrint: function() {
                cierraModalImpresionHerramienta();
            },
            base: base
        });
    }

    // cerrar modal
    function cierraModalImpresionHerramienta() {
        $("#modalCodigosHerramienta").modal('hide');
    }
</script>