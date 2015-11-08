function getKoefs(dayOfWeek, nameOfMonth) {
    $.ajax({
        url: 'datakoef.php',
        type: 'POST',
        dataType: 'json',
        data: {dayOfWeek: dayOfWeek, nameOfMonth: nameOfMonth},
        success: function (srvKoef) {
           
            seasonK = srvKoef;

            if (tracks.length == 0 && (document.getElementById('typeData').value != TD || document.getElementById('typeAuto').value != TS)) {
                tracks = [];
                getTracks(); // если массив пустой обращаемся на Сервер, если нет - применяем коэффициенты	
            } else {
                setFlow(tracks[0].length);
            }
        }
    });
}

function getTracks() {
    $.ajax({
        url: 'data.php',
        type: 'POST',
        dataType: 'json',
        data: {TS: document.getElementById('typeAuto').value, TD: document.getElementById('typeData').value},
        success: function (srvTracks) {
            //  console.log(resM);
            obj2arr(srvTracks);

        }
    });
}