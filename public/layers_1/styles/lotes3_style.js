var size = 0;

var styleCache_lotes3={}
var style_lotes3 = function(feature, resolution){
    var context = {
        feature: feature,
        variables: {}
    };
    var value = ""
    var size = 0;
    var style = [ new ol.style.Style({
        stroke: new ol.style.Stroke({color: 'rgba(0,0,0,0.45)', lineDash: null, lineCap: 'butt', lineJoin: 'miter', width: 0}), fill: new ol.style.Fill({color: 'rgba(237,204,55,0.45)'})
    })];
    if (feature.get("nom_lote") !== null) {
        var labelText = String(feature.get("nom_lote"));
    } else {
        var labelText = ""
    }
    var key = value + "_" + labelText

    if (!styleCache_lotes3[key]){
        var text = new ol.style.Text({
              font: '6.825px \'MS Shell Dlg 2\', sans-serif',
              text: labelText,
              textBaseline: "center",
              textAlign: "left",
              offsetX: 5,
              offsetY: 3,
              fill: new ol.style.Fill({
                color: 'rgba(0, 0, 0, 255)'
              }),
            });
        styleCache_lotes3[key] = new ol.style.Style({"text": text})
    }
    var allStyles = [styleCache_lotes3[key]];
    allStyles.push.apply(allStyles, style);
    return allStyles;
};