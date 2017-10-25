
<label class="select">
    <select name="distritos" id="distritos">
        <option value="0" selected="" disabled="">Distritos</option>
        @foreach ($dists as $dist)
            <option value='{{$dist->cod_dist}}' >{{$dist->distrit}}</option>
        @endforeach
    </select> <i></i> </label>