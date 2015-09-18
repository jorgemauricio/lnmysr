$(document).ready(function () {
    $("#selProRep").change(
        function () {
            $.url("Promedios");
            $.ver_fecha(false, $("#selProRep").val());
        });
    
    if ($.urlParam("var") != null)
        $("#selProRep").val($.urlParam("var"));

    $("#selProRep").trigger("change");
});

$("#img0").click(
    function () {
        $(document).attr("location", "/LNMySR/WRF/VerImagen?source=" + $("#img0").attr("src") + "&var=" + $("#selProRep").val());
    });

$("#img1").click(
    function () {
        $(document).attr("location", "/LNMySR/WRF/VerImagen?source=" + $("#img1").attr("src") + "&var=" + $("#selProRep").val());
    });

$("#img2").click(
    function () {
        $(document).attr("location", "/LNMySR/WRF/VerImagen?source=" + $("#img2").attr("src") + "&var=" + $("#selProRep").val());
    });

$("#img3").click(
    function () {
        $(document).attr("location", "/LNMySR/WRF/VerImagen?source=" + $("#img3").attr("src") + "&var=" + $("#selProRep").val());
    });

$("#img4").click(
    function () {
        $(document).attr("location", "/LNMySR/WRF/VerImagen?source=" + $("#img4").attr("src") + "&var=" + $("#selProRep").val());
    });

$('#img0').error(function () { this.src = '/LNMySR/images/not_found.png'; });
$('#img1').error(function () { this.src = '/LNMySR/images/not_found.png'; });
$('#img2').error(function () { this.src = '/LNMySR/images/not_found.png'; });
$('#img3').error(function () { this.src = '/LNMySR/images/not_found.png'; });
$('#img4').error(function () { this.src = '/LNMySR/images/not_found.png'; });