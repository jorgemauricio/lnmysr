var tipo, con;

MAX_FRAMES_PRO = 5;
MAX_FRAMES_REA = 121;
MAX_FRAMES = 10;
FINT = 1;

var frame = 0;

var frameGustMini = 0;
var frameWindMini = 0;
var frameRefdMini = 0;
var frameT2mMini = 0;

var timeout_id = null;

var imagesGust = new Array(MAX_FRAMES_REA);
var imagesWind = new Array(MAX_FRAMES_REA);
var imagesRefd = new Array(MAX_FRAMES_REA);
var imagesT2m = new Array(MAX_FRAMES_REA);

var fechas_anim = new Array(5);

var f = new Date();
var fecha;

$.urlParam = function (name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results == null) {
        return null;
    }
    else {
        return results[1] || 0;
    }
}

$('#back').click(function () {
    $(window).attr("location", "Index?var=" + $.urlParam("var"));
});

$.url = function (t) {
    tipo = t;
    //con = "http://clima.inifap.gob.mx/wrf/images/"+tipo+"/";     //Clima Inifap
    //con = "https://copy.com/6ittzpwRZznv/WRF/120h/ARW/13km/Images/"+tipo+"/";     // Copy Server
    con = "/wrf/images/" + tipo + "/";                                              // Local Server
    //con = "/Content/images/" + tipo + "/";
}

$.fecha_inicio = function (/*anio, mes, dia*/) {
    //fecha = new Date(anio, mes, dia);
    fecha = new Date();
    fecha.setDate(fecha.getDate() - 5);
}

$.ver_fecha = function (mini, nom) {
    $.fecha_inicio();
    if (f.getDate() < 10) {
        dia = "0" + f.getDate();
    }
    else {
        dia = f.getDate();
    }
    mes = $.num_mes(f.getMonth());
    anio = f.getFullYear();
    var M = "";
    M = $.nom_mes(mes);
    if (dia < 10) {
        dia = "0" + dia * FINT;
    }
    var J = dia * FINT;
    var A = anio;
    var dirImage;
    var diaOrig = dia * FINT;
    var broke = false;
    var mayor = false;
    var fecha1 = new Date(anio, (M * FINT) - 1, dia);
    var j = 0;
    var vars, vars1;
    var fe;
    if (fecha1 < fecha) {
        anio = 2012;
        A = 2012;
        if ((fecha.getMonth() + 1) < 10) {
            M = "0" + (fecha.getMonth() + 1);
        }
        else {
            M = (fecha.getMonth() + 1);
        }
        mes = $.num_mes(fecha.getMonth());
        if (fecha.getDate() < 10) {
            dia = "0" + fecha.getDate();
        }
        else {
            dia = fecha.getDate();
        }
        J = fecha.getDate();
        diaOrig = dia * FINT;
    }
    if (tipo === "Promedios") {
        var meslbl = mes;
        for (var i = 0; i < MAX_FRAMES_PRO; i++) {
            dirImage = $.dir_img(J, anio, A, dia, mes, M, nom);
            while (!file_exists(dirImage)) {
                fecha1 = new Date(A, (M * FINT) - 1, dia);
                if (fecha1 < fecha) {
                    broke = true;
                    mayor = false;
                    break;
                }
                vars = $.fecha_ant(J, M, mes, anio, dia);
                J = vars[0];
                M = vars[1];
                mes = vars[2];
                A = vars[3];
                anio = vars[3];
                dia = vars[4];
                dirImage = $.dir_img(J, anio, A, dia, mes, M, nom);
                if (j === 4) {
                    mayor = true;
                }
                j++;
            }
            $("#img" + i).attr("src", dirImage);
            if (broke) {
                fe = new Date(anio, ($.nom_mes(meslbl) - 1), diaOrig);
                vars1 = $.get_sig_mes(diaOrig, anio, meslbl);
                $("#lblFecha" + i).html($.labeldia(fe.getDay()) + " " + diaOrig + " de " + $.labelmes(meslbl));
                meslbl = vars1[1];
                diaOrig = vars1[0];
                diaOrig++;
            }
            else {
                fe = new Date(anio, ($.nom_mes(mes) - 1), J);
                vars1 = $.get_sig_mes(J, anio, mes);
                $("#lblFecha" + i).html($.labeldia(fe.getDay()) + " " + J + " de " + $.labelmes(mes));
            }
            mes = vars1[1];
            J = vars1[0];
            anio = vars1[2];
            J++;
        }
    }
    else {
        var a = 0, min = 6, K, i = 0, x = 0, j_mini = 5, k_mini = 24;
        if (mini) {
            j_mini = 0;
            k_mini = 17;
            a = 0;
            min = 6;
            $.url(tipo);
        }
        for (var j = 0; j <= j_mini; j++) {
            if (broke)
                break;
            switch (j) {
                case 0:
                    for (var k = min; k < k_mini; k++) {
                        if (broke)
                            break;
                        switch (nom) {
                            case "Gust":
                                imagesGust[i] = new Image();
                                break;
                            case "Wind":
                                imagesWind[i] = new Image();
                                break;
                            case "Ref":
                                imagesRefd[i] = new Image();
                                break;
                            case "T2m":
                                imagesT2m[i] = new Image();
                                break;
                        }

                        if (A >= 2013) {
                            if (M >= 11 && dia >= 6 || A > 2013) {
                                K = a + 7 * FINT;
                            }
                            else {
                                K = a + 1 * FINT;
                            }
                        }
                        else {
                            K = a + 1 * FINT;
                        }
                        dirImage = $.dir_img(J, anio, A, dia, mes, M, nom, k, K);
                        while (!file_exists(dirImage)) {
                            fecha1 = new Date(anio, (M * FINT) - 1, dia);
                            if (fecha1 < fecha) {
                                broke = true;
                                mayor = false;
                                break;
                            }
                            vars = $.fecha_ant(J, M, mes, anio, dia);
                            J = vars[0];
                            M = vars[1];
                            mes = vars[2];
                            A = vars[3];
                            anio = vars[3];
                            dia = vars[4];
                            dirImage = $.dir_img(J, anio, A, dia, mes, M, nom, k, K);
                            if (x >= 5) {
                                mayor = true;
                            }
                            x++;
                        }
                        switch (nom) {
                            case "Gust":
                                imagesGust[i].src = dirImage;
                                break;
                            case "Wind":
                                imagesWind[i].src = dirImage;
                                break;
                            case "Ref":
                                imagesRefd[i].src = dirImage;
                                break;
                            case "T2m":
                                imagesT2m[i].src = dirImage;
                                break;
                        }
                        i++;
                        a++;
                    }
                    if ($.urlParam('source') == nom) {
                        $("#dia_" + j + " a").html(J + "/" + $.nom_mes(mes) + "/" + anio);
                    }
                    vars1 = $.get_sig_mes(J, anio, mes);
                    mes = vars1[1];
                    J = vars1[0];
                    anio = vars1[2];
                    break;
                case 5:
                    for (var k = 0; k <= 6; k++) {
                        switch (nom) {
                            case "Gust":
                                imagesGust[i] = new Image();
                                break;
                            case "Wind":
                                imagesWind[i] = new Image();
                                break;
                            case "Ref":
                                imagesRefd[i] = new Image();
                                break;
                            case "T2m":
                                imagesT2m[i] = new Image();
                                break;
                        }
                        if (A >= 2013) {
                            if (M >= 11 && dia >= 6 || A > 2013) {
                                K = a + 7 * FINT;
                            }
                            else {
                                K = a + 1 * FINT;
                            }
                        }
                        else {
                            K = a + 1 * FINT;
                        }
                        dirImage = $.dir_img(J, anio, A, dia, mes, M, nom, k, K);
                        switch (nom) {
                            case "Gust":
                                imagesGust[i].src = dirImage;
                                break;
                            case "Wind":
                                imagesWind[i].src = dirImage;
                                break;
                            case "Ref":
                                imagesRefd[i].src = dirImage;
                                break;
                            case "T2m":
                                imagesT2m[i].src = dirImage;
                                break;
                        }
                        i++;
                        a++;
                    }
                    $("#dia_" + j + " a").html(J + "/" + $.nom_mes(mes) + "/" + anio);
                    break;
                default:
                    for (var k = 0; k < 24; k++) {
                        switch (nom) {
                            case "Gust":
                                imagesGust[i] = new Image();
                                break;
                            case "Wind":
                                imagesWind[i] = new Image();
                                break;
                            case "Ref":
                                imagesRefd[i] = new Image();
                                break;
                            case "T2m":
                                imagesT2m[i] = new Image();
                                break;
                        }
                        if (A >= 2013) {
                            if (M >= 11 && dia >= 6 || A > 2013) {
                                K = a + 7 * FINT;
                            }
                            else {
                                K = a + 1 * FINT;
                            }
                        }
                        else {
                            K = a + 1 * FINT;
                        }
                        dirImage = $.dir_img(J, anio, A, dia, mes, M, nom, k, K);
                        switch (nom) {
                            case "Gust":
                                imagesGust[i].src = dirImage;
                                break;
                            case "Wind":
                                imagesWind[i].src = dirImage;
                                break;
                            case "Ref":
                                imagesRefd[i].src = dirImage;
                                break;
                            case "T2m":
                                imagesT2m[i].src = dirImage;
                                break;
                        }
                        i++;
                        a++;
                    }
                    $("#dia_" + j + " a").html(J + "/" + $.nom_mes(mes) + "/" + anio);
                    vars1 = $.get_sig_mes(J, anio, mes);
                    mes = vars1[1];
                    J = vars1[0];
                    anio = vars1[2];
                    break;
            }
            J++;
        }
        if (dia < fecha1.getDate() && (M * FINT) - 1 === fecha1.getMonth() && anio === fecha1.getFullYear() && !mini) {
            frame = (diaOrig * FINT) - (dia * FINT);
            if (frame < 5 && frame > 0) {
                frame = frame * 24;
            }
            else {
                frameGustMini = 0;
                frameWindMini = 0;
                frameRefdMini = 0;
                frameT2mMini = 0;
            }
        }
        switch (nom) {
            case "Gust":
                if (mini)
                    $("#imgGustMini").attr("src", imagesGust[frameGustMini].src);
                else
                    $("#imgAnim").attr("src", imagesGust[frame].src);
                break;
            case "Wind":
                if (mini)
                    $("#imgWindMini").attr("src", imagesWind[frameWindMini].src);
                else
                    $("#imgAnim").attr("src", imagesWind[frame].src);
                break;
            case "Ref":
                if (mini)
                    $("#imgRefdMini").attr("src", imagesRefd[frameRefdMini].src);
                else
                    $("#imgAnim").attr("src", imagesRefd[frame].src);
                break;
            case "T2m":
                if (mini)
                    $("#imgT2mMini").attr("src", imagesT2m[frameT2mMini].src);
                else
                    $("#imgAnim").attr("src", imagesT2m[frame].src);
                break;
        }
    }
    if (mayor && !mini) {
        alert("La informaci\u00f3n de la fecha de hoy no se encuentra disponible,\nse mostrar\u00e1 la del " + dia * FINT + " de " + $.labelmes(mes) + " la cual es la m\u00e1s pr\u00f3xima.");
    }
    if (broke && !mini) {
        alert("Los datos no se encuentran disponibles en este momento, intente de nuevo m\u00e1s tarde.");
    }
}

$.fecha_ant = function (J, M, mes, anio, dia) {
    var vars;
    J--;
    if (J < 1) {
        switch (M * FINT) {
            case 1:
                mes = "DEC";
                M = "12";
                J = 31;
                anio--;
                break;
            case 2:
                mes = "JAN";
                M = "01";
                J = 31;
                break;
            case 3:
                mes = "FEB";
                M = "02";
                if ((anio % 4 === 0 && anio % 100 !== 0) || anio % 400 === 0) {
                    J = 29;
                }
                else {
                    J = 28;
                }
                break;
            case 4:
                mes = "MAR";
                M = "03";
                J = 31;
                break;
            case 5:
                mes = "APR";
                M = "04";
                J = 30;
                break;
            case 6:
                mes = "MAY";
                M = "05";
                J = 31;
                break;
            case 7:
                mes = "JUN";
                M = "06";
                J = 30;
                break;
            case 8:
                mes = "JUL";
                M = "07";
                J = 31;
                break;
            case 9:
                mes = "AUG";
                M = "08";
                J = 31;
                break;
            case 10:
                mes = "SEP";
                M = "09";
                J = 30;
                break;
            case 11:
                mes = "OCT";
                M = "10";
                J = 31;
                break;
            case 12:
                mes = "NOV";
                M = "11";
                J = 30;
                break;
        }
    }
    if (J < 10) {
        dia = "0" + J;
    }
    else {
        dia = J;
    }
    vars = new Array(J, M, mes, anio, dia);
    return vars;
}

$.labeldia = function (dia) {
    var d;
    switch (dia) {
        case 0:
            d = "Domingo";
            break;
        case 1:
            d = "Lunes";
            break;
        case 2:
            d = "Martes";
            break;
        case 3:
            d = "Mi&eacute;rcoles";
            break;
        case 4:
            d = "Jueves";
            break;
        case 5:
            d = "Viernes";
            break;
        case 6:
            d = "S&aacute;bado";
            break;
    }
    return d;
}

$.labelmes = function (mes) {
    var M;
    switch (mes) {
        case "JAN":
            M = "Enero";
            break;
        case "FEB":
            M = "Febrero";
            break;
        case "MAR":
            M = "Marzo";
            break;
        case "APR":
            M = "Abril";
            break;
        case "MAY":
            M = "Mayo";
            break;
        case "JUN":
            M = "Junio";
            break;
        case "JUL":
            M = "Julio";
            break;
        case "AUG":
            M = "Agosto";
            break;
        case "SEP":
            M = "Septiembre";
            break;
        case "OCT":
            M = "Octubre";
            break;
        case "NOV":
            M = "Noviembre";
            break;
        case "DEC":
            M = "Diciembre";
            break;
    }
    return M;
}

$.dir_img = function (J, anio, A, dia, mes, M, nom, k, K) {
    var dirImage;
    if (tipo === "Promedios") {
        if (J < 10) {
            dirImage = con + A + "-" + M + "-" + dia + "/" + nom + "_0" + J + mes + anio + ".png";
        }
        else {
            dirImage = con + A + "-" + M + "-" + dia + "/" + nom + "_" + J + mes + anio + ".png";
        }
    }
    else {
        if (k < 10) {
            if (J < 10) {
                dirImage = con + A + "-" + M + "-" + dia + "/" + K + "_" + nom + "_0" + k + "Z0" + J + mes + anio + ".png";
            }
            else {
                dirImage = con + A + "-" + M + "-" + dia + "/" + K + "_" + nom + "_0" + k + "Z" + J + mes + anio + ".png";
            }
        }
        else {
            if (J < 10) {
                dirImage = con + A + "-" + M + "-" + dia + "/" + K + "_" + nom + "_" + k + "Z0" + J + mes + anio + ".png";
            }
            else {
                dirImage = con + A + "-" + M + "-" + dia + "/" + K + "_" + nom + "_" + k + "Z" + J + mes + anio + ".png";
            }
        }
    }
    return dirImage;
}

$.get_sig_mes = function (J, anio, mes) {
    if ((anio % 4 === 0 && anio % 100 !== 0) || anio % 400 === 0) {
        if (mes === "FEB" && J >= 29) {
            J = 0 * FINT;
            mes = "MAR";
        }
    }
    else {
        if (mes === "FEB" && J >= 28) {
            J = 0 * FINT;
            mes = "MAR";
        }
    }

    if ((mes === "APR" || mes === "JUN" || mes === "SEP" || mes === "NOV") && J >= 30) {
        J = 0 * FINT;
        switch (mes) {
            case "APR":
                mes = "MAY";
                break;
            case "JUN":
                mes = "JUL";
                break;
            case "SEP":
                mes = "OCT";
                break;
            case "NOV":
                mes = "DEC";
                break;
        }
    }
    if ((mes === "JAN" || mes === "MAR" || mes === "MAY" || mes === "JUL" || mes === "AUG" || mes === "OCT" || mes === "DEC") && J >= 31) {
        J = 0 * FINT;
        switch (mes) {
            case "JAN":
                mes = "FEB";
                break;
            case "MAR":
                mes = "APR";
                break;
            case "MAY":
                mes = "JUN";
                break;
            case "JUL":
                mes = "AUG";
                break;
            case "AUG":
                mes = "SEP";
                break;
            case "OCT":
                mes = "NOV";
                break;
            case "DEC":
                mes = "JAN";
                anio++;
                break;
        }
    }
    return new Array(J, mes, anio);
}

$.nom_mes = function (mes) {
    var M;
    switch (mes) {
        case "JAN":
            M = "01";
            break;
        case "FEB":
            M = "02";
            break;
        case "MAR":
            M = "03";
            break;
        case "APR":
            M = "04";
            break;
        case "MAY":
            M = "05";
            break;
        case "JUN":
            M = "06";
            break;
        case "JUL":
            M = "07";
            break;
        case "AUG":
            M = "08";
            break;
        case "SEP":
            M = "09";
            break;
        case "OCT":
            M = "10";
            break;
        case "NOV":
            M = "11";
            break;
        case "DEC":
            M = "12";
            break;
    }
    return M;
}

$.num_mes = function (num) {
    var m;
    switch (num) {
        case 0:
            m = "JAN";
            break;
        case 1:
            m = "FEB";
            break;
        case 2:
            m = "MAR";
            break;
        case 3:
            m = "APR";
            break;
        case 4:
            m = "MAY";
            break;
        case 5:
            m = "JUN";
            break;
        case 6:
            m = "JUL";
            break;
        case 7:
            m = "AUG";
            break;
        case 8:
            m = "SEP";
            break;
        case 9:
            m = "OCT";
            break;
        case 10:
            m = "NOV";
            break;
        case 11:
            m = "DEC";
            break;
    }
    return m;
}

var timeout;

$.animate_mini = function (idImg) {
    timeout = setInterval(function () {
        switch (idImg) {
            case "#imgGustMini":
                $(idImg).attr("src", imagesGust[frameGustMini].src);
                frameGustMini = (frameGustMini + 1) % MAX_FRAMES;
                break;
            case "#imgWindMini":
                $(idImg).attr("src", imagesWind[frameWindMini].src);
                frameWindMini = (frameWindMini + 1) % MAX_FRAMES;
                break;
            case "#imgRefdMini":
                $(idImg).attr("src", imagesRefd[frameRefdMini].src);
                frameRefdMini = (frameRefdMini + 1) % MAX_FRAMES;
                break;
            case "#imgT2mMini":
                $(idImg).attr("src", imagesT2m[frameT2mMini].src);
                frameT2mMini = (frameT2mMini + 1) % MAX_FRAMES;
                break;
        }
    }, 150);
}

function file_exists(url) {
    // http://kevin.vanzonneveld.net
    // +   original by: Enrique Gonzalez
    // +      input by: Jani Hartikainen
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // %        note 1: This function uses XmlHttpRequest and cannot retrieve resource from different domain.
    // %        note 1: Synchronous so may lock up browser, mainly here for study purposes.
    // *     example 1: file_exists('http://kevin.vanzonneveld.net/pj_test_supportfile_1.htm');
    // *     returns 1: '123'
    var req = this.window.ActiveXObject ? new ActiveXObject("Microsoft.XMLHTTP") : new XMLHttpRequest();
    if (!req) {
        throw new Error('XMLHttpRequest not supported');
    }
    // HEAD Results are usually shorter (faster) than GET
    req.open('HEAD', url, false);
    req.send(null);
    if (req.status === 200) {
        return true;
    }
    return false;
}