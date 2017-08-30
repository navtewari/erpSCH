$(function () {
    $(window).on("load", function () {
        if ($("#frmSession").length != 0) {
            fillSessions();
        }
        if ($("#frmClasses").length != 0) {
            fillClasses();
            fillTotalClasses();
            fillClassesNewSession();
            fillUsedClasses();
            $('#undo_redo').multiselect();
        }
        if ($("#frmGrades").length != 0) {
           
            fillClasses_grade();
        }
    });
    //-------------------------------------------Session
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
                    str_html = str_html + "<td><i class='icon-info-sign'></i> <b>" + obj.session[i].SESSID + "</b></td>";
                    str_html = str_html + "<td>" + obj.session[i].SESSSTART + "</td>";
                    str_html = str_html + "<td>" + obj.session[i].SESSEND + "</td>";
                    str_html = str_html + '<td class="taskOptions">';
                    str_html = str_html + "<a href='#' class='tip deleteSession' id='" + obj.session[i].SESSID + "'><i class='icon-remove'></i></a>";
                    str_html = str_html + '</td>';
                    str_html = str_html + "</tr>";
                }
                $('#tabSession1').html(str_html);
            }
        });
    }

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

    //---------------------------------------------Classes
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
                    str_html = str_html + "<td><i class='icon-info-sign'></i>  <b>" + obj.classes[i].CLASSID + "</b></td>";
                    str_html = str_html + '<td class="taskOptions">';
                    str_html = str_html + "<a href='#' class='tip editClasses' id='" + obj.classes[i].CLASSID + "'><i class='icon-pencil'></i></a> | ";
                    str_html = str_html + "<a href='#' class='tip deleteClasses' id='" + obj.classes[i].CLASSID + "'><i class='icon-remove'></i></a>";
                    str_html = str_html + '</td>';
                    str_html = str_html + "</tr>";
                }
                $('#tabClass').html(str_html);
            }
        });
    }


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

//---------------------------------------session Wise Class
    function fillTotalClasses() {
        url_ = site_url_ + "/master/getTotalClasses";
        $('#undo_redo').empty();
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                var str_html = '';
                for (i = 0; i < obj.totalClassData.length; i++) {
                    str_html = str_html + "<option value='" + obj.totalClassData[i].CLASSID + "'>" + obj.totalClassData[i].CLASSID + "</option>";
                }
                $('#undo_redo').html(str_html);
            }, error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    }

    function fillClassesNewSession() {
        url_ = site_url_ + "/master/fillClassesNewSession";
        $('#undo_redo').empty();
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                var str_html = '';
                for (i = 0; i < obj.totalclass_in_session.length; i++) {
                    str_html = str_html + "<option value='" + obj.totalclass_in_session[i].CLASSID + "'>" + obj.totalclass_in_session[i].CLASSID + "</option>";
                }
                $('#undo_redo_to').html(str_html);
            }, error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    }

    function fillUsedClasses() {
        url_ = site_url_ + "/master/fillUsedClasses";
        $('#undo_redo').empty();
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                var str_html = '';
                if (obj.used_classes_.length > 0) {
                    for (i = 0; i < obj.used_classes_.length; i++) {
                        str_html = str_html + "<option value='" + obj.used_classes_[i].CLASSID + "'>" + obj.used_classes_[i].CLASSID + "</option>";
                    }
                } else {
                    str_html = str_html + "<option value='-'> -NA- </option>";
                }
                $('#undo_redo1').html(str_html);
            }, error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    }

    $('#btnAddSessionClassSubmit').click(function () {
        $('#undo_redo_to option').prop('selected', true);
        data_ = $('#frmClassInSession').serializeArray();
        url_ = site_url_ + "/master/setClassInSession";

        $.ajax({
            type: 'POST',
            url: url_,
            data: data_,
            success: function (data) {
                var obj = JSON.parse(data);
                if (obj.res_ === false) {
                    callDanger(obj.msg_);
                } else {
                    callSuccess(obj.msg_);
                    fillTotalClasses();
                    fillClassesNewSession();
                }
            }, error: function (xhr, status, error) {
                callSuccess(xhr.responseText);
            }
        });
    });
//------------------------------------------------------------------------
////---------------------------------grading-----------------------------
    function fillClasses_grade() {
        $('#s2id_cmbClassofAdmission span').text("Loading...");             
        url_ = site_url_ + "/reg_adm/getClasses_in_session";
        $('#cmbClassofAdmission').empty();
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                var str_html = '';
                str_html = str_html + "<option value=''>Choose Class</option>";
                for (i = 0; i < obj.class_in_session.length; i++) {
                    str_html = str_html + "<option value='" + obj.class_in_session[i].CLSSESSID + "'>Class " + obj.class_in_session[i].CLASSID + "</option>";
                }
                $('#s2id_cmbClassofAdmission span').text("Choose Class");
                $('#cmbClassofAdmission').html(str_html);
            }
        });
    }
//-----------------------------------------------------------------------
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