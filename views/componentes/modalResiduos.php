<div class='modal fade' id='modalCodigos' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' onclick='cierraModalImpresion()' aria-label='Close'><span
                        aria-hidden='true'>&times;</span></button>
                <h4 class='modal-title' id='myModalLabel'>Código QR</h4>
            </div>
           <div class="modal-body modalBodyCodigos" id="modalBodyCodigos">

            <div class="container-fluid text-center">

                <!-- Logo centrado arriba -->
                <div class="mb-3">
                    <img id="logo" src="" alt="Logo" 
                        style="max-width: 250px; max-height: 150px; display:block; margin: 0 auto;">
                </div>

                <!-- QR centrado -->
                <div id="contenedorCodigo" class="mb-3" style="display: flex; justify-content: center;"></div>

                <!-- Info debajo centrada -->
                <div id="infoEtiqueta" class="mt-2 mb-2" style="text-align:left;"></div>

                <!-- Footer info centrada -->
                <div id="infoFooter" style="text-align:center;"></div>

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
function verModalImpresion(titulo) {
    // levanto modal con img de Codigo
    $("#modalCodigos").modal('show');
}

// trae codigo QR con los datos recibidos y agrega en modal
function getQR(config, data, direccion) {

    debugger;
console.log('sale por la funcion gertQR del modalGenerico');

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
                wc();
            }
        },
        error: function(result) {

        },
        complete: function() {
            wc();
        }
    });
}
// impresion de etiqueta
function imprimirInfoQR() {
    var base = "<?php echo base_url()?>";
    $('.modalBodyCodigos').printThis({
        debug: false,
        importCSS: false,
        importStyle: true,
        pageTitle: "TRAZALOG TOOLS",
        printContainer: true,
        //header: "<h1 style='text-align: center;'>Reporte Articulos Vencidos</h1>",
        loadCSS: "",
        copyTagClasses: true,
        afterPrint: function() {
            cierraModalImpresion();
        },
        base: base
    });
}
// cerrar modal
function cierraModalImpresion() {
    // levanto modal con img de Codigo
    $("#modalCodigos").modal('hide');
}
</script>