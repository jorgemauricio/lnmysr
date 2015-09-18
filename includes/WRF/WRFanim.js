$(document).ready(function (name) {
    variable = $.urlParam('source');

    var accordion_head = $('.accordion > li > a'),
        accordion_body = $('.accordion li > .sub-menu');

    if (variable == "Ref")
        $.url("Tiempo_real/" + variable + "d");
    else
        $.url("Tiempo_real/" + variable);
    $.ver_fecha(false, variable);
    $("#btnF").click();

    accordion_head.first().addClass('active').next().slideDown('normal');

    accordion_head.on('click', function (event) {

        event.preventDefault();

        if ($(this).attr('class') != 'active') {
            accordion_body.slideUp('normal');
            $(this).next().stop(true, true).slideToggle('normal');
            accordion_head.removeClass('active');
            $(this).addClass('active');
        }

    });

});

var variable;

var date = new Date();
var date2 = new Date();
var date3 = new Date();

$.cambioHorario = function () {
    var val = false;
    if (date3.getMonth() >= 3 && date3.getMonth() <= 9) {
        date.setMonth(3);
        for (var i = 1; i < 10; i++) {
            date.setDate(i);
            if (date.getDay() == 0) {
                break;
            }
        }
        date2.setMonth(9);
        for (var i = 25; i < 32; i++) {
            date2.setDate(i);
            if (date2.getDay() == 0) {
                break;
            }
        }
        if (date3 >= date && date3 < date2) {
            val = true;
        }
    }
    return val;
}

$.reset_buttons = function () {
    $("#btnFF").attr("src", "/LNMySR/Content/images/FF.png")
    $("#btnFB").attr("src", "/LNMySR/Content/images/FB.png")
    $("#btnF").attr("src", "/LNMySR/Content/images/F.png")
    $("#btnB").attr("src", "/LNMySR/Content/images/B.png")
    $("#btnPrev").attr("src", "/LNMySR/Content/images/Prev.png")
    $("#btnNext").attr("src", "/LNMySR/Content/images/Next.png")
    $("#btnStop").attr("src", "/LNMySR/Content/images/Stop.png")
}

$(".sub-menu li").hover(function () {
    $("#btnStop").click();
    $(".sub-menu li").removeAttr("class");
    this.className = "selected";
    frame = this.id * FINT;
    switch (variable) {
        case "Gust":
            $("#imgAnim").attr("src", imagesGust[this.id * FINT].src);
            break;
        case "Wind":
            $("#imgAnim").attr("src", imagesWind[this.id * FINT].src);
            break;
        case "Ref":
            $("#imgAnim").attr("src", imagesRefd[this.id * FINT].src);
            break;
        case "T2m":
            $("#imgAnim").attr("src", imagesT2m[this.id * FINT].src);
            break;
        default:

    }
});

$('#imgAnim').load(function () {
    id = $("#" + frame).attr("id");
    if ($.cambioHorario()) {
        if (id == 0 || id == 22)
            $("#dia_0 a").click();
        if (id == 23 || id == 46)
            $("#dia_1 a").click();
        if (id == 47 || id == 70)
            $("#dia_2 a").click();
        if (id == 71 || id == 94)
            $("#dia_3 a").click();
        if (id == 95 || id == 120)
            $("#dia_4 a").click();
    }
    else {
        if (id == 0 || id == 23)
            $("#dia_0 a").click();
        if (id == 24 || id == 47)
            $("#dia_1 a").click();
        if (id == 48 || id == 71)
            $("#dia_2 a").click();
        if (id == 72 || id == 95)
            $("#dia_3 a").click();
        if (id == 96 || id == 120)
            $("#dia_4 a").click();
    }
    $(".sub-menu li").removeAttr("class");
    $("#" + frame).attr("class", "selected");
});
$('#imgAnim').one('error', function () { this.src = '/LNMySR/Content/images/not_found.png'; });

$("#btnFF").click(function () {
    $.reset_buttons();
    $(this).attr("src", "/LNMySR/Content/images/FF_active.png")
    frame = (frame + 1) % MAX_FRAMES_REA;
    switch (variable) {
        case "Gust":
            $("#imgAnim").attr("src", imagesGust[frame].src);
            break;
        case "Wind":
            $("#imgAnim").attr("src", imagesWind[frame].src);
            break;
        case "Ref":
            $("#imgAnim").attr("src", imagesRefd[frame].src);
            break;
        case "T2m":
            $("#imgAnim").attr("src", imagesT2m[frame].src);
            break;
    }

    if (frame === (MAX_FRAMES_REA - 1)) {
        if (timeout_id)
            clearTimeout(timeout_id);
        timeout_id = setTimeout("$('#btnFF').click()", 1000);
    }
    else {
        if (timeout_id)
            clearTimeout(timeout_id);
        timeout_id = setTimeout("$('#btnFF').click()", 200);
    }
});

$("#btnFB").click(function () {
    $.reset_buttons();
    $(this).attr("src", "/LNMySR/Content/images/FB_active.png")
    frame = (frame - 1) % MAX_FRAMES_REA;
    if (frame < 0)
        frame += MAX_FRAMES_REA;
    switch (variable) {
        case "Gust":
            $("#imgAnim").attr("src", imagesGust[frame].src);
            break;
        case "Wind":
            $("#imgAnim").attr("src", imagesWind[frame].src);
            break;
        case "Ref":
            $("#imgAnim").attr("src", imagesRefd[frame].src);
            break;
        case "T2m":
            $("#imgAnim").attr("src", imagesT2m[frame].src);
            break;
    }

    if (frame === 0) {
        if (timeout_id)
            clearTimeout(timeout_id);
        timeout_id = setTimeout("$('#btnFB').click()", 1000);
    }
    else {
        if (timeout_id)
            clearTimeout(timeout_id);
        timeout_id = setTimeout("$('#btnFB').click()", 200);
    }
});

$("#btnF").click(function () {
    $.reset_buttons();
    $(this).attr("src", "/LNMySR/Content/images/F_active.png")
    frame = (frame + 1) % MAX_FRAMES_REA;
    switch (variable) {
        case "Gust":
            $("#imgAnim").attr("src", imagesGust[frame].src);
            break;
        case "Wind":
            $("#imgAnim").attr("src", imagesWind[frame].src);
            break;
        case "Ref":
            $("#imgAnim").attr("src", imagesRefd[frame].src);
            break;
        case "T2m":
            $("#imgAnim").attr("src", imagesT2m[frame].src);
            break;
    }

    if (frame === (MAX_FRAMES_REA - 1)) {
        if (timeout_id)
            clearTimeout(timeout_id);
        timeout_id = setTimeout("$('#btnF').click()", 1000);
    }
    else {
        if (timeout_id)
            clearTimeout(timeout_id);
        timeout_id = setTimeout("$('#btnF').click()", 500);
    }
});

$("#btnB").click(function () {
    $.reset_buttons();
    $(this).attr("src", "/LNMySR/Content/images/B_active.png")
    frame = (frame - 1) % MAX_FRAMES_REA;
    if (frame < 0)
        frame += MAX_FRAMES_REA;
    switch (variable) {
        case "Gust":
            $("#imgAnim").attr("src", imagesGust[frame].src);
            break;
        case "Wind":
            $("#imgAnim").attr("src", imagesWind[frame].src);
            break;
        case "Ref":
            $("#imgAnim").attr("src", imagesRefd[frame].src);
            break;
        case "T2m":
            $("#imgAnim").attr("src", imagesT2m[frame].src);
            break;
    }

    if (frame === 0) {
        if (timeout_id)
            clearTimeout(timeout_id);
        timeout_id = setTimeout("$('#btnB').click()", 1000);
    }
    else {
        if (timeout_id)
            clearTimeout(timeout_id);
        timeout_id = setTimeout("$('#btnB').click()", 500);
    }
});

$("#btnPrev").click(function () {
    $.reset_buttons();
    $(this).attr("src", "/LNMySR/Content/images/Prev_active.png")
    frame = (frame - 1) % MAX_FRAMES_REA;
    if (frame < 0)
        frame += MAX_FRAMES_REA;
    switch (variable) {
        case "Gust":
            $("#imgAnim").attr("src", imagesGust[frame].src);
            break;
        case "Wind":
            $("#imgAnim").attr("src", imagesWind[frame].src);
            break;
        case "Ref":
            $("#imgAnim").attr("src", imagesRefd[frame].src);
            break;
        case "T2m":
            $("#imgAnim").attr("src", imagesT2m[frame].src);
            break;
    }
    if (timeout_id)
        clearTimeout(timeout_id);
    timeout_id = null;
});

$("#btnNext").click(function () {
    $.reset_buttons();
    $(this).attr("src", "/LNMySR/Content/images/Next_active.png")
    frame = (frame + 1) % MAX_FRAMES_REA;
    switch (variable) {
        case "Gust":
            $("#imgAnim").attr("src", imagesGust[frame].src);
            break;
        case "Wind":
            $("#imgAnim").attr("src", imagesWind[frame].src);
            break;
        case "Ref":
            $("#imgAnim").attr("src", imagesRefd[frame].src);
            break;
        case "T2m":
            $("#imgAnim").attr("src", imagesT2m[frame].src);
            break;
    }
    if (timeout_id)
        clearTimeout(timeout_id);
    timeout_id = null;
});

$("#btnStop").click(function () {
    $.reset_buttons();
    $(this).attr("src", "/LNMySR/Content/images/Stop_active.png")
    if (timeout_id)
        clearTimeout(timeout_id);
    timeout_id = null;
});