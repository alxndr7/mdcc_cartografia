var size = 0;

var styleCache_manzanas2={}
var style_manzanas2 = function(feature, resolution){
    var context = {
        feature: feature,
        variables: {}
    };
    var value = ""
    var size = 0;
    var style = [ new ol.style.Style({
        stroke: new ol.style.Stroke({color: 'rgba(0,163,0,1.0)', lineDash: null, lineCap: 'butt', lineJoin: 'miter', width: 1}), 
    })];
    if (feature.get("mz_cat") !== null) {
        var labelText = String(feature.get("mz_cat"));
    } else {
        var labelText = ""
    }
    var key = value + "_" + labelText

    if (!styleCache_manzanas2[key]){
        var text = new ol.style.Text({
              font: '8.125px \'MS Shell Dlg 2\', sans-serif',
              text: labelText,
              textBaseline: "center",
              textAlign: "left",
              offsetX: 5,
              offsetY: 3,
              fill: new ol.style.Fill({
                color: 'rgba(44, 37, 229, 255)'
              }),
            });
        styleCache_manzanas2[key] = new ol.style.Style({"text": text})
    }
    var allStyles = [styleCache_manzanas2[key]];
    allStyles.push.apply(allStyles, style);
    return allStyles;
};