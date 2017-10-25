var geojson_limites_distritales0;
var geojson_sectores_cat1;
var geojson_manzanas2;

$.ajax({url: 'getlimites',
    type: 'GET',
    async: false,
    success: function(r)
    {
        geojson_limites_distritales0 = JSON.parse(r[0].json_build_object);

    }
});

$.ajax({url: 'getsectores',
    type: 'GET',
    async: false,
    success: function(r)
    {
        geojson_sectores_cat1 = JSON.parse(r[0].json_build_object);

    }
});

$.ajax({url: 'getmznas',
    type: 'GET',
    async: false,
    success: function(r)
    {
        geojson_manzanas2 = JSON.parse(r[0].json_build_object);

    }
});