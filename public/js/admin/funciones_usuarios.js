$(document).on('ready', function() {
    $('#admin-select-institucion-usuarios option[value=""]').on('change');
    $('#admin-alert-institucion-usuarios').show();
    $('[name=admin-submenu-usuarios]').hide();
    $('[name=content-usuarios]').hide();
});

$('[name=nav-admin-usuarios-activos]').on('click', function() {
    let identificador = $('#admin-select-institucion-usuarios').val();
    $('#nav-admin-usuarios-activos-'+identificador).addClass('active');
    $('#admin-usuarios-activos-'+identificador).show();
    $('#nav-admin-usuarios-inactivos-'+identificador).removeClass('active');
    $('#admin-usuarios-inactivos-'+identificador).hide();
});

$('[name=nav-admin-usuarios-inactivos]').on('click', function() {
    let identificador = $('#admin-select-institucion-usuarios').val();
    $('#nav-admin-usuarios-activos-'+identificador).removeClass('active');
    $('#admin-usuarios-activos-'+identificador).hide();
    $('#nav-admin-usuarios-inactivos-'+identificador).addClass('active');
    $('#admin-usuarios-inactivos-'+identificador).show();
});

$('#admin-select-institucion-usuarios').on('change', function() {
    let institucion = $(this).val();
    $('[name=admin-submenu-usuarios]').hide();
    $('[name=content-usuarios]').hide();

    if (institucion == '') {
        $('[name=admin-submenu-usuarios]').hide();
        $('[name=content-usuarios]').hide();
        $('#admin-alert-institucion-usuarios').show();
    }
    else {
        $('#admin-alert-institucion-usuarios').hide();
        $('#admin-submenu-usuarios-'+institucion).show();
        $('#content-usuarios-'+institucion).show();
        $('#nav-admin-usuarios-activos-'+institucion).click();
    }
});