$(function () {
    $(window).on("load", function () {
        alert('hello');
    });
    $('#frmSession').load(function () {
        alert("Image loaded.");
    });
});