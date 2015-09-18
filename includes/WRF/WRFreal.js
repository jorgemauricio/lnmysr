$(document).ready(function () {
    $.url("Tiempo_real/Gust");
    $.ver_fecha(true, "Gust");
    $.animate_mini("#imgGustMini")

    $.url("Tiempo_real/Wind");
    $.ver_fecha(true, "Wind");
    $.animate_mini("#imgWindMini")

    $.url("Tiempo_real/Refd");
    $.ver_fecha(true, "Ref");
    $.animate_mini("#imgRefdMini")

    $.url("Tiempo_real/T2m");
    $.ver_fecha(true, "T2m");
    $.animate_mini("#imgT2mMini")
});

$("#imgGustMini").click(
    function () {
        $(document).attr("location", "/LNMySR/WRF/TiempoReal_Hover?source=Gust");
    });

$("#imgWindMini").click(
    function () {
        $(document).attr("location", "/LNMySR/WRF/TiempoReal_Hover?source=Wind");
    });

$("#imgRefdMini").click(
    function () {
        $(document).attr("location", "/LNMySR/WRF/TiempoReal_Hover?source=Ref");
    });

$("#imgT2mMini").click(
    function () {
        $(document).attr("location", "/LNMySR/WRF/TiempoReal_Hover?source=T2m");
    });

$('#imgGustMini').one('error', function () { this.src = '/LNMySR/Content/images/not_found.png'; });
$('#imgWindMini').one('error', function () { this.src = '/LNMySR/Content/images/not_found.png'; });
$('#imgRefdMini').one('error', function () { this.src = '/LNMySR/Content/images/not_found.png'; });
$('#imgT2mMini').one('error', function () { this.src = '/LNMySR/Content/images/not_found.png'; });