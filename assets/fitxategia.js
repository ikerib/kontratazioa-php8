require("select2")
const axios = require('axios');
$(function () {

    $('.select2').select2({ width: '100%' });

    const kontratuaId = $('#fitxategia_kontratua').val() ? $('#fitxategia_kontratua').val() : '-1';
    if (kontratuaId !== "") {
        $('#fitxategia_lotea').prop("disabled", false);
        $('#fitxategia_uploadFile_file').prop('disabled', false);
    }

    $('#fitxategia_kontratua').on('select2:select', function (e) {

        console.log('eeeeeeeeeeeeeeee')

    }).on('select2:close', function (e){
        const url = "/api/kontratuas/" + $(this).val() + ".json";

        $('#fitxategia_lotea').empty();
        $('#fitxategia_lotea').select2('destroy');
        $('#fitxategia_lotea').select2({
            ajax: {
                url: url,
                dataType: 'json',
                processResults: function (data) {
                    console.log(data.lotes);
                    return {
                        results: $.map(data.lotes, function(obj) {
                            return { id: obj.id, text: obj.name };
                        })
                    };
                }
            }
        });

        $('#fitxategia_lotea').prop("disabled", false);
        $('#fitxategia_uploadFile_file').prop('disabled', false);

    });

});
