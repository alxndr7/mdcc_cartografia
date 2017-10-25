@extends('layouts.app')
@section('content')

            <section id="widget-grid" class="">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
                        <div class="well well-sm well-light">
                            <h1 class="txt-color-green"><b>
                                    <h1 class="txt-color-green"><b>Memoria Descriptiva...</b></h1>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="clicknewmemodesc();">
                                            <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                        </button>
                                        <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="clickmodmemodesc();">
                                            <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                        </button>
                                        <button  type="button" class="btn btn-labeled btn-danger" onclick="delete_memo_desc();">
                                            <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                                        </button>
                                        <button type="button" class="btn btn-labeled bg-color-magenta txt-color-white" onclick="reporte_memo_desc();">
                                            <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Imprimir
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input type="hidden" id="current_id" value="0">
                        <table id="tabla_memo_desc"></table>
                        <div id="pager_table_memo_desc"></div>
                    </article>
                </div>
            </section>


</section>

@section('page-js-script')
<script type="text/javascript">

    $(document).ready(function () {
        $("#catastro").show();
        $("#mem_desc").addClass('cr-active');

        var errorClass = 'invalid';
        var errorElement = 'em';

        var validar_form = $('#checkout-form').validate({
            errorClass		: errorClass,
            errorElement	: errorElement,
            highlight: function(element) {
                $(element).parent().removeClass('state-success').addClass("state-error");
                $(element).removeClass('valid');
            },
            unhighlight: function(element) {
                $(element).parent().removeClass("state-error").addClass('state-success');
                $(element).addClass('valid');
            },

            // Rules for form validation
            rules : {
                departamento : {
                    required : true
                },
                provincia : {
                    required : true
                },
                distritos : {
                    required : true,
                },
                hab_urb:{
                    required : true
                },
                mzna : {
                    required  : true
                },
                lote : {
                    required : true
                },
                zona : {
                    required : true
                },
                partida :{
                    required : true
                },
                propietario : {
                    required : true
                },
                area_terreno : {
                    required : true,
                    number: true
                },
                area_libre : {
                    required : true,
                    number: true
                },
                perimetro_total:{
                    required : true,
                    number: true
                },
                sector_cat :{
                    required: true
                },
                mzna_cat :{
                    required: true
                },
                lote_cat:{
                    required: true
                }
            },

            // Messages for form validation
            messages : {
                departamento : {
                    required : 'Elija un Departamento'
                },
                provincia : {
                    required : 'Elija una provincia'
                },
                distritos : {
                    required : 'Elija un distrito'
                },
                hab_urb :{
                    required : 'Campo obligatorio'
                },
                mzna : {
                    required : 'Campo obligatorio'
                },
                lote : {
                    required : 'Campo obligatorio'
                },
                zona : {
                    required : 'Campo obligatorio'
                },
                partida : {
                    required : 'Campo obligatorio'
                },
                propietario : {
                    required : 'Campo obligatorio'
                },
                area_terreno : {
                    required : 'Campo obligatorio',
                    number : 'No se permite letras'
                },
                area_libre : {
                    required : 'Campo obligatorio',
                    number : 'No se permite letras'
                },
                perimetro_total:{
                    required : 'Obligatorio',
                    number : 'Números'
                },
                sector_cat :{
                    required: 'Campo obligatorio'
                },
                mzna_cat :{
                    required: 'Campo obligatorio'
                },
                lote_cat:{
                    required: 'Campo obligatorio'
                }
            },

            // Do not change code below
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent());
            },
        });

        var pageWidth = $("#tabla_memo_desc").parent().width() - 100;

        jQuery("#tabla_memo_desc").jqGrid({
            url: 'list_memo_desc',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_men_desc','Habilitación','Propietario','Mzna','Lote','Zona','Partida'],
            rowNum: 20,sortname: 'id_men_desc', viewrecords: true, caption: 'Memoria Descriptiva', align: "center",
            colModel: [
                {name: 'id_men_desc',hidden: true, index: 'id_men_desc', align: 'center'},
                {name: 'prop_desc', index: 'prop_desc', align: 'left', width:(pageWidth*(35/100))},
                {name: 'nomb_hab_urba', index: 'nomb_hab_urba', align: 'left', width:(pageWidth*(35/100))},
                {name: 'nomb_hab_urba', index: 'nomb_hab_urba', align: 'center', width:(pageWidth*(5/100))},
                {name: 'nomb_hab_urba', index: 'nomb_hab_urba', align: 'center', width:(pageWidth*(5/100))},
                {name: 'nomb_hab_urba', index: 'nomb_hab_urba', align: 'center', width:(pageWidth*(5/100))},
                {name: 'partida', index: 'partida', align: 'center', width:(pageWidth*(15/100))}

            ],
            pager: '#pager_table_memo_desc',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#tabla_memo_desc').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#tabla_memo_desc').jqGrid('getDataIDs')[0];
                            $("#tabla_memo_desc").setSelection(firstid);
                        }
                },
            onSelectRow: function (Id){
                $('#current_id').val($("#tabla_memo_desc").getCell(Id, "id_men_desc"));

            },
            ondblClickRow: function (Id){
                $('#current_id').val($("#tabla_memo_desc").getCell(Id, "id_men_desc"));
                clickmodmemodesc();}
        });

        $(window).on('resize.jqGrid', function () {
            $("#tabla_memo_desc").jqGrid('setGridWidth', $("#content").width());
        });

    });

</script>
@stop

<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/catastro/cat_memo_desc.js') }}"></script>
<div id="dlg_new_edit_memo_desc" style="display: none;">
    <form id="checkout-form" class="smart-form" novalidate="novalidate">
        <input type="hidden" id="id_men_desc" value="0">
        <div class="widget-body">
            <div  class="smart-form">
                <div class="panel-group">
                    <div class="panel panel-success">
                        <div class="panel-heading bg-color-success">.:: Datos ::.</div>
                        <fieldset>
                            <div class="row">
                                <section class="col col-3" id="sect_provs">
                                    <label class="select">
                                        <select name="mes" id="mes">
                                            <option value="0">MES</option>
                                            <option value="Enero">Enero</option>
                                            <option value="Febrero">Febrero</option>
                                            <option value="Marzo">Marzo</option>
                                            <option value="Abril">Abril</option>
                                            <option value="Mayo">Mayo</option>
                                            <option value="Junio">Junio</option>
                                            <option value="Julio">Julio</option>
                                            <option value="Agosto">Agosto</option>
                                            <option value="Setiembre">Setiembre</option>
                                            <option value="Octubre">Octubre</option>
                                            <option value="Noviembre">Noviembre</option>
                                            <option value="Diciembre">Diciembre</option>
                                        </select> <i></i> </label>
                                </section>

                                <section class="col col-3" id="sect_dists">
                                    <label class="select">
                                        <select name="anio" id="anio">
                                            <option value="0">AÑO</option>
                                            <option value="2017" >2017</option>
                                            <option value="2018" >2018</option>
                                            <option value="2019" >2019</option>
                                            <option value="2020 " >2020</option>
                                        </select> <i></i> </label>
                                </section>

                                <section class="col col-2" >
                                    <label class="input">
                                        <input type="text" name="sector_cat" maxlength="2" id="sector_cat" placeholder="Sector">
                                    </label>
                                </section>
                                <section class="col col-2" >
                                    <label class="input">
                                        <input type="text" name="mzna_cat"maxlength="3" id="mzna_cat" placeholder="Mzna">
                                    </label>
                                </section>
                                <section class="col col-2" >
                                    <label class="input">
                                        <input type="text" name="lote_cat" maxlength="3" id="lote_cat" placeholder="Lote">
                                    </label>
                                </section>
                            </div>
                        </fieldset>
                        <div class="panel-heading bg-color-success">.:: Ubicación ::.</div>
                        <fieldset>
                            <div class="row">
                                <section class="col col-4" >

                                    <label class="select">
                                        <select name="departamento" id="departamento" onchange="cargarprov(this);">
                                            <option value="0">Departamento</option>
                                            <option value='04' selected>Arequipa</option>
                                        </select> <i></i> </label>
                                </section>
                                <section class="col col-4" id="sect_provs">
                                    <label class="select">
                                        <select name="provincia" id="provincia">
                                            <option value="0">Provincia</option>
                                            <option value="0401" selected="">Arequipa</option>
                                        </select> <i></i> </label>
                                </section>

                                <section class="col col-4" id="sect_dists">
                                    <label class="select">
                                        <select name="distritos" id="distritos">
                                            <option value="0">Distrito</option>
                                            <option value="040104" selected>Cerro Colorado</option>
                                        </select> <i></i> </label>
                                </section>

                            </div>

                                <section>
                                    <label class="input">
                                        <input type="text" list="list" id="hab_urb" name="hab_urb" placeholder="Habilitación Urbana">
                                        <datalist id="list">
                                            @foreach ($hab_urb as $hab)
                                                <option data-xyz ="{{$hab->id_hab_urba}}" value="{{$hab->nomb_hab_urba}}">{{$hab->id_hab_urba}}</option>
                                            @endforeach
                                        </datalist> </label>
                                </section>

                            <div class="row">
                                <section class="col col-4">
                                    <label class="input">
                                        <input type="text" name="mzna" id="mzna" placeholder="Manzana">
                                    </label>
                                </section>
                                <section class="col col-4">
                                    <label class="input">
                                        <input type="text" name="lote" id="lote" placeholder="Lote">
                                    </label>
                                </section>
                                <section class="col col-4">
                                    <label class="input">
                                        <input type="text" name="zona" id="zona" placeholder="Zona">
                                    </label>
                                </section>
                            </div>
                        </fieldset>
                        <div class="panel-heading bg-color-success">.:: Descripción y uso ::.</div>
                        <fieldset>
                            <div class="row">
                                <section class="col col-6">

                                    <div class="inline-group">
                                        <label class="radio">
                                            ¿Inscrita?</label>
                                        <label class="radio">
                                            <input type="radio" onclick="inscrita_rbtn(this);" id="insc_si" name="radio-inline-inscrita" >
                                            <i></i>Si</label>
                                        <label class="radio">
                                            <input type="radio" onclick="inscrita_rbtn(this);" id="insc_no" name="radio-inline-inscrita" checked="">
                                            <i></i>No</label>

                                    </div>
                                </section>

                                <section class="col col-6">
                                    <label id="lblpartida" class="input">
                                        <input type="text" name="partida" id="partida" placeholder="Partida N°" disabled>
                                    </label>
                                </section>
                            </div>
                        </fieldset>

                        <div class="panel-heading bg-color-success">.:: Propietario ::.</div>
                        <fieldset>
                            <section>
                                <label class="select">
                                    <select name="propietario" id="propietario">
                                        <option value="0" selected="" disabled=""> Seleccione un Propietario</option>
                                        @foreach ($propietarios as $prop)
                                            <option value='{{$prop->cod_prop}}' >{{$prop->prop_desc}}</option>
                                        @endforeach
                                    </select> <i></i> </label>
                            </section>
                        </fieldset>
                        <div class="panel-heading bg-color-success">.:: Áreas ::.</div>

                        <fieldset>
                            <div class="row">
                                <section class="col col-6">
                                    <label class="input">
                                        <input type="text" name="area_terreno" id="area_terreno" placeholder="Área del terreno">
                                    </label>
                                </section>
                                <section class="col col-6">
                                    <label class="input">
                                        <input type="text" name="area_libre" id="area_libre" placeholder="Área libre">
                                    </label>
                                </section>
                            </div>
                        </fieldset>

                        <div class="panel-heading bg-color-success">.:: Perimetros y Linderos ::.</div>

                        <fieldset>
                          <!--  <div class="row">
                            <section class="col col-10">
                                <label class="input">
                                    <input type="text" name="derecho" id="derecho" placeholder="Por el costado derecho">
                                </label>
                            </section>

                            <section class="col col-2">
                                <label class="input">
                                    <input type="text" name="code" placeholder="00.00">
                                </label>
                            </section>
</div>-->
                            <!--
                            <div class="row">
                                <section class="col col-10">
                                    <label class="input">
                                        <input type="text" name="frente" id="frente" placeholder="Por el frente">
                                    </label>
                                </section>

                                <section class="col col-2">
                                    <label class="input">
                                        <input type="text" name="medida_frente" id="medida_frente" placeholder="00.00">
                                    </label>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col col-10">
                                    <label class="input">
                                        <input type="text" name="derecho" id="derecho" placeholder="Por el costado derecho">
                                    </label>
                                </section>

                                <section class="col col-2">
                                    <label class="input">
                                        <input type="text" name="medida_derecha" id="medida_derecha"  placeholder="00.00">
                                    </label>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col col-10">
                                    <label class="input">
                                        <input type="text" name="izquierdo"  id="izquierdo" placeholder="Por el costado Izquierdo">
                                    </label>
                                </section>

                                <section class="col col-2">
                                    <label class="input">
                                        <input type="text" name="medida_izquierda" id="medida_izquierda" placeholder="00.00">
                                    </label>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col col-10">
                                    <label class="input">
                                        <input type="text" name="fondo" id="fondo" placeholder="Por el fondo">
                                    </label>
                                </section>

                                <section class="col col-2">
                                    <label class="input">
                                        <input type="text" name="medida_fondo" id="medida_fondo" placeholder="00.00">
                                    </label>
                                </section>
                            </div>
-->
                            <section>
                                <label class="input">
                                    <input type="text" name="frente" id="frente" placeholder="Por el frente">
                                </label>
                            </section>

                            <section>
                                <label class="input">
                                    <input type="text" name="derecho" id="derecho" placeholder="Por el costado derecho">
                                </label>
                            </section>
                            <section>
                                <label class="input">
                                    <input type="text" name="izquierdo"  id="izquierdo" placeholder="Por el costado Izquierdo">
                                </label>
                            </section>
                            <section>
                                <label class="input">
                                    <input type="text" name="fondo" id="fondo" placeholder="Por el fondo">
                                </label>
                            </section>
                            <div class="row">
                                <section class="col col-10">
                                    <label class="input" style="padding-top: 5px;text-align: right">Perímetro total:
                                    </label>
                                </section>

                                <section class="col col-2">
                                    <label class="input">
                                        <input type="text" name="perimetro_total" id="perimetro_total" placeholder="00.00">
                                    </label>
                                </section>
                            </div>

                        </fieldset>
                        <div class="panel-heading bg-color-success">.:: Servicios ::.</div>

                        <fieldset>
                            <section>

                                <div class="inline-group">
                                    <label class="radio">
                                        ¿La unidad inmobiliaria cuenta con servicios?</label>
                                    <label class="radio">
                                        <input type="radio" id="serv_si" onclick="servicios_rbtn(this);" name="radio-inline" >
                                        <i></i>Si</label>
                                    <label class="radio">
                                        <input type="radio" id="serv_no" onclick="servicios_rbtn(this);" name="radio-inline" checked="">
                                        <i></i>No</label>
                                </div>
                            </section>
                            <div class="row" style="padding-left: 30px;">
                                <section class="col col-4">
                                    <label class="checkbox state-error"><input type="checkbox" id="serv_luz" name="checkbox_serv" disabled><i></i>Luz</label>
                                </section>
                                <section class="col col-4">
                                    <label class="checkbox state-error"><input type="checkbox" id="serv_agua" name="checkbox_serv" disabled><i></i>Agua</label>
                                </section>
                                <section class="col col-4">
                                    <label class="checkbox state-error"><input type="checkbox" id="serv_desag" name="checkbox_serv" disabled><i></i>Desague</label>
                                </section>
                            </div>

                        </fieldset>



                    </div>
                </div>

            </div>
        </div>

    </form>
</div>

<script>
    var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    var f=new Date();
    document.getElementById("mes").value = meses[f.getMonth()];
    document.getElementById("anio").value = f.getFullYear();
    //alert(f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());

</script>
@endsection




