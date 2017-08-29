$(function () {
    $(window).on("load", function () {
        if ($("#frmSession").length != 0) {
            fillSessions();
        }
        if ($("#frmClasses").length != 0) {
            fillClasses();
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
                for (i = 0; i < obj.session.length; i++) {
                    str_html = str_html + "<tr class='gradeX'>";
                    str_html = str_html + "<td> <button class='btn btn-danger btn-mini deleteSession' id='" + obj.session[i].SESSID + "'><i class='icon-minus'></i></button></td>";
                    str_html = str_html + "<td><b>" + obj.session[i].SESSID + "</b></td>";
                    str_html = str_html + "<td>" + obj.session[i].SESSSTART + "</td>";
                    str_html = str_html + "<td>" + obj.session[i].SESSEND + "</td>";
                    str_html = str_html + "</tr>";
                }
                $('#tabSession1').html(str_html);
            }
        });
    }

    function fillClasses() {
        url_ = site_url_ + "/master/getclasses";
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                var str_html = '';
                for (i = 0; i < obj.classes.length; i++) {
                    str_html = str_html + "<tr class='gradeX'>";
                    str_html = str_html + "<td> <button class='btn btn-danger btn-mini deleteClasses' id='" + obj.classes[i].CLASSID + "'><i class='icon-minus'></i></button></td>";
                    str_html = str_html + "<td> <button class='btn btn-success btn-mini editClasses' id='" + obj.classes[i].CLASSID + "'><i class='icon-edit'></i></button></td>";
                    str_html = str_html + "<td><b>" + obj.classes[i].CLASSID + "</b></td>";
                    str_html = str_html + "</tr>";
                }
                $('#tabClass').html(str_html);
            }
        });
    }

    //-----------------------------------------------------------------------------------------------

    $('.sessionSubmit').click(function () {
        //alert($('#startYear').val());
        if ($('#startYear').val() === $('#endYear').val()) {
            callDanger("Please select Different Dates for Session Start and Session End!!");
        } else {
            data_ = $('#frmSession').serialize();
            url_ = site_url_ + "/master/create_Session";

            $.ajax({
                type: 'POST',
                url: url_,
                data: data_,
                success: function (data) {
                    var obj = JSON.parse(data);
                    //alert(obj.res_);
                    if (obj.res_ === false) {
                        callDanger(obj.msg_);
                    } else {
                        callSuccess(obj.msg_);
                        fillSessions();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });

    $('body').on('click', '.deleteSession', function () {
        var sessid = this.id;
        url_ = site_url_ + "/master/delete_Session/" + sessid;
        if (confirm('Are you sure you want to delete Session ' + sessid)) {
            $.ajax({
                type: 'POST',
                url: url_,
                success: function (data) {
                    var obj = JSON.parse(data);
                    if (obj.res_ === false) {
                        callDanger(obj.msg_);
                    } else {
                        callSuccess(obj.msg_);
                        fillSessions();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });

    $('.classSubmit').click(function () {
        if ($('#txtAddClass_').val() == '') {
            callDanger("Please fill Class Name !!");
            $('#txtAddClass_').focus();
        } else {
            data_ = $('#frmClasses').serialize();
            url_ = site_url_ + "/master/create_Class";

            $.ajax({
                type: 'POST',
                url: url_,
                data: data_,
                success: function (data) {
                    var obj = JSON.parse(data);
                    //alert(obj.res_);
                    if (obj.res_ === false) {
                        callDanger(obj.msg_);
                    } else {
                        callSuccess(obj.msg_);
                        fillClasses();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });

    $('body').on('click', '.deleteClasses', function () {
        var classid = this.id;
        url_ = site_url_ + "/master/delete_Class/" + classid;
        if (confirm('Are you sure you want to delete Class ' + classid)) {
            $.ajax({
                type: 'POST',
                url: url_,
                success: function (data) {
                    var obj = JSON.parse(data);
                    if (obj.res_ === false) {
                        callDanger(obj.msg_);
                    } else {
                        callSuccess(obj.msg_);
                        fillClasses();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });

    $('body').on('click', '.editClasses', function () {
        var classid = this.id;
        url_ = site_url_ + "/master/get_Class_for_update/" + classid;
        $.ajax({
            type: 'POST',
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                $('#txtEditClass_ID').val(obj.classData[0].CLASSID);
                $('#txtEditClass_').val(obj.classData[0].CLASS);
                $('#s2id_cmbEditSection span').text(obj.classData[0].SECTION);
                if (obj.classData[0].SECTION != '-') {
                    $("#cmbEditSection option:contains(" + obj.classData[0].SECTION + ")").attr('selected', 'selected');
                }
                $('#newClass').css({'display': 'none'});
                $('#editClass').css({'display': 'block'});
            }, error: function (xhr, status, error) {
                callSuccess(xhr.responseText);
            }
        });
    });

    $('body').on('click', '.classUpdateCancel', function () {
        $('#newClass').css({'display': 'block'});
        $('#editClass').css({'display': 'none'});
    });

    $('body').on('click', '.classUpdate', function () {
        var classid = $('#txtEditClass_ID').val();
        if ($('#txtEditClass_').val() == '') {
            callDanger("Please fill Class Name !!");
            $('#txtEditClass_').focus();
        } else {
            if (confirm('Are you sure you want to Update Class ' + classid)) {

                data_ = $('#frmClasses_Edit').serialize();
                url_ = site_url_ + "/master/update_Class/" + classid;

                $.ajax({
                    type: 'POST',
                    url: url_,
                    data: data_,
                    success: function (data) {
                        var obj = JSON.parse(data);
                        //alert(obj.res_);
                        if (obj.res_ === false) {
                            callDanger(obj.msg_);
                        } else {
                            callSuccess(obj.msg_);
                            fillClasses();
                            $('#newClass').css({'display': 'block'});
                            $('#editClass').css({'display': 'none'});
                        }
                    }, error: function (xhr, status, error) {
                        callSuccess(xhr.responseText);
                    }
                });
            }
        }
    });

    // Popup boxes
    function callDanger(message) {
        $.gritter.add({
            title: 'Error . . .',
            text: message,
            image: base_url_ + '/assets_/img/demo/error-circle.png',
            sticky: false,
        });
    }
    function callSuccess(message) {
        $.gritter.add({
            title: 'Congratulations!!',
            text: message,
            image: base_url_ + '/assets_/img/demo/envelope.png',
            sticky: false,
            class_name: 'gritter-success'
        });
    }
    // -----------
});