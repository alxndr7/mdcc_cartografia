function limpiar_dl_memo_desc(tip)
{

    $("#sector_cat").val("");
    $("#mzna_cat").val("");
    $("#lote_cat").val("");
    $("#id_men_desc").val("");
    $('#hab_urb').val("");
    $('#mzna').val("");
    $('#lote').val("");
    $('#zona').val("");
    $("#insc_si").prop("checked",false);
    $("#insc_no").prop('checked', true);
    $("#partida").attr('disabled', true);
    $("#partida").val("");
    $("#propietario").val(0);
    $("#area_terreno").val("");
    $("#area_libre").val("");
    $("#frente").val("");
    $("#derecho").val("");
    $("#izquierdo").val("");
    $("#fondo").val("");
    $("#serv_si").prop('checked', false);
    $("#serv_no").prop('checked', true);
    $("#serv_luz").attr('disabled', true);
    $("#serv_agua").attr('disabled', true);
    $("#serv_desag").attr('disabled', true);
    $("#serv_luz").prop('checked', false);
    $("#serv_agua").prop('checked',false);
    $("#serv_desag").prop('checked', false);
    $("#perimetro_total").val("");

}

function clicknewmemodesc()
{
    limpiar_dl_memo_desc();
    $("#checkout-form").validate().resetForm();
    $("#checkout-form").validate().reset();
    $(".state-error").removeClass("state-error");
    $("#dlg_new_edit_memo_desc").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  MEMORIA DESCRIPTIVA (NUEVO) :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                prueba_validar();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_new_edit_memo_desc").dialog('open');
}

function inscrita_rbtn(obj){
    $('#lblpartida').addClass('state-success').removeClass('state-error');
    $("#partida-error").hide();
    if(obj.id == "insc_no"){
        $("#partida").prop( "disabled", true );
    }
    else
        $( "#partida").prop( "disabled", false );
}

function servicios_rbtn(obj){

    if(obj.id == "serv_no"){
        $('input[name="checkbox_serv"]').attr('disabled', true);
        $("#serv_luz").prop("checked",false);
        $("#serv_agua").prop("checked",false);
        $("#serv_desag").prop("checked",false);
       // $("#partida").prop( "disabled", true );
    }
    else{
        $('input[name="checkbox_serv"]').attr('disabled', false);
    }

}


function prueba_validar(){
    //validar_form.resetForm();
    //$("#selectId option:selected").html();
    //$('#list option:selected').val();
    //$("#neym option:selected").text()
    //alert($("#list option:selected").text());
    //alert($("#list").selectedIndex);
    //alert($("#items option:selected").attr('value'));
    //alert($("#serv_luz").is(':checked'));

    if($("#checkout-form").valid())
        save_edit_memo_desc(1);
}


function clickmodmemodesc()
{
    limpiar_dl_memo_desc();
    $("#checkout-form").validate().resetForm();
    $("#checkout-form").validate().reset();
    $(".state-error").removeClass("state-error");

    $("#dlg_new_edit_memo_desc").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  MEMORIA DESCRIPTIVA (EDITAR) :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                save_edit_memo_desc(2);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_new_edit_memo_desc").dialog('open');


    MensajeDialogLoadAjax('dlg_new_edit_memo_desc', '.:: Cargando ...');

    id = $("#current_id").val();
    $.ajax({url: 'memoria_descriptiva/'+id,
        type: 'GET',
        success: function(r)
        {
            $("#sector_cat").val(r[0].sector_cat);
            $("#mzna_cat").val(r[0].mzna_cat);
            $("#lote_cat").val(r[0].lote_cat);
            $("#id_men_desc").val(r[0].id_men_desc);
            $("#mes").val(r[0].mes);
            $("#anio").val(r[0].anio);
            $("#departamento").val(r[0].id_dep);
            $("#provincia").val(r[0].id_prov);
            $("#distritos").val(r[0].id_dist);
            $('#hab_urb').val(r[0].nomb_hab_urba);
            $('#mzna').val(r[0].mzna);
            $('#lote').val(r[0].lote);
            $('#zona').val(r[0].zona);
            //alert(r[0].f_inscrita);
            if(r[0].f_inscrita){
                $("#insc_si").prop("checked",true);
                $("#insc_no").prop('checked', false);
                $("#partida").attr('disabled', false);
                $("#partida").val(r[0].partida);
            }else{
                $("#insc_si").prop('checked', false);
                $("#insc_no").prop('checked', true);
                $("#partida").attr('disabled', true);
            }
            $("#propietario").val(r[0].cod_prop);
            $("#area_terreno").val(r[0].area_terreno);
            $("#area_libre").val(r[0].area_libre);
            $("#frente").val(r[0].lindero_frente);
            $("#derecho").val(r[0].lindero_derecha);
            $("#izquierdo").val(r[0].lindero_izquierda);
            $("#fondo").val(r[0].lindero_fondo);
            $("#perimetro_total").val(r[0].perimetro_total)

            if(r[0].f_servicios){
                $("#serv_si").prop("checked",true);
                $("#serv_no").prop('checked', false);
                $("#serv_luz").attr('disabled', false);
                $("#serv_agua").attr('disabled', false);
                $("#serv_desag").attr('disabled', false);
                $("#serv_luz").prop('checked', r[0].f_luz);
                $("#serv_agua").prop('checked', r[0].f_agua);
                $("#serv_desag").prop('checked', r[0].f_desague);

                $("#partida").val(r[0].partida);
            }else{
                $("#serv_si").prop('checked', false);
                $("#serv_no").prop('checked', true);
                $("#serv_luz").attr('disabled', true);
                $("#serv_agua").attr('disabled', true);
                $("#serv_desag").attr('disabled', true);
                $("#serv_luz").prop('checked', false);
                $("#serv_agua").prop('checked',false);
                $("#serv_desag").prop('checked', false);
            }
            //$('#hab_urb').val(r[0].id_hab_urba);
            MensajeDialogLoadAjaxFinish('dlg_new_edit_memo_desc');

        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_new_edit_memo_desc');
        }
    });
}




function save_edit_memo_desc(tipo) {

    sector_cat = $("#sector_cat").val();
    mzna_cat = $("#mzna_cat").val();
    lote_cat = $("#lote_cat").val();
    mes = $("#mes").val();
    anio = $("#anio").val();
    dept = $("#departamento").val();
    prov = $("#provincia").val();
    dist = $("#distritos").val();

    var val = $('#hab_urb').val()
    var xyz = $('#list option').filter(function() {
        return this.value == val;
    }).data('xyz');
    var id_hab_urba = xyz ? '' + xyz : 'No Match';

    mzna = $("#mzna").val();
    lote = $("#lote").val();
    zona = $("#zona").val();
    if($('#insc_si').is(':checked')){
        insc_si = true;
        partida = $("#partida").val();
    }else{
        insc_si = false;
        partida = '';
    }
    propietario = $("#propietario").val();
    area_terreno = $("#area_terreno").val();
    area_libre = $("#area_libre").val();
    frente = $("#frente").val();
    derecho = $("#derecho").val();
    izquierdo = $("#izquierdo").val();
    fondo = $("#fondo").val();
    perimetro_total = $("#perimetro_total").val();
    if($('#serv_si').is(':checked')){
        serv_si = true;
        serv_luz = $("#serv_luz").is(':checked');
        serv_agua = $("#serv_agua").is(':checked');
        serv_desag = $("#serv_desag").is(':checked');
    }else{
        serv_si = false;
        serv_luz = false;
        serv_agua = false;
        serv_desag = false;
    }

    if (tipo == 1) {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'insert_new_memo_desc',
            type: 'POST',
            data: {
                id_dep: dept,
                id_prov:prov,
                id_dist:dist,
                id_hab_urba:id_hab_urba,
                mzna:mzna,
                lote:lote,
                zona:zona,
                f_inscrita: insc_si,
                partida: partida,
                cod_prop:propietario,
                area_terreno: area_terreno,
                area_libre: area_libre,
                lindero_frente: frente,
                lindero_derecha: derecho,
                lindero_izquierda: izquierdo,
                lindero_fondo: fondo,
                f_servicios:serv_si,
                f_luz:serv_luz,
                f_agua:serv_agua,
                f_desague:serv_desag,
                mes:mes,
                anio: anio,
                sector_cat: sector_cat,
                mzna_cat :mzna_cat,
                lote_cat: lote_cat,
                perimetro_total : perimetro_total
            },
            success: function (data) {
                dialog_close('dlg_new_edit_memo_desc');
                fn_actualizar_grilla('tabla_memo_desc', 'list_memo_desc');
                MensajeExito('Nueva Memoria Descriptiva', 'El item Ha sido Insertado.');
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
                        url: 'update_memo_desc',
                        type: 'POST',
                        data: {
                            id_men_desc: id,
                            id_dep: dept,
                            id_prov:prov,
                            id_dist:dist,
                            id_hab_urba:id_hab_urba,
                            mzna:mzna,
                            lote:lote,
                            zona:zona,
                            f_inscrita: insc_si,
                            partida: partida,
                            cod_prop:propietario,
                            area_terreno: area_terreno,
                            area_libre: area_libre,
                            lindero_frente: frente,
                            lindero_derecha: derecho,
                            lindero_izquierda: izquierdo,
                            lindero_fondo: fondo,
                            perimetro_total : perimetro_total,
                            f_servicios:serv_si,
                            f_luz:serv_luz,
                            f_agua:serv_agua,
                            f_desague:serv_desag,
                            mes:mes,
                            anio: anio,
                            sector_cat: sector_cat,
                            mzna_cat :mzna_cat,
                            lote_cat: lote_cat

                        },
                        success: function (data) {
                            MensajeExito('Editar Sector', 'Memoria Descriptiva: '+ id + '  -  Ha sido Modificado.');
                            fn_actualizar_grilla('tabla_memo_desc', 'list_memo_desc');
                            dialog_close('dlg_new_edit_memo_desc');
                            MensajeDialogLoadAjaxFinish('dlg_new_edit_memo_desc', '.:: CARGANDO ...');
                        },
                        error: function (data) {
                            mostraralertas('* Contactese con el Administrador...');
                            MensajeAlerta('Editar Memoria Descriptiva','Ocurrio un Error en la Operacion.');
                            dialog_close('dlg_new_edit_memo_desc');
                            MensajeDialogLoadAjaxFinish('dlg_new_edit_memo_desc', '.:: CARGANDO ...');
                        }
                    });
                },
                Cancelar: function () {
                    MensajeAlerta('Editar Sector','Operacion Cancelada.');
                }
            }
        });

    }
}

function delete_memo_desc() {
    id = $("#current_id").val();

    $.confirm({
        title: '.:Cuidado... !',
        content: 'Los Cambios no se podran revertir...',
        buttons: {
            Confirmar: function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'delete_memo_desc',
                    type: 'POST',
                    data: {id_men_desc: id},
                    success: function (data) {
//                        $.alert(raz_soc + '- Ha sido Eliminado');
                        fn_actualizar_grilla('tabla_memo_desc', 'list_memo_desc');
                        dialog_close('dlg_new_edit_memo_desc');
                        MensajeExito('Eliminar Memoria Descriptiva', id + ' - Ha sido Eliminado');
                    },
                    error: function (data) {
                        MensajeAlerta('Eliminar Memoria Descriptiva', id + ' - No se pudo Eliminar.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
                    }
                });
            },
            Cancelar: function () {
                MensajeAlerta('Eliminar Memoria Descriptiva','Operacion Cancelada.');
            }

        }
    });
}

function cargarprov(){
    //alert($("#departamento").val());
    MensajeDialogLoadAjax('provincia', '.:: CARGANDO ...');
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'select_provincias',
        type: 'POST',
        data: {cod: $("#departamento").val()},
        success: function (data) {
            //alert(data);
            $('#sect_provs').html(data);
//                        $.alert(raz_soc + '- Ha sido Eliminado');
            //fn_actualizar_grilla('tabla_sectores', 'list_sectores');
            //dialog_close('dlg_nuevo_sector');
            //MensajeExito('Eliminar Sector', id + ' - Ha sido Eliminado');
            MensajeDialogLoadAjaxFinish('provincia', '.:: CARGANDO ...');

        },
        error: function (data) {
            MensajeAlerta('Eliminar Sector', id + ' - No se pudo Eliminar.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
        }
    });

}

function cargardist(){
    //alert($("#departamento").val());
    MensajeDialogLoadAjax('distritos', '.:: CARGANDO ...');
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'select_distritos',
        type: 'POST',
        data: {cod_prov: $("#provincia").val()},
        success: function (data) {
            //alert(data);
            $('#sect_dists').html(data);
//                        $.alert(raz_soc + '- Ha sido Eliminado');
            //fn_actualizar_grilla('tabla_sectores', 'list_sectores');
            //dialog_close('dlg_nuevo_sector');
            //MensajeExito('Eliminar Sector', id + ' - Ha sido Eliminado');
            MensajeDialogLoadAjaxFinish('distritos', '.:: CARGANDO ...');

        },
        error: function (data) {
            MensajeAlerta('Eliminar Sector', id + ' - No se pudo Eliminar.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
        }
    });

}


function reporte_memo_desc()
{
    Id=$('#tabla_memo_desc').jqGrid ('getGridParam', 'selrow');
    if(Id==null)
    {
        mostraralertas("No hay Predio seleccionado para impresión");
        return false;
    }
    window.open('pre_reporte_md/'+Id);


}