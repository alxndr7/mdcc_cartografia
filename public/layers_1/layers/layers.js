
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

//alert(geojson_manzanas2);
var format_manzanas2 = new ol.format.GeoJSON();
var features_manzanas2 = format_manzanas2.readFeatures(geojson_manzanas2,
            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
var jsonSource_manzanas2 = new ol.source.Vector({
    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
});
jsonSource_manzanas2.addFeatures(features_manzanas2);var lyr_manzanas2 = new ol.layer.Vector({
                source:jsonSource_manzanas2,
                style: style_manzanas2,
                title: "manzanas"
            });
var format_lotes3 = new ol.format.GeoJSON();
var features_lotes3 = format_lotes3.readFeatures(geojson_lotes3,
            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
var jsonSource_lotes3 = new ol.source.Vector({
    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
});
jsonSource_lotes3.addFeatures(features_lotes3);
var lyr_lotes3 = new ol.layer.Vector({
                source:jsonSource_lotes3,
                style: style_lotes3,
                title: "lotes"
            });


lyr_limites_distritales0.setVisible(true);
lyr_sectores_cat1.setVisible(true);
lyr_manzanas2.setVisible(false);
lyr_lotes3.setVisible(false);

var layersList = [lyr_limites_distritales0,lyr_sectores_cat1,lyr_manzanas2,lyr_lotes3];
lyr_limites_distritales0.set('fieldAliases', {'gid': 'gid', 'layer': 'layer', 'doctype': 'doctype', });
lyr_sectores_cat1.set('fieldAliases', {'gid': 'gid', 'entity': 'entity', 'codigo': 'codigo', 'sector': 'sector', });
lyr_manzanas2.set('fieldAliases', {'gid': 'gid', 'mz_cat': 'mz_cat', 'mz_urb': 'mz_urb', 'sector_cat': 'sector_cat', 'aprobacion': 'aprobacion', 'cod_hab': 'cod_hab', 'nombre': 'nombre', 'jurisdicci': 'jurisdicci', });
lyr_lotes3.set('fieldAliases', {'gid': 'gid', 'layer': 'layer', 'cod_mza': 'cod_mza', 'mz_urb': 'mz_urb', 'cod_sect': 'cod_sect', 'nom_lote': 'nom_lote', 'cod_habi': 'cod_habi', 'habilit': 'habilit', 'sec_mzna': 'sec_mzna', 'cod_lote': 'cod_lote', });
lyr_limites_distritales0.set('fieldImages', {'gid': 'TextEdit', 'layer': 'TextEdit', 'doctype': 'TextEdit', });
lyr_sectores_cat1.set('fieldImages', {'gid': 'TextEdit', 'entity': 'TextEdit', 'codigo': 'TextEdit', 'sector': 'TextEdit', });
lyr_manzanas2.set('fieldImages', {'gid': 'TextEdit', 'mz_cat': 'TextEdit', 'mz_urb': 'TextEdit', 'sector_cat': 'TextEdit', 'aprobacion': 'TextEdit', 'cod_hab': 'TextEdit', 'nombre': 'TextEdit', 'jurisdicci': 'TextEdit', });
lyr_lotes3.set('fieldImages', {'gid': 'TextEdit', 'layer': 'TextEdit', 'cod_mza': 'TextEdit', 'mz_urb': 'TextEdit', 'cod_sect': 'TextEdit', 'nom_lote': 'TextEdit', 'cod_habi': 'TextEdit', 'habilit': 'TextEdit', 'sec_mzna': 'TextEdit', 'cod_lote': 'TextEdit', });
lyr_limites_distritales0.set('fieldLabels', {'gid': 'no label', 'layer': 'no label', 'doctype': 'no label', });
lyr_sectores_cat1.set('fieldLabels', {'gid': 'no label', 'entity': 'no label', 'codigo': 'no label', 'sector': 'no label', });
lyr_manzanas2.set('fieldLabels', {'gid': 'no label', 'mz_cat': 'no label', 'mz_urb': 'no label', 'sector_cat': 'no label', 'aprobacion': 'no label', 'cod_hab': 'no label', 'nombre': 'no label', 'jurisdicci': 'no label', });
lyr_lotes3.set('fieldLabels', {'gid': 'no label', 'layer': 'no label', 'cod_mza': 'no label', 'mz_urb': 'no label', 'cod_sect': 'no label', 'nom_lote': 'no label', 'cod_habi': 'no label', 'habilit': 'no label', 'sec_mzna': 'no label', 'cod_lote': 'no label', });
lyr_lotes3.on('precompose', function(evt) {
    evt.context.globalCompositeOperation = 'normal';
});
