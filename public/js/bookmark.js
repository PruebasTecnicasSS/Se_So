//bookmark js
$(function () {

    //delete a url
    $('a[id^=deleteUrl_]').click(function (event) {
        event.preventDefault();

        let id = $(this).attr('id').split('_');
        let idUrl = id[1];

        let deleteurl = function () {

            //get url for delete
            let url = $("#urlDelete").attr('href');

            //set id
            let param = {
                'id': idUrl,
            };


            let callbackAccept = function () {
                location.reload();
            };

            let callbackDeny = function () {
                $("#mensaje").html($("#errorDelete").val());
                openModal('errorUrl');
            };

            jsAjax(param, url, callbackAccept, callbackDeny);

        };

        /** alert modal semantic ui informacion */
        openModal('deleteBookmark', deleteurl);
    });

    //edit url
    $('a[id^=editUrl_]').click(function (event) {
        event.preventDefault();

        let id = $(this).attr('id').split('_');
        let idUrl = id[1];

        //get url
        let url = $('#url_' + codigo).text();

        //put url in the input for edit
        $("#editUrlInput").val(url);


        let save = function () {
            //get url for edit
            let url = $("#urlEdit").attr('href');

            //set params
            let param = {
                'id': idUrl,
                'url': $("#editUrlInput").val()
            };

            let callbackAccept = function () {
                location.reload();
            };

            let callbackDeny = function () {
                $("#mensaje").html($("#errorEdit").val());
                openModal('errorUrl');
            };

            jsAjax(param, url, callbackAccept, callbackDeny);


        };

        /** alerta modal semantic ui informacion */
        openModal('editBookmark', save);
    });

    //Add url
    $("#addUrl").click(function (event) {

        let url = $("#urlAdd").attr('href');

        let param = {
            'url': $("#newUrl").val()
        };

        let callbackAccept = function () {
            location.reload();
        };

        let callbackDeny = function () {
            $("#mensaje").html($("#errorEdit").val());
            openModal('errorUrl');
        };

        jsAjax(param, url, callbackAccept, callbackDeny);

    });


});