
function new_dlg_map_limites(obj)
{
    $("#dlg_map").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  LIMITES :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                save_edit_manzana(1);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_map").dialog('open');

    $("#id").val(obj.get('gid'));
    $("#codigo").val(obj.get('nombre'));
    $("#sector").val(obj.get('mz_cat'));

}


function new_dlg_map_sectores(obj)
{
    $("#dlg_map").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  SECTORES :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                save_edit_manzana(1);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_map").dialog('open');

    $("#id").val(obj.get('gid'));
    $("#codigo").val(obj.get('nombre'));
    $("#sector").val(obj.get('mz_cat'));

}

function new_dlg_map_hab_urb(obj)
{

    $('#id_hab_urb_dist').val(obj.get('gid'));
    $('#descripcion_hab_urb').html('Habilitación: ' + obj.get('nom_hab_urb'));


    $("#dialog_distrital").dialog({
        autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  HABILITACIÓN URBANA DISTRITAL  :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                subir_archivos();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dialog_distrital").dialog('open');

    $("#cod_hab").val(obj.get('cod_hab'));
    $("#codigo").val(obj.get('nombre'));
    $("#sector").val(obj.get('mz_cat'));
    $("#nom_hab_urb").val(obj.get('nom_hab_urb'));
}

function new_dlg_map_prov(obj)
{
    $('#id_hab_urb_prov').val(obj.get('gid'));
    $('#descripcion_hab_urb_prov').html('Habilitación: ' + obj.get('nom_hab_urb'));

    $("#dialog_provincial").dialog({
        autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  HABILITACIÓN URBANA PROVINCIAL  :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                subir_hab_urb_prov();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dialog_provincial").dialog('open');
}


function new_dlg_map_cofopri(obj)
{

    $('#id_hab_urb_cofo').val(obj.get('gid'));
    $('#descripcion_hab_urb_cofo').html('Habilitación: ' + obj.get('nom_hab_urb'));

    $("#dialog_cofopri").dialog({
        autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  HABILITACIÓN URBANA COFOPRI  :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                subir_hab_urb_cofopri();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dialog_cofopri").dialog('open');
}


function new_dlg_map_sin_datos(obj)
{

    $('#id_hab_urb_sin_datos').val(obj.get('gid'));
    $('#descripcion_hab_urb_sd').html('Habilitación: ' + obj.get('nom_hab_urb'));

    $("#dialog_sin_datos").dialog({
        autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  HABILITACIÓN URBANA SIN INFORMACIÓN  :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                subir_hab_urb_sin_datos();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dialog_sin_datos").dialog('open');
}



function new_dlg_opc_aprob(obj)
{
    $("#dlg_opc_aprobado").dialog({
        autoOpen: false, modal: true, width: 300, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  TIPO DE APROBACION  :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Ver",
            "class": "btn btn-success bg-color-green",
            click: function () {
                abrir_aprobacion(obj);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_opc_aprobado").dialog('open');

}


function abrir_aprobacion(currentFeature){
    var id_aprob = $('#select_aprob').val();
    //alert(id_aprob);
    if('004' == id_aprob){
        new_dlg_map_hab_urb(currentFeature);
    }
    if('001' == id_aprob){
        new_dlg_map_prov(currentFeature);
    }
    if('002' == id_aprob){
        new_dlg_map_cofopri(currentFeature);
    }
    if('003' == id_aprob){
        new_dlg_map_sin_datos(currentFeature);
    }
}


function clickmodmzna()
{
    $("#dlg_manzana").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  EDITAR SECTOR :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                save_edit_manzana(2);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_manzana").dialog('open');


    MensajeDialogLoadAjax('dlg_manzana', '.:: Cargando ...');

    id = $("#current_id").val();
    $.ajax({url: 'catastro_mzns/'+id,
        type: 'GET',
        success: function(r)
        {
            $("#id_mzna").val(r[0].id_mzna);
            $("#id_sector_nuevo_editar").val(r[0].id_sect);
            $("#codi_mzna").val(r[0].codi_mzna);
            $("#mzna_dist").val(r[0].mzna_dist);
            MensajeDialogLoadAjaxFinish('dlg_manzana');

        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_manzana');
        }
    });
}


function get_mzns_por_sector(id_sec){
    //var map = new ol.Map("map");
    // add layers here"POINT(-71.546226195617 -16.3045550718574)"
   // map.setCenter(new ol.LonLat(-71.546226195617, -16.3045550718574), 5);
    if(id_sec != '0')
    {
        //alert(id_sec);
        MensajeDialogLoadAjax('map', '.:: CARGANDO ...');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_centro_sector',
            type: 'POST',
            data: {codigo: id_sec+""},
            success: function (data) {
//                        $.alert(raz_soc + '- Ha sido Eliminado');
                //alert(data[0].lat + " / " + data[0].lon);
                map.getView().setCenter(ol.proj.transform([parseFloat(data[0].lat),parseFloat(data[0].lon)], 'EPSG:4326', 'EPSG:3857'));
                map.getView().setZoom(16);
            },
            error: function (data) {
                MensajeAlerta('Eliminar Arancel Rústico', id + ' - No se pudo Eliminar.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
            }
        });

        //alert($("#departamento").val());
/*
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'mznas_x_sector',
            type: 'POST',
            data: {codigo: id_sec+""},
            success: function (data) {
                //alert(data);
                $('#select_manzanas').html(data);
//                        $.alert(raz_soc + '- Ha sido Eliminado');
                //fn_actualizar_grilla('tabla_sectores', 'list_sectores');
                //dialog_close('dlg_nuevo_sector');
                //MensajeExito('Eliminar Sector', id + ' - Ha sido Eliminado');
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró ningún predio.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
            }
        });*/

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'geogetmznas_x_sector',
            type: 'POST',
            data: {codigo: id_sec+""},
            success: function (data) {
                //alert(data[0].json_build_object);
                //alert(geojson_manzanas2);
                map.removeLayer(lyr_manzanas2);
                var format_manzanas2 = new ol.format.GeoJSON();
                var features_manzanas2 = format_manzanas2.readFeatures(JSON.parse(data[0].json_build_object),
                    {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_manzanas2 = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                //vectorSource.addFeatures(features_manzanas2);
                jsonSource_manzanas2.addFeatures(features_manzanas2);
                lyr_manzanas2 = new ol.layer.Vector({
                    source:jsonSource_manzanas2,
                    style: label_manzanas,
                    title: "manzanas"
                });

                map.addLayer(lyr_manzanas2);
                layersList[2] = lyr_manzanas2;
                //alert(layersList.length);
                MensajeDialogLoadAjaxFinish('map', '.:: CARGANDO ...');

            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró ningún predio.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
            }
        });

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_lotes_x_sector',
            type: 'POST',
            data: {codigo: id_sec+""},
            success: function (data) {
                //alert(data[0].json_build_object);
                //alert(geojson_manzanas2);
                map.removeLayer(lyr_lotes3);
                var format_lotes3 = new ol.format.GeoJSON();
                var features_lotes3 = format_lotes3.readFeatures(JSON.parse(data[0].json_build_object),
                    {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_lotes3 = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                //vectorSource.addFeatures(features_manzanas2);
                jsonSource_lotes3.addFeatures(features_lotes3);

                lyr_lotes3 = new ol.layer.Vector({
                    source:jsonSource_lotes3,
                    style: label_lotes,
                    title: "lotes"
                });

                map.addLayer(lyr_lotes3);
                layersList[3] = lyr_lotes3;

                //alert(layersList.length);
                MensajeDialogLoadAjaxFinish('map', '.:: CARGANDO ...');

            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró ningún predio.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
            }
        });
    }

    else{
        alert("Seleccione un sector");
    }

}

function label_manzanas(feature, resolution) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: 'red',
            width: 2
        }),
        fill: new ol.style.Fill({
            color: 'rgba(255, 0, 0, 0.1)'
        }),
        text: new ol.style.Text({
            text: feature.get('mz_cat')
        })
    });
}

function label_lotes(feature) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: 'green',
            width: 1
        }),
        fill: new ol.style.Fill({
            color: 'rgba(0, 255, 0, 0.1)'
        }),
        text: new ol.style.Text({
            font: '12px Calibri,sans-serif',
            fill: new ol.style.Fill({ color: '#000' }),
            stroke: new ol.style.Stroke({
                color: '#fff', width: 2
            }),
            // get the text from the feature - `this` is ol.Feature
            // and show only under certain resolution
            text: map.getView().getZoom() > 16 ? feature.get('codi_lote') : ''
        })
         /*
        text: new ol.style.Text({
            text: feature.get('nom_lote')
        })
       text: map.getView().getZoom() > 12 ? feature.get('nom_lote') : ''*/
    });
}

function get_predios(){
    //alert(1);
    var sector = $('#sectores_map').val();

    //alert($('#draw_predios').is(':checked'));
    if($('#draw_predios').is(':checked')){
        if(sector != '0')
        {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: 'get_predios_rentas',
                type: 'POST',
                data: {codigo: sector},
                success: function (data) {
                    //alert(data[0].json_build_object);
                    //alert(geojson_manzanas2);
                    map.removeLayer(lyr_predios4);
                    var format_predios4 = new ol.format.GeoJSON();
                    var features_predios4 = format_predios4.readFeatures(JSON.parse(data[0].json_build_object),
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_predios4 = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    //vectorSource.addFeatures(features_manzanas2);
                    jsonSource_predios4.addFeatures(features_predios4);
                    lyr_predios4 = new ol.layer.Vector({
                        source:jsonSource_predios4,
                        style: label_predios,
                        title: "predios"
                    });

                    map.addLayer(lyr_predios4);
                    layersList[4] = lyr_predios4;
                    //alert(layersList.length);
                    MensajeDialogLoadAjaxFinish('map', '.:: CARGANDO ...');

                },
                error: function (data) {
                    MensajeAlerta('Predios', 'No se encontraron predios en este sector');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
                }
            });


        }
        else{
            $("#draw_predios").prop("checked",false);
            alert('Seleccione un sector');
        }
    }
    else {
        map.removeLayer(lyr_predios4);
    }

}

function label_predios(feature) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: 'green',
            width: 1
        }),
        fill: new ol.style.Fill({
            color: 'rgb(255, 255, 0)'
        }),
        text: new ol.style.Text({
            font: '12px Calibri,sans-serif',
            fill: new ol.style.Fill({ color: '#000' }),
            stroke: new ol.style.Stroke({
                color: '#fff', width: 2
            }),
            // get the text from the feature - `this` is ol.Feature
            // and show only under certain resolution
            text: map.getView().getZoom() > 16 ? feature.get('nom_lote') : ''
        })
        /*
         text: new ol.style.Text({
         text: feature.get('nom_lote')
         })
         text: map.getView().getZoom() > 12 ? feature.get('nom_lote') : ''*/
    });
}



var doHover = false;
var onSingleClick2 = function(evt,id_layer) {
    if (doHover) {
        return;
    }
    var pixel = map.getEventPixel(evt.originalEvent);
    var coord = evt.coordinate;
    var popupField;
    var popupText = '';
    var currentFeature;
    var currentFeatureKeys;
    map.forEachFeatureAtPixel(pixel, function(feature, layer) {
        currentFeature = feature;
        currentFeatureKeys = currentFeature.getKeys();

        //alert(currentFeatureKeys);

        if(lyr_limites_distritales0 == layer && id_layer == '1'){
            new_dlg_map_limites(currentFeature);
        }
        if(lyr_sectores_cat1 == layer && id_layer == '3'){
            new_dlg_map_sectores(currentFeature);
        }
        if(lyr_hab_urb_cat1 == layer && id_layer == '2'){
                new_dlg_opc_aprob(currentFeature);
            //new_dlg_map_hab_urb(currentFeature);
        }
    });
};

function subir_archivos() {

    var form = new FormData($("#form_ind_docs")[0]);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'guardar_documentos',
        method: "POST",
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.msg == 'si') {
                dialog_close('dialog_distrital');
                location.reload();
            } else {
                mostraralertas('* Error al cambiar la foto.');
            }
        },
        error: function (er) {
            mostraralertas('* Error en Base de Datos.<br>* Comuniquese con el Administrador.');
        }
    });

}

function subir_hab_urb_cofopri(){
    var filesSelected = $("#cofo_doc1").val();
    if (filesSelected == '') {
        mostraralertasconfoco('* Seleccione una Foto', 'cofo_doc1');
        return false;
    }
    var form = new FormData($("#form_hab_urb_cofo")[0]);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'docs_hab_urb_cofopri',
        method: "POST",
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.msg == 'si') {
                dialog_close('dialog_cofopri');
                location.reload();
            } else {
                mostraralertas('* Error al cambiar la foto.');
            }
        },
        error: function (er) {
            mostraralertas('* Error en Base de Datos.<br>* Comuniquese con el Administrador.');
        }
    });
}


function subir_hab_urb_sin_datos(){
    var filesSelected = $("#sin_datos_doc1").val();
    if (filesSelected == '') {
        mostraralertasconfoco('* Seleccione una Foto', 'sin_datos_doc1');
        return false;
    }
    var form = new FormData($("#form_hab_urb_sin_datos")[0]);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'docs_hab_urb_sin_datos',
        method: "POST",
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.msg == 'si') {
                dialog_close('dialog_sin_datos');
                location.reload();
            } else {
                mostraralertas('* Error al cambiar la foto.');
            }
        },
        error: function (er) {
            mostraralertas('* Error en Base de Datos.<br>* Comuniquese con el Administrador.');
        }
    });
}

function subir_hab_urb_prov(obj)
{
    /*
    var filesSelected = $("#sin_datos_doc1").val();
    if (filesSelected == '') {
        mostraralertasconfoco('* Seleccione una Foto', 'sin_datos_doc1');
        return false;
    }*/
    var form = new FormData($("#form_hab_urb_prov")[0]);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'docs_hab_urb_prov',
        method: "POST",
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.msg == 'si') {
                dialog_close('dialog_provincial');
                location.reload();
            } else {
                mostraralertas('* Error al cambiar la foto.');
            }
        },
        error: function (er) {
            mostraralertas('* Error en Base de Datos.<br>* Comuniquese con el Administrador.');
        }
    });
}

map.on('singleclick', function(evt) {

    var selec_layer = $("#select_layer").val();
    //alert(selec_layer);
    onSingleClick2(evt,selec_layer);
});

var layerSwitcher = new ol.control.LayerSwitcher({
    tipLabel: 'Légende' // Optional label for button
});
map.addControl(layerSwitcher);