var size = 0;

var styleCache_sectores_cat1={}
var style_sectores_cat1 = function(feature, resolution){
    var context = {
        feature: feature,
        variables: {}
    };
    var value = ""
    var size = 0;
    var style = [ new ol.style.Style({
        stroke: new ol.style.Stroke({color: 'rgba(44,37,229,1.0)', lineDash: null, lineCap: 'butt', lineJoin: 'miter', width: 0}), 
    })];
    if (feature.get("codigo") !== null) {
        var labelText = String(feature.get("codigo"));
    } else {
        var labelText = ""
    }
    var key = value + "_" + labelText

    if (!styleCache_sectores_cat1[key]){
        var text = new ol.style.Text({
              font: '10.725px \'MS Shell Dlg 2\', sans-serif',
              text: labelText,
              textBaseline: "center",
              textAlign: "left",
              offsetX: 5,
              offsetY: 3,
              fill: new ol.style.Fill({
                color: 'rgba(0, 0, 0, 255)'
              }),
              stroke: new ol.style.Stroke({
                color: "#cef51e",
                width: 0
              }),
            });
        styleCache_sectores_cat1[key] = new ol.style.Style({"text": text})
    }
    var allStyles = [styleCache_sectores_cat1[key]];
    allStyles.push.apply(allStyles, style);
    return allStyles;
};