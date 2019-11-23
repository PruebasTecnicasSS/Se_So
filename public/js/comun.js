$(document).ready(function () {


    $("#datos").DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json'
        },
        "ordering": true
    });

    $("#datosGestion").DataTable({

        "ordering": true,
        aLengthMenu: [
            [10, 50, 100, -1],
            [10, 50, 100, "All"]
        ],
        iDisplayLength: -1
    });

    $("#datosLog").DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json'
        },
        "ordering": false
    });

})
;


/** open modal **/
function abrirDialogoModal(claseDelModal, callbackAccept, callbackDeny) {

    callbackDeny = typeof callbackDeny === 'undefined' ? function () {
        $("." + claseDelModal).modal('hide');
        return false;
    } : callbackDeny;


    callbackAccept = typeof callbackAccept === 'undefined' ? function () {
    } : callbackAccept;


    $("." + claseDelModal).modal({
        closable: false,
        transition: 'fade up',
        onApprove: callbackAccept,
        onDeny: callbackDeny
    }).modal('show');
}


// ajax
function jsAjax(param,url, callbackAccept, callbackDeny){

    $.ajax(
        {
            data: param,
            url: url,
            type: 'post',
            success: function (response) {
                callbackAccept;
            },
            error: function (xhr, status) {
                callbackDeny;
            },
        }
    );

}

/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/





