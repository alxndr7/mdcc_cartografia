<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MDCC</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/smartadmin-production-plugins.min.css') }}" rel="stylesheet" type="text/css" media="screen">
    <link href="{{ asset('css/smartadmin-production.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/smartadmin-skins.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('layers/ol.css')}}" />
    <script src="{{ asset('layers/ol.js')}}"></script>
    <script src="{{ asset('js/libs/jquery-2.1.1.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('layers/ol3-layerswitcher.css')}}">
    <script  src="{{ asset('layers/ol3-layerswitcher.js')}}"></script>

    <link rel="shortcut icon" href="{{ asset('img/favicon/favi.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/favicon/favi.ico') }}" type="image/x-icon">

    <link rel="shortcut icon" href="img/favicon/favi.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon/favi.ico" type="image/x-icon">

    <!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">-->

    <link rel="apple-touch-icon" href="{{ asset('img/splash/sptouch-icon-iphone.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/splash/touch-icon-ipad.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/splash/touch-icon-iphone-retina.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/splash/touch-icon-ipad-retina.png') }}">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="apple-touch-startup-image" href="{{ asset('img/splash/ipad-landscape.png') }}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
    <link rel="apple-touch-startup-image" href="{{ asset('img/splash/ipad-portrait.png') }}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
    <link rel="apple-touch-startup-image" href="{{ asset('img/splash/iphone.png') }}" media="screen and (max-device-width: 320px)">

    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.0/jquery-confirm.min.css">-->

    <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-confirm.css') }}" rel="stylesheet">



</head>
<body class="desktop-detected pace-done fixed-header fixed-navigation">
<header id="header">
    <div id="logo-group">
        <span id="logo"> <img src="img/logo_cc_2.png" alt="SmartAdmin"> </span>

    </div>
    <div class="project-context hidden-xs">
        <span class="label">Menu:</span>
        <span class="project-selector dropdown-toggle" data-toggle="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" data-action="toggleShortcut"> Principal <i class="fa fa-list"></i> </a></span>
    </div>
    @if (Auth::guest())
        <div class="pull-right" style="margin-top: 8px">
            <a href="{{ route('login') }}" class="btn btn-default ">Iniciar Session</a>
        </div>
    @else
        <div class="pull-right">
            <div id="hide-menu" class="btn-header pull-right">
                <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Colapsar Menu"><i class="fa fa-reorder"></i></a> </span>
            </div>
            <div id="logout" class="btn-header transparent pull-right">
                    <span> <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Salir" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-sign-out"></i></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </span>
            </div>
            <ul class="header-dropdown-list">
                <li class="">
                    <a href="#" class="dropdown-toggle userdropdown pull-right" data-toggle="dropdown" style="margin-top: 8px;font-weight:bold;text-transform: uppercase">
                        <img src="data:image/png;base64,{{ Auth::user()->foto }}" style="width: 35px; height: 35px;border: 1px solid #fff; outline: 1px solid #bfbfbf;">
                        <span style="color: black">BIENVENIDO, {{ Auth::user()->ape_nom }} </span> <i class="fa fa-angle-down" style="color: black"></i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a onclick="cambiar_foto_usuario();" class="padding-10 padding-top-0 padding-bottom-0" style="cursor: pointer;margin-bottom: 4px;"><i class="fa fa-cog"></i> Cambiar Foto</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Cambiar Password</a>
                        </li>
                        <div class="divider"></div>
                        <li>
                            <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Setting</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    @endif
</header>
<!-- Dialogo de alertas -->
<div id="alertdialog" style="display: none;" ></div>

@if (!Auth::guest())

@endif

<style>
    .smart-form fieldset {
        padding: 5px 8px 0px;
    }
    .smart-form section {
        margin-bottom: 5px;
    }
    .smart-form .label {
        margin-bottom: 0px;
    }
    .smart-form .col {
        padding-right: 8px;
        padding-left: 8px;
    }
</style>



<div>

    <div id="content">
        <section id="widget-grid"  style="margin-top: 45px">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
                    <div class="well well-sm well-light">
                        <h1 class="txt-color-green"><b>Mantenimiento de Usuarios...</b></h1>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="text-right">
                                    <div class="col-xs-2 col-sm-12 col-md-12 col-lg-5">
                                        <div class="input-group">
                                            <div class="icon-addon addon-md">
                                                <input type="text" class="form-control" placeholder="Buscar">
                                                <label title="" rel="tooltip" class="glyphicon glyphicon-search" for="Buscar" data-original-title="Buscar"></label>
                                            </div>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary">Buscar</button>
                                    </span>
                                        </div>
                                    </div>
                                    <button onclick="open_dialog_new_edit_Usuario();" id="btn_vw_usuarios_Nuevo" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white">
                                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                    </button>
                                    <button onclick="dlg_Editar_Usuario();" id="btn_vw_usuarios_Editar" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                        <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                    </button>
                                    <button onclick="eliminar_usuario();" id="btn_vw_usuarios_Eliminar" type="button" class="btn btn-labeled btn-danger">
                                        <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                                    </button>
                                    <button type="button" class="btn btn-labeled bg-color-magenta txt-color-white">
                                        <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Imprimir
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 well well-sm well-light">
                <table id="table_Usuarios"></table>
                <div id="pager_table_Usuarios"></div>
            </article>
        </section>
    </div>
</div>

<div class="page-footer" style="background: #01A858;">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <span class="txt-color-white">Municipalidad Distrital de Cerro Colorado © Arequipa - Perú &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><a href="http://www.mdcc.gob.pe" target="blank"style="color: white">www.municerrocolorado.gob.pe</a>
        </div>
    </div>
</div>
<!--************************                  CAMBIAR FOTO USUARIO         *******************************-->
<div id="dialog_Cambiar_Foto_Usuario" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">
                <div class="panel panel-success" style="border: 0px !important;">
                    <div class="panel-heading bg-color-success">.:: Selecciona Tu Foto ::.</div>
                    <div class="panel-body">
                        <form id="form_cambiar_foto" name="form_cambiar_foto">
                            <div class="text-center col col-12" style="margin-top: 10px;">
                                <img id="vw_usuario_cambiar_foto_img" src="{{asset('img/avatars/male.png')}}" name="vw_usuario_cambiar_foto_img" size="2048" style="width: 233px;height: 230px;border: 1px solid #fff; outline: 1px solid #bfbfbf;margin-bottom: 14px;">
                                <label class="label">Seleccionar Foto:</label>
                                <label class="input">
                                    <input type="file" id="vw_usuario_cambiar_cargar_foto" name="vw_usuario_cambiar_cargar_foto" accept="image/png, image/jpeg, image/jpg">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="shortcut" style="text-align: center">
    <ul>
        <li>
            <a href="home" class="jarvismetro-tile big-cubes bg-color-purple"> <span class="iconbox"> <i class="fa fa-map-marker fa-4x"></i> <span> Cartografía</span> </span> </a>
        </li>
        <li>
            <a href="usuarios" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span> Usuarios </span> </span> </a>
        </li>
    </ul>
</div>

<script src="{{ asset('js/libs/jquery-ui-1.10.3.min.js') }}"></script>


<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.0/jquery-confirm.min.js"></script>-->

<script src="{{ asset('archivos_js/global_function.js') }}"></script>

<script src="{{ asset('js/app.config.js') }}"></script>
<script src="{{ asset('js/app.min.js') }}"></script>
<script src="{{ asset('js/block_ui.js') }}"></script>

<script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>

<script src="{{ asset('js/plugin/jqgrid/jquery.jqGrid.min.js') }}"></script>
<script src="{{ asset('js/plugin/jqgrid/grid.locale-en.min.js') }}"></script>

<script src="{{ asset('js/plugin/masked-input/jquery.maskedinput.min.js') }}"></script>

<script src="{{ asset('js/notification/SmartNotification.min.js')}}"></script>
<script src="{{ asset('js/plugin/select2/select2.min.js')}}"></script>


<script src="{{ asset('js/jquery-confirm.js')}}"></script>
<script src="{{ asset('js/pdf/jspdf.debug.js') }}"></script>
<script src="{{ asset('js/pdf/html2pdf.js') }}"></script>
<script src="{{ asset('archivos_js/configuracion.js') }}"></script>
<script src="{{ asset('js/plugin/jquery-validate/jquery.validate.min.js')}}"></script>
<!--<script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script>-->

<!--
        <script src="{{ asset('layers/resources/qgis2web_expressions.js')}}"></script>
        <script src="{{ asset('layers/resources/polyfills.js')}}"></script>
        <script src="{{ asset('layers/resources/ol.js')}}"></script>
        <script src="{{ asset('layers/resources/ol3-layerswitcher.js')}}"></script>
        <script src="{{ asset('layers/layers/cargar_capas.js')}}"></script>
        <script src="{{ asset('layers/layers/lotes3.js')}}"></script>
        <script src="{{ asset('layers/styles/limites_distritales0_style.js')}}"></script>
        <script src="{{ asset('layers/styles/sectores_cat1_style.js')}}"></script>
        <script src="{{ asset('layers/styles/manzanas2_style.js')}}"></script>
        <script src="{{ asset('layers/styles/lotes3_style.js')}}"></script>
        <script src="{{ asset('layers/layers/layers.js')}}" type="text/javascript"></script>
        <script src="{{ asset('layers/resources/qgis2web.js')}}"></script>
        <script src="{{ asset('layers/resources/Autolinker.min.js')}}"></script>-->

<!--<script data-pace-options='{ "restartOnRequestAfter": true }' src="js/plugin/pace/pace.min.js"></script>-->

@if (!Auth::guest())
        <!--        <input type="hidden" id="usuario_id" value="{{ Auth::user()->id }}" >
        <input type="hidden" id="usuario" value="{{ Auth::user()->ape_nom }}" >-->
<!--<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">-->

<script>
    $(document).ready(function () {
        pageSetUp();
        $.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
            _title: function (title) {
                if (!this.options.title) {
                    title.html("&#160;");
                } else {
                    title.html(this.options.title);
                }
            }
        }));
        jconfirm.defaults = {
            closeIcon: true,
            type: 'green',

        };
        $("#alertdialog").dialog({
            autoOpen: false,modal:true,title: "<div class='widget-header'><h4>.: Mensaje del Sistema :.</h4></div>", buttons: [ { html: '<span class="btn-label"><i class="glyphicon glyphicon-check"></i></span>&nbsp; Aceptar',
                "class": "btn btn-labeled bg-color-blue txt-color-white", click: function() { $( this ).dialog( "close" );  if(focoglobal!=""){ foco(focoglobal);} focoglobal="";} } ]
        });
        memory_glob_dni = '';
        memory_glob_usuario = '';
        $("#menu_configuracion").show();
        $("#li_config_usuarios").addClass('cr-active');
        $(document).ready(function () {
            jQuery("#table_Usuarios").jqGrid({
                url: 'list_usuarios',
                datatype: 'json', mtype: 'GET',
                height: 'auto', autowidth: true,
                toolbarfilter: true,
                colNames: ['id', 'DNI', ' Nombres', 'Usuario', 'Fecha Nac.'],
                rowNum: 13, sortname: 'id', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE USUARIOS REGISTRADOS', align: "center",
                colModel: [
                    {name: 'id', index: 'id', hidden: true},
                    {name: 'dni', index: 'dni', align: 'center', width: 80},
                    {name: 'ape_nom', index: 'ape_nom', width: 250},
                    {name: 'usuario', index: 'usuario', width: 130},
                    {name: 'fch_nac', index: 'fch_nac', width: 100}
                ],
                pager: '#pager_table_Usuarios',
                rowList: [13, 20],
                onSelectRow: function (Id) {},
                ondblClickRow: function (Id) {
                    dlg_Editar_Usuario();
                }
            });
            $(window).on('resize.jqGrid', function () {
                $("#table_Usuarios").jqGrid('setGridWidth', $("#content").width());
            });
        });

    });
</script>
@endif

<div id="dialog_new_edit_Usuario" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <form action="usuario_save" enctype="multipart/form-data" method="POST" id="form_user" name="form_user" target="iframeformuser">
                <input type="hidden" id="vw_usuarios_id" name="vw_usuarios_id" value="">
                {{ csrf_field() }}
                <iframe id="iframeformuser" name="iframeformuser" style="display: none;"></iframe>
                <fieldset>
                    <section>
                        <label class="label">Nombres y Apellidos:</label>
                        <label class="input">
                            <div class="input-group">
                                <input id="vw_usuario_txt_ape_nom" type="text" name="vw_usuario_txt_ape_nom" placeholder="Nombres y Apellidos" style="text-transform: uppercase">
                                <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                            </div>
                        </label>
                    </section>
                    <div class="row">
                        <section class="col col-6">
                            <label class="label">Foto:</label>
                            <img id="vw_usuario_foto_img" src="{{asset('img/avatars/male.png')}}" name="vw_usuario_foto_img" size="1024" style="width: 233px;height: 220px;border: 1px solid #fff; outline: 1px solid #bfbfbf;margin-bottom: 14px;">
                            <label class="label">Seleccionar Foto:</label>
                            <label class="input">
                                <input type="file" id="vw_usuario_cargar_foto" name="vw_usuario_cargar_foto" placeholder="solo jpge,jpg,png" accept="image/png, image/jpeg, image/jpg">
                            </label>
                        </section>
                        <section class="col col-6">
                            <label class="label">Dni:</label>
                            <label class="input">
                                <div class="input-group">
                                    <input id="vw_usuario_txt_dni" name="vw_usuario_txt_dni" onblur="validar_dni(this.value);" type="text" placeholder="00000000" onkeypress="return soloDNI(event);" maxlength="8">
                                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                </div>
                            </label>
                            <label class="label">Fecha Nacimiento:</label>
                            <label class="input">
                                <div class="input-group">
                                    <input id="vw_usuario_txt_fch_nac" name="vw_usuario_txt_fch_nac" type="text" data-mask="99/99/9999" data-mask-placeholder="_" placeholder="dia/mes/año">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </label>
                            <label class="label">Usuario:</label>
                            <label class="input">
                                <div class="input-group">
                                    <input id="vw_usuario_txt_usuario" name="vw_usuario_txt_usuario" type="text" onblur="validar_usuario(this.value);" placeholder="de 3 a mas caracteres" style="text-transform: uppercase">
                                    <span id="vw_usuario_btn_val_usuario" class="input-group-addon"><i class="fa fa-user"></i></span>
                                </div>
                            </label>
                            <label class="label">Password:</label>
                            <label class="input">
                                <div class="input-group">
                                    <input id="vw_usuario_txt_password" name="vw_usuario_txt_password" type="password" placeholder="Password">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                </div>
                            </label>
                            <label class="label">Confirmar Password:</label>
                            <label class="input">
                                <div class="input-group">
                                    <input id="vw_usuario_txt_conf_pass" type="password" placeholder="Confirmar Password">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                </div>
                            </label>
                        </section>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<!-- **************************                EDITAR USUARIO-          ************************************-->
<div id="dialog_Editar_Usuario" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">
                <div class="panel panel-success" style="border: 0px !important;">
                    <div class="panel-heading bg-color-success">.:: Datos del Usuario ::.</div>
                    <div class="panel-body">
                        <div class="col col-12" style="margin-top: 10px;">
                            <label class="label">Nombres y Apellidos:</label>
                            <label class="input">
                                <div class="input-group">
                                    <input id="vw_usuario_txt_ape_nom_2" type="text" placeholder="Nombres y Apellidos" style="text-transform: uppercase">
                                    <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                </div>
                            </label>
                        </div>
                        <section>
                            <div class="col col-6">
                                <label class="label">Usuario:</label>
                                <label class="input">
                                    <div class="input-group">
                                        <input id="vw_usuario_txt_usuario_2" type="text" onblur="validar_usuario(this.value);" placeholder="de 3 a mas caracteres" style="text-transform: uppercase">
                                        <span id="vw_usuario_btn_val_usuario" class="input-group-addon"><i class="fa fa-user"></i></span>
                                    </div>
                                </label>
                            </div>
                            <div class="col col-6">
                                <label class="label">Dni:</label>
                                <label class="input">
                                    <div class="input-group">
                                        <input id="vw_usuario_txt_dni_2" onblur="validar_dni(this.value);" type="text" placeholder="00000000" onkeypress="return soloDNI(event);" maxlength="8">
                                        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                    </div>
                                </label>
                            </div>
                        </section>
                        <section>
                            <div class="col col-6">
                                <label class="label">Fecha Nacimiento:</label>
                                <label class="input">
                                    <div class="input-group">
                                        <input id="vw_usuario_txt_fch_nac_2" type="text" data-mask="99/99/9999" data-mask-placeholder="_" placeholder="dia/mes/año">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </label>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
