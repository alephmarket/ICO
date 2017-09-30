
/**
** @id          String -    the id want to set coutdown
** @date        String  -   the time point  
** @coundown    Boolean -   is the time coutdown
**/
function uc_material_boxs_countdown(id, date,countdown) {
    var countdown = typeof countdown !== 'undefined' ?  countdown : true;
    var datefuture = new Date(date);
    var div = document.getElementById(id);
    var allbox = div.getElementsByClassName("uc_box");
    var calctime = (new Date()) - datefuture;
    if(calctime < 0){
        if(countdown){
            calctime = - calctime;
        }
        var day = Math.floor(calctime / 86400000); calctime -= day * 86400000;
        var hour = Math.floor(calctime / 3600000); calctime -= hour * 3600000;
        var minute = Math.floor(calctime / 60000); calctime -= minute * 60000;
        var second = Math.floor(calctime / 1000);
        allbox[0].children[0].innerHTML = day;
        allbox[1].children[0].innerHTML = hour;
        allbox[2].children[0].innerHTML = minute;
        allbox[3].children[0].innerHTML = second;
    }
}
