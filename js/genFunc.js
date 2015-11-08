function obj2arr(obj) {
    var count = 0;
    for (var prs in obj)
    {
        if (obj.hasOwnProperty(prs))
            count++;
    }
    //Вычленяем из массива коэффициент учета эпюры по пикселам
    pxK = obj['pxK'];
    count = count - 1;
    tracks = new Array(new Array(), new Array(), new Array());
    for (var i = 0; i < count; i++) {
        tracks[0][i] = obj[i]['points'];
        tracks[1][i] = obj[i]['flow'];
        tracks[2][i] = obj[i]['name'];
    }
    setFlow(count);
}