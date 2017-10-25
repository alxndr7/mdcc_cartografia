@extends('layouts.app')

@section('content')
    <style>
        html, body {
            background-color: #ffffff;
        }
    </style>
    <style>
        html, body, #map {
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
        }
        .ol-touch .rotate-north {
            top: 80px;
        }
        .ol-mycontrol {
            background-color: rgba(255, 255, 255, 0.4);
            border-radius: 4px;
            padding: 2px;
            position: absolute;
            width:300px;
            top: 5px;
            left:40px;
        }
    </style>
    <!--
    <div id="map">
        <div id="popup" class="ol-popup">
            <a href="#" id="popup-closer" class="ol-popup-closer"></a>
            <div id="popup-content"></div>
        </div>
    </div>-->
    <form class="smart-form">


    <div id="map" style="background: white; height: 100%">
        <div id="popup" class="ol-popup">
            <a href="#" id="popup-closer" class="ol-popup-closer"></a>
            <div id="popup-content"></div>
        </div>
    </div>
        </form>

    <script>
        /*
        var url = 'https://sampleserver1.arcgisonline.com/ArcGIS/rest/services/' +
                'Specialty/ESRI_StateCityHighway_USA/MapServer';

        var layers = [
            new ol.layer.Tile({
                source: new ol.source.OSM()
            }),
            new ol.layer.Image({
                source: new ol.source.ImageArcGISRest({
                    ratio: 1,
                    params: {},
                    url: url
                })
            })
        ];
        var map = new ol.Map({
            layers: layers,
            target: 'map',
            view: new ol.View({
                center: [-10997148, 4569099],
                zoom: 4
            })
        });
*/


        window.app = {};
        var app = window.app;
        var layersList = [];
        var vectorSource = new ol.source.Vector({});
        var lyr_sectores_cat1;
        var lyr_manzanas2;
        var lyr_limites_distritales0;
        var lyr_lotes3;
        var lyr_predios4;
        var LayersList2= [lyr_sectores_cat1,lyr_manzanas2,lyr_limites_distritales0,lyr_lotes3,lyr_predios4];

        var defaultCerroColorado = new ol.style.Style({
            stroke: new ol.style.Stroke({
                color: '#0000ff',
                width: 2
            })
        });

        var manzanas_Style = new ol.style.Style({
            stroke: new ol.style.Stroke({
                color: '#ff0000',
                width: 2
            })
        });

        var selectEuropa = new ol.style.Style({
            stroke: new ol.style.Stroke({
                color: '#ff0000',
                width: 2
            })
        });

        app.CustomToolbarControl = function(opt_options) {

            var options = opt_options || {};

            var button = document.createElement('button');
            button.innerHTML = 'N';

            var button1 = document.createElement('button');
            button1.innerHTML = 'some button';

            var selectList = document.createElement("select");
            selectList.id = "sectores_map";
            selectList.className = "input-sm col-xs-5";
            selectList.onchange = function(e){
                console.log(e);
                get_mzns_por_sector(this.value);
                //alert(this.value);
            }


            var sectores = {!! json_encode($sectores) !!};
            var option = document.createElement("option");
            option.value = '0';
            option.text = "--- Sector ---";
            selectList.appendChild(option);
           // alert(global_cod_alm[0].codigo);
            for (var i = 0; i < sectores.length; i++) {
                var option = document.createElement("option");
                option.value = sectores[i].id_sec;
                option.text = sectores[i].sector;
                selectList.appendChild(option);
            }

            var selectList_layer = document.createElement("select");
            selectList_layer.id = "select_layer";
            selectList_layer.className = "input-sm col-xs-5";
            /*
            selectList_layer.onchange = function(e){
                console.log(e);
                get_mzns_por_sector(this.value);
                //alert(this.value);
            }*/

            var option_layer = document.createElement("option");
            option_layer.value = '0';
            option_layer.text = "--- Layer ---";
            selectList_layer.appendChild(option_layer);
            var option_layer = document.createElement("option");
            option_layer.value = '1';
            option_layer.text = "Limites Distritales";
            selectList_layer.appendChild(option_layer);

            var option_layer = document.createElement("option");
            option_layer.value = '2';
            option_layer.text = "Habilitaciones Urbanas";
            selectList_layer.appendChild(option_layer);

            var option_layer = document.createElement("option");
            option_layer.value = '3';
            option_layer.text = "Sectores";
            selectList_layer.appendChild(option_layer);
            /*

            var checkbox = document.createElement('input');
            checkbox.type = "checkbox";
            checkbox.name = "name"
            checkbox.value = "value";
            checkbox.id = "draw_predios";
            document.body.appendChild(checkbox);*/
            var div2 = document.createElement('div');
            div2.className = "col-xs-1";
/*
            var label = document.createElement('label');
            label.className = 'toggle col-xs-2';
            label.innerHTML = '<input type="checkbox" id="draw_predios" name="checkbox-toggle" onclick="get_predios();"> <i data-swchon-text="ON" data-swchoff-text="OFF"></i>Predios';
*/
            var this_ = this;
            var handleRotateNorth = function(e) {
                this_.getMap().getView().setRotation(0);
            };


            button.addEventListener('click', handleRotateNorth, false);
            button.addEventListener('touchstart', handleRotateNorth, false);

            var element = document.createElement('div');
            element.className = 'ol-unselectable ol-mycontrol';

            element.appendChild(selectList);
            element.appendChild(div2);
            element.appendChild(selectList_layer);
           // element.appendChild(label);

            ol.control.Control.call(this, {
                element: element,
                target: options.target
            });

        };
        ol.inherits(app.CustomToolbarControl, ol.control.Control);


        function styleFunction() {
            return [
                new ol.style.Style({
                    fill: new ol.style.Fill({
                        color: 'rgba(255,255,255,0.4)'
                    }),
                    stroke: new ol.style.Stroke({
                        color: '#3399CC',
                        width: 1.25
                    }),
                    text: new ol.style.Text({
                        font: '12px Calibri,sans-serif',
                        fill: new ol.style.Fill({ color: '#000' }),
                        stroke: new ol.style.Stroke({
                            color: '#fff', width: 2
                        }),
                        // get the text from the feature - `this` is ol.Feature
                        // and show only under certain resolution
                        text: map.getView().getZoom() > 12 ? this.get('description') : ''
                    })
                })
            ];
        }


        var map = new ol.Map({
            controls: ol.control.defaults({
                attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
                    collapsible: false
                })
            }).extend([
                new app.CustomToolbarControl()
            ]),
            layers: [
                new ol.layer.Group({
                    'title': 'Base maps',
                    layers: [
                        new ol.layer.Tile({
                            title: 'Water color',
                            type: 'base',
                            visible: false,
                            source: new ol.source.Stamen({
                                layer: 'watercolor'
                            })
                        }),
                        new ol.layer.Tile({
                            title: 'OSM',
                            type: 'base',
                            visible: true,
                            source: new ol.source.OSM()
                        }),
                        new ol.layer.Tile({
                            title: 'BLANK',
                            type: 'base',
                            visible: false
                        })
                    ]
                })
            ],
            target: 'map',
            view: new ol.View({
                center: [-11000000, 4600000],
                zoom: 4
            })
        });



        $.ajax({url: 'getlimites',
            type: 'GET',
            async: false,
            success: function(r)
            {
                geojson_limites_distritales0 = JSON.parse(r[0].json_build_object);
                var format_limites_distritales0 = new ol.format.GeoJSON();
                var features_limites_distritales0 = format_limites_distritales0.readFeatures(geojson_limites_distritales0,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_limites_distritales0 = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                //features_limites_distritales0.set('description', "1");
                //features_limites_distritales0.set('description', "1");
                //features_limites_distritales0.setStyle(styleFunction);
                jsonSource_limites_distritales0.addFeatures(features_limites_distritales0);

                lyr_limites_distritales0 = new ol.layer.Vector({
                    source:jsonSource_limites_distritales0,
                    style: defaultCerroColorado,
                    title: "Límites Distritales"
                });

                //lyr_limites_distritales0.set('fieldLabels', {'gid': 'no label', 'layer': 'no label', 'doctype': 'no label', });
                map.addLayer(lyr_limites_distritales0);

                //vectorSource.addFeature( featurething );
            }
        });

        $.ajax({url: 'getsectores',
            type: 'GET',
            async: false,
            success: function(r)
            {
                geojson_sectores_cat1 = JSON.parse(r[0].json_build_object);
                var format_sectores_cat1 = new ol.format.GeoJSON();
                var features_sectores_cat1 = format_sectores_cat1.readFeatures(geojson_sectores_cat1,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_sectores_cat1 = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                //features_limites_distritales0.set('description', "1");
                //features_limites_distritales0.setStyle(styleFunction);
                jsonSource_sectores_cat1.addFeatures(features_sectores_cat1);
                lyr_sectores_cat1 = new ol.layer.Vector({
                    source:jsonSource_sectores_cat1,
                    style: polygonStyleFunction,
                    title: "Sectores Catastrales"
                });
                map.addLayer(lyr_sectores_cat1);
            }
        });


        $.ajax({url: 'get_hab_urb',
            type: 'GET',
            async: false,
            success: function(r)
            {
                geojson_hab_urb_cat1 = JSON.parse(r[0].json_build_object);
                var format_hab_urb_cat1 = new ol.format.GeoJSON();
                var features_hab_urb_cat1 = format_hab_urb_cat1.readFeatures(geojson_hab_urb_cat1,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_hab_urb_cat1 = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });

                jsonSource_hab_urb_cat1.addFeatures(features_hab_urb_cat1);
                lyr_hab_urb_cat1 = new ol.layer.Vector({
                    source:jsonSource_hab_urb_cat1,
                    style: polygonStyleFunction_hab_urb,
                    title: "Habilitaciones Urbanas"
                });
                map.addLayer(lyr_hab_urb_cat1);
            }
        });
/*
        $.ajax({url: 'getmznas',
            type: 'GET',
            async: false,
            success: function(r)
            {
                var format_manzanas2 = new ol.format.GeoJSON();
                var features_manzanas2 = format_manzanas2.readFeatures(JSON.parse(r[0].json_build_object),
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_manzanas2 = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                //vectorSource.addFeatures(features_manzanas2);
                jsonSource_manzanas2.addFeatures(features_manzanas2);
                lyr_manzanas2 = new ol.layer.Vector({
                    source:jsonSource_manzanas2,
                    style: label_manzanas_full,
                    title: "Manzanas"
                });

                map.addLayer(lyr_manzanas2);
            }
        });
*/

        map.getView().fit([-7986511.592568, -1853075.694599, -7949722.367052, -1825746.555644], map.getSize());
        var fullscreen = new ol.control.FullScreen();
        map.addControl(fullscreen);

        function polygonStyleFunction(feature, resolution) {
            return new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'blue',
                    width: 2
                }),
                fill: new ol.style.Fill({
                    color: 'rgba(0, 0, 255, 0.1)'
                }),
                text: new ol.style.Text({
                    text: feature.get('codigo')
                })
            });
        }

        function polygonStyleFunction_hab_urb(feature, resolution) {
            return new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'black',
                    width: 2
                }),
                fill: new ol.style.Fill({
                    color: 'rgba(0, 255, 0, 0.1)'
                }),
                text: new ol.style.Text({
                    text: feature.get('cod_hab')
                })
            });
        }

        function label_manzanas_full(feature) {
            return new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'red',
                    width: 2
                }),
                fill: new ol.style.Fill({
                    color: 'rgba(255, 0, 0, 0.1)'
                })
            });
        }


    </script>
    <script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/map/map.js') }}"></script>

    <div id="dlg_opc_aprobado" style="display: none;">
        <div class="widget-body">
            <div  class="smart-form">
                <div class="panel-group">
                    <div class="panel panel-success">
                        <div class="panel-heading bg-color-success">.:: APROBADO POR ::.</div>
                        <div class="panel-body">
                            <input type="hidden" id="id_mzna" value="0">
                            <fieldset>
                                    <section style="text-align: center;">
                                        <label class="lbl_aprob">
                                            <select id="select_aprob" class="form-control" style="width: 200px" >
                                                @foreach ($aprobado as $a)
                                                    <option value='{{$a->grup_tab}}' >{{$a->desc_tab}}</option>
                                                @endforeach
                                            </select><i></i> </label>
                                    </section>
                            </fieldset>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div id="dialog_distrital" style="display: none">
        <div class="widget-body">
            <div  class="smart-form">
                <div class="panel-group">
                    <!-- widget div-->
                    <div>

                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->

                        </div>
                        <!-- end widget edit box -->

                        <!-- widget content -->
                        <div class="widget-body">

                            <p id="descripcion_hab_urb">

                            </p>
                            <hr class="simple">
                            <ul id="myTab1" class="nav nav-tabs bordered">
                                <li class="active">
                                    <a href="#s1" data-toggle="tab">Independización</a>
                                </li>
                                <li>
                                    <a href="#s2" data-toggle="tab">Habilitación Urbana</a>
                                </li>
                                <li>
                                    <a href="#s3" data-toggle="tab">Recepción de Obra</a>
                                </li>
                                <li>
                                    <a href="#s4" data-toggle="tab">Plan Integral</a>
                                </li>

                            </ul>

                            <div id="myTabContent1" class="tab-content padding-10">

                                <div class="tab-pane fade in active" id="s1">
                                    <form id="form_ind_docs" name="form_ind_docs">
                                        <fieldset>

                                                <input type="hidden" id="id_hab_urb_dist" name="id_hab_urb_dist" >
                                        <div class="row">
                                            <section class="col col-4">
                                                <label class="label" style="text-align: right">Planos:</label>
                                            </section>

                                            <section class="col col-8">
                                                <label class="input">
                                                    <input type="file" id="ind_planos" name="ind_planos" placeholder="solo pdf" accept="application/pdf">
                                                </label>
                                            </section>

                                        </div>
                                            <div class="row">
                                                <section class="col col-4">
                                                    <label class="label" style="text-align: right">Memoria Descriptiva:</label>
                                                </section>
                                                <section class="col col-8">
                                                    <label class="input">
                                                        <input type="file" id="ind_memo_desc" name="ind_memo_desc" placeholder="solo pdf" accept="application/pdf">
                                                    </label>
                                                </section>
                                            </div>

                                            <div class="row">
                                                <section class="col col-4">
                                                    <label class="label" style="text-align: right">Aprobación:</label>
                                                </section>

                                                <section class="col col-8">
                                                    <label class="input">
                                                        <input type="file" id="ind_aprobacion" name="ind_aprobacion" placeholder="solo pdf" accept="application/pdf">
                                                    </label>
                                                </section>
                                            </div>
                                            <div class="row">
                                                <section class="col col-4">
                                                    <label class="label" style="text-align: right">Partida Registral/Copia literal:</label>
                                                </section>
                                                <section class="col col-8">
                                                    <label class="input">
                                                        <input type="file" id="ind_cop_literal" name="ind_cop_literal" placeholder="solo pdf" accept="application/pdf">
                                                    </label>
                                                </section>
                                            </div>
                                            <div class="row">
                                                <section class="col col-4">
                                                    <label class="label" style="text-align: right">Certificado de Zonificación:</label>
                                                </section>
                                                <section class="col col-8">
                                                    <label class="input">
                                                        <input type="file" id="ind_zonificacion" name="ind_zonificacion" placeholder="solo pdf" accept="application/pdf">
                                                    </label>
                                                </section>
                                            </div>
                                            <div class="row">
                                                <section class="col col-4" >
                                                    <label class="label" style="text-align: right">Resolución:</label>
                                                </section>
                                                <section class="col col-8">
                                                    <label class="input">
                                                        <input type="file" id="ind_resolucion" name="ind_resolucion" placeholder="solo pdf" accept="application/pdf">
                                                    </label>
                                                </section>
                                            </div>
                                    </fieldset>
                                </div>
                                <div class="tab-pane fade" id="s2">

                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-4">
                                                <label class="label" style="text-align: right">Planos:</label>
                                            </section>
                                            <section class="col col-8">
                                                <label class="input">
                                                    <input type="file" id="hu_planos" name="hu_planos" placeholder="solo pdf" accept="application/pdf">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <section class="col col-4">
                                                <label class="label" style="text-align: right">Memoria Descriptiva:</label>
                                            </section>
                                            <section class="col col-8">
                                                <label class="input">
                                                    <input type="file" id="hu_memo_desc" name="vw_usuario_cargar_foto" placeholder="solo pdf" accept="application/pdf">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <section class="col col-4">
                                                <label class="label" style="text-align: right">Aprobación:</label>
                                            </section>

                                            <section class="col col-8">
                                                <label class="input">
                                                    <input type="file" id="hu_aprobacion" name="hu_aprobacion" placeholder="solo pdf" accept="application/pdf">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <section class="col col-4">
                                                <label class="label" style="text-align: right">Partida Registral/Copia literal:</label>
                                            </section>
                                            <section class="col col-8">
                                                <label class="input">
                                                    <input type="file" id="hu_cop_literal" name="hu_cop_literal" placeholder="solo pdf" accept="application/pdf">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <section class="col col-4">
                                                <label class="label" style="text-align: right">Certificado de Zonificación:</label>
                                            </section>
                                            <section class="col col-8">
                                                <label class="input">
                                                    <input type="file" id="hu_zonificacion" name="hu_zonificacion" placeholder="solo pdf" accept="application/pdf">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <section class="col col-4" >
                                                <label class="label" style="text-align: right">Resolución:</label>
                                            </section>
                                            <section class="col col-8">
                                                <label class="input">
                                                    <input type="file" id="hu_resolucion" name="hu_resolucion" placeholder="solo pdf" accept="application/pdf">
                                                </label>
                                            </section>
                                        </div>
                                    </fieldset>

                                </div>
                                <div class="tab-pane fade" id="s3">

                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-4">
                                                <label class="label" style="text-align: right">Planos:</label>
                                            </section>
                                            <section class="col col-8">
                                                <label class="input">
                                                    <input type="file" id="ro_planos" name="ro_planos" placeholder="solo pdf" accept="application/pdf">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <section class="col col-4">
                                                <label class="label" style="text-align: right">Memoria Descriptiva:</label>
                                            </section>
                                            <section class="col col-8">
                                                <label class="input">
                                                    <input type="file" id="ro_memo_desc" name="ro_memo_desc" placeholder="solo pdf" accept="application/pdf">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <section class="col col-4">
                                                <label class="label" style="text-align: right">Aprobación:</label>
                                            </section>

                                            <section class="col col-8">
                                                <label class="input">
                                                    <input type="file" id="ro_aprobacion" name="ro_aprobacion" placeholder="solo pdf" accept="application/pdf">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <section class="col col-4">
                                                <label class="label" style="text-align: right">Partida Registral/Copia literal:</label>
                                            </section>
                                            <section class="col col-8">
                                                <label class="input">
                                                    <input type="file" id="ro_cop_literal" name="ro_cop_literal" placeholder="solo pdf" accept="application/pdf">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <section class="col col-4">
                                                <label class="label" style="text-align: right">Certificado de Zonificación:</label>
                                            </section>
                                            <section class="col col-8">
                                                <label class="input">
                                                    <input type="file" id="ro_zonificacion" name="ro_zonificacion" placeholder="solo pdf" accept="application/pdf">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <section class="col col-4" >
                                                <label class="label" style="text-align: right">Resolución:</label>
                                            </section>
                                            <section class="col col-8">
                                                <label class="input">
                                                    <input type="file" id="ro_resolucion" name="ro_resolucion" placeholder="solo pdf" accept="application/pdf">
                                                </label>
                                            </section>
                                        </div>
                                    </fieldset>

                                </div>
                                <div class="tab-pane fade" id="s4">

                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-4">
                                                <label class="label" style="text-align: right">Planos:</label>
                                            </section>
                                            <section class="col col-8">
                                                <label class="input">
                                                    <input type="file" id="pi_planos" name="pi_planos" placeholder="solo pdf" accept="application/pdf">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <section class="col col-4">
                                                <label class="label" style="text-align: right">Memoria Descriptiva:</label>
                                            </section>
                                            <section class="col col-8">
                                                <label class="input">
                                                    <input type="file" id="pi_memo_desc" name="pi_memo_desc" placeholder="solo pdf" accept="application/pdf">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <section class="col col-4">
                                                <label class="label" style="text-align: right">Aprobación:</label>
                                            </section>

                                            <section class="col col-8">
                                                <label class="input">
                                                    <input type="file" id="pi_aprobacion" name="pi_aprobacion" placeholder="solo pdf" accept="application/pdf">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <section class="col col-4">
                                                <label class="label" style="text-align: right">Partida Registral/Copia literal:</label>
                                            </section>
                                            <section class="col col-8">
                                                <label class="input">
                                                    <input type="file" id="pi_cop_literal" name="pi_cop_literal" placeholder="solo pdf" accept="application/pdf">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <section class="col col-4">
                                                <label class="label" style="text-align: right">Certificado de Zonificación:</label>
                                            </section>
                                            <section class="col col-8">
                                                <label class="input">
                                                    <input type="file" id="pi_zonificacion" name="pi_zonificacion" placeholder="solo pdf" accept="application/pdf">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <section class="col col-4" >
                                                <label class="label" style="text-align: right">Resolución:</label>
                                            </section>
                                            <section class="col col-8">
                                                <label class="input">
                                                    <input type="file" id="pi_resolucion" name="pi_resolucion" placeholder="solo pdf" accept="application/pdf">
                                                </label>
                                            </section>
                                        </div>
                                    </fieldset>
                                    </form>

                                </div>

                            </div>


                        </div>
                        <!-- end widget content -->

                    </div>
                    <!-- end widget div -->
                </div>
            </div>
        </div>
    </div>

    <div id="dialog_provincial" style="display: none">
        <div class="widget-body">
            <div  class="smart-form">
                <div class="panel-group">
                    <p id="descripcion_hab_urb_prov">

                    </p>

                    <hr class="simple">

                    <fieldset>
                        <form id="form_hab_urb_prov" name="form_hab_urb_prov">
                            <input type="hidden" id="id_hab_urb_prov" name="id_hab_urb_prov" >
                            <div class="row">
                                <section class="col col-3">
                                    <label class="label" style="text-align: right">Documento 1:</label>
                                </section>

                                <section class="col col-9">
                                    <label class="input">
                                        <input type="file" id="prov_doc1" name="prov_doc1" placeholder="solo pdf" accept="application/pdf">
                                    </label>
                                </section>

                            </div>
                            <div class="row">
                                <section class="col col-3">
                                    <label class="label" style="text-align: right">Documento 2:</label>
                                </section>
                                <section class="col col-9">
                                    <label class="input">
                                        <input type="file" id="prov_doc2" name="prov_doc2" placeholder="solo pdf" accept="application/pdf">
                                    </label>
                                </section>
                            </div>

                            <div class="row">
                                <section class="col col-3">
                                    <label class="label" style="text-align: right">Documento 3:</label>
                                </section>

                                <section class="col col-9">
                                    <label class="input">
                                        <input type="file" id="prov_doc3" name="prov_doc3" placeholder="solo pdf" accept="application/pdf">
                                    </label>
                                </section>
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>

    <div id="dialog_sin_datos" style="display: none">
        <div class="widget-body">
            <div  class="smart-form">
                <div class="panel-group">
                    <p id="descripcion_hab_urb_sd">

                    </p>

                    <hr class="simple">
                    <fieldset>
                        <form id="form_hab_urb_sin_datos" name="form_hab_urb_sin_datos">
                            <input type="hidden" id="id_hab_urb_sin_datos" name="id_hab_urb_sin_datos" >
                            <div class="row">
                                <section class="col col-3">
                                    <label class="label" style="text-align: right">Documento:</label>
                                </section>
                                <section class="col col-9">
                                    <label class="input">
                                        <input type="file" id="sin_datos_doc1" name="sin_datos_doc1" placeholder="solo pdf" accept="application/pdf">
                                    </label>
                                </section>
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>

    <div id="dialog_cofopri" style="display: none">
        <div class="widget-body">
            <div  class="smart-form">
                <div class="panel-group">
                    <p id="descripcion_hab_urb_cofo">

                    </p>

                    <hr class="simple">
                    <fieldset>
                        <form id="form_hab_urb_cofo" name="form_ind_docs">
                            <input type="hidden" id="id_hab_urb_cofo" name="id_hab_urb_cofo" >
                            <div class="row">
                                <section class="col col-3">
                                    <label class="label" style="text-align: right">Documento:</label>
                                </section>

                                <section class="col col-9">
                                    <label class="input">
                                        <input type="file" id="cofo_doc1" name="cofo_doc1" placeholder="solo pdf" accept="application/pdf">
                                    </label>
                                </section>

                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>

    <div id="dlg_map" style="display: none;">
        <div class="widget-body">
            <div  class="smart-form">
                <div class="panel-group">
                    <div class="panel panel-success">
                        <div class="panel-heading bg-color-success">.:: Datos de la Habilitación Urbana ::.</div>
                        <div class="panel-body">
                            <input type="hidden" id="id_mzna" value="0">
                            <fieldset>
                                <div class="row">
                                    <section class="col col-2" style="padding-right: 5px; text-align: center">
                                        <label class="label" style="text-align: center">Código:</label>
                                        <label class="input">
                                            <input id="cod_hab" type="text" placeholder="" class="input-sm">
                                        </label><i></i>
                                    </section>

                                    <section class="col col-10" style="padding-left: 5px">
                                        <label class="label">Nombre:</label>
                                        <label class="input">
                                            <input id="nom_hab_urb" type="text" placeholder="" class="input-sm">
                                        </label><i></i>
                                    </section>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="row">
                                    <section class="col col-6" style="padding-right: 5px; text-align: center">
                                        <label class="label" style="text-align: left">Resolución:</label>
                                        <label class="input">
                                            <input id="resolucion" type="text" placeholder="" class="input-sm">
                                        </label><i></i>
                                    </section>

                                    <section class="col col-6" style="padding-left: 5px">
                                        <label class="label">Aprobado:</label>
                                        <label class="input">
                                            <input id="aprobado" type="text" placeholder="" class="input-sm">
                                        </label><i></i>
                                    </section>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="row">
                                    <section class="col col-12">

                                        <label class="label">Seleccionar Archivo:</label>
                                        <label class="input">
                                            <input type="file" id="vw_usuario_cargar_foto" name="vw_usuario_cargar_foto" placeholder="solo jpge,jpg,png" accept="image/, image/jpeg, image/jpg">
                                        </label>
                                    </section>
                                </div>
                            </fieldset>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('configuracion/vw_general')

@endsection
