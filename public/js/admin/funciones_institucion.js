$(document).on('ready', function() {
    $('#nav-institucion-informacion').addClass('active');
    $('#admin-institucion-informacion').show();
    $('#nav-institucion-usuarios').removeClass('active');
    $('#admin-institucion-usuarios').hide();
    $('#nav-institucion-actividad').removeClass('active');
    $('#admin-institucion-actividad').hide();
});

$('#nav-institucion-informacion').on('click', function() {
    $('#nav-institucion-informacion').addClass('active');
    $('#admin-institucion-informacion').show();
    $('#nav-institucion-usuarios').removeClass('active');
    $('#admin-institucion-usuarios').hide();
    $('#nav-institucion-actividad').removeClass('active');
    $('#admin-institucion-actividad').hide();
});

$('#nav-institucion-usuarios').on('click', function() {
    $('#nav-institucion-informacion').removeClass('active');
    $('#admin-institucion-informacion').hide();
    $('#nav-institucion-usuarios').addClass('active');
    $('#admin-institucion-usuarios').show();
    $('#nav-institucion-actividad').removeClass('active');
    $('#admin-institucion-actividad').hide();
});

$('#nav-institucion-actividad').on('click', function() {
    $('#nav-institucion-informacion').removeClass('active');
    $('#admin-institucion-informacion').hide();
    $('#nav-institucion-usuarios').removeClass('active');
    $('#admin-institucion-usuarios').hide();
    $('#nav-institucion-actividad').addClass('active');
    $('#admin-institucion-actividad').show();
});

$('#btn-cambiar-logo').on('click', function() {
    $('#logo').show();
    $("#logo").val(null);
    $('#img-logo-nuevo').attr('src', '');
    $('#img-logo-nuevo').show();
    $('#btn-cancelar-logo').show();
    $('#img-logo').hide();
    $('#btn-cambiar-logo').hide();
});

$('#btn-cancelar-logo').on('click', function() {
    $('#logo').hide();
    $('#logo').val(null);
    $('#img-logo-nuevo').attr('src', '');
    $('#img-logo-nuevo').hide();
    $('#btn-cancelar-logo').hide();
    $('#img-logo').show();
    $('#btn-cambiar-logo').show();
});