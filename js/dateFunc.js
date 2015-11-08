
function todayDay() {
    var now = new Date();
    var Day = now.getDate();
    if (Day < 10) {
        Day = "0" + Day;
    }
    var Month = now.getMonth() + 1;
    if (Month < 10) {
        Month = "0" + Month;
    }
    var Year = now.getYear() + 1900;
    //  return Day + "-" + Month + "-" + Year;
    return now;
}

function getWeekDay(num) {
    var days = ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'];
    return days[num];
}
function getMonth(num) {
    var month = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];

    return month[num];
}

function numTodayMonth(dat) {
    var now = new Date(dat);
    var month = now.getMonth() + 1;
    if (month < 10) {
        month = "0" + month;
    }
    return month;
}
function numTodayDayOfWeek(dat) {
    //var now = new Date(dat);
    var days = ['1', '2', '3', '4', '5', '6', '7'];
    return days[dat.getDay()];
}