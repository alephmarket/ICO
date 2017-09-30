function uc_white_line_circle_countdown_draw (element, value, max, linewidth, strokestyle) {
    var percent = value * 100 / max;
    var angle = 360 * percent / 100;
    var Ar = angle * Math.PI / 180;

    var canvas = element;
    canvas.height = element.parentElement.offsetHeight;
    canvas.width = element.parentElement.offsetWidth;
    var context = canvas.getContext("2d");
    var centerX = canvas.width / 2;
    var centerY = canvas.height / 2;
    var radius = canvas.width / 2 - (linewidth / 2);

    context.beginPath();
    context.clearRect(0, 0, canvas.width, canvas.height);
    context.arc(centerX, centerY, radius, 0, Ar, false);
    context.imageSmoothingEnabled= true;
    context.lineWidth = linewidth;
    context.strokeStyle = strokestyle;
    context.stroke();
}
/**
** @id          String -    the id want to set coutdown
** @date        String  -   the time point  
** @coundown    Boolean -   is the time coutdown
**/
function uc_white_line_circle_countdown(id,date, width, color1, color2, color3, color4, countdown) {
    var datepass = new Date(date);
    var div = document.getElementById(id);
    var allbox = div.getElementsByClassName("uc_box");
    var calctime = (new Date()) - datepass;
    if(calctime < 0){
        if(countdown){
            calctime = - calctime;
        }
        var day = Math.floor(calctime / 86400000); calctime -= day * 86400000;
        var hour = Math.floor(calctime / 3600000); calctime -= hour * 3600000;
        var minute = Math.floor(calctime / 60000); calctime -= minute * 60000;
        var second = Math.floor(calctime / 1000);

        allbox[0].children[1].innerHTML = day; uc_white_line_circle_countdown_draw(allbox[0].children[0],day,366,width,color1);
        allbox[1].children[1].innerHTML = hour; uc_white_line_circle_countdown_draw(allbox[1].children[0],hour,24,width,color2);
        allbox[2].children[1].innerHTML = minute; uc_white_line_circle_countdown_draw(allbox[2].children[0],minute,60,width,color3);
        allbox[3].children[1].innerHTML = second; uc_white_line_circle_countdown_draw(allbox[3].children[0],second,60,width,color4);
    }
}