function setFlow(count) {
    //Здесь останавливаем работу прогресс бара	
    spinner.stop();
    myCollection.removeAll();

    //Расчет применяемых к массиву коэффициентов:
    //Коэф, учитывающий прогноз по году
    var forecastK = (109.9 + 4.426 * (document.getElementById('year').value - 1996)) / 176.3;


    if (document.getElementById("typeData").value == "one") {
        seasonK = 1;
    }
 
    for (n = 0; n < count; ++n) {

        var widthLine = tracks[1][n] * epZoomK * seasonK * pxK;
        trackView(tracks[0][n], widthLine, Math.round(tracks[1][n] * seasonK), tracks[2][n]);
    }
    myMap.geoObjects.add(myCollection);

    TS = document.getElementById('typeAuto').value;
    TD = document.getElementById('typeData').value;
    DW = document.getElementById('dayOfWeek').value;
    MY = document.getElementById('month').value;
    
  
}

function trackView(geometry, strokeWidth, intAuto, trackName) {
   
    var properties = {
        hintContent: intAuto + " " + "од/добу" + " (" + trackName + ")"

    },
    options = {
        draggable: false,
        strokeOpacity: 0.6,
        strokeColor: '#0000FF', //#ff0000
        strokeWidth: strokeWidth,
    },
            polyline = new ymaps.Polyline(geometry, properties, options);
    myCollection.add(polyline);
 
}
function init() {
    myMap = new ymaps.Map('map', {
        center: [48.9000, 30.5025], // 50.3443
        zoom: 7
    });
    myCollection = new ymaps.GeoObjectArray();
    myMap.behaviors.enable('scrollZoom');
    myMap.controls.add('zoomControl');
    //myMap.options.set('scrollZoomSpeed', 0.1);

    myMap.events.add('boundschange', function (e) {
        var newZoom = e.get('newZoom'),
                oldZoom = e.get('oldZoom');
        if (newZoom != oldZoom) {

            //console.log('Yes');
        }
    });
}        