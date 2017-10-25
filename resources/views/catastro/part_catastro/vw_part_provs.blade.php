<label class="select">
    <select name="provincia" id="provincia" onchange="cargardist();">
        <option value="0" selected="" disabled="">Provincia</option>
        @foreach ($provs as $prov)
            <option value='{{$prov->cod_prov}}' >{{$prov->provinc}}</option>
        @endforeach
    </select> <i></i> </label>
