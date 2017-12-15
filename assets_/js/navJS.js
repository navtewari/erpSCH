$(function () {
    $(window).on("load", function () {
        if ($("#frmGenSchool").length != 0) {
            fillStates('cmbPState1');
            fillGeneralPage();
        }

        if ($("#frmGenSchoolEdit").length != 0) {
            fillStates('cmbPState');
        }

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

        if ($("#frmSubject").length != 0) {
            fillClasses_subject();
        }

        if ($("#frmTeacher").length != 0) {
            fillTeacher();
            fillTeacher_combo();
            fillClasses_teacher();
        }
    });
    //-------------------------------------------General
    function fillStates(selector) {
        $('#s2id_' + selector + ' span').text("Loading...");
        url_ = site_url_ + "/reg_adm/getState";
        $('#' + selector).empty();
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                var str_html = '';
                for (i = 0; i < obj.state.length; i++) {
                    if (obj.state[i].NAME_ == 'UTTARAKHAND') {
                        str_html = str_html + "<option value='" + obj.state[i].NAME_ + "' selected='selected'>" + obj.state[i].NAME_ + "</option>";
                    } else {
                        str_html = str_html + "<option value='" + obj.state[i].NAME_ + "'>" + obj.state[i].NAME_ + "</option>";
                    }
                }
                $('#s2id_' + selector + ' span').text("UTTARAKHAND");
                $('#' + selector).html(str_html);
            }
        });
    }

    function fillGeneralPage() {
        url_ = site_url_ + "/master/getGeneralStatus";
        $.ajax({
            type: 'POST',
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                if (obj.res_ === true) {

                    $('.submitSchoolData').css({'display': 'none'});
                    $('.editSchoolData').css({'display': 'block'});
                    $('#schoolLogo').attr("src", '');
                    logo = base_url_ + 'assets_/logo/' + obj.msg_[0].SCH_LOGO;
                    $('#schoolLogo').attr("src", logo);

                    $('#labelschName').html(obj.msg_[0].SCH_NAME);
                    $('#labelschContact').html(obj.msg_[0].SCH_CONTACT);
                    $('#labelschEmail').html(obj.msg_[0].SCH_EMAIL);
                    $('#labelschAdd').html(obj.msg_[0].SCH_ADD);
                    $('#labelschCity').html(obj.msg_[0].SCH_CITY);
                    $('#labelschDisitt').html(obj.msg_[0].SCH_DISITT);
                    $('#labelschState').html(obj.msg_[0].SCH_STATE);
                    $('#labelschCountry').html(obj.msg_[0].SCH_COUNTRY);

                    $('#txtSchID').val(obj.msg_[0].SCH_ID);
                    $('#txtSchName').val(obj.msg_[0].SCH_NAME);
                    $('#txtSchContact').val(obj.msg_[0].SCH_CONTACT);
                    $('#txtSchEmail').val(obj.msg_[0].SCH_EMAIL);
                    $('#txtSchAdd').val(obj.msg_[0].SCH_ADD);
                    $('#txtPCity').val(obj.msg_[0].SCH_CITY);
                    $('#txtPDistt').val(obj.msg_[0].SCH_DISITT);
                    $('#txtCountry').val(obj.msg_[0].SCH_COUNTRY);
                } else {
                    $('.submitSchoolData').css({'display': 'block'});
                    $('.editSchoolData').css({'display': 'none'});
                }
            }, error: function (xhr, status, error) {
                callSuccess(xhr.responseText);
            }
        });
    }

    function sch_Submit(opt) {
        if (opt === '1') {
            if ($('#txtSchName1').val() === '') {
                callDanger("Please Enter School Name !!");
                $('#txtSchName1').focus();
            } else {
                data_ = new FormData($('#frmGenSchool')[0]);                
            }
            //data_ = $('#frmGenSchool').serializeArray();           
        } else {
            data_ = new FormData($('#frmGenSchoolEdit')[0]);
            //data_ = $('#frmGenSchoolEdit').serializeArray();
        }
        url_ = site_url_ + "/master/submitSchool/" + opt;        
        $.ajax({
            type: 'POST',
            url: url_,
            data: data_,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                var obj = JSON.parse(data);
                if (obj.res_ === false) {
                    callDanger(obj.msg_);
                } else {
                    callSuccess(obj.msg_);
                    fillGeneralPage();
                }
            }, error: function (xhr, status, error) {
                callSuccess(xhr.responseText);
            }
        });        
    }
    $('.schoolSubmit').click(function () {
        sch_Submit('1');
    });
    $('.updateMe').click(function () {
        sch_Submit('2');
        $('.txtSchLogoEdit').css({'display': 'none'});
        $('.txtSchNameEdit').css({'display': 'none'});
        $('.txtSchContactEdit').css({'display': 'none'});
        $('.txtSchEmailEdit').css({'display': 'none'});
        $('.txtSchAddEdit').css({'display': 'none'});
        $('.txtSchDisittEdit').css({'display': 'none'});
        $('.txtSchCityEdit').css({'display': 'none'});
        $('.txtSchStateEdit').css({'display': 'none'});
        $('.txtSchCountryEdit').css({'display': 'none'});
    });
    $('#editPhoto').click(function () {
        if ($('.txtSchLogoEdit:visible').length == 0)
        {
            $('.txtSchLogoEdit').css({'display': 'block'});
        } else {
            $('.txtSchLogoEdit').css({'display': 'none'});
        }
    });
    $('#editName').click(function () {
        if ($('.txtSchNameEdit:visible').length == 0)
        {
            $('.txtSchNameEdit').css({'display': 'block'});
        } else {
            $('.txtSchNameEdit').css({'display': 'none'});
        }
    });
    $('#editContact').click(function () {
        if ($('.txtSchContactEdit:visible').length == 0)
        {
            $('.txtSchContactEdit').css({'display': 'block'});
        } else {
            $('.txtSchContactEdit').css({'display': 'none'});
        }
    });
    $('#editEmail').click(function () {
        if ($('.txtSchEmailEdit:visible').length == 0)
        {
            $('.txtSchEmailEdit').css({'display': 'block'});
        } else {
            $('.txtSchEmailEdit').css({'display': 'none'});
        }
    });
    $('#editAdd').click(function () {
        if ($('.txtSchAddEdit:visible').length == 0)
        {
            $('.txtSchAddEdit').css({'display': 'block'});
        } else {
            $('.txtSchAddEdit').css({'display': 'none'});
        }
    });
    $('#editCity').click(function () {
        if ($('.txtSchCityEdit:visible').length == 0)
        {
            $('.txtSchCityEdit').css({'display': 'block'});
        } else {
            $('.txtSchCityEdit').css({'display': 'none'});
        }
    });
    $('#editDisitt').click(function () {
        if ($('.txtSchDisittEdit:visible').length == 0)
        {
            $('.txtSchDisittEdit').css({'display': 'block'});
        } else {
            $('.txtSchDisittEdit').css({'display': 'none'});
        }
    });
    $('#editState').click(function () {
        if ($('.txtSchStateEdit:visible').length == 0)
        {
            $('.txtSchStateEdit').css({'display': 'block'});
        } else {
            $('.txtSchStateEdit').css({'display': 'none'});
        }
    });
    $('#editCountry').click(function () {
        if ($('.txtSchCountryEdit:visible').length == 0)
        {
            $('.txtSchCountryEdit').css({'display': 'block'});
        } else {
            $('.txtSchCountryEdit').css({'display': 'none'});
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
                $('#editClass').css({'display': 'block'});
                $('#txtEditClass_').focus();
            }, error: function (xhr, status, error) {
                callSuccess(xhr.responseText);
            }
        });
    });
    $('body').on('click', '.classUpdateCancel', function () {
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
        $('#s2id_cmbClassofGrading span').text("Loading...");
        url_ = site_url_ + "/reg_adm/getClasses_in_session";
        $('#cmbClassofGrading').empty();
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
                $('#s2id_cmbClassofGrading span').text("Choose Class");
                $('#cmbClassofGrading').html(str_html);
            }
        });
    }

    $('#cmbClassofGrading').change(function () {
        fillGradeinTable();
    });
    function fillGradeinTable() {
        var classSessID = $('#cmbClassofGrading').val();
        var className = $("#cmbClassofGrading option:selected").text();
        url_ = site_url_ + "/master/getClassGrade/" + classSessID;
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                var str_html = '';
                if (obj.class_grade.length > 0) {
                    for (i = 0; i < obj.class_grade.length; i++) {
                        str_html = str_html + "<tr class='gradeX'>";
                        str_html = str_html + "<td><i class='icon-info-sign'></i>  <b>" + obj.class_grade[i].minMarks + ' - ' + obj.class_grade[i].maxMarks + "</b></td>";
                        str_html = str_html + "<td><b>" + obj.class_grade[i].grade + "</b></td>";
                        str_html = str_html + "<td><b>" + obj.class_grade[i].description + "</b></td>";
                        str_html = str_html + '<td class="taskOptions">';
                        str_html = str_html + "<a href='#' class='tip editGrade' id='" + obj.class_grade[i].gradeID + "'><i class='icon-pencil'></i></a> | ";
                        str_html = str_html + "<a href='#' class='tip deleteGrade' id='" + obj.class_grade[i].gradeID + '~' + obj.class_grade[i].grade + "'><i class='icon-remove'></i></a>";
                        str_html = str_html + '</td>';
                        str_html = str_html + "</tr>";
                    }
                    $('#tabGrading').html(str_html);
                    $('#exitHeading').html('Existing Grades for ' + className);
                } else {
                    $('#tabGrading').html('NO Grade Present for ' + className);
                }
            }
        });
    }

    $('.gradingSubmit').click(function () {
        if ($('#cmbClassofGrading').val() === '') {
            callDanger("Please Select Class !!");
            $('#cmbClassofGrading').focus();
        } else if ($('#minMarks').val() === '') {
            callDanger("Please Enter Minimum Marks !!");
            $('#minMarks').focus();
        } else if ($('#maxMarks').val() === '') {
            callDanger("Please Enter Maximum Marks !!");
            $('#maxMarks').focus();
        } else if ($('#txtGrade').val() === '') {
            callDanger("Please Enter Grade !!");
            $('#txtGrade').focus();
        } else {
            data_ = $('#frmGrades').serializeArray();
            url_ = site_url_ + "/master/submitGrades";
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
                        fillGradeinTable();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });
    $('body').on('click', '.deleteGrade', function () {
        var str = this.id;
        var arr_str = str.split('~');
        var gradeid = arr_str[0];
        var gradeName = arr_str[1];
        url_ = site_url_ + "/master/deleteGrade/" + gradeid;
        if (confirm('Are you sure you want to delete Grade ' + gradeName)) {
            $.ajax({
                type: 'POST',
                url: url_,
                success: function (data) {
                    var obj = JSON.parse(data);
                    if (obj.res_ === false) {
                        callDanger(obj.msg_);
                    } else {
                        callSuccess(obj.msg_);
                        fillGradeinTable();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });
    $('body').on('click', '.editGrade', function () {
        var gradeID = this.id;
        var className = $("#cmbClassofGrading option:selected").text();
        url_ = site_url_ + "/master/get_grade_for_update/" + gradeID;
        $.ajax({
            type: 'POST',
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                $('#gradeID_Edit').val(obj.class_grade[0].gradeID);
                $('#classID_Edit').val(obj.class_grade[0].clssessID);
                $('#ClassID_Edit').val(className);
                $('#minMarks_Edit').val(obj.class_grade[0].minMarks);
                $('#maxMarks_Edit').val(obj.class_grade[0].maxMarks);
                $('#txtGrade_Edit').val(obj.class_grade[0].grade);
                $('#txtDesc_Edit').val(obj.class_grade[0].description);
                $('#editGrade').css({'display': 'block'});
                $('#minMarks_Edit').focus();
            }, error: function (xhr, status, error) {
                callSuccess(xhr.responseText);
            }
        });
    });
    $('.gradingEdit').click(function () {
        if ($('#minMarks_Edit').val() === '') {
            callDanger("Please Enter Minimum Marks !!");
            $('#minMarks_Edit').focus();
        } else if ($('#maxMarks_Edit').val() === '') {
            callDanger("Please Enter Maximum Marks !!");
            $('#maxMarks_Edit').focus();
        } else if ($('#txtGrade_Edit').val() === '') {
            callDanger("Please Enter Grade !!");
            $('#txtGrade_Edit').focus();
        } else {
            data_ = $('#frmGrades_Edit').serializeArray();
            url_ = site_url_ + "/master/editGrades";
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
                        fillGradeinTable();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });
    $('.gradingEditCancel').click(function () {
        $('#editGrade').css({'display': 'none'});
    });
//-----------------------------------------------------------------------
//------------------------------------subject--------------------------------
    function fillClasses_subject() {
        $('#s2id_subClassID span').text("Loading...");
        url_ = site_url_ + "/reg_adm/getClasses_in_session";
        $('#subClassID').empty();
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                var str_html = '';
                str_html = str_html + "<option value=''>Choose Class</option>";
                for (i = 0; i < obj.class_in_session.length; i++) {
                    str_html = str_html + "<option value='" + obj.class_in_session[i].CLASSID + "'>Class " + obj.class_in_session[i].CLASSID + "</option>";
                }
                $('#s2id_subClassID span').text("Choose Class");
                $('#subClassID').html(str_html);
            }
        });
    }

    $('#subClassID').change(function () {
        fillSubjectinTable();
    });
    function fillSubjectinTable() {
        var classID = $('#subClassID').val();
        var className = $("#subClassID option:selected").text();
        url_ = site_url_ + "/master/getClassSubject/" + classID;
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                var str_html = '';
                if (obj.class_subject.length > 0) {
                    for (i = 0; i < obj.class_subject.length; i++) {
                        str_html = str_html + "<tr class='gradeX'>";
                        str_html = str_html + "<td><i class='icon-info-sign'></i>  <b>" + obj.class_subject[i].subName + "</b></td>";
                        str_html = str_html + "<td class='taskOptions'><b>" + obj.class_subject[i].status + "</b></td>";
                        str_html = str_html + '<td class="taskOptions">';
                        str_html = str_html + "<a href='#' class='tip deleteSubject' id='" + obj.class_subject[i].subjectID + '~' + obj.class_subject[i].subName + "'><i class='icon-remove'></i></a>";
                        str_html = str_html + '</td>';
                        str_html = str_html + "</tr>";
                    }
                    $('#tabSubjects').html(str_html);
                    $('#exitHeading').html('Existing Subjects for ' + className);
                } else {
                    $('#tabSubjects').html('NO Subject Present for ' + className);
                }
            }
        });
    }

    $('.subjectSubmit').click(function () {
        if ($('#subClassID').val() === '') {
            callDanger("Please Select Class !!");
            $('#subClassID').focus();
        } else if ($('#txtSubject').val() === '') {
            callDanger("Please Enter Subject Name !!");
            $('#txtSubject').focus();
        } else if ($("#chkSubStatusTH").prop("checked") == false && $("#chkSubStatusPR").prop("checked") == false) {
            callDanger("Please Check Subject Status !!");
            $('#chkSubStatusTH').focus();
        } else {
            data_ = $('#frmSubject').serializeArray();
            url_ = site_url_ + "/master/submitSubject";
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
                        fillSubjectinTable();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });
    $('body').on('click', '.deleteSubject', function () {
        var str = this.id;
        var arr_str = str.split('~');
        var subjectid = arr_str[0];
        var subjectName = arr_str[1];
        url_ = site_url_ + "/master/deleteSubject/" + subjectid;
        if (confirm('Are you sure you want to delete Grade ' + subjectName)) {
            $.ajax({
                type: 'POST',
                url: url_,
                success: function (data) {
                    var obj = JSON.parse(data);
                    if (obj.res_ === false) {
                        callDanger(obj.msg_);
                    } else {
                        callSuccess(obj.msg_);
                        fillSubjectinTable();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });
//-----------------------------------------Teachers-----------------------------------
    function fillTeacher() {
        url_ = site_url_ + "/master/getTeachers";
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                var str_html = '';
                for (i = 0; i < obj.Teacher.length; i++) {
                    str_html = str_html + "<tr class='gradeX'>";
                    str_html = str_html + "<td><i class='icon-info-sign'></i> <b>" + obj.Teacher[i].name + "</b></td>";
                    str_html = str_html + "<td>" + obj.Teacher[i].username + "</td>";
                    str_html = str_html + '<td class="taskOptions">';
                    str_html = str_html + "<a href='#' class='tip editTeacher' id='" + obj.Teacher[i].teacherID + "'><i class='icon-pencil'></i></a> | ";
                    str_html = str_html + "<a href='#' class='tip deleteTeacher' id='" + obj.Teacher[i].teacherID + '~' + obj.Teacher[i].name + "'><i class='icon-remove'></i></a>";
                    str_html = str_html + '</td>';
                    str_html = str_html + "</tr>";
                }
                $('#tabTeacher').html(str_html);
            }
        });
    }

    $('.teacherSubmit').click(function () {
        if ($('#txtName').val() === '') {
            callDanger("Please Enter Teacher Name !!");
            $('#txtName').focus();
        } else if ($('#txtUname').val() === '') {
            callDanger("Please Enter User name For Teacher !!");
            $('#txtUname').focus();
        } else {
            data_ = $('#frmTeacher').serializeArray();
            url_ = site_url_ + "/master/submitTeacher";
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
                        fillTeacher();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });
    $('body').on('click', '.deleteTeacher', function () {
        var str = this.id;
        var arr_str = str.split('~');
        var teacherid = arr_str[0];
        var teacherName = arr_str[1];
        url_ = site_url_ + "/master/deleteTeacher/" + teacherid;
        if (confirm('Are you sure you want to delete Teacher ' + teacherName)) {
            $.ajax({
                type: 'POST',
                url: url_,
                success: function (data) {
                    var obj = JSON.parse(data);
                    if (obj.res_ === false) {
                        callDanger(obj.msg_);
                    } else {
                        callSuccess(obj.msg_);
                        fillTeacher();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });
    $('body').on('click', '.editTeacher', function () {
        var teacherID = this.id;
        url_ = site_url_ + "/master/get_teacher_for_update/" + teacherID;
        $.ajax({
            type: 'POST',
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                $('#txtName_Edit').val(obj.Teacher_data[0].name);
                $('#teachID_Edit').val(obj.Teacher_data[0].teacherID);
                $('#txtUname_Edit').val(obj.Teacher_data[0].username);
                $('#editTeacher').css({'display': 'block'});
                $('#txtName_Edit').focus();
            }, error: function (xhr, status, error) {
                callSuccess(xhr.responseText);
            }
        });
    });
    $('.teacherEdit').click(function () {
        if ($('#txtName_Edit').val() === '') {
            callDanger("Please Enter Teacher Name !!");
            $('#txtName_Edit').focus();
        } else if ($('#txtUname_Edit').val() === '') {
            callDanger("Please Enter User Name for Teacher !!");
            $('#txtUname_Edit').focus();
        } else {
            data_ = $('#frmUpdateTeacher').serializeArray();
            url_ = site_url_ + "/master/updateTeacher";
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
                        fillTeacher();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });
    $('.cancelUpdateTeacher').click(function () {
        $('#editTeacher').css({'display': 'none'});
    });
    function fillTeacher_combo() {
        $('#s2id_txtTeacherID span').text("Loading...");
        url_ = site_url_ + "/master/getTeachers";
        $('#txtTeacherID').empty();
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                var str_html = '';
                str_html = str_html + "<option value=''>Choose Teacher</option>";
                for (i = 0; i < obj.Teacher.length; i++) {
                    str_html = str_html + "<option value='" + obj.Teacher[i].teacherID + "'> " + obj.Teacher[i].name + "</option>";
                }
                $('#s2id_txtTeacherID span').text("Choose Teacher");
                $('#txtTeacherID').html(str_html);
            }
        });
    }

    $('#txtTeacherID').change(function () {
        fillTeacherAssociatedSubject();
    });
    function fillTeacherAssociatedSubject() {
        var teacherID = $('#txtTeacherID').val();
        var teacherName = $("#txtTeacherID option:selected").text();
        url_ = site_url_ + "/master/getTeacherAssociatedSubject/" + teacherID;
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                if (obj.Teacher_subject.length) {
                    var str_html = '';
                    for (i = 0; i < obj.Teacher_subject.length; i++) {
                        str_html = str_html + "<tr class='gradeX'>";
                        str_html = str_html + "<td><i class='icon-info-sign'></i> <b>" + obj.Teacher_subject[i].classID + "</b></td>";
                        str_html = str_html + "<td>" + obj.Teacher_subject[i].subName + "</td>";
                        str_html = str_html + "<td>" + obj.Teacher_subject[i].status + "</td>";
                        str_html = str_html + '<td class="taskOptions">';
                        str_html = str_html + "<a href='#' class='tip deleteAssoicatedSubject' id='" + obj.Teacher_subject[i].tasID + '~' + obj.Teacher_subject[i].subName + "'><i class='icon-remove'></i></a>";
                        str_html = str_html + '</td>';
                        str_html = str_html + "</tr>";
                    }
                    $('#exitHeading').html('Associated Subjects for ' + teacherName);
                    $('#tabAssociatedSubjects').html(str_html);
                } else {
                    $('#exitHeading').html('Associated Subjects for ' + teacherName);
                    $('#tabAssociatedSubjects').html('No subject Associated');
                }
            }
        });
    }

    $('.SubmitAssociate').click(function () {
        if ($('#txtTeacherID').val() === '') {
            callDanger("Please Select Teacher Name !!");
            $('#txtTeacherID').focus();
        } else if ($('#cmbSubject').val() === null) {
            callDanger("Please Select subject to Associate !!");
            $('#cmbSubject').focus();
        } else {
            data_ = $('#frmAssociateSubject').serializeArray();
            url_ = site_url_ + "/master/AssociatedSubject";
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
                        fillTeacherAssociatedSubject();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });
    function fillClasses_teacher() {
        $('#s2id_subClassTeacherID span').text("Loading...");
        url_ = site_url_ + "/reg_adm/getClasses_in_session";
        $('#subClassTeacherID').empty();
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                var str_html = '';
                str_html = str_html + "<option value=''>Choose Class</option>";
                for (i = 0; i < obj.class_in_session.length; i++) {
                    str_html = str_html + "<option value='" + obj.class_in_session[i].CLASSID + "'>Class " + obj.class_in_session[i].CLASSID + "</option>";
                }
                $('#s2id_subClassTeacherID span').text("Choose Class");
                $('#subClassTeacherID').html(str_html);
            }
        });
    }

    $('#subClassTeacherID').change(function () {
        var classID = $('#subClassTeacherID').val();
        url_ = site_url_ + "/master/getClassSubject/" + classID;
        $('#s2id_cmbSubject span').text("Loading...");
        $('#cmbSubject').empty();
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                if (obj.class_subject.length > 0) {
                    var str_html = '';
                    str_html = str_html + "<option value=''>Choose Subject</option>";
                    for (i = 0; i < obj.class_subject.length; i++) {
                        str_html = str_html + "<option value='" + obj.class_subject[i].subjectID + "'>" + obj.class_subject[i].subName + " " + obj.class_subject[i].status + "</option>";
                    }
                    $('#s2id_cmbSubject span').text("Choose Subject");
                    $('#cmbSubject').html(str_html);
                } else {
                    $('#s2id_cmbSubject span').text('Subject not found');
                }
            }
        });
    });
    $('body').on('click', '.deleteAssoicatedSubject', function () {
        var str = this.id;
        var arr_str = str.split('~');
        var tasid = arr_str[0];
        var subName = arr_str[1];
        url_ = site_url_ + "/master/deleteAssoicatedSubject/" + tasid;
        if (confirm('Are you sure you want to delete Associated Subject ' + subName)) {
            $.ajax({
                type: 'POST',
                url: url_,
                success: function (data) {
                    var obj = JSON.parse(data);
                    if (obj.res_ === false) {
                        callDanger(obj.msg_);
                    } else {
                        callSuccess(obj.msg_);
                        fillTeacherAssociatedSubject();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });
//------------------------------------------------------------------------------------
//----------------------------------------------------------------------------
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