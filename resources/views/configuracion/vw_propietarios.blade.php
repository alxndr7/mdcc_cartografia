@extends('layouts.app')
@section('content')

            <section id="widget-grid" class="">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
                        <div class="well well-sm well-light">
                            <h1 class="txt-color-green"><b>
                                    <h1 class="txt-color-green"><b>PROPIETARIOS...</b></h1>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="clicknewpropietario();">
                                            <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                        </button>
                                        <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="clickmodpropietario();">
                                            <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                        </button>
                                        <button  type="button" class="btn btn-labeled btn-danger" onclick="delete_propietario();">
                                            <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input type="hidden" id="current_id" value="0">
                        <table id="tabla_propietarios"></table>
                        <div id="pager_tabla_propietarios"></div>
                    </article>
                </div>
            </section>


</section>

@section('page-js-script')
<script type="text/javascript">

    $(document).ready(function () {
        $("#menu_configuracion").show();
        $("#conf_propietarios").addClass('cr-active');

        var pageWidth = $("#tabla_propietarios").parent().width() - 100;

        jQuery("#tabla_propietarios").jqGrid({
            url: 'list_propietarios',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['Código','Descripción'],
            rowNum: 20,sortname: 'id_sec', viewrecords: true, caption: 'Propietarios', align: "center",
            colModel: [
                {name: 'cod_prop', index: 'cod_prop', align: 'center',width:(pageWidth*(30/100))},
                {name: 'prop_desc', index: 'prop_desc', align: 'left', width:(pageWidth*(70/100))},

            ],
            pager: '#pager_tabla_propietarios',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#tabla_propietarios').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#tabla_propietarios').jqGrid('getDataIDs')[0];
                            $("#tabla_propietarios").setSelection(firstid);
                        }
                },
            onSelectRow: function (Id){
                $('#current_id').val($("#tabla_propietarios").getCell(Id, "cod_prop"));

            },
            ondblClickRow: function (Id){
                $('#current_id').val($("#tabla_propietarios").getCell(Id, "cod_prop"));
                clickmodpropietario();}
        });

        $(window).on('resize.jqGrid', function () {
            $("#tabla_propietarios").jqGrid('setGridWidth', $("#content").width());
        });

    });

</script>
@stop

<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/configuracion/propietarios.js') }}"></script>
<div id="dlg_new_edit_propietario" style="display: none;">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">
                <div class="panel panel-success">
                    <div class="panel-heading bg-color-success">.:: Descripción Propietario ::.</div>
                    <fieldset>
                        <section>
                            <input type="hidden" id="cod_prop" value="0">
                            <label class="input">
                                <input type="text" id="prop_desc" name="prop_desc" placeholder="Nombre propietario">
                            </label>
                        </section>
                    </fieldset>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection




