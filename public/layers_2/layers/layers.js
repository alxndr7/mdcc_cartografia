var format_limites_distritales0 = new ol.format.GeoJSON();
var features_limites_distritales0 = format_limites_distritales0.readFeatures(geojson_limites_distritales0, 
            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
var jsonSource_limites_distritales0 = new ol.source.Vector({
    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
});
jsonSource_limites_distritales0.addFeatures(features_limites_distritales0);
var lyr_limites_distritales0 = new ol.layer.Vector({
                source:jsonSource_limites_distritales0, 
                style: style_limites_distritales0,
                title: "limites_distritales"
            });

var format_sectores_cat1 = new ol.format.GeoJSON();
var features_sectores_cat1 = format_sectores_cat1.readFeatures(geojson_sectores_cat1,
            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
var jsonSource_sectores_cat1 = new ol.source.Vector({
    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
});
jsonSource_sectores_cat1.addFeatures(features_sectores_cat1);

var lyr_sectores_cat1 = new ol.layer.Vector({
                source:jsonSource_sectores_cat1,
                style: style_sectores_cat1,
                title: "sectores_cat"
            });

lyr_limites_distritales0.setVisible(true);
lyr_sectores_cat1.setVisible(false);
var layersList = [lyr_limites_distritales0,lyr_sectores_cat1];
lyr_limites_distritales0.set('fieldAliases', {'gid': 'gid', 'layer': 'layer', 'doctype': 'doctype', });
lyr_sectores_cat1.set('fieldAliases', {'gid': 'gid', 'entity': 'entity', 'codigo': 'codigo', 'sector': 'sector', });
lyr_limites_distritales0.set('fieldImages', {'gid': 'TextEdit', 'layer': 'TextEdit', 'doctype': 'TextEdit', });
lyr_sectores_cat1.set('fieldImages', {'gid': 'TextEdit', 'entity': 'TextEdit', 'codigo': 'TextEdit', 'sector': 'TextEdit', });
lyr_limites_distritales0.set('fieldLabels', {'gid': 'no label', 'layer': 'no label', 'doctype': 'no label', });
lyr_sectores_cat1.set('fieldLabels', {'gid': 'no label', 'entity': 'no label', 'codigo': 'no label', 'sector': 'no label', });
lyr_sectores_cat1.on('precompose', function(evt) {
    evt.context.globalCompositeOperation = 'normal';
});

$.ajax({url: 'getgeoson',
    type: 'GET',
    success: function(r)
    {
        alert(r[0].json_build_object);

    }
});