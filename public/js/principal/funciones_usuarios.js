$('#btn-cambiar-usvi-foto').on('click', function() {
    $('#foto').show();
    $("#foto").val(null);
    $('#img-usvi-foto-nueva').attr('src', '');
    $('#img-usvi-foto-nueva').show();
    $('#btn-cancelar-usvi-foto').show();
    $('#img-usvi-foto').hide();
    $('#btn-cambiar-usvi-foto').hide();
});

$('#btn-cancelar-usvi-foto').on('click', function() {
    $('#foto').hide();
    $('#foto').val(null);
    $('#img-usvi-foto-nueva').attr('src', '');
    $('#img-usvi-foto-nueva').hide();
    $('#btn-cancelar-usvi-foto').hide();
    $('#img-usvi-foto').show();
    $('#btn-cambiar-usvi-foto').show();
});