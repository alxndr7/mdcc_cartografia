function limpiar_dlg(){
    $("#prop_desc").val('');
    $("#cod_prop").val(0);
}

function clicknewpropietario()
{
    limpiar_dlg();
    $("#dlg_new_edit_propietario").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO PROPIETARIO :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                save_edit_propietario(1);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_new_edit_propietario").dialog('open');
}

function clickmodpropietario()
{
    limpiar_dlg();

    $("#dlg_new_edit_propietario").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  EDITAR PROPIETARIO :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                save_edit_propietario(2);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_new_edit_propietario").dialog('open');


    MensajeDialogLoadAjax('dlg_new_edit_propietario', '.:: Cargando ...');

    id = $("#current_id").val();
    $.ajax({url: 'propietarios_mdesc/'+id,
        type: 'GET',
        success: function(r)
        {
            $("#cod_prop").val(r[0].cod_prop);
            $("#prop_desc").val(r[0].prop_desc);
            MensajeDialogLoadAjaxFinish('dlg_new_edit_propietario');

        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_new_edit_propietario');
        }
    });
}




function save_edit_propietario(tipo) {

    prop_desc = $("#prop_desc").val();

    if (tipo == 1) {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'insert_new_propietario',
            type: 'POST',
            data: {
                prop_desc: prop_desc
            },
            success: function (data) {
                dialog_close('dlg_new_edit_propietario');
                fn_actualizar_grilla('tabla_propietarios', 'list_propietarios');
                MensajeExito('Nuevo Propietario', 'El Propietario Ha sido Insertado.');
            },
            error: function (data) {
                mostraralertas('* Contactese con el Administrador...');
            }
        });
    }
    else if (tipo == 2) {
        id = $("#current_id").val();
        MensajeDialogLoadAjax('dialog_new_edit_Contribuyentes', '.:: CARGANDO ...');
        $.confirm({
            title: '.:Cuidado... !',
            content: 'Los Cambios no se podran revertir...',
            buttons: {
                Confirmar: function () {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'update_propietario',
                        type: 'POST',
                        data: {
                            cod_prop: id,
                            prop_desc: prop_desc

                        },
                        success: function (data) {
                            MensajeExito('Editar Propietario', 'Propietario: '+ id + '  -  Ha sido Modificado.');
                            fn_actualizar_grilla('tabla_propietarios', 'list_propietarios');
                            dialog_close('dlg_new_edit_propietario');
                            MensajeDialogLoadAjaxFinish('dlg_new_edit_propietario', '.:: CARGANDO ...');
                        },
                        error: function (data) {
                            mostraralertas('* Contactese con el Administrador...');
                            MensajeAlerta('Editar Propietario','Ocurrio un Error en la Operacion.');
                            dialog_close('dlg_new_edit_propietario');
                            MensajeDialogLoadAjaxFinish('dlg_new_edit_propietario', '.:: CARGANDO ...');
                        }
                    });
                },
                Cancelar: function () {
                    MensajeAlerta('Editar Propietario','Operacion Cancelada.');
                }
            }
        });

    }
}

function delete_propietario() {
    id = $("#current_id").val();

    $.confirm({
        title: '.:Cuidado... !',
        content: 'Los Cambios no se podran revertir...',
        buttons: {
            Confirmar: function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'delete_propietario',
                    type: 'POST',
                    data: {cod_prop: id},
                    success: function (data) {
//                        $.alert(raz_soc + '- Ha sido Eliminado');
                        fn_actualizar_grilla('tabla_propietarios', 'list_propietarios');
                        dialog_close('dlg_new_edit_propietario');
                        MensajeExito('Eliminar Propietario', id + ' - Ha sido Eliminado');
                    },
                    error: function (data) {
                        MensajeAlerta('Eliminar Propietario', id + ' - No se pudo Eliminar.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
                    }
                });
            },
            Cancelar: function () {
                MensajeAlerta('Eliminar Propietario','Operacion Cancelada.');
            }

        }
    });
}

