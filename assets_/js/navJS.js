$(function () {
    $(document).ajaxStart(function () {
        $('#loading_process').css('opacity', '1');
        $('#loading_process').css('display', 'inline-block');
        $('#loading_process').html('<img src="' + base_url_ + '/assets_/img/spinner.gif" /> Its Loading...');
    });
    $(document).ajaxComplete(function () {
        $('#loading_process').css('opacity', '1');
        $('#loading_process').css('display', 'none');
        $('#loading_process').html('');
    });
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
            fillClassSubjectinTable()
        }

        if ($("#frmSubjectMarks").length != 0) {
            fillClasses_subjectmarks();
        }

        if ($("#frmTeacher").length != 0) {
            fillStaffCategory_combo();
        }

        if ($("#frmScholastic").length != 0) {
            fillScholastic_item();
        }

        if ($("#frmScholasticAddClass").length != 0) {
            fillscholastic_forclass();
            fillClasses_forscholastic();
        }

        if ($("#frmCoScholastic").length != 0) {
            fillCoScholastic_item();
        }

        if ($("#frmcoScholasticAddClass").length != 0) {
            fillcoscholastic_forclass();
            fillClasses_forcoscholastic();
        }

        if ($("#frmStudentContact").length != 0) {
            fillClasses_forContact();
        }

        if ($("#frmExamTerm").length != 0) {
            fillTerm();
        }

        if ($("#frmInputResult").length != 0) {
            fillExamTermCombo();
            fillClassforResult();
        }

        if ($("#frmDisplayResult").length != 0) {
            fillcmbClassforResult();
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
                    logo = base_url_ + 'assets_/' + _img_folder_ + '/logo/' + obj.msg_[0].SCH_LOGO + "?version=1.9";
                    $('#schoolLogo').attr("src", logo);
                    $('#labelschName').html(obj.msg_[0].SCH_NAME);
                    $('#labelschContact').html(obj.msg_[0].SCH_CONTACT);
                    $('#labelschEmail').html(obj.msg_[0].SCH_EMAIL);
                    $('#labelschAdd').html(obj.msg_[0].SCH_ADD);
                    $('#labelschCity').html(obj.msg_[0].SCH_CITY);
                    $('#labelschDisitt').html(obj.msg_[0].SCH_DISITT);
                    $('#labelschState').html(obj.msg_[0].SCH_STATE);
                    $('#labelschCountry').html(obj.msg_[0].SCH_COUNTRY);
                    $('#labelschAffiliation').html(obj.msg_[0].AFFILIATION);
                    $('#labelschWebsite').html(obj.msg_[0].WEBSITE);
                    $('#labelschRemarks').html(obj.msg_[0].REMARK);
                    $('#txtSchID').val(obj.msg_[0].SCH_ID);
                    $('#txtSchName').val(obj.msg_[0].SCH_NAME);
                    $('#txtSchContact').val(obj.msg_[0].SCH_CONTACT);
                    $('#txtSchEmail').val(obj.msg_[0].SCH_EMAIL);
                    $('#txtSchAdd').val(obj.msg_[0].SCH_ADD);
                    $('#txtPCity').val(obj.msg_[0].SCH_CITY);
                    $('#txtPDistt').val(obj.msg_[0].SCH_DISITT);
                    $('#txtCountry').val(obj.msg_[0].SCH_COUNTRY);
                    $('#txtaffilation').val(obj.msg_[0].AFFILIATION);
                    $('#txtwebsite').val(obj.msg_[0].WEBSITE);
                    $('#txtRemark').val(obj.msg_[0].REMARK);
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
        $('.txtSchAffiliationEdit').css({'display': 'none'});
        $('.txtSchWebsiteEdit').css({'display': 'none'});
        $('.txtSchRemarksEdit').css({'display': 'none'});
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
    $('#editAffiliation').click(function () {
        if ($('.txtSchAffiliationEdit:visible').length == 0)
        {
            $('.txtSchAffiliationEdit').css({'display': 'block'});
        } else {
            $('.txtSchAffiliationEdit').css({'display': 'none'});
        }
    });
    $('#editWebsite').click(function () {
        if ($('.txtSchWebsiteEdit:visible').length == 0)
        {
            $('.txtSchWebsiteEdit').css({'display': 'block'});
        } else {
            $('.txtSchWebsiteEdit').css({'display': 'none'});
        }
    });
    $('#editRemarks').click(function () {
        if ($('.txtSchRemarksEdit:visible').length == 0)
        {
            $('.txtSchRemarksEdit').css({'display': 'block'});
        } else {
            $('.txtSchRemarksEdit').css({'display': 'none'});
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
        //alert(data_);
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
                    $('#tabGrading').html('<td colspan="4">NO Grade Present for ' + className + '</td>');
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
        url_ = site_url_ + "/reg_adm/getClasses_in_session";
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                var str_html = '';
                for (i = 0; i < obj.class_in_session.length; i++) {
                    str_html = str_html + "<input type='radio' name='classcoSub' class='span2' id='" + obj.class_in_session[i].CLSSESSID + "' value='" + obj.class_in_session[i].CLASSID + "'> <b>Class " + obj.class_in_session[i].CLASSID + "</b><br>";
                }
                $('#fillclassforSub').html(str_html);
            }
        });
    }

    function fillClassSubjectinTable() {
        var classID = $('input[type=radio][name=classcoSub]:checked').attr('id');
        var className = $('#' + classID).val();
        if ($('#' + classID).is(":checked")) {
            url_ = site_url_ + "/master/getClassSubject/" + className;
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
                            str_html = str_html + "<td><input type='text' name='txtSub' class='span7 txtPriority' id='txt-" + obj.class_subject[i].subjectID + "' value='" + obj.class_subject[i].priority + "'></td>";
                            str_html = str_html + '<td class="taskOptions">';
                            str_html = str_html + "<a href='#' class='tip deleteSubject' id='" + obj.class_subject[i].subjectID + "~" + obj.class_subject[i].subName + "'><i class='icon-remove'></i></a>";
                            str_html = str_html + '</td>';
                            str_html = str_html + "</tr>";
                        }
                        $('#fillAssociatedSubject').html(str_html);
                        $('#exitHeading1').html('Subjects Associated with Class ' + className);
                    } else {
                        $('#exitHeading1').html('No Subject is Associated with Class ' + className);
                        $('#fillAssociatedSubject').html("<td colspan='3'><font color='red'>NO Subject is Associated with Class " + className + "</font></td>");
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    }

    $('#fillclassforSub').on('change', '[type=radio]', function (e) {
        fillClassSubjectinTable();
    });
    $('.subjectSubmit').click(function () {
        var classID = $('input[type=radio][name=classcoSub]:checked').attr('id');
        var className = $('#' + classID).val();
        if (className === undefined) {
            callDanger("Please Select Class !!");
        } else if ($('#txtSubject').val() === '') {
            callDanger("Please Enter Subject Name !!");
            $('#txtSubject').focus();
        } else {
            data_ = $('#frmSubject').serializeArray();
            url_ = site_url_ + "/master/submitSubject/" + className;
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
                        fillClassSubjectinTable();
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
        if (confirm('Are you sure you want to delete Subject ' + subjectName)) {
            $.ajax({
                type: 'POST',
                url: url_,
                success: function (data) {
                    var obj = JSON.parse(data);
                    if (obj.res_ === false) {
                        callDanger(obj.msg_);
                    } else {
                        callSuccess(obj.msg_);
                        fillClassSubjectinTable();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });
//-----------------------------------------Teachers-----------------------------------
    $('#CategoryID').change(function () {
        fillTeacher();
    });
    function fillTeacher() {
        var staffCatID = $('#CategoryID').val();
        var staffCatgory = $("#CategoryID option:selected").text();
        url_ = site_url_ + "/master/getTeachers/" + staffCatID;
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                var str_html = '';
                var tStatus;
                if (obj.Teacher.length > 0) {
                    for (i = 0; i < obj.Teacher.length; i++) {
                        if (obj.Teacher[i].STATUS_ === '1') {
                            tStatus = 'working';
                        } else {
                            tStatus = 'not working';
                        }
                        str_html = str_html + "<tr class='gradeX'>";
                        str_html = str_html + "<td><i class='icon-info-sign'></i> <b>" + obj.Teacher[i].name + "</b></td>";
                        str_html = str_html + "<td>" + tStatus + "</td>";
                        str_html = str_html + '<td class="taskOptions">';
                        str_html = str_html + "<a href='#' class='tip editTeacher' id='" + obj.Teacher[i].teacherID + "'><i class='icon-pencil'></i></a> | ";
                        str_html = str_html + "<a href='#' class='tip deleteTeacher' id='" + obj.Teacher[i].teacherID + '~' + obj.Teacher[i].name + "'><i class='icon-remove'></i></a>";
                        str_html = str_html + '</td>';
                        str_html = str_html + "</tr>";
                    }
                    $('#tabTeacher').html(str_html);
                    $('#exitHeading').html("Existing Staff Members for " + staffCatgory);
                } else {
                    $('#exitHeading').html("Existing Staff Members for " + staffCatgory);
                    $('#tabTeacher').html("<td colspan='3'><font color='red'>No Staff Member is available yet</font></td>");
                }
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
                if (obj.Teacher_data[0].STATUS_ === '1') {
                    $("input[type=radio][value=1]").attr("checked", true);
                } else {
                    $("input[type=radio][value=0]").attr("checked", true);
                }
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
        url_ = site_url_ + "/master/getExistingTeachers";
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

    function fillStaffCategory_combo() {
        $('#s2id_CategoryID span').text("Loading...");
        url_ = site_url_ + "/master/getExistingStaffCategory";
        $('#CategoryID').empty();
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                var str_html = '';
                str_html = str_html + "<option value=''>Choose Category</option>";
                for (i = 0; i < obj.Staff.length; i++) {
                    str_html = str_html + "<option value='" + obj.Staff[i].ST_ID + "'> " + obj.Staff[i].STATUS + "</option>";
                }
                $('#s2id_CategoryID span').text("Choose Category");
                $('#CategoryID').html(str_html);
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
                    $('#tabAssociatedSubjects').html('<td colspan="4">No subject Associated</td>');
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
//-------------------------Subject Marks--------------------------------------
    function fillClasses_subjectmarks() {
        $('#s2id_subClassID span').text("Loading...");
        url_ = site_url_ + "/reg_adm/getClasses_in_session";
        $('#subClassMarksID').empty();
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
                $('#s2id_subClassMarksID span').text("Choose Class");
                $('#subClassMarksID').html(str_html);
            }
        });
    }

    $('#subClassMarksID').change(function () {
        var classID = $('#subClassMarksID').val();
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
        fillMarksAssociatedSubject();
    });
    function fillMarksAssociatedSubject() {
        var classID = $('#subClassMarksID').val();
        var subjectID = $('#cmbSubject').val();
        var subjectName = $("#cmbSubject option:selected").text();
        var className = $("#subClassMarksID option:selected").text();
        url_ = site_url_ + "/exam/getMarksAssociatedSubject/" + subjectID + "/" + classID;
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                if (obj.Subject_marks.length) {
                    var str_html = '';
                    for (i = 0; i < obj.Subject_marks.length; i++) {
                        str_html = str_html + "<tr class='gradeX'>";
                        str_html = str_html + "<td><i class='icon-info-sign'></i> <b>" + obj.Subject_marks[i].subName + " (" + obj.Subject_marks[i].status + ")</b></td>";
                        str_html = str_html + "<td>" + obj.Subject_marks[i].maxMarks + "</td>";
                        str_html = str_html + "<td>" + obj.Subject_marks[i].passMarks + "</td>";
                        str_html = str_html + '<td class="taskOptions">';
                        str_html = str_html + "<a href='#' class='tip deleteAssoicatedSubjectMarks' id='" + obj.Subject_marks[i].submarkID + "'><i class='icon-remove'></i></a>";
                        str_html = str_html + '</td>';
                        str_html = str_html + "</tr>";
                    }
                    $('#exitHeading').html('Associated Marks for Subjects in ' + className + '</span>');
                    $('#tabSubjects').html(str_html);
                } else {
                    $('#exitHeading').html('Associated Marks for Subjects in ' + className + '</span>');
                    $('#tabSubjects').html('<td colspan="4"><span style="color:red;">No Marks Associated with Subjects in ' + className + ' </span></td>');
                }
            }, error: function (xhr, status, error) {
                callSuccess(xhr.responseText);
            }
        });
    }

    $('body').on('click', '.deleteAssoicatedSubjectMarks', function () {
        var marksID = this.id;
        url_ = site_url_ + "/exam/deleteAssoicatedSubjectMarks/" + marksID;
        if (confirm('Are you sure you want to delete these Marks')) {
            $.ajax({
                type: 'POST',
                url: url_,
                success: function (data) {
                    var obj = JSON.parse(data);
                    if (obj.res_ === false) {
                        callDanger(obj.msg_);
                    } else {
                        callSuccess(obj.msg_);
                        fillMarksAssociatedSubject();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });
    function subMarks_Submit() {
        if ($('#txtmaxMarks').val() === '') {
            callDanger("Please Enter Maximum Marks for the subject!!");
            $('#txtmaxMarks').focus();
        } else if ($('#txtpassMarks').val() === '') {
            callDanger("Please Enter Pass Marks for the subject!!");
            $('#txtpassMarks').focus();
        } else {
            data_ = new FormData($('#frmSubjectMarks')[0]);
        }
        url_ = site_url_ + "/exam/submitMarksAssociatedSubject";
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
                    fillMarksAssociatedSubject();
                }
            }, error: function (xhr, status, error) {
                callSuccess(xhr.responseText);
            }
        });
    }
    $('.subjectMarksSubmit').click(function () {
        subMarks_Submit();
    });
    function fillScholastic_item() {
        url_ = site_url_ + "/exam/getAllScholasticItems";
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                if (obj.Scholastic.length) {
                    var str_html = '';
                    for (i = 0; i < obj.Scholastic.length; i++) {
                        str_html = str_html + "<tr class='gradeX'>";
                        str_html = str_html + "<td>" + obj.Scholastic[i].item + "</td>";
                        str_html = str_html + "<td>" + obj.Scholastic[i].maxMarks + "</td>";
                        str_html = str_html + "<td>" + obj.Scholastic[i].minMarks + "</td>";
                        str_html = str_html + "<td><input type='text' name='txtSub' class='span9 txtschoPriority' id='txt-" + obj.Scholastic[i].itemID + "' value='" + obj.Scholastic[i].priority + "'></td>";
                        str_html = str_html + '<td class="taskOptions">';
                        str_html = str_html + "<a href='#' class='tip editScholastic' id='" + obj.Scholastic[i].itemID + "'><i class='icon-pencil'></i></a> | ";
                        str_html = str_html + "<a href='#' class='tip deleteScholastic' id='" + obj.Scholastic[i].itemID + '~' + obj.Scholastic[i].item + "'><i class='icon-remove'></i></a>";
                        str_html = str_html + '</td>';
                        str_html = str_html + "</tr>";
                    }
                    $('#exitHeading').html('Scholastic items already present </span>');
                    $('#tabScholastic').html(str_html);
                } else {
                    $('#exitHeading').html('No Scholastic items present </span>');
                    $('#tabScholastic').html('<td colspan="3"><span style="color:red;">No Scholastic items present  </span></td>');
                }
            }, error: function (xhr, status, error) {
                callSuccess(xhr.responseText);
            }
        });
    }

    $('.submitScholastic').click(function () {
        if ($('#txtScholasticItem').val() === '') {
            callDanger("Please Enter Scholastic Item Name !!");
            $('#txtScholasticItem').focus();
        } else if ($('#txtScholasticMarks').val() === '') {
            callDanger("Please Enter Marks allotted to Scholastic Item!!");
            $('#txtScholasticMarks').focus();
        } else {
            data_ = $('#frmScholastic').serializeArray();
            url_ = site_url_ + "/exam/submitScholasticItem";
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
                        fillScholastic_item();
                        fillscholastic_forclass();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });
    $('body').on('click', '.editScholastic', function () {
        var scholasticID = this.id;
        url_ = site_url_ + "/exam/get_Scholastic_for_update/" + scholasticID;
        $.ajax({
            type: 'POST',
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                $('#ScholasticID_Edit').val(scholasticID);
                $('#txtScholasticItem_edit').val(obj.Scholasticitem[0].item);
                $('#txtScholasticMarks_edit').val(obj.Scholasticitem[0].maxMarks);
                $('#txtScholasticminMarks_edit').val(obj.Scholasticitem[0].minMarks);
                $('#editScholasticDiv').css({'display': 'block'});
                $('#txtScholasticItem_edit').focus();
            }, error: function (xhr, status, error) {
                callSuccess(xhr.responseText);
            }
        });
    });
    $('body').on('click', '.submitScholastic_edit', function () {
        if ($('#txtScholasticItem_edit').val() === '') {
            callDanger("Please Enter Scholastic Item Name !!");
            $('#txtScholasticItem_edit').focus();
        } else if ($('#txtScholasticMarks_edit').val() === '') {
            callDanger("Please Enter Marks allotted to Scholastic Item!!");
            $('#txtScholasticMarks_edit').focus();
        } else {
            data_ = $('#frmScholastic_edit').serializeArray();
            url_ = site_url_ + "/exam/updateScholasticItem";
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
                        fillScholastic_item();
                        fillscholastic_forclass();
                        $('#editScholasticDiv').css({'display': 'none'});
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });
    $('body').on('click', '.deleteScholastic', function () {
        var str = this.id;
        var arr_str = str.split('~');
        var scholasticID = arr_str[0];
        var scholasticItem = arr_str[1];
        url_ = site_url_ + "/exam/delete_Scholastic/" + scholasticID;
        if (confirm('Are you sure you want to delete ' + scholasticItem)) {
            $.ajax({
                type: 'POST',
                url: url_,
                success: function (data) {
                    var obj = JSON.parse(data);
                    if (obj.res_ === false) {
                        callDanger(obj.msg_);
                    } else {
                        callSuccess(obj.msg_);
                        fillScholastic_item();
                        fillscholastic_forclass();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });
    function fillscholastic_forclass() {
        url_ = site_url_ + "/exam/getAllScholasticItems";
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                if (obj.Scholastic.length) {
                    var str_html = '';
                    for (i = 0; i < obj.Scholastic.length; i++) {
                        str_html = str_html + "<input type='checkbox' name='chkScholastic[]' class='span2' value='" + obj.Scholastic[i].itemID + "' id='" + obj.Scholastic[i].itemID + "'> <b> " + obj.Scholastic[i].item + " [" + obj.Scholastic[i].maxMarks + "]" + "</b><br>";
                    }
                    $('#fillscholastic').html(str_html);
                } else {
                    $('#fillscholastic').html('No Scholastic items present </span>');
                }
            }, error: function (xhr, status, error) {
                callSuccess(xhr.responseText);
            }
        });
    }

    function fillClasses_forscholastic() {
        url_ = site_url_ + "/reg_adm/getClasses_in_session";
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                var str_html = '';
                for (i = 0; i < obj.class_in_session.length; i++) {
                    str_html = str_html + "<input type='radio' name='classSch' class='span2' id='" + obj.class_in_session[i].CLSSESSID + "' value='" + obj.class_in_session[i].CLASSID + "'> <b>Class " + obj.class_in_session[i].CLASSID + "</b><br>";
                }
                $('#fillclass').html(str_html);
            }
        });
    }

    function fillAssociatedScholasticItem() {
        var str = $('input[type=radio][name=classSch]:checked').attr('id');
        var className = $('#' + str).val();
        if ($('#' + str).is(":checked")) {
            url_ = site_url_ + "/exam/get_class_scholastic_in_session/" + str;
            $.ajax({
                type: "POST",
                url: url_,
                success: function (data) {
                    var obj = JSON.parse(data);
                    // alert(obj.scholasticinclass.length);
                    var str_html = '';
                    if (obj.scholasticinclass.length > 0) {
                        for (i = 0; i < obj.scholasticinclass.length; i++) {
                            str_html = str_html + "<tr class='gradeX'>";
                            str_html = str_html + "<td><i class='icon-info-sign'></i>  <b>" + obj.scholasticinclass[i].item + "</b></td>";
                            str_html = str_html + '<td class="taskOptions">';
                            str_html = str_html + "<a href='#' class='tip deleteAssociatedScholastic' id='" + obj.scholasticinclass[i].ADDSCHCLASSID + "'><i class='icon-remove'></i></a>";
                            str_html = str_html + '</td>';
                            str_html = str_html + "</tr>";
                        }
                        $('#fillAssociatedScholastic').html(str_html);
                        $('#exitHeading1').html('Scholastic Item Associated with Class ' + className);
                    } else {
                        $('#exitHeading1').html('No Scholastic Item Associated with Class ' + className);
                        $('#fillAssociatedScholastic').html("<td colspan='3'><font color='red'>NO Scholastic Item Associated with Class " + className + "</font></td>");
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    }

    $('#fillclass').on('change', '[type=radio]', function (e) {
        fillAssociatedScholasticItem();
    });
    $('body').on('click', '.Add_scholastic_class', function () {
        var classsid = $('input[type=radio][name=classSch]:checked').attr('id');
        data_ = $('#frmScholasticAddClass').serializeArray();
        url_ = site_url_ + "/exam/AddScholastictoClass/" + classsid;
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
                    fillAssociatedScholasticItem();
                }
            }, error: function (xhr, status, error) {
                callSuccess(xhr.responseText);
            }
        });
    });
    $('body').on('click', '.deleteAssociatedScholastic', function () {
        var assoID = this.id;
        url_ = site_url_ + "/exam/delAssociated_scholastic_class/" + assoID;
        if (confirm('Are you sure you want to delete this Scholastic Item from Class')) {
            $.ajax({
                type: 'POST',
                url: url_,
                success: function (data) {
                    var obj = JSON.parse(data);
                    if (obj.res_ === false) {
                        callDanger(obj.msg_);
                    } else {
                        callSuccess(obj.msg_);
                        fillAssociatedScholasticItem();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });
    function fillCoScholastic_item() {
        url_ = site_url_ + "/exam/getAllCoScholasticItems";
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                if (obj.CoScholastic.length) {
                    var str_html = '';
                    for (i = 0; i < obj.CoScholastic.length; i++) {
                        str_html = str_html + "<tr class='gradeX'>";
                        str_html = str_html + "<td>" + obj.CoScholastic[i].coitem + "</td>";
                        str_html = str_html + "<td><input type='text' name='txtSub' class='span9 txtcoschoPriority' id='txt-" + obj.CoScholastic[i].coitemID + "' value='" + obj.CoScholastic[i].priority + "'></td>";
                        str_html = str_html + '<td class="taskOptions">';
                        str_html = str_html + "<a href='#' class='tip deleteCoScholastic' id='" + obj.CoScholastic[i].coitemID + '~' + obj.CoScholastic[i].coitem + "'><i class='icon-remove'></i></a>";
                        str_html = str_html + '</td>';
                        str_html = str_html + "</tr>";
                    }
                    $('#exitHeading').html('Co-Scholastic items already present </span>');
                    $('#tabCoScholastic').html(str_html);
                } else {
                    $('#exitHeading').html('No Co-Scholastic items present </span>');
                    $('#tabCoScholastic').html('<td colspan="3"><span style="color:red;">No Co-Scholastic items present  </span></td>');
                }
            }, error: function (xhr, status, error) {
                callSuccess(xhr.responseText);
            }
        });
    }

    $('.submitCoScholastic').click(function () {
        if ($('#txtCoScholasticItem').val() === '') {
            callDanger("Please Enter Co-Scholastic Item Name !!");
            $('#txtCoScholasticItem').focus();
        } else {
            data_ = $('#frmCoScholastic').serializeArray();
            url_ = site_url_ + "/exam/submitCoScholasticItem";
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
                        fillCoScholastic_item();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });
    $('body').on('click', '.deleteCoScholastic', function () {
        var str = this.id;
        var arr_str = str.split('~');
        var coscholasticID = arr_str[0];
        var coscholasticItem = arr_str[1];
        url_ = site_url_ + "/exam/delete_coScholastic/" + coscholasticID;
        if (confirm('Are you sure you want to delete ' + coscholasticItem)) {
            $.ajax({
                type: 'POST',
                url: url_,
                success: function (data) {
                    var obj = JSON.parse(data);
                    if (obj.res_ === false) {
                        callDanger(obj.msg_);
                    } else {
                        callSuccess(obj.msg_);
                        fillCoScholastic_item();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });
    $('body').on('click', '.editCoScholastic', function () {
        var coscholasticID = this.id;
        url_ = site_url_ + "/exam/get_coScholastic_for_update/" + coscholasticID;
        $.ajax({
            type: 'POST',
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                $('#coScholasticID_Edit').val(coscholasticID);
                $('#txtcoScholasticItem_edit').val(obj.coScholasticitem[0].coitem);
                $('#editcoScholasticDiv').css({'display': 'block'});
                $('#txtcoScholasticItem_edit').focus();
            }, error: function (xhr, status, error) {
                callSuccess(xhr.responseText);
            }
        });
    });
    function fillcoscholastic_forclass() {
        url_ = site_url_ + "/exam/getAllCoScholasticItems";
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                if (obj.CoScholastic.length) {
                    var str_html = '';
                    for (i = 0; i < obj.CoScholastic.length; i++) {
                        str_html = str_html + "<input type='checkbox' name='chkcoScholastic[]' class='span2' value='" + obj.CoScholastic[i].coitemID + "' id='" + obj.CoScholastic[i].coitemID + "'> <b> " + obj.CoScholastic[i].coitem + "</b><br>";
                    }
                    $('#fillcoscholastic').html(str_html);
                } else {
                    $('#fillcoscholastic').html('No Co-Scholastic items present </span>');
                }
            }, error: function (xhr, status, error) {
                callSuccess(xhr.responseText);
            }
        });
    }

    function fillClasses_forcoscholastic() {
        url_ = site_url_ + "/reg_adm/getClasses_in_session";
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                var str_html = '';
                for (i = 0; i < obj.class_in_session.length; i++) {
                    str_html = str_html + "<input type='radio' name='classcoSch' class='span2' id='" + obj.class_in_session[i].CLSSESSID + "' value='" + obj.class_in_session[i].CLASSID + "'> <b>Class " + obj.class_in_session[i].CLASSID + "</b><br>";
                }
                $('#fillcoclass').html(str_html);
            }
        });
    }

    function fillAssociatedcoScholasticItem() {
        var str = $('input[type=radio][name=classcoSch]:checked').attr('id');
        var className = $('#' + str).val();
        if ($('#' + str).is(":checked")) {
            url_ = site_url_ + "/exam/get_class_coscholastic_in_session/" + str;
            $.ajax({
                type: "POST",
                url: url_,
                success: function (data) {
                    var obj = JSON.parse(data);
                    // alert(obj.scholasticinclass.length);
                    var str_html = '';
                    if (obj.coscholasticinclass.length > 0) {
                        for (i = 0; i < obj.coscholasticinclass.length; i++) {
                            str_html = str_html + "<tr class='gradeX'>";
                            str_html = str_html + "<td><i class='icon-info-sign'></i>  <b>" + obj.coscholasticinclass[i].coitem + "</b></td>";
                            str_html = str_html + '<td class="taskOptions">';
                            str_html = str_html + "<a href='#' class='tip deleteAssociatedScholastic' id='" + obj.coscholasticinclass[i].ADDCOSCHCLASSID + "'><i class='icon-remove'></i></a>";
                            str_html = str_html + '</td>';
                            str_html = str_html + "</tr>";
                        }
                        $('#fillAssociatedcoScholastic').html(str_html);
                        $('#exitHeading1').html('Co-Scholastic Item Associated with Class ' + className);
                    } else {
                        $('#exitHeading1').html('No Co-Scholastic Item Associated with Class ' + className);
                        $('#fillAssociatedcoScholastic').html("<td colspan='3'><font color='red'>NO Co-Scholastic Item Associated with Class " + className + "</font></td>");
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    }

    $('#fillcoclass').on('change', '[type=radio]', function (e) {
        fillAssociatedcoScholasticItem();
    });
    $('body').on('click', '.Add_coscholastic_class', function () {
        var classsid = $('input[type=radio][name=classcoSch]:checked').attr('id');
        data_ = $('#frmcoScholasticAddClass').serializeArray();
        url_ = site_url_ + "/exam/AddcoScholastictoClass/" + classsid;
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
                    fillAssociatedcoScholasticItem();
                }
            }, error: function (xhr, status, error) {
                callSuccess(xhr.responseText);
            }
        });
    });
    function fillClasses_forContact() {
        $('#s2id_stuClassID span').text("Loading...");
        url_ = site_url_ + "/reg_adm/getClasses_in_session";
        $('#stuClassID').empty();
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
                $('#s2id_stuClassID span').text("Choose Class");
                $('#stuClassID').html(str_html);
            }
        });
    }

    $('#stuClassID').change(function () {
        var clssessid = $('#stuClassID').val();
        var className = $("#stuClassID option:selected").text();
        url_ = site_url_ + "/master/get_student_detail/" + clssessid;
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                var str_html = '';
                for (i = 0; i < obj.Student.length; i++) {
                    str_html = str_html + "<tr class='gradeX'>";
                    str_html = str_html + "<td>" + (i + 1) + "</td>";
                    str_html = str_html + "<td>" + obj.Student[i].FNAME + "</td>";
                    str_html = str_html + "<td>" + obj.Student[i].FATHER + "</td>";
                    str_html = str_html + "<td><input type='text' name='txtB' class='textB' id='txt-" + obj.Student[i].regid + "' value='" + obj.Student[i].MOBILE_S + "'></td>";
                    str_html = str_html + '<td class="taskOptions">';
                    str_html = str_html + "<a href='#' class='btn editStudentContact' id='" + obj.Student[i].regid + "'><i class='fa fa-arrow-circle-right fa-lg'></i></a>";
                    str_html = str_html + '</td>';
                    str_html = str_html + "</tr>";
                }
                $('#tabStudents').html(str_html);
                $('#exitHeading').html('Student in <span style="color:blue">' + className + '</span>');
            }
        });
    });
    $('body').on('click', '.editStudentContact', function () {
        var assoID = this.id;
        var ida = 'txt-' + assoID;
        var contactNo = $('#' + ida).val();
        url_ = site_url_ + "/master/submitStudentContact/" + assoID + "/" + contactNo;
        $.ajax({
            type: 'POST',
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                if (obj.res_ === false) {
                    callDanger(obj.msg_);
                } else {
                    callSuccess(obj.msg_);
                }
            }, error: function (xhr, status, error) {
                callDanger(xhr.responseText);
            }
        });
    });
    $(document).on('keyup', "input[type='text']", function () {
        if ($(this).attr('class') === "span7 txtPriority") {
            var priority = $(this).val();
            var subID = $(this).attr('id');
            var arr_str = subID.split('-');
            var subjectID = arr_str[1];
            url_ = site_url_ + "/master/setSubjectPriority/" + subjectID + "/" + priority;
            $.ajax({
                type: 'POST',
                url: url_,
                success: function (data) {
                    var obj = JSON.parse(data);
                    if (obj.res_ === false) {
                        callDanger(obj.msg_);
                    } else {
                        callSuccess(obj.msg_);
                        fillClassSubjectinTable();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        } else if ($(this).attr('class') === "span9 txtschoPriority") {
            var priority = $(this).val();
            var scholasticID = $(this).attr('id');
            var arr_str = scholasticID.split('-');
            var schoID = arr_str[1];
            url_ = site_url_ + "/exam/setSchoPriority/" + schoID + "/" + priority;
            $.ajax({
                type: 'POST',
                url: url_,
                success: function (data) {
                    var obj = JSON.parse(data);
                    if (obj.res_ === false) {
                        callDanger(obj.msg_);
                    } else {
                        callSuccess(obj.msg_);
                        fillScholastic_item();
                        fillscholastic_forclass();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        } else if ($(this).attr('class') === "span9 txtcoschoPriority") {
            var priority = $(this).val();
            var coscholasticID = $(this).attr('id');
            var arr_str = coscholasticID.split('-');
            var coschoID = arr_str[1];
            url_ = site_url_ + "/exam/setcoSchoPriority/" + coschoID + "/" + priority;
            $.ajax({
                type: 'POST',
                url: url_,
                success: function (data) {
                    var obj = JSON.parse(data);
                    if (obj.res_ === false) {
                        callDanger(obj.msg_);
                    } else {
                        callSuccess(obj.msg_);
                        fillCoScholastic_item();
                        fillcoscholastic_forclass
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        } else if ($(this).attr('class') === "form-control marks_0_1") {
            var stuID = $(this).attr('id');
            var arr_str = stuID.split('-');
            var maxMarks_ = parseInt(arr_str[1]);
            var marks = parseInt($(this).val());
            if (maxMarks_ < marks) {
                alert('Marks cannot be greater than ' + maxMarks_ + ' for selected Assessment Item');
                $(this).val('');
                $(this).focus();
            }
        }
    });
    function fillTerm() {
        url_ = site_url_ + "/exam/get_examterm_in_session";
        $.ajax({
            type: 'POST',
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                var str_html = '';
                if (obj.examTerm.length > 0) {
                    for (i = 0; i < obj.examTerm.length; i++) {
                        str_html = str_html + "<tr class='gradeX'>";
                        str_html = str_html + "<td>" + obj.examTerm[i].termName + "</td>";
                        str_html = str_html + '<td class="taskOptions">';
                        str_html = str_html + "<a href='#' class='btn DeleteTerm' id='" + obj.examTerm[i].termID + "~" + obj.examTerm[i].termName + "'><i class='icon-remove'></i></a>";
                        str_html = str_html + '</td>';
                        str_html = str_html + "</tr>";
                    }
                    $('#tabExamTerm').html(str_html);
                } else {
                    $('#exitHeading1').html('<td colspan="2">No Exam Term Present for This Session</td>');
                    $('#tabExamTerm').html('<td colspan="2">No Exam Term Present for This Session</td>');
                }
            }
        });
    }

    $('.submitExamTerm').click(function () {
        if ($('#txtExamTerm').val() === '') {
            callDanger("Please Enter Exam Term !!");
            $('#txtExamTerm').focus();
        } else {
            data_ = $('#frmExamTerm').serializeArray();
            url_ = site_url_ + "/exam/create_term";
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
                        fillTerm();
                        fillExamTermCombo();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });
    $('body').on('click', '.DeleteTerm', function () {
        var str = this.id;
        var arr_str = str.split('~');
        var termID = arr_str[0];
        var termName = arr_str[1];
        url_ = site_url_ + "/exam/deleteTerm/" + termID;
        if (confirm('Are you sure you want to delete ' + termName)) {
            $.ajax({
                type: 'POST',
                url: url_,
                success: function (data) {
                    var obj = JSON.parse(data);
                    if (obj.res_ === false) {
                        callDanger(obj.msg_);
                    } else {
                        callSuccess(obj.msg_);
                        fillTerm();
                        fillExamTermCombo();
                    }
                }, error: function (xhr, status, error) {
                    callSuccess(xhr.responseText);
                }
            });
        }
    });
    function fillExamTermCombo() {
        $('#s2id_cmbExamTerm span').text("Loading...");
        url_ = site_url_ + "/exam/get_examterm_in_session";
        $('#cmbExamTerm').empty();
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                var str_html = '';
                str_html = str_html + "<option value=''>Choose Term</option>";
                for (i = 0; i < obj.examTerm.length; i++) {
                    str_html = str_html + "<option value='" + obj.examTerm[i].termID + "'>" + obj.examTerm[i].termName + "</option>";
                }
                $('#s2id_cmbExamTerm span').text("Choose Term");
                $('#cmbExamTerm').html(str_html);
            }
        });
    }

    function fillClassforResult() {
        $('#s2id_cmbClassofResult span').text("Loading...");
        url_ = site_url_ + "/reg_adm/getClasses_in_session";
        $('#cmbClassofResult').empty();
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                var str_html = '';
                str_html = str_html + "<option value=''>Choose Class</option>";
                for (i = 0; i < obj.class_in_session.length; i++) {
                    str_html = str_html + "<option value='" + obj.class_in_session[i].CLSSESSID + "'> Class " + obj.class_in_session[i].CLASSID + "</option>";
                }
                $('#s2id_cmbClassofResult span').text("Choose Class");
                $('#cmbClassofResult').html(str_html);
            }
        });
    }

    $('#cmbClassofResult').change(function () {
        $('#cmbAssessment > option').eq('0').attr('selected', 'selected')
        $('#s2id_cmbAssessment span').text("Choose Assessment Area");
        $('#cmbAssessmentItem').empty();
        $('#s2id_cmbAssessmentItem span').text("Select Above Assessment Area");
        document.getElementById('subjectHidden').style.display = 'none';
        $('#tabStudentsMarks').html('');
        if ($('#cmbClassofResult').val() != '') {
            data_ = $("#cmbClassofResult option:selected").text();
            var arr_str = data_.split(' ');
            var classID = arr_str[2];
            url_ = site_url_ + "/master/getClassSubject/" + classID;
            //alert(url_);
            $('#s2id_cmbSubjectMarks span').text("Checking...");
            $.ajax({
                type: "POST",
                url: url_,
                data: data_,
                success: function (data) {
                    var obj = JSON.parse(data);
                    var str_html = '';
                    str_html = str_html + "<option value=''>Choose Subject</option>";
                    for (i = 0; i < obj.class_subject.length; i++) {
                        str_html = str_html + "<option value='" + obj.class_subject[i].subjectID + "'>" + obj.class_subject[i].subName + "</option>";
                    }
                    $('#s2id_cmbSubjectMarks span').text("Choose Subject");
                    $('#cmbSubjectMarks').html(str_html);
                }
            });
        } else {
            $('#s2id_cmbSubjectMarks span').text("Subject not found");
        }
    });
    $('#cmbAssessment').change(function () {
        $('#tabStudentsMarks').html('');
        var assArea = $('#cmbAssessment').val();
        if ($('#cmbClassofResult').val() != '') {
            if (assArea === '1') { //for Scholastic
                data_ = $('#cmbClassofResult').val();
                //alert(data_);
                url_ = site_url_ + "/exam/get_scholastic_item_classwise/" + data_;
                //alert(url_);                
                $('#cmbAssessmentItem').html('Checking ...');
                $.ajax({
                    type: "POST",
                    url: url_,
                    data: data_,
                    success: function (data) {
                        var obj = JSON.parse(data);
                        var str_html = '';
                        str_html = str_html + "<option value=''>Choose Scholastic Item</option>";
                        for (i = 0; i < obj.scholasticItem.length; i++) {
                            str_html = str_html + "<option value='" + obj.scholasticItem[i].itemID + "'>" + obj.scholasticItem[i].item + "</option>";
                        }
                        $('#s2id_cmbAssessmentItem span').text("Choose Scholastic Item");
                        $('#cmbAssessmentItem').html(str_html);
                        document.getElementById('subjectHidden').style.display = 'block';
                        getStudents();
                    }
                });
            } else if (assArea === '2') {//for coscholastic                 
                document.getElementById('subjectHidden').style.display = 'none';
                data_ = $('#cmbClassofResult').val();
                //alert(data_);
                url_ = site_url_ + "/exam/get_coscholastic_item_classwise/" + data_;
                //alert(url_);                
                $('#cmbAssessmentItem').html('Checking ...');
                $.ajax({
                    type: "POST",
                    url: url_,
                    data: data_,
                    success: function (data) {
                        var obj = JSON.parse(data);
                        var str_html = '';
                        str_html = str_html + "<option value=''>Choose Co-Scholastic Item</option>";
                        for (i = 0; i < obj.coscholasticItem.length; i++) {
                            str_html = str_html + "<option value='" + obj.coscholasticItem[i].coitemID + "'>" + obj.coscholasticItem[i].coitem + "</option>";
                        }
                        $('#s2id_cmbAssessmentItem span').text("Choose Co-Scholastic Item");
                        $('#cmbAssessmentItem').html(str_html);
                        getStudents();
                    }
                });
            } else {
                callDanger('Select Proper Assessment Area');
            }
        } else {
            callDanger('Select Class First');
            $('#cmbAssessment > option').eq('0').attr('selected', 'selected')
            $('#s2id_cmbAssessment span').text("Choose Assessment Area");
            $('#cmbAssessmentItem').empty();
            $('#s2id_cmbAssessmentItem span').text("Select Above Assessment Area");
            document.getElementById('subjectHidden').style.display = 'none';
        }
    });
    function getStudents() {
        if ($('#cmbAssessment').val() == '1') {
            if ($('#cmbExamTerm').val() != '' && $('#cmbClassofResult').val() != '' && $('#cmbAssessmentItem').val() != '' && $('#cmbSubjectMarks').val() != '') {
                var examTerm = $('#cmbExamTerm').find(":selected").text();
                var classID = $("#cmbClassofResult").val();
                var className = $("#cmbClassofResult").find(":selected").text();
                var subject = $('#cmbSubjectMarks').find(":selected").text();
                var assid = $('#cmbAssessmentItem').val();
                var assName = $('#cmbAssessmentItem').find(":selected").text();
                $('#exitHeading').html('Term - <span style="color:blue;margin-right:40px;">' + examTerm + '</span> <span style="color:blue;margin-right:40px;">' + className + '</span> Subject - <span style="color:blue">' + subject + ' (' + assName + ') ' + '</span>');
                url_ = site_url_ + "/exam/getstudentsforclass/" + classID + "/1/" + assid;
                data_ = $('#frmInputResult').serialize();
                $('#tabStudentsMarks').html('<td colspan="3">Checking for availability. Please wait...</td>');
                $.ajax({
                    type: "POST",
                    url: url_,
                    data: data_,
                    success: function (data) {
                        var obj = JSON.parse(data);
                        var str_html = '';
                        if (obj.res_ !== '') {
                            str_html = str_html + ('<tr><td colspan="4" bgcolor="red" style="color:#fff">' + obj.res_ + '</td></tr>');
                        }
                        if (obj.studentdata.length > 0) {
                            for (i = 0; i < obj.studentdata.length; i++) {
                                str_html = str_html + "<tr class='gradeX'>";
                                str_html = str_html + "<td>" + obj.studentdata[i].regid + "</td>";
                                str_html = str_html + "<td>" + obj.studentdata[i].FNAME + "</td>";
                                if (obj.res_ !== '') {
                                    str_html = str_html + "<td id='td-" + obj.studentdata[i].regid + "'><input type='text' required='required' style='width:100px;background:yellow' class='form-control marks_0_1' name='marks_status[" + obj.studentdata[i].schID + "]' id='" + obj.studentdata[i].regid + "-" + obj.maxMarks + "' value='" + obj.studentdata[i].marks + "' /></td>";
                                } else {
                                    str_html = str_html + "<td id='td-" + obj.studentdata[i].regid + "'><input type='text' required='required' style='width:100px;' class='form-control marks_0_1' name='marks_status[" + obj.studentdata[i].regid + "]' id='" + obj.studentdata[i].regid + "-" + obj.maxMarks + "' value='' /></td>";
                                }
                                str_html = str_html + "<td><input type='checkbox' class='span9' id='chk-" + obj.studentdata[i].regid + "'/><b>AB</b></td>";
                                str_html = str_html + "</tr>";
                                $('#txtExamDate').val(obj.studentdata[i].DATEOFTEST);
                            }
                            $('#tabStudentsMarks').html(str_html);
                            $('#trMarks').html('Marks');
                            if (obj.res_ !== '') {
                                document.getElementById('divSubmitResultMarks').style.display = 'none';
                                document.getElementById('divUpdateResultMarks').style.display = 'block';
                            } else {
                                document.getElementById('divSubmitResultMarks').style.display = 'block';
                                document.getElementById('divUpdateResultMarks').style.display = 'none';
                            }
                        } else {
                            $('#tabStudentsMarks').html('<td colspan="4">No Student Present in this class for This Session</td>');
                        }
                    }
                });
            }
        } else if ($('#cmbAssessment').val() == '2') {
            if ($('#cmbExamTerm').val() != '' && $('#cmbClassofResult').val() != '' && $('#cmbAssessmentItem').val() != '') {

                var examTerm = $('#cmbExamTerm').find(":selected").text();
                var classID = $("#cmbClassofResult").val();
                var className = $("#cmbClassofResult").find(":selected").text();
                var assTerm = $('#cmbAssessmentItem').find(":selected").text();
                $('#exitHeading').html('Term - <span style="color:blue;margin-right:40px;">' + examTerm + '</span> <span style="color:blue;margin-right:40px;">' + className + '</span> Assessment Item - <span style="color:blue">' + assTerm + '</span>');
                url_ = site_url_ + "/exam/getstudentsforclass/" + classID + "/2";
                data_ = $('#frmInputResult').serialize();
                $('#tabStudentsMarks').html('<td colspan="3">Checking for availability. Please wait...</td>');
                $.ajax({
                    type: "POST",
                    url: url_,
                    data: data_,
                    success: function (data) {
                        var obj = JSON.parse(data);
                        var str_html = '';
                        if (obj.res_ !== '') {
                            str_html = str_html + ('<tr><td colspan="4" bgcolor="red" style="color:#fff">' + obj.res_ + '</td></tr>');
                        }
                        if (obj.studentdata.length > 0) {
                            for (i = 0; i < obj.studentdata.length; i++) {
                                str_html = str_html + "<tr class='gradeX'>";
                                str_html = str_html + "<td>" + obj.studentdata[i].regid + "</td>";
                                str_html = str_html + "<td>" + obj.studentdata[i].FNAME + "</td>";
                                if (obj.res_ !== '') {
                                    str_html = str_html + "<td id='td-" + obj.studentdata[i].regid + "'><input type='text' resuired='required' style='width:100px;background:yellow' class='form-control marks_0_2' name='marks_status[" + obj.studentdata[i].coschID + "]' id='" + obj.studentdata[i].regid + "' value='" + obj.studentdata[i].grade + "' /></td>";
                                } else {
                                    str_html = str_html + "<td id='td-" + obj.studentdata[i].regid + "'><input type='text' required='required' style='width:100px;' class='form-control marks_0_2' name='marks_status[" + obj.studentdata[i].regid + "]' id='" + obj.studentdata[i].regid + "' value='' /></td>";
                                }
                                str_html = str_html + "<td><input type='checkbox' class='span9' id='chk-" + obj.studentdata[i].regid + "'/><b>AB</b></td>";
                                str_html = str_html + "</tr>";
                                $('#txtExamDate').val(obj.studentdata[i].DATEOFTEST);
                            }
                            $('#tabStudentsMarks').html(str_html);
                            $('#trMarks').html('Grade');
                            if (obj.res_ !== '') {
                                document.getElementById('divSubmitResultMarks').style.display = 'none';
                                document.getElementById('divUpdateResultMarks').style.display = 'block';
                            } else {
                                document.getElementById('divSubmitResultMarks').style.display = 'block';
                                document.getElementById('divUpdateResultMarks').style.display = 'none';
                            }
                        } else {
                            $('#tabStudentsMarks').html('<td colspan="4">No Student Present in this class for This Session</td>');
                        }
                    }
                });
            }
        }
    }

    $('#tabStudentsMarks').on('change', '[type=checkbox]', function (e) {
        data_ = $(this).attr('id');
        var arr_str = data_.split('-');
        var studentID = arr_str[1];

        if ($(this).attr('checked')) {
            $("#td-" + studentID).find("input[type='text']").val('AB');
        } else {
            $("#td-" + studentID).find("input[type='text']").val('');
        }
    });

    $('#cmbExamTerm').change(function () {
        getStudents();
    });
    $('#cmbAssessmentItem').change(function () {
        getStudents();
    });
    $('#cmbSubjectMarks').change(function () {
        getStudents();
    });
    $('.submitMarks').click(function () {
        data_ = $('#frmInputResult').serializeArray();
        url_ = site_url_ + "/exam/inputResult";
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
                    getStudents();
                }
            }, error: function (xhr, status, error) {
                callSuccess(xhr.responseText);
            }
        });
    });
    $('.updateMarks').click(function () {
        data_ = $('#frmInputResult').serializeArray();
        url_ = site_url_ + "/exam/updateInputResult";
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
                }
            }, error: function (xhr, status, error) {
                callSuccess(xhr.responseText);
            }
        });
    });

    function fillcmbClassforResult() {
        $('#s2id_cmbClassforResult span').text("Loading...");
        url_ = site_url_ + "/reg_adm/getClasses_in_session";
        $('#cmbClassforResult').empty();
        $.ajax({
            type: "POST",
            url: url_,
            success: function (data) {
                var obj = JSON.parse(data);
                var str_html = '';
                str_html = str_html + "<option value=''>Choose Class</option>";
                for (i = 0; i < obj.class_in_session.length; i++) {
                    str_html = str_html + "<option value='" + obj.class_in_session[i].CLSSESSID + "'> Class " + obj.class_in_session[i].CLASSID + "</option>";
                }
                $('#s2id_cmbClassforResult span').text("Choose Class");
                $('#cmbClassforResult').html(str_html);
            }
        });
    }

    $('#cmbClassforResult').change(function () {
        getRemarks();
    });

    function getRemarks() {
        document.getElementById('divInfo').style.display = 'none';
        document.getElementById('divclassData').style.display = 'block';
        document.getElementById('divmarksheetPanel').style.display = 'none';
        $('#tabStudentForResult').html('');
        if ($('#cmbClassforResult').val() != '') {
            data_ = $('#cmbClassforResult').val();
            classID_ = $("#cmbClassforResult").find(":selected").text();
            url_ = site_url_ + "/exam/get_student_for_result/" + data_;

            $.ajax({
                type: "POST",
                url: url_,
                data: data_,
                success: function (data) {
                    var obj = JSON.parse(data);
                    var str_html = '';
                    if (obj.studentdata.length > 0) {
                        for (i = 0; i < obj.studentdata.length; i++) {
                            str_html = str_html + "<tr class='gradeX'>";
                            str_html = str_html + "<td><a href='" + site_url_ + "/exam/fetchResult/" + data_ + '/' + obj.studentdata[i].regid +"'><i class='icon-play' title='Generate Result'></i></a></td>";
                            str_html = str_html + "<td>" + obj.studentdata[i].regid + "</td>";
                            str_html = str_html + "<td>" + obj.studentdata[i].FNAME + "</td>";
                            if (obj.checkRemarks === '1') {
                                str_html = str_html + "<td class='tdRemarks'><input type='text' style='width:400px;background:#F7FB9F;' class='form-control marks_0_4' name='stu_remark[" + obj.studentdata[i].resultsubtotalID + "]' id='" + obj.studentdata[i].regid + "_' value='" + obj.studentdata[i].teacherRemark + "'/></td>";
                                str_html = str_html + "<td class='tdPromoted'><input type='text' style='width:100px;background:#F7FB9F;' class='form-control marks_0_4' name='stu_promoted[" + obj.studentdata[i].resultsubtotalID + "]' id='" + obj.studentdata[i].regid + "__' value='" + obj.studentdata[i].promotedClass + "'/></td>";
                            } else if (obj.checkRemarks === '2') {
                                str_html = str_html + "<td class='tdRemarks'><input type='text' style='width:400px;' class='form-control marks_0_4' name='stu_remark[" + obj.studentdata[i].regid + "]' id='" + obj.studentdata[i].regid + "_'/></td>";
                                str_html = str_html + "<td class='tdPromoted'><input type='text' style='width:100px;' class='form-control marks_0_4' name='stu_promoted[" + obj.studentdata[i].regid + "]' id='" + obj.studentdata[i].regid + "__'/></td>";
                            }
                            str_html = str_html + "</tr>";
                        }
                    }
                    if (obj.checkRemarks === '1') {
                        str_html = str_html + "<tr><td colspan='5'><input type='button' id='updateRemarks' class='btn btn-success' value='Update Student Data' style='width:400px;float:right; margin-right:80px;'></td></tr>";
                    } else if (obj.checkRemarks === '2') {
                        str_html = str_html + "<tr><td colspan='5'><input type='button' id='submitRemarks' class='btn btn-primary' value='Submit Student Data' style='width:400px;float:right; margin-right:80px;'></td></tr>";
                    }
                    $('#exitHeading').html('Student Detail of' + classID_);
                    $('#tabStudentForResult').html(str_html);
                    document.getElementById('divInfo').style.display = 'block';
                    $('#information').html("Below information <i><b>(TEACHER'S REMARK & PROMOTED TO CLASS)</b></i> will <strong>only be filled</strong> if the Result of all the terms is inserted. <br>Click <strong>View Result</strong>  to check Result");
                }
            });
        } else {
            document.getElementById('divInfo').style.display = 'none';
        }
    }
    $('body').on('click', '.btnCopyRemarks', function () {
        var data_ = $(".tdRemarks").find("input[type='text']").val();
        if (data_ !== '') {
            $(".tdRemarks").find("input[type='text']").val(data_);
        } else {
            $(".tdRemarks").find("input[type='text']").val('');
        }
    });

    $('body').on('click', '.btnCopyPromoted', function () {
        var data_ = $(".tdPromoted").find("input[type='text']").val();
        if (data_ !== '') {
            $(".tdPromoted").find("input[type='text']").val(data_);
        } else {
            $(".tdPromoted").find("input[type='text']").val('');
        }
    });

    $('body').on('click', '#submitRemarks', function () {
        classsessid = $('#cmbClassforResult').val();
        data_ = $('#frmSubmitRemarks').serializeArray();
        url_ = site_url_ + "/exam/submitRemarks/" + classsessid;

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
                    getRemarks();
                }
            }, error: function (xhr, status, error) {
                callDanger(xhr.responseText);
            }
        });
    });

    $('body').on('click', '#updateRemarks', function () {
        classsessid = $('#cmbClassforResult').val();
        data_ = $('#frmSubmitRemarks').serializeArray();
        url_ = site_url_ + "/exam/updateRemarks/" + classsessid;

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
                    getRemarks();
                }
            }, error: function (xhr, status, error) {
                callDanger(xhr.responseText);
            }
        });
    });

    $('body').on('click', '.btnseeResult', function () {
        document.getElementById('divclassData').style.display = 'none';
        document.getElementById('divmarksheetPanel').style.display = 'block';
        var classsessid = $('#cmbClassforResult').val();
        data_ = $("#cmbClassforResult option:selected").text();
        var arr_str = data_.split(' ');
        var classID = arr_str[2];
        var regid = $(this).attr('id');
        url_ = site_url_ + "/exam/fetchResult/" + classsessid + "/" + classID + "/" + regid;      
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
                }
            }, error: function (xhr, status, error) {
                callDanger(xhr.responseText);
            }
        });
    });


//----------------------------------------------------------------------------
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