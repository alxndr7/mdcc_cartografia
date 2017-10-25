<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Imprimir Memoria Descriptiva</title>
    <link href="{{ asset('css/pdf_md.css') }}" rel="stylesheet">
</head>
<body>

    <div id="details" class="clearfix">
        <div id="invoice" >
            <div class="lado" style="text-align: center !important;">
                <img src="{{asset('img/aportes/logomdcc.png')}}" size="2048" style="width: 300px;height: 100px;margin-bottom: 14px;">
            </div>
            <div class="lado" style="text-align: center !important; padding-top: 20px;padding-left: 30px">
                <img src="{{asset('img/aportes/LOGO_GDUC.png')}}" size="2048" style="width: 230px;height: 55px;margin-bottom: 14px;">

            </div>

            <div class="titulo" style="text-align: center"><u>MEMORIA DESCRIPTIVA</u></div>

    </div>

    <div class="lado3">
        <div Class="asunto">1. Ubicación:</div>
        <table class="table_md" border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 0px; font-size: 1.3em;">
            <thead>
            <tr >
                <th style="width: 20%;"></th>
                <th style="width: 80%"></th>

            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>  <li style="list-style-type: square">Departamento</li></td>
                    <td>:  {{ $memo_desc[0]->dpto }}</td>
                </tr>
                <tr>
                    <td> <li style="list-style-type: square">Provincia</li></td>
                    <td>:  {{ $memo_desc[0]->provinc }}</td>
                </tr>
                <tr>
                    <td> <li style="list-style-type: square">Distrito</li></td>
                    <td>:  {{ $memo_desc[0]->distrit }}</td>
                </tr>
                <tr>
                    <td> <li style="list-style-type: square">Habilitación</li></td>
                    <td>:  {{ $memo_desc[0]->nomb_hab_urba }}</td>
                </tr>
                <tr>
                    <td> <li style="list-style-type: square">Manzana</li></td>
                    <td>:  {{ $memo_desc[0]->mzna }}</td>
                </tr>
                <tr>
                    <td> <li style="list-style-type: square">Lote</li></td>
                    <td>:  {{ $memo_desc[0]->lote }}</td>
                </tr>
                <tr>
                    <td> <li style="list-style-type: square">Zona</li></td>
                    <td>:  {{ $memo_desc[0]->zona }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="lado3">
        <div Class="asunto">2. Descripción y uso:</div>
        <ul>
            La unidad inmobiliaria esta dedicada al uso de Parque, el cual
            @if ($memo_desc[0]->f_inscrita == true)
                se encuentra inscrita en la
                Partida N°{{ $memo_desc[0]->partida }}
                de la Superintendencia Nacional de Registros Públicos
            @else
                no se encuentra inscrita en la Superintendencia Nacional de Registros Públicos
            @endif

        </ul>

    </div>

    <div class="lado3">
        <div Class="asunto">3. Propietario:</div>
        <ul> El propietario es:</ul>

        <ul style="list-style-type: square">
            <li style="padding-left: 30px"> La {{ $memo_desc[0]->prop_desc }}</li>
        </ul>

    </div>

    <div class="lado3">
        <div Class="asunto">4. Áreas:</div>
        <ul style="list-style-type: square">
            <li> Área del Terreno:  {{ $memo_desc[0]->area_terreno }} m<sup>2</sup></li>
            <li> Área Libre:   {{ $memo_desc[0]->area_libre }} m<sup>2</sup></li>
        </ul>
    </div>

    <div class="lado3">
        <div Class="asunto">5. Perímetros y linderos:</div>
        <ul style="list-style-type: square">
            @if($memo_desc[0]->lindero_frente)
                <li> Por el frente:  {{ $memo_desc[0]->lindero_frente }} ml. </li>
            @else
                <li> Por el frente:</li>
            @endif

            @if($memo_desc[0]->lindero_derecha)
                    <li> Por el costado derecho:   {{ $memo_desc[0]->lindero_derecha }}   ml.</li>
            @else
                    <li> Por el costado derecho:</li>
                @endif

                @if($memo_desc[0]->lindero_izquierda)
                    <li> Por el costado izquierdo :  {{ $memo_desc[0]->lindero_izquierda }}   ml.</li>
                @else
                    <li> Por el costado izquierdo :</li>

                @endif
                @if($memo_desc[0]->lindero_fondo)
                    <li> Por el fondo:   {{ $memo_desc[0]->lindero_fondo }}   ml.</li>
                @else
                    <li> Por el fondo:</li>

                @endif
        </ul>
        <ul style="list-style-type: square">
            <li> Perímetro total: {{ $memo_desc[0]->perimetro_total }} ml.</li>
        </ul>

    </div>
    <div class="lado3">
        <div Class="asunto">6. Servicios:</div>
        <ul>
           La unidad inmobiliaria
            @if ($memo_desc[0]->f_servicios == true)
                cuenta con los servicios de
                {{ $servicios }}

            @else
                no cuenta con servicios.
            @endif


        </ul>
    </div>

        <br><br>
        <div id="invoice" >
            <div class="lado" style="text-align: right !important;">

            </div>
            <div class="lado">
            </div>
            <div class="lado" style="text-align: left !important">
                Arequipa, {{$memo_desc[0]->mes  }} del {{$memo_desc[0]->anio}}
            </div>
        </div>

</body>

</html>
