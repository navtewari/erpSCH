$(function () {
    $(window).on("load", function () {
        if ($("#frmSession").length != 0) {
            fillSessions();
        }
    });

    function fillSessions() {
        url_ = site_url_ + "/master/getsession";

        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                var str_html = '';
                str_html = str_html + "<option value='new'>New | New Student</option>";
                for (i = 0; i < obj.session.length; i++) {
                    str_html = str_html + "<option value='" + obj.session[i].SESSSTART + "'>" + obj.session[i].SESSSTART + " | " + obj.session[i].SESSEND + "</option>";
                }
                $('#cmbRegistration').html(str_html);
            }
        });
    }
});