$(function(){

	$(document).ajaxStart(function(){
	    $('#loading_process').css('opacity', '1');
		$('#loading_process').css('display', 'inline-block');
		$('#loading_process').html('<img src="'+base_url_+'/assets_/img/spinner.gif" /> Its Loading...');
	});

	$(document).ajaxComplete(function(){
	    $('#loading_process').css('opacity', '1');
		$('#loading_process').css('display', 'none');
		$('#loading_process').html('');	
	});

	//$("#txtStudentPhone").mask("(999) 999-9999");
	$("#txtStudentPhone").blur(function(){
		var ph = $("#txtStudentPhone").val();

		if(ph.length < 10 || ph.length > 10){
			$('#ph_error').css('background', '#ffff00');
			$('#ph_error').html('10 digits please!!')
		} else {
			$('#ph_error').css('background', 'transparent');
			$('#ph_error').html('');
		}
	});
	$( window ).on( "load", function(){
		
		$(".page-loader").fadeOut("slow");
		if($('#frmAdmission').length != 0){
			$('input[type=radio]').css('opacity', '1');
			fillStudents();
			fillClasses();
			fillStates('cmbPState');
			fillStates('cmbCState');
			fillSiblings();
			fillDiscount();
			$('#ph_error').css('background', 'transparent');
			$('#ph_error').html('');
		}
		if($('#frmAssociateStaticFee').length != 0){
			fillClasses_for_current_session();
			fill_accordion_showing_classes_associates_staticHeads();
		}
		if($('#frmAssociateFlexibleFee').length != 0){
			$('input[type=checkbox]').css('opacity', '1');
			fillFlexibleHeads_for_Associate_with_students();
			fillClasses_to_find_students();
			view_classes_to_view_students();
		}
		if($('#frmStaticFee').length != 0){
			fill_static_fee_heads();
		}
		if(('#frmPromoteStudents').length != 0){
			$('input[type=radio]').css('opacity', '1');
			$('._select').css('display', 'block');
			fillClassesforPromoteStudent('cmbAdmFor');
			fillClassesforPromoteStudent('cmbAdmittedStudents');
			$('#undo_redo').multiselect();
			$('#s2id_undo_redo ul').css('display', 'none');
		}
		if(('#frmUserManagement').length != 0){
			fillUserStatus('cmbUserStatus');
			fillexistingUsers();
		}
		if($('#frmAddAttendance').length != 0){
			fillClasses_for_attendance();
		}

		if($('#frmStudentToDrop').length != 0){
			fillStudents_to_drop();
		}

		if($('#frmDayBook').length != 0){
			fillSubheads();
		}

		if($('#frmTCCC').length != 0){
			fillStudents_cc_tc();
		}
		if($('#frmAddSessionWiseDetail').length != 0){
			fillClasses_for_sessionWiseDetail();	
		}
	});
	// Common Function to reload the current Page via http
	function reloadme(){
		location.reload(true);
	}
	// ---------------------------------------------------

	// Function definitions need to call when needed
		function fillClasses_for_sessionWiseDetail(){
			$('#s2id_cmbClassesForSessionWiseDetail span').text("Loading...");
			url_ = site_url_ + "/reg_adm/getClasses_in_session";
			$('#cmbClassesForSessionWiseDetail').empty();
			$.ajax({
				type: "POST",
				url: url_,
				success:  function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					str_html = str_html + "<option value=''>Choose Class</option>";
					for(i=0;i<obj.class_in_session.length; i++){
						str_html = str_html + "<option value='"+obj.class_in_session[i].CLSSESSID+"'>Class "+obj.class_in_session[i].CLASSID+"</option>";
					}
					$('#s2id_cmbClassesForSessionWiseDetail span').text("Choose Class");
					$('#cmbClassesForSessionWiseDetail').html(str_html);
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		}
		function fillClasses_for_attendance(){
			$('#s2id_cmbClassesForStudents span').text("Loading...");
			url_ = site_url_ + "/reg_adm/getClasses_in_session";
			$('#cmbClassesForStudents').empty();
			$.ajax({
				type: "POST",
				url: url_,
				success:  function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					str_html = str_html + "<option value=''>Choose Class</option>";
					for(i=0;i<obj.class_in_session.length; i++){
						str_html = str_html + "<option value='"+obj.class_in_session[i].CLSSESSID+"'>Class "+obj.class_in_session[i].CLASSID+"</option>";
					}
					$('#s2id_cmbClassesForStudents span').text("Choose Class");
					$('#cmbClassesForStudents').html(str_html);
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		}
		function fillStudents_in_table(){
			//student_data_here
			url_ = site_url_ + "/reg_adm/getstudents_for_dropdown";
			str = '';
			str = '<tr class="gradeX odd"><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr>';
			str = str + '<tr class="gradeX even"><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td></tr>';
			$('#student_data_here').html(str);
		}
		function fillStudents_to_drop(){
			$('#s2id_cmbRegistrationID_to_Drop span').text("Loading...");
			url_ = site_url_ + "/reg_adm/getstudents_for_dropdown_for_dropping";
			$('#cmbRegistrationID_to_Drop').empty();
			$.ajax({
				type: "POST",
				url: url_,
				success:  function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					str_html = str_html + "<option value='select'>Select Student</option>";
					for(i=0;i<obj.students_.length; i++){
						str_html = str_html + "<option value='"+obj.students_[i].regid+"'>"+obj.students_[i].regid+" | "+obj.students_[i].FNAME+"</option>";
					}
					$('#s2id_cmbRegistrationID_to_Drop span').text("Select Student");
					$('#cmbRegistrationID_to_Drop').html(str_html);
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		}
		function fillStudents(){
			$('#s2id_cmbRegistrationID span').text("Loading...");
			url_ = site_url_ + "/reg_adm/getstudents_for_dropdown";
			$('#cmbRegistrationID').empty();
			$.ajax({
				type: "POST",
				url: url_,
				success:  function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					str_html = str_html + "<option value='new'>New | New Student</option>";
					for(i=0;i<obj.students_.length; i++){
						str_html = str_html + "<option value='"+obj.students_[i].regid+"'>"+obj.students_[i].regid+" | "+obj.students_[i].FNAME+"</option>";
					}
					$('#s2id_cmbRegistrationID span').text("New | New Student");
					$('#cmbRegistrationID').html(str_html);
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		}
		function fillStudents_cc_tc(){
			$('#s2id_cmbRegistrationID_for_tccc span').text("Loading...");
			url_ = site_url_ + "/reg_adm/getstudents_for_dropdown";
			$('#cmbRegistrationID_for_tccc').empty();
			$.ajax({
				type: "POST",
				url: url_,
				success:  function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					str_html = str_html + "<option value='x'>Select Student</option>";
					for(i=0;i<obj.students_.length; i++){
						str_html = str_html + "<option value='"+obj.students_[i].regid+"'>"+obj.students_[i].regid+" | "+obj.students_[i].FNAME+"</option>";
					}
					$('#s2id_cmbRegistrationID_for_tccc span').text("Select Sstudent");
					$('#cmbRegistrationID_for_tccc').html(str_html);
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		}
		function fillSiblings(){
			$('#s2id_cmbSiblingRegistrationID span').text("Loading...");
			url_ = site_url_ + "/reg_adm/get_admitted_students";
			//$('#cmbRegistrationID').empty();
			$.ajax({
				type: "POST",
				url: url_,
				success:  function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					str_html = str_html + "<option value='x'>Select Sibling</option>";
					for(i=0;i<obj.students_.length; i++){
						str_html = str_html + "<option value='"+obj.students_[i].regid+"'>"+obj.students_[i].regid+" | "+obj.students_[i].FNAME+"</option>";
					}
					$('#s2id_cmbSiblingRegistrationID span').text("Select Sibling");
					$('#cmbSiblingRegistrationID').html(str_html);
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		}
		function fillDiscount(){
			$('#s2id_cmbDiscount_if_any span').text("Loading...");
			url_ = site_url_ + "/reg_adm/getDiscount";
			$('#show')
			$.ajax({
				type: "POST",
				url: url_,
				success:  function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					str_html = str_html + "<option value='Select Discount'>No-Discount</option>";
					for(i=0;i<obj.discounts_.length; i++){
						str_html = str_html + "<option value='"+obj.discounts_[i].ITEM_+"'>"+obj.discounts_[i].ITEM_+"</option>";
					}
					$('#s2id_cmbDiscount_if_any span').text("Select Discount");
					$('#cmbDiscount_if_any').html(str_html);
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		}
		function fillClasses(){
			$('#s2id_cmbClassofAdmission span').text("Loading...");
			url_ = site_url_ + "/reg_adm/getClasses_in_session";
			$('#cmbClassofAdmission').empty();
			$.ajax({
				type: "POST",
				url: url_,
				success:  function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					str_html = str_html + "<option value=''>Choose Class</option>";
					for(i=0;i<obj.class_in_session.length; i++){
						str_html = str_html + "<option value='"+obj.class_in_session[i].CLSSESSID+"'>Class "+obj.class_in_session[i].CLASSID+"</option>";
					}
					$('#s2id_cmbClassofAdmission span').text("Choose Class");
					$('#cmbClassofAdmission').html(str_html);
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		}
		function fillStates(selector){
			$('#s2id_'+selector+' span').text("Loading...");
			url_ = site_url_ + "/reg_adm/getState";
			$('#'+selector).empty();
			$.ajax({
				type: "POST",
				url: url_,
				success:  function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					for(i=0;i<obj.state.length; i++){
						if(obj.state[i].NAME_ == 'UTTARAKHAND'){
							str_html = str_html + "<option value='"+obj.state[i].NAME_+"' selected='selected'>"+obj.state[i].NAME_+"</option>";
						} else {
							str_html = str_html + "<option value='"+obj.state[i].NAME_+"'>"+obj.state[i].NAME_+"</option>";
						}
					}
					$('#s2id_'+selector+' span').text("UTTARAKHAND");
					$('#'+selector).html(str_html);
				}, error: function(xhr, status, error){
						callDanger(xhr.responseText);
					}
			});
		}	
		function reset_admission_form(){
			// Resetting whole Form
				$('#reset_me').click();
				$('#uniform-optStuMale span').removeClass('checked');
				$('#uniform-optStuFemale span').removeClass('checked');
				$('#student_photo_here').html('<img src='+base_url_+'assets_/'+_img_folder_+'/student_photo/no-image.jpg'+' />');
				$('.filename').text("No file selected");
				$('#show_siblings').html('');
				$('#show_discount').html('');
				$('#cmbClassofAdmission').removeAttr('disabled', 'disabled');
				$('#s2id_cmbClassofAdmission').removeClass('disabledbutton');
				$('#txtAdmitStatus').val('new');
				fillStudents();
				fillClasses();
				fillStates('cmbPState');
				fillStates('cmbCState');
				fillSiblings();
				fillDiscount();
				reset_discount_form();
			// --------------------
		}
		function fillClassesforPromoteStudent(objstr){
			url_ = site_url_ + "/reg_adm/getClasses_in_session";
			$('#'+objstr).empty();
			$.ajax({
				type: "POST",
				url: url_,
				success:  function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					str_html = str_html + "<option value=''>Choose Class</option>";
					for(i=0;i<obj.class_in_session.length; i++){
						str_html = str_html + "<option value='"+obj.class_in_session[i].CLSSESSID+"'>Class "+obj.class_in_session[i].CLASSID+"</option>";
					}
					$('#s2id_'+objstr+' span').text("Choose Class");
					$('#'+objstr).html(str_html);
				}, error: function(xhr, status, error){
						callDanger(xhr.responseText);
				}
			});
		}
		function fillexistingUsers(){
			url_ = site_url_ + "/userManagement/getUsers";
			$.ajax({
				type: "POST",
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					if(obj.length != 0){
						var str_html = '';
						for(i=0; i<obj.length; i++){
							str_html = str_html + "<tr>";
							str_html = str_html + "<td>"+obj[i].USERNAME_+"</td>";
							str_html = str_html + "<td>"+obj[i].name+"</td>";
							str_html = str_html + "<td>"+obj[i].STATUS+"</td>";
							if(obj[i].ACTIVE == 1){
								str_html = str_html + "<td style='text-align: center; font-size: 15px;'><div style='color: #009000' id='action_user_"+obj[i].USERNAME_+"'><span class='icon-thumbs-up active-deactive-user' id='activedeactive_"+0+"_"+obj[i].USERNAME_+"'></span> | <span class='icon-pencil edituser' id='edit_"+obj[i].USERNAME_+"'></span></div></td>";
							} else {
								str_html = str_html + "<td style='text-align: center; font-size: 15px;'><div style='color: #ff0000' id='action_user_"+obj[i].USERNAME_+"'><span class='icon-thumbs-down active-deactive-user' id='activedeactive_"+1+"_"+obj[i].USERNAME_+"'></span> | <span class='icon-pencil edituser' id='edit_"+obj[i].USERNAME_+"'></span></div></td>";
							}
						}
						$('#view_users_in_createUserMgnt').html(str_html);
					} else {

					}
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		}
		function fillUserStatus(objstr){
			url_ = site_url_ + "/userManagement/getuserstatus";
			$('#'+objstr).empty();
			$.ajax({
				type: "POST",
				url: url_,
				success:  function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					str_html = str_html + "<option value=''>Select User Status</option>";
					for(i=0;i<obj.userstatus.length; i++){
						str_html = str_html + "<option value='"+obj.userstatus[i].ST_ID+"'>"+obj.userstatus[i].STATUS+"</option>";
					}
					$('#s2id_'+objstr+' span').text("Select User Status");
					$('#'+objstr).html(str_html);
				}, error: function(xhr, status, error){
						callDanger(xhr.responseText);
				}
			});
		}
		function reset_createUserForm(){
			$('#resetCreateUser').click();
		}
		$('#resetCreateUser').click(function(){
			$('.create-update-user-form div').removeClass('update_color');
			$('#create_update_user').val('Create');
			$('#create_update_user').removeClass('btn-danger');
			$('#create_update_user').addClass('btn-success');
			$('#txtUser_').removeAttr('disabled');
			$('#txtUser_').css('opacity', '1');
			fillUserStatus('cmbUserStatus');
			$("#cmbStaff").empty();
			$("#s2id_cmbStaff span").text('Select Member');
		});
		$('#reload_me').click(function(){
			$('#reload_or_not').val('yes');
			if($('#reload_or_not').val() == 'yes'){
				reloadme();
			}
		});
		$('#cmbRegistrationID_to_Drop').change(function(){
			if($('#cmbRegistrationID_to_Drop').val() != 'select'){
			var regid_ = $('#cmbRegistrationID_to_Drop').val();
				url_ = site_url_ + "/DropStudent/get_admision_detail/"+regid_;
				$('#student_to_drop_detail').html('');
				$('#student_to_drop_address').html('');
				$.ajax({
					type: 'post',
					url: url_,
					success: function(data){
						var obj = JSON.parse(data);
						var dttime = obj.personal_academics.DOA;
						var dttime = dttime.split(' ');
						var dt = dttime[0].split('/');
						$('#show_class_for_drop').html('Class ' + obj.personal_academics.CLASSID);
						$('#show_DOA').html(dt[1]+"/"+dt[0]+"/"+dt[2]);
						$('#student_photo_here').html('<img src='+base_url_+'/assets_/'+_img_folder_+'/student_photo/'+obj.personal_academics.PHOTO_+' />');
						var str_html = '<table class="table table-bordered">';
						str_html = str_html + '<tr>';
						str_html = str_html + '<th style="text-align: left;color: #0000ff">Reg. No. </th><th style="text-align: left;color: #0000ff">'+regid_+'</th>';
						str_html = str_html + '</tr>';
						str_html = str_html + '<tr>';
						str_html = str_html + '<td><b>Name</b> </td><td>'+obj.personal_academics.FNAME+'</td>';
						str_html = str_html + '</tr>';
						if(obj.personal_academics.GENDER == 'M' || obj.personal_academics.GENDER == 'Male'){
							str_html = str_html + '<tr>';
							str_html = str_html + '<td><b>Gender</b> </td><td>Male</td>';
							str_html = str_html + '</tr>';
						} else {
							str_html = str_html + '<tr>';
							str_html = str_html + '<td><b>Gender</b> </td><td>Female</td>';
							str_html = str_html + '</tr>';
						}
						str_html = str_html + '<tr>';
						str_html = str_html + '<td><b>Father</b> </td><td> '+obj.personal_academics.FATHER+'<br><u>Mob.</u>: '+obj.personal_academics.F_MOBILE+'</td>';
						str_html = str_html + '</tr>';
						str_html = str_html + '<tr>';
						str_html = str_html + '<td><b>Mother</b> </td><td> '+obj.personal_academics.MOTHER+'<br><u>Mob.</u>: '+obj.personal_academics.M_MOBILE+'</td>';
						str_html = str_html + '</tr>';
						str_html = str_html + '</table>';
						str_html = str_html + '<table class="table table-bordered">';
						str_html = str_html + '<tr>';
						str_html = str_html + '<th style="text-align: left">Contact</th>';
						str_html = str_html + '</tr>';
						str_html = str_html + '<tr>';
						str_html = str_html + '<td style="color: #0000ff; font-weight: bold">';
						str_html = str_html + obj.personal_academics.MOBILE_S;
						str_html = str_html + '</td>';
						str_html = str_html + '</tr>';
						str_html = str_html + '</table>';
						$('#student_to_drop_detail').html(str_html);

						str_html = '<table class="table table-bordered">';
						str_html = str_html + '<tr>';
						str_html = str_html + '<th style="text-align: left">Permanent</th>';
						str_html = str_html + '</tr>';
						str_html = str_html + '<tr>';
						str_html = str_html + '<td>';
						str_html = str_html + obj.address_permanent.STREET_1+',<br>';
						str_html = str_html + obj.address_permanent.CITY_+' - '+obj.address_permanent.PIN_+',<br>';
						str_html = str_html + obj.address_permanent.DISTT_+',<br>';
						str_html = str_html + obj.address_permanent.STATE_+' ('+obj.address_permanent.COUNTRY_+')';
						str_html = str_html + '</td>';
						str_html = str_html + '</tr>';
						str_html = str_html + '</table>';

						str_html = str_html + '<table class="table table-bordered">';
						str_html = str_html + '<tr>';
						str_html = str_html + '<th style="text-align: left">Correspondance</th>';
						str_html = str_html + '</tr>';
						str_html = str_html + '<tr>';
						str_html = str_html + '<td>';
						str_html = str_html + obj.address_correspondance.STREET_1+',<br>';
						str_html = str_html + obj.address_correspondance.CITY_+' - '+obj.address_correspondance.PIN_+',<br>';
						str_html = str_html + obj.address_correspondance.DISTT_+',<br>';
						str_html = str_html + obj.address_correspondance.STATE_+' ('+obj.address_correspondance.COUNTRY_+')';
						str_html = str_html + '</td>';
						str_html = str_html + '</tr>';
						str_html = str_html + '</table>';
						$('#student_to_drop_address').html(str_html);

						if(obj.personal_academics.STATUS_ == 1){
							$('#txtReasonToDrop').val('');
							$('#drop_button').removeAttr('disabled');
							$('#drop_button').val('Drop Student');
							$('#drop_button').removeClass('btn-default')
							$('#drop_button').addClass('btn-danger');
							$('#txtReasonToDrop').focus();
						} else {
							$('#txtReasonToDrop').val(obj.dropped.record.REASON);
							$('#drop_button').removeClass('btn-danger')
							$('#drop_button').addClass('btn-default');
							$('#drop_button').attr('disabled', 'disabled');
							$('#drop_button').val('Already Dropped');
						}
						
					}, error: function(xhr, status, error){
						callDanger(xhr.responseText);
					}
				});
			} else {
				$('#txtReasonToDrop').val('');
				$('#show_class_for_drop').html('');
				$('#show_DOA').html('');
				$('#student_photo_here').html('');
				$('#student_to_drop_detail').html('');
				$('#student_to_drop_address').html('');
			}
		});
		$('body').on('click', '#drop_button', function(){
			if($.trim($('#txtReasonToDrop').val())==''){
				alert('please fill the reason first.');
			} else {
				var data_ = $('#frmStudentToDrop').serialize();
				var url_ = site_url_ + '/DropStudent/dropstudent';
				$.ajax({
					type: "POST",
					url: url_,
					data: data_,
					success: function(data){
						var obj = JSON.parse(data);
						if(obj.res_ == true){
							callSuccess(obj.msg_);
						} else {
							callDanger(obj.msg_);
						}
						fillStudents_to_drop();
						$('#txtReasonToDrop').val('');
						$('#show_class_for_drop').html('');
						$('#show_DOA').html('');
						$('#student_photo_here').html('');
						$('#student_to_drop_detail').html('');
						$('#student_to_drop_address').html('');
					}
				});
			}
		});
		$('#cmbRegistrationID').change(function(){
			if($('#cmbRegistrationID').val() == 'new'){
				reset_admission_form();
			} else {
				reset_other_tc_form();
				var regid_ = $('#cmbRegistrationID').val();
				url_ = site_url_ + "/reg_adm/get_admision_detail/"+regid_;
				$.ajax({
					type: 'post',
					url: url_,
					success: function(data){
						var obj = JSON.parse(data);
						// Filling Personal & Academics Detail
						if(jQuery.isEmptyObject(obj.personal_academics) == false){
							$('#student_photo_here').html('<img src='+base_url_+'/assets_/'+_img_folder_+'/student_photo/'+obj.personal_academics.PHOTO_+' />');
							if(obj.curr_sess_admission == 'current'){
								$('#cmbClassofAdmission').removeAttr('disabled', 'disabled');
								$('#s2id_cmbClassofAdmission').removeClass('disabledbutton');
								//$('#s2id_cmbClassofAdmission span').text("Class "+obj.personal_academics.CLASSID);
								$('#cmbClassofAdmission').val(obj.personal_academics.CLASS_OF_ADMISSION);
							} else {
								$('#s2id_cmbClassofAdmission span').text("Class "+obj.personal_academics.CLASSID+" (Admitted in "+obj.personal_academics.SESSID+")");
								$('#cmbClassofAdmission').attr('disabled', 'disabled');
								$('#s2id_cmbClassofAdmission').addClass('disabledbutton');
							}
							$('#txtAdmitStatus').val(obj.curr_sess_admission);
							if(obj.personal_academics.DOA != ''){
								$('#txtDOA').val(obj.personal_academics.DOA);
							}
							$('#txtFullName').val(obj.personal_academics.FNAME);
							if(obj.personal_academics.DOB_ != ''){
								$('#txtStudDOB').val(obj.personal_academics.DOB_);
							}
							if(obj.personal_academics.GENDER != ''){
								//$('#uniform-optStuMale').removeClass('focus');
								//$('#uniform-optStuFemale').removeClass('focus');
								if(obj.personal_academics.GENDER == 'Male' || obj.personal_academics.GENDER == 'M'){
									$('#optStuMale').prop('checked', true);
									$('#uniform-optStuMale').addClass('focus');
								} else if (obj.personal_academics.GENDER == 'Female' || obj.personal_academics.GENDER == 'F') {
									$('#optStuFemale').prop('checked', true);
									$('#uniform-optStuFemale').addClass('focus');
								}
							}
							$('#txtStudentAdhaarCardNo').val(obj.personal_academics.ADHAARCARD_STUDENT);
							$('#txtAdmNumber').val(obj.personal_academics.ADM_NO);
							// Filling Parents Detail
							$('#txtFatherName').val(obj.personal_academics.FATHER);
							$('#txtFatherMobile').val(obj.personal_academics.F_MOBILE);
							$('#txtFatherEmail').val(obj.personal_academics.F_EMAIL);
							$('#txtFatherProfession').val(obj.personal_academics.F_PROFESSION);
							$('#txtMotherName').val(obj.personal_academics.MOTHER);
							$('#txtMotherMobile').val(obj.personal_academics.M_MOBILE);
							$('#txtMotherEmail').val(obj.personal_academics.M_EMAIL);
							$('#txtMotherProfession').val(obj.personal_academics.M_PROFESSION);
						}
						// Filling Address Detail
						if(jQuery.isEmptyObject(obj.address_permanent) == false){
							$('#txtPAddress').val(obj.address_permanent.STREET_1);
							$('#txtPCity').val(obj.address_permanent.CITY_);
							$('#txtPDistt').val(obj.address_permanent.PIN_);
							$('#txtPPinCode').val(obj.address_permanent.DISTT_);
							$('#cmbPState').val(obj.address_permanent.STATE_);
							$('#s2id_cmbPState span').text(obj.address_permanent.STATE_);
							$('#txtPCountry').val(obj.address_permanent.COUNTRY_);
						}

						if(jQuery.isEmptyObject(obj.address_correspondance) == false){
							$('#txtCAddress').val(obj.address_correspondance.STREET_1);
							$('#txtCCity').val(obj.address_correspondance.CITY_);
							$('#txtCDistt').val(obj.address_correspondance.DISTT_);
							$('#txtCPinCode').val(obj.address_correspondance.PIN_);
							$('#cmbCState').val(obj.address_correspondance.STATE_);
							$('#s2id_cmbCState span').text(obj.address_correspondance.STATE_);
							$('#txtCCountry').val(obj.address_correspondance.COUNTRY_);
						}
						if(jQuery.isEmptyObject(obj.contact) == false){
							$('#txtStudentPhone').val(obj.contact.MOBILE_S);
							$('#txtEmail').val(obj.contact.EMAIL_S);
						}
						$('#show_siblings').html('');
						$('#txtSiblings').val('');
						if(jQuery.isEmptyObject(obj.siblings) == false){
							$('#txtSiblings').val(obj.siblings.SIBLINGS);
							var x_ = $('#txtSiblings').val();
							var arrSibling = x_.split(',');
							$('#show_siblings').html('');
							for(i=0;i<arrSibling.length;i++){
								if($.trim(arrSibling[i]) != ''){
									$('#show_siblings').html($('#show_siblings').html()+design_cover_for_sibling_representation(arrSibling[i]));
								}
							}
						}
						$('#show_discount').html('');
						$('#txtDiscounts').val('');
						if(jQuery.isEmptyObject(obj.discounts) == false){
							$('#txtDiscounts').val(obj.discounts.DISCOUNT);
							var x_ = $('#txtDiscounts').val();
							var arrDiscount = x_.split(',');
							$('#show_discount').html('');
							for(i=0;i<arrDiscount.length;i++){
								if($.trim(arrDiscount[i]) != ''){
									$('#show_discount').html($('#show_discount').html()+design_cover_for_discount_representation(arrDiscount[i], regid_));
								}
							}
						}
						if(jQuery.isEmptyObject(obj.personal_academics) == false){
							$('#cmbCategory').val(obj.personal_academics.CATEGORY);
							$('#s2id_cmbCategory span').text(obj.personal_academics.CATEGORY);
						}
						if(jQuery.isEmptyObject(obj.personal_detail) == false){
							$('#txtSchoolNo').val(obj.personal_detail.SCHOOL_NO);
							$('#txtBookNo').val(obj.personal_detail.BOOK_NO);
							$('#txtSNo').val(obj.personal_detail.SNO);
							$('#txtApplicationNo').val(obj.personal_detail.APPLICATION_NO);
							$('#txtRenewedUpto').val(obj.personal_detail.RENEWED_UPTO);

							$('#cmbSchoolStatus').val(obj.personal_detail.SCHOOL_STATUS);
							$('#s2id_cmbSchoolStatus span').text(obj.personal_detail.SCHOOL_STATUS);

							$('#txtRgNo').val(obj.personal_detail.REGNO_OF_CANDIDATE);
							$('#txtNationality').val(obj.personal_detail.NATIONALITY);
							$('#txtNationality').val(obj.personal_detail.NATIONALITY);
							$('#txtSubjectOffered').val(obj.personal_detail.SUBJECT_OFFERED);

							if(obj.personal_detail.STUDENT_FAILED == 'YES'){
								$('#optFailedYes').prop('checked', true);
								$('#uniform-optFailedYes').addClass('focus');
							} else if (obj.personal_detail.STUDENT_FAILED == 'NO') {
								$('#optFailedNo').prop('checked', true);
								$('#uniform-optFailedNo').addClass('focus');
							}

							if(obj.personal_detail.ANY_CONCESSION == 'YES'){
								$('#optConcessionYes').prop('checked', true);
								$('#uniform-optConcessionYes').addClass('focus');
							} else if (obj.personal_detail.ANY_CONCESSION == 'NO') {
								$('#optConcessionNo').prop('checked', true);
								$('#uniform-optConcessionNo').addClass('focus');
							}

							if(obj.personal_detail.NCC_SCOUT_GUIDE == 'NCC'){
								$('#optNCC').prop('checked', true);
								$('#uniform-optNCC').addClass('focus');
							} else if (obj.personal_detail.NCC_SCOUT_GUIDE == 'SCOUT') {
								$('#optSCOUT').prop('checked', true);
								$('#uniform-optSCOUT').addClass('focus');
							} else if (obj.personal_detail.NCC_SCOUT_GUIDE == 'GUIDE') {
								$('#optGUIDE').prop('checked', true);
								$('#uniform-optGUIDE').addClass('focus');
							} else {
								$('#optNA').prop('checked', true);
								$('#uniform-optNA').addClass('focus');
							}
						}
						if(jQuery.isEmptyObject(obj.tc_status) == false){
							
							if(obj.tc_status.DUES_PAID == 'YES'){
								$('#optDuesPaidYes').prop('checked', true);
								$('#uniform-optDuesPaidYes').addClass('focus');
							} else if (obj.tc_status.DUES_PAID == 'NO') {
								$('#optDuesPaidNo').prop('checked', true);
								$('#uniform-optDuesPaidNo').addClass('focus');
							}

							$('#txtDateOfCuttingName').val(obj.tc_status.DATE_OF_CUTTING_NAME);
							$('#txtReasonForLeavingSchool').val(obj.tc_status.REASON_OF_LEAVING_SCHOOL);
							$('#txtMeetingsUptoDate').val(obj.tc_status.NO_OF_MEETING_UPTODATE);
							$('#txtSchoolDaysAttended').val(obj.tc_status.SCHOOL_DAYS_ATTENDED);
							
							$('#cmbGeneralConduct').val(obj.tc_status.GENERAL_CONDUCT_OF_STUDENT);
							$('#s2id_cmbGeneralConduct span').text(obj.tc_status.GENERAL_CONDUCT_OF_STUDENT);

							$('#cmbLastStudiedClass').val(obj.tc_status.LAST_STUDIED_CLASS);
							$('#select2-cmbLastStudiedClass-container span').html(obj.tc_status.LAST_STUDIED_CLASS);
							
							$('#txtSchoolOrBoard').val(obj.tc_status.SCHOOL_OR_BOARD);

							if(obj.tc_status.PROMOTED == 'YES'){
								$('#optPromotedYes').prop('checked', true);
								$('#uniform-optPromotedYes').addClass('focus');
							} else if (obj.tc_status.PROMOTED == 'NO') {
								$('#optPromotedNo').prop('checked', true);
								$('#uniform-optPromotedNo').addClass('focus');
							}

							$('#txtRemarks').val(obj.tc_status.REMARKS_IF_ANY);
							$('#txtTcIssueDate').val(obj.tc_status.DATE_OF_ISSUE);
						}
					}, error: function(xhr, status, error){
						callDanger(xhr.responseText);
					}
				});
			}
		});
		$('.reset_button_template').click(function(){
			reset_admission_form();
		});
		$('.submit_or_update_admission').click(function(e){
			e.preventDefault();
			if($('#cmbClassofAdmission').val() == '' && ($('#txtAdmitStatus').val() == 'new' || $('#txtAdmitStatus').val() == 'current') ){
				callDanger("Please select Class of Admission !!");
			} else if($('#txtFullName').val() == '') {
				callDanger("Please fill student Name !!");
			} else if($("#optStuMale").prop("checked")==false && $("#optStuFemale").prop("checked") == false){
				callDanger("Please select gender. !!");
			} else {
				if($.trim($('#txtStudentAdhaarCardNo').val()) == ''){
					$('#txtStudentAdhaarCardNo').val('x');
				}
				data_ = new FormData($('#frmAdmission')[0]);
				url_ = site_url_ + "/reg_adm/update_Admission";
				$.ajax({
					type: 'POST',
					url: url_,
					data: data_,
					async: false,
			        cache: false,
			        contentType: false,
			        processData: false,
					success: function(data){
						var obj = JSON.parse(data);
						reset_admission_form();
						if(obj.res_ == true){
							callSuccess(obj.msg_);
						} else{
							callDanger(obj.msg_);
						}
					}, error: function(xhr, status, error){
						callDanger(xhr.responseText);
					}
				});
			}
		});
		// Sibling & Discount Module Code
		function design_cover_for_sibling_representation(current_selection){
			var temp = "<div style='float: left; padding: 2px' id='_"+current_selection+"_id'><div style='float: left; padding: 2px; background: #ffffff; color: #000000; border:#808080 solid 1px; border-radius: 5px; font-size: 10px'>"+current_selection+"&nbsp;<span id='"+current_selection+"_id' class='deleteme_as_sibling icon-trash' style='color: #ff0000; font-size:11px;z-index:99'></span></div></div>";
			return temp;
		}

		function design_cover_for_discount_representation(current_selection, regid_){
			var temp = "<div style='float: left; padding: 2px' id='_"+regid_+"_"+current_selection+"_DISCOUNT_id'><div style='float: left; padding: 2px; background: #ffffff; color: #000000; border:#808080 solid 1px; border-radius: 5px; font-size: 10px'>"+current_selection+"&nbsp;<span  id='"+regid_+"_"+current_selection+"_DISCOUNT_id' class='deleteme_as_discount icon-trash' style='color: #ff0000; font-size:11px;z-index:99'></span></div></div>";
			return temp;
		}
		$('#cmbSiblingRegistrationID').change(function(){
			if($('#cmbSiblingRegistrationID').val()!='x'){
				var current_selection = $('#cmbSiblingRegistrationID').val();
				var current_selection_ = design_cover_for_sibling_representation(current_selection);
				if($('#txtSiblings').val() != ''){
					var str = $('#txtSiblings').val();
    				if(str.indexOf(current_selection) == -1){
    					$('#txtSiblings').val($('#txtSiblings').val() + "," + current_selection);
    					$('#show_siblings').html($('#show_siblings').html()+current_selection_);
    				}
				} else {
					$('#txtSiblings').val(current_selection);
					$('#show_siblings').html(current_selection_);
				}
			}
		});

		$('#cmbDiscount_if_any').change(function(){
			if($('#cmbDiscount_if_any').val()!='x'){
				var current_selection = $('#cmbDiscount_if_any').val();
				var current_selection_ = design_cover_for_discount_representation(current_selection, $('#cmbRegistrationID').val());
				if($('#txtDiscounts').val() != ''){
					var str = $('#txtDiscounts').val();
    				if(str.indexOf(current_selection) == -1){
    					$('#txtDiscounts').val($('#txtDiscounts').val() + "," + current_selection);
    					$('#show_discount').html($('#show_discount').html()+current_selection_);
    				}
				} else {
					$('#txtDiscounts').val(current_selection);
					$('#show_discount').html(current_selection_);
				}
			}
		});

		$('body').on('click', '.deleteme_as_discount', function(){
			var arrDiscount = [];
			var temp = this.id;
			var arr = temp.split('_');
			var id_ = $.trim(arr[1]);
			var x_ = $('#txtDiscounts').val();
			var arrDiscount = x_.split(',');

			arrDiscount.splice($.inArray(id_, arrDiscount),1);
			
			$('#txtDiscounts').val(arrDiscount);
			$('#_'+temp).css('display','none');
		});

		$('body').on('click', '.deleteme_as_sibling', function(){
			var arrSibling = [];
			var temp = this.id;
			var arr = temp.split('_');
			var id_ = $.trim(arr[0]);
			
			var x_ = $('#txtSiblings').val();
			var arrSibling = x_.split(',');

			arrSibling.splice($.inArray(id_, arrSibling),1);

			$('#txtSiblings').val(arrSibling);
			$('#_'+temp).css('display','none');
		});

		// -----------------------
	// ----------------------------------------
	// Master Discount ------------------------
		$('#cmbCategory').change(function(){
			if($('#cmbCategory').val() == 'SIBLINGS'){
				$('#txtItem').val($('#cmbCategory').val());
				$('#txtItem').attr('disabled', 'disabled');
				$('#sibling_count').css('display', 'block');
				$('#cmbSiblingCountForDiscount').focus();
			} else {
				$('#sibling_count').css('display', 'none');
				$('#txtItem').removeAttr('disabled');
				if($('#txtItem').val() == 'SIBLINGS' || $('#txtItem').val() == 'SIBLING'){
					$('#txtItem').val('');
				}
				$('#txtItem').focus();
			}
		});

		function fill_discounts(){
			url_ = site_url_ + "/discount/get_discounts";
			$.ajax({
				type: 'POST',
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					for(i=0; i<obj.discounts.length; i++){
						str_html = str_html + '<tr>';
						str_html = str_html + '<td style="text-align: left" class="taskDesc"><i class="icon-info-sign"></i> ';
						str_html = str_html + obj.discounts[i].ITEM_;
						str_html = str_html + '</td>';
						str_html = str_html + '<td style="text-align: left" class="taskDesc">';
						str_html = str_html + obj.discounts[i].STATUS_;
						str_html = str_html + '<td style="text-align: left" class="taskDesc">';
						str_html = str_html + obj.discounts[i].CATEGORY;
						str_html = str_html + '</td>';
						str_html = str_html + '<td style="text-align: left" class="taskDesc">';
						str_html = str_html + obj.discounts[i].AMOUNT;
						str_html = str_html + '</td>';
						str_html = str_html + '<td style="text-align: left" class="taskDesc">';
						str_html = str_html + obj.discounts[i].DESC_;
						str_html = str_html + '</td>';
						str_html = str_html + '<td class="taskDesc">';
						str_html = str_html + '<a href="#" class="tip ModifyDiscount" id="Edit~'+ obj.discounts[i].DID + '"><i class="icon-pencil"></i></a> | ';
						str_html = str_html + '<a href="#" class="tip ModifyDiscount" id="Delete~'+ obj.discounts[i].DID + '"><i class="icon-remove"></i></a>';
						str_html = str_html + '</td>';
						str_html = str_html + '</tr>'
					}
					$('#static_fee_heads_here').html(str_html);
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		}
		$('#update_master_Discount').click(function(){
			if($.trim($('#txtItem').val()) == ''){
				callDanger("Please fill the name of discounted item !!");
			} else if($('#cmbSiblingCountForDiscount').val() == '') {
				callDanger("Please fill sibling number !!");
			} else if($('#cmdStatus').val() == 'x'){
				callDanger("Please select the status of discounted category !!");
			} else if($.trim($('#txtAmount').val()) == '') {
				callDanger("Please select the status of discounted category !!");
			} else {
				$('#txtItem').removeAttr('disabled');
				var data_ = $('#frmDiscounts').serialize();
				var url_ = site_url_ + "/discount/submit_discount";
				$.ajax({
					type: 'POST',
					url: url_,
					data: data_,
					success:  function(data){
						$('#discount_head').html('Add Discount');
						$('#discount_head').removeClass('edit_color_head');
						$('#txtItem').removeClass('edit_color_content');
						$('#txtItem').val();
						$('#s2id_cmdStatus span').removeClass('edit_color_content');
						$('#txtAmount').removeClass('edit_color_content');
						$('#txtDesc').removeClass('edit_color_content');
						$('#sibling_count').css('display', 'none');
						$('#s2id_cmbSiblingCountForDiscount span').text('Select Number');
						var obj = JSON.parse(data);
						if(obj.res_ == true){
							callSuccess(obj.msg_);
							$('#reset_discount').click();
							fill_discounts();
							if($('#txtBool').val() == 'new'){
								$('#txtItem').focus();
							}
						} else {
							callDanger(obj.msg_);	
							$('#txtItem').focus();
						}
					}, error: function(xhr, status, error){
						callDanger(xhr.responseText);
					} 
				});
			}
		});

		$('body').on('click', '.ModifyDiscount', function(){
			var temp = this.id;
			var xarr = temp.split('~');
			var data_ = "did="+xarr[1];
			if(xarr[0] == 'Edit'){
				var url_ = site_url_ + "/discount/get_specific_discount";
				$.ajax({
					type: 'POST',
					url: url_,
					data: data_,
					success: function(data){
						$('#discount_head').html('Update Discount');
						$('#discount_head').addClass('edit_color_head');
						$('#txtItem').addClass('edit_color_content');
						$('#s2id_cmdStatus span').addClass('edit_color_content');
						$('#s2id_cmdCategory span').addClass('edit_color_content');
						$('#txtAmount').addClass('edit_color_content');
						$('#txtDesc').addClass('edit_color_content');
						$('#update_master_Discount').val('Update');
						$('#update_master_Discount').removeClass('btn-success');
						$('#update_master_Discount').addClass('btn-primary');

						var obj = JSON.parse(data);
						$('#txtBool').val('edit');
						$('#txtDiscountID').val(obj.DID);
						$('#txtItem').val(obj.ITEM_);

						$('#cmdStatus').val(obj.STATUS_);
						$('#s2id_cmdStatus span').text(obj.STATUS_);
						$('#cmbCategory').val(obj.CATEGORY);
						$('#s2id_cmbCategory span').text(obj.CATEGORY);
						if(obj.CATEGORY == 'SIBLINGS'){
							$('#sibling_count').css('display', 'block');
							$('#cmbSiblingCountForDiscount').val(obj.ELIGIBLE_COUNT);
							$('#s2id_cmbSiblingCountForDiscount span').text(obj.ELIGIBLE_COUNT);
						}
						$('#txtAmount').val(obj.AMOUNT);
						$('#txtDesc').val(obj.DESC_);
						$('#txtItem').focus();
					}, error: function(xhr, status, error){
						callDanger(xhr.responseText);
					} 
				});
			} else if(xarr[0] == 'Delete'){
				if(confirm("Do you really want to delete this item?") == true){
					var url_ = site_url_ + "/discount/deleted_specific_discount";
					$.ajax({
						type: 'POST',
						url: url_,
						data: data_,
						success: function(data){
							fill_discounts();
							callSuccess("Discounted Item Successfully deleted.");
						}, error: function(xhr, status, error){
							callDanger(xhr.responseText);
						} 
					});
				}
			}
		});
		$('#reset_discount').click(function(){
			reset_discount_form();
		});
		function reset_discount_form(){
			$('#discount_head').html('Add Discount');
			$('#discount_head').removeClass('edit_color_head');
			$('#txtItem').removeClass('edit_color_content');
			$('#cmdStatus').val('x');
			$('#s2id_cmdStatus span').removeClass('edit_color_content');
			$('#s2id_cmdStatus span').text('Select Status');
			$('#cmbCategory').val('GENERAL');
			$('#s2id_cmbCategory span').removeClass('edit_color_content');
			$('#s2id_cmbCategory span').text('GENERAL');
			$('#txtAmount').removeClass('edit_color_content');
			$('#txtDesc').removeClass('edit_color_content');
			$('#update_master_Discount').val('Add');
			$('#update_master_Discount').removeClass('btn-primary');
			$('#update_master_Discount').addClass('btn-success');
		}
		function reset_other_tc_form(){
			$('#txtSchoolNo').val('');
			$('#txtBookNo').val('');
			$('#txtSNo').val('');
			$('#txtApplicationNo').val('');
			$('#txtRenewedUpto').val('');

			$('#cmbSchoolStatus').val('');
			$('#s2id_cmbSchoolStatus span').text('');

			$('#txtRgNo').val('');
			$('#txtNationality').val('');
			$('#txtNationality').val('');
			$('#txtSubjectOffered').val('');
			
			$('#optFailedNo').prop('checked', true);
			$('#optConcessionNo').prop('checked', true);
			$('#optNA').prop('checked', true);


			$('#optDuesPaidNo').prop('checked', true);
			
			$('#txtDateOfCuttingName').val('');
			$('#txtReasonForLeavingSchool').val('');
			$('#txtMeetingsUptoDate').val('');
			$('#txtSchoolDaysAttended').val('');
			
			$('#cmbGeneralConduct').val('');

			$('#cmbLastStudiedClass').val('');
			
			$('#txtSchoolOrBoard').val('');
			
			$('#optPromotedYes').prop('checked', true);

			$('#txtRemarks').val('');
			$('#txtTcIssueDate').val('');
		}
	// ----------------------------------------
	// Master Fee -----------------------------
		/**/// Static Heads below
		function rest_static_head_form(){
			$('#txtFeeStaticHead').val('');
		}
		$('body').on('click','.discount_applicable', function(){
			var str = this.id;
			var arr = str.split('~');
			var url_ = site_url_ + "/master_fee/update_discount_applicable";
			if(arr[1] == 'discount_applicable_yes'){
				var data_ = "sthdid="+arr[0]+"&status_=0";
			} else if(arr[1] == 'discount_applicable_no'){
				var data_ = "sthdid="+arr[0]+"&status_=1";
			}
			$.ajax({
				type: "POST",
				url: url_,
				data: data_,
				success: function(data){
					var obj = JSON.parse(data);
					if(obj.res_ == true){
						callSuccess(obj.msg_);
					} else {
						callDanger(obj.msg_);	
					}
					fill_static_fee_heads();
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		});
		$('#add_static_head').click(function(){
			if($.trim($('#txtFeeStaticHead').val()) != ''){
				url_ = site_url_ + "/master_fee/submit_static_fee_head";
				data_ = 'txtFeeStaticHead='+$('#txtFeeStaticHead').val()+'&cmbDuration='+$('#cmbDuration').val();
				
				$.ajax({
					type: "POST",
					url: url_,
					data: data_,
					success: function(data){
						var obj = JSON.parse(data);
						if(obj.res_ == true){
							callSuccess(obj.msg_);
							fill_static_fee_heads();
							fill_static_heads_to_assiciates_classes();
							rest_static_head_form();
						} else {
							callDanger(obj.msg_);
						}
					}, error: function(xhr, status, error){
						callDanger(xhr.responseText);
					}
				});
			} else {
				callDanger("Please fill Static head.");
				$('#txtFeeStaticHead').focus();
			}
		return false;
		});

		function fill_static_fee_heads(){
			url_ = site_url_ + "/master_fee/get_static_fee_heads";
			$.ajax({
				type: 'POST',
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					for(i=0; i<obj.static_heads.length; i++){
						str_html = str_html + '<tr>';
						str_html = str_html + '<td style="text-align: left" class="taskDesc"><i class="icon-info-sign"></i>';
						str_html = str_html + obj.static_heads[i].FEE_HEAD;
						str_html = str_html + '</td>';
						str_html = str_html + '<td style="text-align: left" class="taskDesc"></i>';
						str_html = str_html + obj.static_heads[i].ITEM;
						str_html = str_html + '</td>';
						str_html = str_html + '<td  style="text-align: center">';
                        if(obj.static_heads[i].DISCOUNT_APPLICABLE == 1){
							str_html = str_html + "<i class='icon-ok _yes_ discount_applicable' id='"+obj.static_heads[i].ST_HD_ID+"~discount_applicable_yes'>&nbsp;</i>";
                        }else{
							str_html = str_html + "<i class='icon-remove _no_ discount_applicable' id='"+obj.static_heads[i].ST_HD_ID+"~discount_applicable_no'>&nbsp;</i>";
                        }
                        str_html = str_html + "</td>";
						str_html = str_html + '<td class="taskOptions">';
						str_html = str_html + '<a href="#" class="tip edit_static_head_" id="EditStaticHead~'+ obj.static_heads[i].ST_HD_ID + '~'+ obj.static_heads[i].FEE_HEAD + '~'+ obj.static_heads[i].DURATION + '~'+ obj.static_heads[i].ITEM + '"><i class="icon-pencil"></i></a> | ';
						str_html = str_html + '<a href="#" class="tip delete_static_head_" id="'+ obj.static_heads[i].ST_HD_ID + '"><i class="icon-remove"></i></a>';
						str_html = str_html + '</td>';
						str_html = str_html + '</tr>'
					}
					$('#static_fee_heads_here').html(str_html);
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		}

		$('body').on('click', '.edit_static_head_', function () {
			var str = this.id;
			arr_str = str.split('~');
			static_head_id = arr_str[1];
			$('#edit_static_head_panel').css('display', 'block');
			$('#txtFeeStaticHead_edit').val(arr_str[2]);
			$('#txtID_edit').val(arr_str[1]);
			$('#cmbDuration_edit').val(arr_str[3]);
			$('#s2id_cmbDuration_edit span').text(arr_str[4]);
			$('#txtFeeStaticHead_edit').focus();
		});

		$('body').on('click', '.delete_static_head_', function () {
			url_ = site_url_ + "/master_fee/deleteStatichead/"+this.id;
			$.ajax({
				type: 'POST',
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					if(obj.res_ == true){
						callSuccess(obj.msg_);
						fill_static_fee_heads();
						fill_static_heads_to_assiciates_classes();
					} else {
						callDanger(obj.msg_);
					}
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		});

		$('.cancel_static_head_update').click(function(){
			$('#edit_static_head_panel').css('display', 'none');
		});

		$('#update_static_head').click(function(){
			if($.trim($('#txtFeeStaticHead_edit').val()) != ''){
				url_ = site_url_ + "/master_fee/update_static_head";
				data_ = "txtFeeStaticHead_edit="+$('#txtFeeStaticHead_edit').val()+"&txtID_edit="+$('#txtID_edit').val()+"&cmbDuration_edit="+$('#cmbDuration_edit').val();
				$.ajax({
					type: "POST",
					url: url_,
					data: data_,
					success: function(data){
						$('#txtFeeStaticHead_edit').val("");
						$('#cmbDuration_edit').val("n");
						$('#s2id_cmbDuration_edit span').text("As per selected months");
						$('#txtID_edit').val("");
						$('#edit_static_head_panel').css('display', 'none');
						var obj = JSON.parse(data);
						if(obj.res_ == true){
							callSuccess(obj.msg_);
							fill_static_fee_heads();
							fill_static_heads_to_assiciates_classes();
						} else {
							callDanger(obj.msg_);
						}
					}, error: function(xhr, status, error){
						callDanger(xhr.responseText);
					}
				});
			} else {
				callDanger("Please fill Static head.");
				$('#txtFeeStaticHead_edit').focus();
			}
		});

		/**/// Flexible Heads below
		function rest_flexi_head_form(){
			$('#txtFeeFlexibleHead').val('');
			$('#txtFeeFlexibleHeadAmt').val('');
		}
		$('#add_flexible_head').click(function(){
			if($.trim($('#txtFeeFlexibleHead').val()) != '' && $.trim($('#txtFeeFlexibleHeadAmt').val()) != '' && isNaN($('#txtFeeFlexibleHeadAmt').val()) == false){
				url_ = site_url_ + "/master_fee/submit_flexible_fee_head";
				data_ = 'txtFeeFlexibleHead='+$('#txtFeeFlexibleHead').val()+'&txtFeeFlexibleHeadAmt='+$.trim($('#txtFeeFlexibleHeadAmt').val())+'&cmbDuration_felxi='+$('#cmbDuration_felxi').val();
				$.ajax({
					type: "POST",
					url: url_,
					data: data_,
					success: function(data){
						var obj = JSON.parse(data);
						if(obj.res_ == true){
							callSuccess(obj.msg_);
							fill_flexible_fee_heads();
							fillFlexibleHeads_for_Associate_with_students();
							rest_flexi_head_form();
						} else {
							callDanger(obj.msg_);
						}
					}, error: function(xhr, status, error){
						callDanger(xhr.responseText);
					}
				});
			} else {
				callDanger("Please fill Flexible head and amount both and amount should be numeric.");
				if($.trim($('#txtFeeFlexibleHead').val()) == ''){
					$('#txtFeeFlexibleHead').focus();
				} else {
					$('#txtFeeFlexibleHeadAmt').focus();
				}
			}
		return false;
		});
		function fill_static_heads_to_assiciates_classes(){
			url_ = site_url_ + "/master_fee/get_static_fee_heads";
			$.ajax({
				type: 'POST',
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					str_html = str_html + "<option value='x'>Select Head</option>";
					for(i=0;i<obj.static_heads.length; i++){
						str_html = str_html + "<option value='"+obj.static_heads[i].ST_HD_ID+"'>"+obj.static_heads[i].FEE_HEAD+"</option>";
					}
					$('#s2id_cmbStaticHeads span').text("Select Head");
					$('#cmbStaticHeads').html(str_html);
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		}
		function fill_flexible_fee_heads(){
			url_ = site_url_ + "/master_fee/get_flexible_heads";
			$.ajax({
				type: 'POST',
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					for(i=0; i<obj.flexi_heads.length; i++){
						str_html = str_html + '<tr>';
						str_html = str_html + '<td style="text-align: left" class="taskDesc"><i class="icon-info-sign"></i>';
						str_html = str_html + obj.flexi_heads[i].FEE_HEAD;
						str_html = str_html + '</td>';
						str_html = str_html + '<td  style="text-align: right" class="taskDesc">'+ obj.flexi_heads[i].AMOUNT;
						str_html = str_html + '</td>'
						str_html = str_html + '<td class="taskDesc">'+ obj.flexi_heads[i].ITEM;
						str_html = str_html + '</td>'
						str_html = str_html + '<td class="taskOptions">';
						str_html = str_html + '<a href="#" class="tip edit_flexible_head_" id="EditFlexibleHead~'+ obj.flexi_heads[i].FLX_HD_ID + '~'+ obj.flexi_heads[i].FEE_HEAD + '~' + obj.flexi_heads[i].AMOUNT + '"><i class="icon-pencil"></i></a> | ';
						str_html = str_html + '<a href="#" class="tip delete_flexible_head_" id="'+ obj.flexi_heads[i].FLX_HD_ID + '"><i class="icon-remove"></i></a>';
						str_html = str_html + '</td>';
						str_html = str_html + '</tr>'
					}
					$('#flexible_fee_heads_here').html(str_html);
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		}

		$('body').on('click', '.edit_flexible_head_', function () {
			var str = this.id;
			arr_str = str.split('~');
			static_head_id = arr_str[1];
			$('#edit_flexible_head_panel').css('display', 'block');
			$('#txtFlexibleHead_edit').val(arr_str[2]);
			$('#txtFlexibleHeadAmt_edit').val(arr_str[3])
			$('#txtFlexID_edit').val(arr_str[1]);
			$('#cmbDuration_felxi_edit').val(arr_str[4]);
			$('#s2id_cmbDuration_felxi_edit span').text(arr_str[5]);
			$('#txtFlexibleHead_edit').focus();
		});

		$('#update_flexible_head').click(function(){
			if($.trim($('#txtFlexibleHead_edit').val()) != '' && $.trim($('#txtFlexibleHeadAmt_edit').val()) != '' && isNaN($('#txtFlexibleHeadAmt_edit').val()) == false){
				url_ = site_url_ + "/master_fee/update_flexible_head";
				data_ = "txtFlexibleHead_edit="+$('#txtFlexibleHead_edit').val()+"&txtFlexID_edit="+$('#txtFlexID_edit').val()+"&txtFlexibleHeadAmt_edit="+$('#txtFlexibleHeadAmt_edit').val()+'&cmbDuration_felxi_edit='+$('#cmbDuration_felxi_edit').val();
				$.ajax({
					type: "POST",
					url: url_,
					data: data_,
					success: function(data){
						$('#txtFlexibleHead_edit').val("");
						$('#txtFlexibleHeadAmt_edit').val("");
						$('#txtFlexID_edit').val("");
						$('#edit_flexible_head_panel').css('display', 'none');
						var obj = JSON.parse(data);
						if(obj.res_ == true){
							callSuccess(obj.msg_);
							fill_flexible_fee_heads();
							fillFlexibleHeads_for_Associate_with_students();
						} else {
							callDanger(obj.msg_);
						}
					}, error: function(xhr, status, error){
						callDanger(xhr.responseText);
					}
				});
			} else {
				callDanger("For updation: Please fill Flexible head and amount both and amount should be numeric.");
				if($.trim($('#txtFlexibleHead_edit').val()) == ''){
					$('#txtFlexibleHead_edit').focus();
				} else {
					$('#txtFlexibleHeadAmt_edit').focus();
				}
			}
		});
		$('.cancel_flexible_head_update').click(function(){
			$('#edit_flexible_head_panel').css('display', 'none');
		});
		$('body').on('click', '.edit_static_head_', function () {
			var str = this.id;
			arr_str = str.split('~');
			static_head_id = arr_str[1];
			$('#edit_static_head_panel').css('display', 'block');
			$('#txtFeeStaticHead_edit').val(arr_str[2]);
			$('#txtID_edit').val(arr_str[1]);
			$('#txtFeeStaticHead_edit').focus();
		});

		$('body').on('click', '.delete_flexible_head_', function () {
			url_ = site_url_ + "/master_fee/delete_flexible_head/"+this.id;
			$.ajax({
				type: 'POST',
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					if(obj.res_ == true){
						callSuccess(obj.msg_);
						fill_flexible_fee_heads();
						fillFlexibleHeads_for_Associate_with_students();
					} else {
						callDanger(obj.msg_);
					}
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		});

		// Asociate Static Heads with Classes
		$("#classes_for_static_heads_check_boxes").click(function(){  //"select all" change 
		    var status = this.checked; // "select all" checked status
		    $('.classes_for_static_heads').each(function(){ //iterate all listed checkbox items
		        this.checked = status; //change ".checkbox" checked status
		    });
		});
		function fill_accordion_showing_classes_associates_staticHeads(){
			url_ = site_url_ + "/master_fee/fill_accordion_statichead_associates_classes";
			$.ajax({
				type: "POST",
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					for(i=0; i<obj.class_fee_in_session.length; i++){
						str_html = str_html + '<div class="accordion-group widget-box">';
						str_html = str_html + '<div class="accordion-heading">';
						str_html = str_html + '<div class="widget-title"> ';
						str_html = str_html + '<a data-parent="#collapse-group" href="#cls_'+obj.class_fee_in_session[i].CLSSESSID+'" data-toggle="collapse">'
						str_html = str_html + '<span class="icon"><i class="icon-plus-sign"></i></span>';
						str_html = str_html + '<h5>Class ' + obj.class_fee_in_session[i].CLASSID + '</h5>';
						str_html = str_html + '</a>';
						str_html = str_html + '</div>';
						str_html = str_html + '</div>';
						if(i != 0){
							str_html = str_html + '<div class="collapse accordion-body" id="cls_'+obj.class_fee_in_session[i].CLSSESSID+'">';
						} else { 
							str_html = str_html + '<div class="collapse in accordion-body" id="cls_'+obj.class_fee_in_session[i].CLSSESSID+'">';
						}
						str_html = str_html + '<div class="widget-content">';
						for(j=0; j<obj.class_splitted_fee_in_session.length; j++){
							if(obj.class_fee_in_session[i].CLSSESSID == obj.class_splitted_fee_in_session[j].CLSSESSID){
								str_html = str_html + '<div style="clear: both; height: 2px"></div>';
								str_html = str_html + '<div style="border:#A0A0A0 dotted 1px; background: #f0f0f0; border-radius:5px; padding: 5px 5px 0px 5px" class="span8" id="panel_'+obj.class_splitted_fee_in_session[j].CFEESPLITID+'">';
								str_html = str_html + '<div class="span6"><span class="icon"><i class="icon-ok"></i></span>&nbsp;&nbsp;';
								str_html = str_html + obj.class_splitted_fee_in_session[j].FEE_HEAD;
								str_html = str_html + '</div>';
								str_html = str_html + '<div class="span5">';
								str_html = str_html + obj.class_splitted_fee_in_session[j].AMOUNT;
								str_html = str_html + '</div>';
								str_html = str_html + '<div class="span1">';
								str_html = str_html + '<a href="#"><span class="icon"><i class="icon-remove delete_splitted_static_fee_in_class" style="color: #ff0000" id="del~'+obj.class_splitted_fee_in_session[j].CFEESPLITID+'"></i></span></a>';
								str_html = str_html + '</div>';
								str_html = str_html + '</div>'
								str_html = str_html + '<div style="clear: both;"></div>';
							}
						}
						str_html = str_html + '</div>';
						str_html = str_html + '</div>';
						str_html = str_html + '</div>';
					}
					$('#collapse-group').html(str_html);
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		}
		$('body').on('click', '.delete_splitted_static_fee_in_class', function () {
			str = this.id;
			arrid = str.split('~');
			strid = 'panel_'+arrid[1];
			url_ = site_url_ + "/master_fee/delete_splitted_head_from_class/"+arrid[1];
			$.ajax({
				type: 'POST',
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					if(obj.res_ == true){
						$('#'+strid).css('opacity', '0');
					} else {
						callDanger(obj.msg_);
					}
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		});
		function fillClasses_for_current_session(){
			url_ = site_url_ + "/master_fee/get_class_in_session";
			$.ajax({
				type: 'POST',
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					for(i=0; i<obj.classes_.length;i++){
						str_html = str_html + '<tr>';
						str_html = str_html + '<td>';
						str_html = str_html + '<input type="checkbox" class="classes_for_static_heads" name="ckhClass_[]" id="ckh~'+obj.classes_[i].CLSSESSID+'" value="'+obj.classes_[i].CLSSESSID+'" style="border: #f0f0f0 dashed 1px"/>';
						str_html = str_html + '</td>';
						str_html = str_html + '<td>';
						str_html = str_html + 'Class ' + obj.classes_[i].CLASSID;
						str_html = str_html + '</td>';
						str_html = str_html + '</tr>';
					}
					$('#classes_associates_staticHeads').html(str_html);
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		}		
		$('#associate_static_head_with_classes').click(function(){
			var anyBoxesChecked = false;
			if($('#cmbStaticHeads').val() != 'x' && $.trim($('#txtFeeStaticHeadAmt').val()) != '' && isNaN($('#txtFeeStaticHeadAmt').val()) == false){
				$('#frmAssociateStaticFee input[type="checkbox"]').each(function() {
			        if ($(this).is(":checked")) {
			            anyBoxesChecked = true;
			        }
			    });
			    if(anyBoxesChecked == false){
			    	callDanger("Please select atleast 1 Class to associate the selected static head.");	
			    } else {
			    	url_ = site_url_ + '/master_fee/submit_static_fee_to_class';
			    	data_ = $('#frmAssociateStaticFee').serialize();
			    	$.ajax({
			    		type: 'POST',
			    		url: url_,
			    		data: data_,
			    		success: function(data){
			    			var obj = JSON.parse(data);
			    			if(obj.res_ == true){
			    				callSuccess(obj.msg_);
			    				$('.classes_for_static_heads').each(function(){ //iterate all listed checkbox items
							        this.checked = false; //change ".checkbox" checked status
							    });
			    				$('#txtFeeStaticHeadAmt').val('');
			    				fill_accordion_showing_classes_associates_staticHeads();
			    			} else {
			    				callDanger(obj.msg_);
			    			}
			    		}, error: function(xhr, status, error){
							callDanger(xhr.responseText);
						}
			    	});
			    }
			} else {
				callDanger('Please Select Static head and amount both and amount should be numeric.');
			}
		});
		// ----------------------------------

		// Asociate Flexible Heads with Students individually
		$("#classes_associates_students_for_flexibleHeads_check_boxes").click(function(){  //"select all" change 
		    var status = this.checked; // "select all" checked status
		    $('.students_as_per_class_for_flexible_heads').each(function(){ //iterate all listed checkbox items
		        this.checked = status; //change ".checkbox" checked status
		    });
		});

		function fillFlexibleHeads_for_Associate_with_students(){
			url_ = site_url_ + "/master_fee/get_flexible_heads";
			$.ajax({
				type: 'POST',
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					for(i=0; i<obj.flexi_heads.length;i++){
						str_html = str_html + '<tr>';
						str_html = str_html + '<td>';
						str_html = str_html + '<input type="radio" name="opt_flexible_heads" id="opt~'+obj.flexi_heads[i].FLX_HD_ID+'" value="'+obj.flexi_heads[i].FLX_HD_ID+'" style="border: #f0f0f0 dashed 1px"/>';
						str_html = str_html + '</td>';
						str_html = str_html + '<td>';
						str_html = str_html + obj.flexi_heads[i].FEE_HEAD + "<span style='color:#0000ff'> [INR "+obj.flexi_heads[i].AMOUNT+"/-]</span>";
						str_html = str_html + '</td>';
						str_html = str_html + '</tr>';
					}
					$('#flexibleHeads_for_associating_Students').html(str_html);
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		}

		function fillClasses_to_find_students(){
			url_ = site_url_ + "/master_fee/get_class_in_session";
			$.ajax({
				type: 'POST',
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					for(i=0; i<obj.classes_.length;i++){
						str_html = str_html + '<tr>';
						str_html = str_html + '<td>';
						str_html = str_html + '<input type="radio" name="optClasses" class="fillStudents_for_flexible_heads" id="opt~'+obj.classes_[i].CLSSESSID+'~'+obj.classes_[i].CLASSID+'" value="'+obj.classes_[i].CLSSESSID+'" />';
						str_html = str_html + '</td>';
						str_html = str_html + '<td>';
						str_html = str_html + 'Class ' + obj.classes_[i].CLASSID;
						str_html = str_html + '</td>';
						str_html = str_html + '</tr>';
					}
					$('#classes_to_find_students').html(str_html);
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		}
		$('body').on('click', '.fillStudents_for_flexible_heads', function () {
			var clsid = this.id;
			var clssessid = this.value;
			var cls = clsid.split('~');
			url_ = site_url_ + "/master_fee/getStduents_in_current_session/"+clssessid;
			$('#name_of_class_for_students').html('Students for Class <b style="width: 15px; background: #808080; color: #ffff00; padding: 2px; border-radius: 5px;">'+cls[2]+'</b>');
			$.ajax({
				type: 'POST',
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					if(obj.students__.length != 0){
						for(i=0; i<obj.students__.length;i++){
							str_html = str_html + '<tr>';
							str_html = str_html + '<td>';
							str_html = str_html + '<input type="checkbox" class="students_as_per_class_for_flexible_heads" name="ckhStudents_[]" id="ckh~'+obj.students__[i].regid+'" value="'+obj.students__[i].regid+'" />';
							str_html = str_html + '</td>';
							str_html = str_html + '<td>';
							str_html = str_html + obj.students__[i].regid + " | "+obj.students__[i].FNAME;
							str_html = str_html + '</td>';
							str_html = str_html + '</tr>';
						}
					} else {
						str_html = str_html = "<tr style='color:#ff0000'><td>X</td><td>No Student Found</td></tr>";
					}
					$('#students_for_selected_class').html(str_html);
					$('#classes_associates_students_for_flexibleHeads_check_boxes').attr('checked', false);
					$('#uniform-classes_associates_students_for_flexibleHeads_check_boxes').removeClass('checked');
					
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
			
		});

		$('#associate_flexible_head_with_Students').click(function(){
			var anyBoxesChecked = false;
			var anyradiobox_for_flexible_head = false;
			var anyradiobox_for_class = false;


			$('#flexibleHeads_for_associating_Students input[type="radio"]').each(function() {
		        if ($(this).is(":checked")) {
		            anyradiobox_for_flexible_head = true;
		        }
		    });

			$('#classes_to_find_students input[type="radio"]').each(function() {
		        if ($(this).is(":checked")) {
		            anyradiobox_for_class = true;
		        }
		    });

			$('#students_for_selected_class input[type="checkbox"]').each(function() {
		        if ($(this).is(":checked")) {
		            anyBoxesChecked = true;
		        }
		    });
		    if(anyradiobox_for_flexible_head == false){
		    	callDanger('Please select a flexible head to proceed.');
		    } else if(anyradiobox_for_class == false){
		    	callDanger('Please select a class to find students.');
		    } else if(anyBoxesChecked == false){
		    	callDanger('Please select atleast 1 student to associate the selected flexible head.');
		    } else {
		    	url_ = site_url_ + "/master_fee/associateFlexibleHead_with_student";
		    	data_ = $('#frmAssociateFlexibleFee').serialize();
		    	
		    	$.ajax({
		    		type: "POST",
		    		url: url_,
		    		data: data_,
		    		success: function(data){
		    			var obj = JSON.parse(data);
		    			if(obj.res_ == true){
		    				callSuccess(obj.msg_);
		    			} else {
		    				callDanger(obj.msg_);
		    			}
		    		}, error: function(xhr, status, error){
						callDanger(xhr.responseText);
					}
		    	});
		    }
		});

		$('body').on('click', '.my_flexible_head_association', function(){
			str = this.id;
			arr = str.split('__');
			url_ = site_url_ + "/master_fee/del_associated_flx_with_student/"+arr[1];
			$('#_'+str).hide();
			$.ajax({
				type: "POST",
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					if(obj.res_ == false){
						callDanger(obj.msg_);
						$('#_'+str).show();
					}
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		});
		function view_classes_to_view_students(){
			url_ = site_url_ + "/master_fee/get_class_in_session";

			$.ajax({
				type: 'POST',
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					for(i=0; i<obj.classes_.length;i++){
						str_html = str_html + '<tr>';
						str_html = str_html + '<td>';
						str_html = str_html + '<input type="radio" name="optClassesforview" class="View_Students_for_flexible_heads" id="view_opt~'+obj.classes_[i].CLSSESSID+'~'+obj.classes_[i].CLASSID+'" value="'+obj.classes_[i].CLSSESSID+'" />';
						str_html = str_html + '</td>';
						str_html = str_html + '<td>';
						str_html = str_html + 'Class ' + obj.classes_[i].CLASSID;
						str_html = str_html + '</td>';
						str_html = str_html + '</tr>';
					}
					$('#classes_to_View_Students_status').html(str_html);
					
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		}
		$('body').on('click', '.View_Students_for_flexible_heads', function () {
			var str = this.id;
			var arr = str.split('~');
			var clssessid = arr[1];
			call_to_fill_view_students_for_flexible_heads(clssessid);
		});
		function call_to_fill_view_students_for_flexible_heads(clssessid){
			var url_ = site_url_ + "/master_fee/get_flexible_fee_head_for_class/"+clssessid;

			$.ajax({
				type:"POST",
				url:url_,
				success: function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					var flexi_heads;
					var flexi_heads_associated = '';
					if(obj.flexiHeadsAssociatedWithClass.length > 0){
						for(loop1=0;loop1<obj.flexiHeadsAssociatedWithClass.length;loop1++){
							flexi_heads_associated = flexi_heads_associated + '<div id="deleteFlexiheadAssociatedForClass1_'+clssessid+'_'+obj.flexiHeadsAssociatedWithClass[loop1].FLX_HD_ID+'" style="float: left; padding: 2px; overflow: hidden"><div style="padding: 1px 3px 1px 3px; border-radius:5px; background: #00AFEC; font-size: 10px; color: #ffffff; display: inline-block; min-width: 20px">'+obj.flexiHeadsAssociatedWithClass[loop1].FEE_HEAD+'<i class="icon-trash delete_flexible_head_associated" style="float: right;padding: 3px 3px 0px 6px; font-size: 11px" id="deleteFlexiheadAssociatedForClass2_'+clssessid+'_'+obj.flexiHeadsAssociatedWithClass[loop1].FLX_HD_ID+'"></i></div></div>';
						}
					}
					$('#AssociatedHeads_against_selectedClass').html(flexi_heads_associated);
					if(obj.students__.length != 0){
						for(i=0; i<obj.students__.length; i++){
							str_html = str_html + '<tr>';
							str_html = str_html + '<td>';
							str_html = str_html + obj.students__[i].regid
							str_html = str_html + '</td>';
							str_html = str_html + '<td>';
							str_html = str_html + obj.students__[i].FNAME
							str_html = str_html + '</td>';
							str_html = str_html + '<td>';
							flexi_heads = '';
							for(j=0; j<obj.view_student_associated_with_flexible_heads.length;j++){
								if(obj.students__[i].regid == obj.view_student_associated_with_flexible_heads[j].regid){
									flexi_heads = flexi_heads + '<div id="_delete_flexihead_from_association__'+obj.view_student_associated_with_flexible_heads[j].ADFLXFEESTUDID+'" style="float: left; padding: 2px; overflow: hidden"><div style="padding: 1px 3px 1px 3px; border-radius:5px; background: #00AFEC; font-size: 10px; color: #ffffff; display: inline-block; min-width: 20px">'+obj.view_student_associated_with_flexible_heads[j].FEE_HEAD+'<i class="icon-trash my_flexible_head_association" style="float: right;padding: 3px 3px 0px 6px; font-size: 11px" id="delete_flexihead_from_association__'+obj.view_student_associated_with_flexible_heads[j].ADFLXFEESTUDID+'"></i></div></div>';
								}
							}
							str_html = str_html + flexi_heads;
							str_html = str_html + '</td>';
							str_html = str_html + '</tr>';
						}
						$('#student_associated_flexibleheads_classwise').html(str_html);
					} else {
						str_html = str_html + '<tr><td colspan="3" style="color: #ff0000; font-family: verdana, Arial">X: No Student Found in this class !!</td></tr>';
						$('#student_associated_flexibleheads_classwise').html(str_html);
					}
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		}
		$('body').on('click', '.delete_flexible_head_associated', function(){
			if(confirm('Are you sure to delete the Fee Head?') == true){
				var str = this.id;
				var arr = str.split('_');
				var data_ = '&txtClasssessid='+arr[1]+"&txtFlexiHeadID="+arr[2];
				var url_ = site_url_ + "/master_fee/erase_flexiHeads_associated";
				$.ajax({
					type: "GET",
					url: url_,
					data: data_,
					success: function(data){
						var obj = JSON.parse(data);
						if(obj.res_ == true){
							call_to_fill_view_students_for_flexible_heads(arr[1]);
							callSuccess(obj.msg_);
						} else {
							callDanger(obj.msg_);
						}
					}
				});
			}
		});
		// --------------------------------------------------

		// Invoice code below -------------------------------
		$('#cmbYearFromForInvoice').change(function(){$('#cmbClassForInvoice').change();});
	    $('#cmbMonthFromForInvoice').change(function(){$('#cmbClassForInvoice').change();});
	    $('#cmbYearToForInvoice').change(function(){$('#cmbClassForInvoice').change();});
	    $('#cmbMonthToForInvoice').change(function(){$('#cmbClassForInvoice').change();});
	    
		$('#cmbClassForInvoice').change(function(){
			var year_upto=0, month_upto=0;
			var global_bool;
			var class__ = $('#cmbClassForInvoice').val();
			$('#show_message').css('display', 'none');
			$('#show_message').html("");
			data_ = $('#frmInvoice').serialize();
	        $("#class_invoices_here").html("<h5 style='text-align: center'>Please wait...</h5>");
                // Fetching form data
                var year_from = parseInt($('#cmbYearFromForInvoice').val(),10);
                var month_from = parseInt($('#cmbMonthFromForInvoice').val(),10);
                var year_to = parseInt($('#cmbYearToForInvoice').val(),10);
                var month_to = parseInt($('#cmbMonthToForInvoice').val(),10);
                var total_amount_for_class = 0;
                //-------------------
                //alert(year_from + " - " + month_from + " - " + year_to + " - " + month_to + " - " + $('#cmbClassForInvoice').val());

				if(class__ != "x" && year_from != "" && month_from != "" && year_to != "" && month_to != ""){
			        if(year_from <= year_to){
			        	if(year_from  == year_to && month_from > month_to){
			        		$("#class_invoices_here").html("<div style='text-align: center; padding: 5px'><b>Month-from</b> should be less than or equals to <b>Month-to</b></div>");
			        	} else {
			        		total_months = calculate_no_months(year_from, month_from, year_to, month_to);
				            data_ = $('#frmInvoice').serialize();
				            url_ = site_url_ + "/fee/show_invoice_needs_to_be_generated";
				            var str_html = '';
				            $.ajax({
				                type : 'POST',
				                url : url_,
				                data : data_,
				                success : function(data){
				                    var obj = JSON.parse(data);

				                    $('#show_message').css('display', 'block');
				                    $('#show_message').html(obj.prev_invoice_generated_month_year.msg);
				                    //if(obj.prev_invoice_generated_month_year.year < year_from ){
					                    //str_html = str_html + obj.previous_invoice.length;
					                    str_html = str_html + '<table class="table table-bordered table-striped">';
		                    			str_html = str_html + '<tbody>';

					                    if(obj.fetch_class_students.length != 0 && obj.static_fee_to_class.length != 0){
					                    	$('#total_students').html(obj.fetch_class_students.length+ " Student");	 
					                        var fixHeads = '';
					                        var fixHeadsAmount = 0;//obj.static_fee_to_class[0].TOTFEE;
					                        var totalFixHeadsAmount = 0;
					                        var invoice_already_generated = false;

					                        // Fetching data for pay fee and receipt printing
						                    	url_Receipt = site_url_ + "/fee/show_class_for_receipt";
								            	data_Receipt = "class_in_session_for_Receipt="+class__+"&cmbYearFromForReceipt="+year_from+"&cmbMonthFromForReceipt="+month_from+"&cmbYearToForReceipt="+year_to+"&cmbMonthToForReceipt="+month_to;
									            $.ajax({
									                type : 'POST',
									                url : url_Receipt,
									                data : data_Receipt,
									                success : function(data){
									                    var objreceipt = JSON.parse(data);
									                    for(i=0;i<obj.static_fee_to_class.length;i++){
								                        	if(obj.static_fee_to_class[i].DURATION == '1'){
								                        		fixHeadsAmount = fixHeadsAmount + parseInt(obj.static_fee_to_class[i].AMOUNT, 10);
								                        	} else {
								                        		fixHeadsAmount = fixHeadsAmount + (parseInt(obj.static_fee_to_class[i].AMOUNT, 10)*parseInt(total_months,10));
								                        	}
								                            if(i == obj.static_fee_to_class.length-1){
								                                //fixHeads = fixHeads + obj.static_fee_to_class[i].FEE_HEAD + "{" + obj.static_fee_to_class[i].AMOUNT + "}";
								                                fixHeads = fixHeads + "<div class='fee_heads_static' title='"+obj.static_fee_to_class[i].AMOUNT+"'>"+obj.static_fee_to_class[i].FEE_HEAD+'</div>';
								                            } else {
								                                fixHeads = fixHeads + "<div class='fee_heads_static' title='"+obj.static_fee_to_class[i].AMOUNT+"'>"+obj.static_fee_to_class[i].FEE_HEAD+'</div> ';
								                            }
								                        }
								                        totalFixHeadsAmount = fixHeadsAmount;
								                            str_html = str_html + "<tr style='background: #ffffff'>";
								                            str_html = str_html + "<td colspan='9' style='vertical-align: middle'> <div style='float:  left'>Standard Fix Fee for this class-&nbsp;&nbsp;</div>"+fixHeads+'<div style="clear: both"></div>';
								                            str_html = str_html + "<div style='float: left'><b>Note: </b>Generate/ Print Invoice for "+total_months+" month(s). </div></td>"
								                            str_html = str_html + "<td colspan='3' style='background: #FEF4F2; text-align: center; vertical-align: middle'><h5>Receipt Area</h5></td></tr>";
								                            str_html = str_html + "<tr>";
								                            
								                            str_html = str_html + "<tr class='gradeX'>";
								                            str_html = str_html + "<th>Reg. No</th>";
								                            str_html = str_html + "<th>Name</th>";      
								                            str_html = str_html + "<th>Discount</th>";      
								                            str_html = str_html + "<th style='text-align: right !important'>Fix Fee</th>";
								                                str_html = str_html + "<th style='min-width: 100px; max-width: 200px'>Opted Fee</th>";
								                                str_html = str_html + "<th style='text-align: right !important'>Amount</th>";
								                            str_html = str_html + "<th width='100' style='text-align: right !important'>Total Fee</th>";
								                            str_html = str_html + "<th width='100' style='text-align: center !important'>Invoice</th>";
								                            str_html = str_html + "<th width='100' style='text-align: center !important'>Undo Invoice</th>";
								                            str_html = str_html + "<th width='100' style='text-align: right !important'>Dues</th>";
								                            str_html = str_html + "<th width='100' style='text-align: center !important'>Pay Fee</th>";
								                            str_html = str_html + "<th width='100' style='text-align: center !important'>Print Receipt</th>";
								                            str_html = str_html + "</tr>";

								                            var student_discount = obj.discount_associated;
								                        for(loop1=0;loop1<obj.fetch_class_students.length; loop1++){
								                        	invoice_already_generated = false;
								                        	for(pinvoiceloop=0;pinvoiceloop<obj.previous_invoice.length;pinvoiceloop++){
								                        		if(obj.previous_invoice[pinvoiceloop].REGID == obj.fetch_class_students[loop1].regid){
								                        			invoice_already_generated = true;
								                        			var invdetid = obj.previous_invoice[pinvoiceloop].INVDETID;
								                        			break;
								                        		}
								                        	}
								                        	var st_discount_data = '';
								                        	$.each( student_discount, function( key, value ) {
								                        		if(obj.fetch_class_students[loop1].regid == value.regid){
								                        			var st_dis_data = value.DISCOUNT;
								                        			var ar_ = st_dis_data.split(',');
								                        			for(i=0; i<ar_.length; i++){
								                        				st_discount_data = st_discount_data + "<div class='discount_lable'>"+ar_[i]+"</div>";	
								                        			}
															  		
															  		return;
															  	}
															});
								                        	//var st_arr_discount = st_discount_data.split(',');

								                            str_html = str_html + "<tr class='gradeX'>";
								                            str_html = str_html + "<td>"+obj.fetch_class_students[loop1].regid+"</td>";
								                            str_html = str_html + "<td style='width: 150px'>"+obj.fetch_class_students[loop1].FNAME+"</td>";
								                            str_html = str_html + "<td>"+st_discount_data+"</td>";
								                            str_html = str_html + "<td style='text-align: right !important'><span class='highlightText'>"+totalFixHeadsAmount+"</span></td>";
								                            flexifee = ''
								                            flexiAmount = 0;
								                            	// Calculation of Flexi-Heads and its amount opted-by student individually
								                                for(j=0;j<obj.flexible_head_to_class.length; j++){
								                                    if(obj.fetch_class_students[loop1].regid == obj.flexible_head_to_class[j].regid){
								                                        flexifee = flexifee + '<div class="cover_heads"><div class="fee_heads_flexi" title="'+obj.flexible_head_to_class[j].AMOUNT+'">'+obj.flexible_head_to_class[j].FEE_HEAD+'</div></div>';
								                                        if(obj.flexible_head_to_class[j].DURATION == '1'){
											                        		flexiAmount = flexiAmount + parseInt(obj.flexible_head_to_class[j].AMOUNT, 10);
											                        	} else {
											                        		flexiAmount = flexiAmount + (parseInt(obj.flexible_head_to_class[j].AMOUNT, 10)*parseInt(total_months,10));
											                        	}
								                                    }
								                                }
								                                // -----------------------------------------------------------------------
								                                flxmt =flexiAmount; 

								                                str_html = str_html + "<td>"+flexifee+"</td>";
								                                total_flexiAmount = flexiAmount;
								                                str_html = str_html + "<td style='text-align: right !important'><span class='highlightText'>"+total_flexiAmount+"</span></td>";

								                            totalAmount = parseInt(totalFixHeadsAmount,10)+parseInt(total_flexiAmount,10);
								                            total_amount_for_class = parseInt(total_amount_for_class, 10)+parseInt(totalAmount,10);
								                            str_html = str_html + "<td style='text-align: right !important'><span class='highlightText' title='"+totalFixHeadsAmount+" + "+total_flexiAmount+"'>"+totalAmount+"</span></td>";

								                            if(invoice_already_generated == true){
								                            	str_html = str_html + "<td style='text-align: center !important' id='"+obj.fetch_class_students[loop1].regid+"_for_invoice_print'><a href='"+site_url_+"/fee/print_invoice/"+invdetid+"/"+class__+"' target='_blank'><span class='print_invoice'><i class='icon-print' title='Print Invoice'></i></span></a></td>";
								                            	str_html = str_html + "<td style='text-align: center !important' class='place_for_undo' id='place_for_undo_"+obj.fetch_class_students[loop1].regid+"'><span class='payFee'><i class='icon-undo undoinvoice' title='Undo Invoice' id='undoinvoice_"+invdetid+"_"+obj.fetch_class_students[loop1].regid+"_"+class__+"'></i></span></td>";
								                        	} else {
								                        		str_html = str_html + "<td style='text-align: center !important' id='"+obj.fetch_class_students[loop1].regid+"_for_invoice_print'><span class='generate_invoice' id='"+obj.fetch_class_students[loop1].regid+"'><i class='icon-lock' title='Generate Invoice'></i></span></td>";
								                        		str_html = str_html + "<td style='text-align: center !important' class='place_for_undo' id='place_for_undo_"+obj.fetch_class_students[loop1].regid+"'></td>";
								                        	}
								                        	// Below code for Pay Fee and Print receipt
								                        		var regid_ = obj.fetch_class_students[loop1].regid
								                        		var len_receipt = objreceipt.fetch_invoice_for_receipt.length;
											                	if(len_receipt != 0){
												                	var index = findIndex(regid_,objreceipt.fetch_invoice_for_receipt);
												                    if(index != -1){
												                        if(objreceipt.fetch_invoice_for_receipt[index].STATUS == 1){
												                        	var due_amount = objreceipt.fetch_invoice_for_receipt[index].DUE_AMOUNT;
												                            if(due_amount <= 0){
												                            	str_html = str_html + "<td style='background: #FEF4F2; text-align: right !important' id='dueAmt_"+regid_+"'><span class='dimtext' title='"+due_amount+"'>"+due_amount+"</span></td>";
												                            	str_html = str_html + "<td style='background: #FEF4F2; text-align: center !important' id='payFee_"+objreceipt.fetch_invoice_for_receipt[index].INVDETID+"_"+regid_+"_outer'><i class='icon-play myreceipt_from_invoice' id='payFee_"+objreceipt.fetch_invoice_for_receipt[index].INVDETID+"_"+regid_+"' style='color: #F9ADAD'></i></td>";
												                            	str_html = str_html + "<td style='background: #FEF4F2; text-align: center !important'><a href='"+site_url_+"/fee/print_latest_receipt/"+objreceipt.fetch_invoice_for_receipt[index].INVDETID+"' target='_blank'><span class='print_invoice'><i class='icon-print print_latest_receipt' id='print_fee~"+objreceipt.fetch_invoice_for_receipt[index].INVDETID+"'></i></span></a></td>";
												                            } else {
												                            	str_html = str_html + "<td style='background: #FEF4F2; text-align: right !important' id='dueAmt_"+regid_+"'><span class='red_' title='"+due_amount+"'>"+due_amount+"</span></td>";
												                            	str_html = str_html + "<td style='background: #FEF4F2; text-align: center !important' id='payFee_"+objreceipt.fetch_invoice_for_receipt[index].INVDETID+"_"+regid_+"_outer'><i class='icon-play myreceipt_from_invoice' id='payFee_"+objreceipt.fetch_invoice_for_receipt[index].INVDETID+"_"+regid_+"' style='color: #ff0000'></i></td>";
												                            	str_html = str_html + "<td style='background: #FEF4F2; text-align: center !important' id='print_fee_"+objreceipt.fetch_invoice_for_receipt[index].INVDETID+"_outer'><a href='"+site_url_+"/fee/print_latest_receipt/"+objreceipt.fetch_invoice_for_receipt[index].INVDETID+"' target='_blank'><span class='print_invoice'><i class='icon-print print_latest_receipt' id='print_fee_"+objreceipt.fetch_invoice_for_receipt[index].INVDETID+"'></i></span></a></td>";
												                            }
												                    	} else {
												                    		str_html = str_html + "<td style='background: #FEF4F2; text-align: right !important' id='dueAmt_"+regid_+"'><span class='dimtext' title='NA'></span></td>";
												                        	str_html = str_html + "<td style='background: #FEF4F2; text-align: center !important'><i class='icon-remove' style='color: #DE9797'></i></td>";
												                        	str_html = str_html + "<td style='background: #FEF4F2; text-align: center !important'><i class='icon-remove' style='color: #DE9797'></i></td>";
												                    	}
												                	} else {
												                		str_html = str_html + "<td style='background: #FEF4F2; text-align: right !important' id='dueAmt_"+regid_+"'><span class='dimtext' title='NA'></span></td>";
												                		str_html = str_html + "<td style='background: #FEF4F2; text-align: center !important' id='payFee_"+regid_+"_to_hold'></td>";
												                		str_html = str_html + "<td style='background: #FEF4F2; text-align: center !important' id='print_fee_"+regid_+"_to_hold'><i class='icon-print' style='color: #a0a0a0'></i></td>";
												                	}
												                } else {
												                	str_html = str_html + "<td style='background: #FEF4F2; text-align: right !important' id='dueAmt_"+regid_+"'><span class='dimtext' title='NA'></span></td>";
												                	str_html = str_html + "<td style='background: #FEF4F2; text-align: center !important' id='payFee_"+regid_+"_to_hold'></td>";
												                	str_html = str_html + "<td style='background: #FEF4F2; text-align: center !important' id='print_fee_"+regid_+"_to_hold'><i class='icon-print' style='color: #a0a0a0'></i></td>";
												                }
											                // ---------------------------------------------- 
								                        	//str_html = str_html + payFee_in_Invoice(class__, year_from, month_from, year_to, month_to, obj.fetch_class_students[loop1].regid);
								                            str_html = str_html + "</tr>";
								                        }
								                        str_html = str_html + "<tr class='gradeX'>";
							                            str_html = str_html + "<td colspan='5' style='text-align: right !important'>Total Fee for the class</td>";
														str_html = str_html + "<td style='text-align: right !important; color: #0000ff; font-weight: bold'>"+total_amount_for_class+"</td>";
							                            str_html = str_html + "<td colspan='5'></td>";
							                            str_html = str_html + "</tr>";

							                            str_html = str_html + '</tbody>';
						                				str_html = str_html + '</table>';
									                    $("#class_invoices_here").html(str_html);
									                },
									                error: function (xhr, ajaxOptions, thrownError) {       
									                    $("#class_invoices_here").empty();
									                    $("#class_invoices_here").append(thrownError);
									                }
									            });
								            // -----------------------------------------------
					                    } else {
					                    	$('#total_students').html('');
					                        str_html = "<div class='rear_message'><i class='icon-ban-circle'></i> <b>No Fee</b> adjusted for the <b>class</b> yet.</div>";
					                        str_html = str_html + '</tbody>';
			                				str_html = str_html + '</table>';
						                    $("#class_invoices_here").html(str_html);
					                    }
					                    // -here stops
				                },
				                error: function (xhr, ajaxOptions, thrownError) {       
				                    //alert(xhr.responseText);
				                    str_html = thrownError;
				                    $("#class_invoices_here").empty();
				                    $("#class_invoices_here").append(str_html);
				                }
				            });
			        	}
			        } else {
			            $("#class_invoices_here").html("<div class='rear_message'><i class='icon-ban-circle'></i> <b>Year-from</b> should be less than or equals to <b>Year-to</b></div>");
			        }
		        } else {
		            $("#class_invoices_here").html("");
		        }
	        return false;
		});
		$('body').on('click', '.generate_invoice', function(){
			var regid_ = this.id;
			var $class__ = $('#cmbClassForInvoice').val();
            var data_ = $('#frmInvoice').serialize() + '&regid='+this.id;
            var url_ = site_url_ + '/fee/generateInvoice';

            $.ajax({
            	type: "POST",
            	url:url_,
            	data:data_,
            	success: function(data){
            		var obj = JSON.parse(data);
            		if(obj.bool__ != 1){
            			callDanger(obj.msg_);
            		} else {
            			$('#'+regid_+"_for_invoice_print").html("<a href='"+site_url_+"/fee/print_invoice/"+obj.invdetid+"/"+$class__+"' target='_blank'><span class='print_invoice'><i class='icon-print' title='Print Invoice'></i></span></a>");
            			$('#place_for_undo_'+regid_).html("<span class='payFee'><i class='icon-undo undoinvoice' title='Undo Invoice' id='undoinvoice_"+obj.invdetid+"_"+regid_+"_"+$class__+"'></i></span>");

            			$('#dueAmt_'+regid_).html("<span class='red_' title='"+obj.total_amount_due+"'>"+obj.total_amount_due+"</span>");
            			$('#payFee_'+regid_+'_to_hold').html("<i class='icon-play myreceipt_from_invoice' id='payFee_"+obj.invdetid+"_"+regid_+"' style='color: #ff0000'></i>");
						$('#print_fee_'+regid_+'_to_hold').html("<span><i class='icon-print' style='color: #a0a0a0'></i></span>");

						var new_id_for_payFee  = 'payFee_'+obj.invdetid+'_'+regid_+'_outer';
						$('#payFee_'+regid_+'_to_hold').attr("id", new_id_for_payFee);

						var new_id_for_printFee = 'print_fee_'+obj.invdetid+'_outer';
						$('#print_fee_'+regid_+'_to_hold').attr("id", new_id_for_printFee);
            		}
            		
            	},
            	error: function (xhr, ajaxOptions, thrownError) {     
                    callDanger(xhr.responseText);
                }
            });
		});
		$('body').on('click', '.undoinvoice', function(){
			var str = this.id;
			var arr_ = str.split("_");
			var regid_ = arr_[2];
			var invdetid = arr_[1];
			var url_ = site_url_ + '/fee/undo_invoice/'+arr_[1]+'/'+arr_[2]+'/'+arr_[3];
			$.ajax({
				type: "POST",
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					if(obj.bool_ == 2){
						$('#place_for_undo_'+regid_).html('');
						$('#'+regid_+"_for_invoice_print").html("<span class='generate_invoice' id='"+regid_+"'><i class='icon-lock' title='Generate Invoice'></i></span>");

						$('#payFee_'+invdetid+'_'+regid_+'_outer').html('');
						$('#print_fee_'+invdetid+'_outer').html('');
						$('#dueAmt_'+regid_).html('');
						var new_id = 'payFee_'+regid_+'_to_hold';
						$('#payFee_'+invdetid+'_'+regid_+'_outer').attr("id", new_id);

						var new_id_for_printFee = 'print_fee_'+regid_+'_to_hold';
						$('#print_fee_'+invdetid+'_outer').attr("id", new_id_for_printFee);

					} else {
						callDanger(obj.msg_);
					}
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		});
		
		function calculate_no_months(yrfrom, mnthfrom, yr2, mnth2){
		        yrfrom = parseInt(yrfrom,10);
		        mnthfrom = parseInt(mnthfrom,10);
		        yr2 = parseInt(yr2,10);
		        mnth2 = parseInt(mnth2,10);
		        if(yrfrom<yr2){
		            count_1 = 12 - mnthfrom;
		            count_2 = mnth2 - 1;
		            total = count_1 + count_2 + 2;
		        } else if(yrfrom == yr2){
		            if(mnthfrom<=mnth2){

		                total = mnth2 - mnthfrom + 1;
		            } else {
		                total = 0;
		            }
		        }
		        return total;
		    }
			// --------------------------------------------------

			// Paying Fee & Receipt code below
			$('#cmbYearFromForReceipt').change(function(){$('#class_in_session_for_Receipt').change();});
			$('#cmbMonthFromForReceipt').change(function(){$('#class_in_session_for_Receipt').change();});
			$('#cmbYearToForReceipt').change(function(){$('#class_in_session_for_Receipt').change();});
			$('#cmbMonthToForReceipt').change(function(){$('#class_in_session_for_Receipt').change();});
			$('#class_in_session_for_Receipt').change(function(){
	        	if($('#class_in_session_for_Receipt').val() != ""){
		            var class_ = $('#class_in_session_for_Receipt').find('option:selected').text();
		            var year_from = parseInt($('#cmbYearFromForReceipt').val(),10);
	                var month_from = parseInt($('#cmbMonthFromForReceipt').val(),10);
	                var year_to = parseInt($('#cmbYearToForReceipt').val(),10);
	                var month_to = parseInt($('#cmbMonthToForReceipt').val(),10);
	                var total_amount_for_class = 0;
                	if(class_ != "x" && year_from != "" && month_from != "" && year_to != "" && month_to != ""){
                		data_ = $('#frmPayFee').serialize();
		            	url_ = site_url_ + "/fee/show_class_for_receipt";
			            $.ajax({
			                type : 'POST',
			                url : url_,
			                data : data_,
			                success : function(data){
			                	var tot_fixAmount_1_time = 0, tot_fixAmount_n_time = 0, fixHeads_1='',fixHeads_n='';
			                    var obj = JSON.parse(data);
			                    var len_ = obj.fetch_invoice_for_receipt.length;

			                    if(len_ != 0){
			                    	var total_months= parseInt(obj.fetch_invoice_for_receipt[0].NOM,10);
				                    var str_html 	= '';
				                    // For static or fix heads '1' and 'n' times
				                    var fixheads_1_time = obj.fetch_invoice_for_receipt[0].STATIC_HEADS_1_TIME;
				                    if(fixheads_1_time != ''){
				                    	var fixamt_1_time = obj.fetch_invoice_for_receipt[0].STATIC_SPLIT_AMT_1_TIME;
				                    	var fixH1 = fixheads_1_time.split(',');
				                    	var fixH1_amt = fixamt_1_time.split(',');
				                    	for(i=0; i<fixH1.length;i++){
				                    		str = fixH1[i];
				                    		fixHeads_1 = fixHeads_1 + "<div class='fee_heads_static' title='"+parseInt(fixH1_amt[i],10)+"'>"+str.split('@')[0]+'</div>';
				                    		tot_fixAmount_1_time = tot_fixAmount_1_time + parseInt(fixH1_amt[i],10);
				                    	}
				                	} else {
				                		fixHeads_1 = '';
				                	}

				                	var fixheads_n_times = obj.fetch_invoice_for_receipt[0].STATIC_HEADS_N_TIMES;
				                    if(fixheads_n_times != ''){
					                    var fixamt_n_time = obj.fetch_invoice_for_receipt[0].STATIC_SPLIT_AMT_N_TIME;
					                    var fixHn = fixheads_n_times.split(',');
					                    var fixHn_amt = fixamt_n_time.split(',');
				                    	for(i=0;i<fixHn.length;i++){
				                    		str = fixHn[i];
				                    		fixHeads_n = fixHeads_n + "<div class='fee_heads_static' title='"+parseInt(fixHn_amt[i],10)+"'>"+str.split('@')[0]+'</div>';
				                    		tot_fixAmount_n_time = tot_fixAmount_n_time + parseInt(fixHn_amt[i],10);	
				                    	}
				                    	tot_fixAmount_n_time = parseInt(parseInt(tot_fixAmount_n_time,10)*total_months,10);
					                } else {
					                	fixHeads_n = '';
					                }

					                var totalFixHeadsAmount =  parseInt(tot_fixAmount_n_time,10) + parseInt(tot_fixAmount_1_time,10);
				                    // -----------------------

			                    	// Fetching Period data from the first record as period is same for all the records fetched
			                    	var year_from 	= obj.fetch_invoice_for_receipt[0].YEAR_FROM;
	                				var month_from 	= obj.fetch_invoice_for_receipt[0].MONTH_FROM;
	                				var year_to 	= obj.fetch_invoice_for_receipt[0].YEAR_TO;
	                				var month_to 	= obj.fetch_invoice_for_receipt[0].MONTH_TO;
	                				// ----------------------------------------------------------------------------------------

			                        str_html = str_html + '<table class="table table-bordered table-striped">';
		                    		str_html = str_html + '<tbody>';
			                        $('#class_here_for_fee').html(class_);
			                        $('#total_students_payfee').html(len_+ " student(s) can pay fee");
			                        
			                        str_html = str_html + "<tr style='background: #ffffff'>";
		                            str_html = str_html + "<td colspan='9' style='vertical-align: middle'> <div style='float:  left'>Standard Fix Fee for this class-&nbsp;&nbsp;</div>"+fixHeads_1+fixHeads_n+'<div style="clear: both"></div>';
		                            str_html = str_html + "<div style='float: left'>Note: Collection of FEE for "+total_months+" month(s) i.e. ["+get_months(month_from)+", "+year_from+" -to- "+get_months(month_to)+", "+year_to+"]";
		                            str_html = str_html + "</td>";
		                            str_html = str_html + "<tr>";
		                            
		                            str_html = str_html + "<tr class='gradeX'>";
		                            str_html = str_html + "<th>Registration No</th>";
		                            str_html = str_html + "<th>Name</th>";      
		                            str_html = str_html + "<th style='text-align: right !important'>Fix Fee Amount</th>";
	                                str_html = str_html + "<th style='min-width: 100px; max-width: 200px'>Opted Fee</th>";
	                                str_html = str_html + "<th style='text-align: right !important'>Amount</th>";
		                            str_html = str_html + "<th width='100' style='text-align: right !important'>Previous Dues</th>";
		                            str_html = str_html + "<th width='80' style='text-align: right !important'>Total Dues</th>";
		                            str_html = str_html + "<th width='50' style='text-align: center !important'>Pay Fee</th>";
		                            str_html = str_html + "<th width='50' style='text-align: center !important'>Print Fee</th>";
		                            str_html = str_html + "</tr>";
		                            
		                            var total_amount_for_class = 0;

	 		                        for(loop1=0;loop1<obj.fetch_class_students.length; loop1++){
	 		                        	var flexifee = '', flexiHeads_1 = '', flexiHeads_n = '';
				                        var flexiAmount = 0;
				                        var total_flexiAmount = 0, tot_flexiAmount_1_time = 0, tot_flexiAmount_n_time = 0;
			                        	var index = findIndex(obj.fetch_class_students[loop1].regid,obj.fetch_invoice_for_receipt);

			                            str_html = str_html + "<tr class='gradeX'>";
			                            str_html = str_html + "<td>"+obj.fetch_class_students[loop1].regid+"</td>";
			                            str_html = str_html + "<td>"+obj.fetch_class_students[loop1].FNAME+"</td>";

			                            if(index != -1){
			                            		str_html = str_html + "<td style='text-align: right !important'><span class='dimtext'>"+totalFixHeadsAmount+"</span></td>";
				                            	// Calculation of Flexi-Heads and its amount opted-by student individually
				                            	var due_amount = obj.fetch_invoice_for_receipt[index].DUE_AMOUNT;
				                            	var prev_dues = obj.fetch_invoice_for_receipt[index].PREV_DUE_AMOUNT;
				                                var flexiheads_1_time = obj.fetch_invoice_for_receipt[index].FLEXIBLE_HEADS_1_TIME;
							                    if(flexiheads_1_time != ''){
							                    	var flexiamt_1_time = obj.fetch_invoice_for_receipt[index].FLEXI_SPLIT_AMT_1_TIME;
							                    	var flexiH1 = flexiheads_1_time.split(',');
							                    	var flexiH1_amt = flexiamt_1_time.split(',');
							                    	for(i=0; i<flexiH1.length;i++){
							                    		flexiHeads_1 = flexiHeads_1 + "<div class='fee_heads_static' title='"+parseInt(flexiH1_amt[i],10)+"'>"+flexiH1[i]+'</div>';
							                    		tot_flexiAmount_1_time = tot_flexiAmount_1_time + parseInt(flexiH1_amt[i],10);
							                    	}
							                	} else {
							                		flexiHeads_1 = '';
							                	}
							                	
							                	
							                	var flexiheads_n_times = obj.fetch_invoice_for_receipt[index].FLEXIBLE_HEADS_N_TIMES;
							                    
							                    if(flexiheads_n_times != ''){
								                    var flexiamt_n_time = obj.fetch_invoice_for_receipt[index].FLEXI_SPLIT_AMT_N_TIMES;
								                    var flexiHn = flexiheads_n_times.split(',');
								                    var flexiHn_amt = flexiamt_n_time.split(',');
							                    	for(i=0;i<flexiHn.length;i++){
							                    		flexiHeads_n = flexiHeads_n + "<div class='fee_heads_static' title='"+parseInt(flexiHn_amt[i],10)+"'>"+flexiHn[i]+'</div>';
							                    		tot_flexiAmount_n_time = tot_flexiAmount_n_time + parseInt(flexiHn_amt[i],10);	
							                    	}
							                    	tot_flexiAmount_n_time = parseInt(parseInt(tot_flexiAmount_n_time,10)*total_months,10);
								                } else {
								                	flexiHeads_n = '';
								                }
								                //*/
				                                // -----------------------------------------------------------------------
				                                str_html = str_html + "<td>"+flexiHeads_1+flexiHeads_n+"</td>";
				                                total_flexiAmount = parseInt(tot_flexiAmount_1_time,10)+parseInt(tot_flexiAmount_n_time, 10);
				                                if(total_flexiAmount != 0){
				                                	str_html = str_html + "<td style='text-align: right !important'><span class='dimtext'>"+total_flexiAmount+"</span></td>";
				                            	} else {
				                            		str_html = str_html + "<td style='text-align: right !important'><span class='dimtext'></span></td>";
				                            	}


				                            totalAmount = parseInt(totalFixHeadsAmount,10)+parseInt(total_flexiAmount,10);
				                            total_amount_for_class = parseInt(total_amount_for_class, 10)+parseInt(totalAmount,10) + parseInt(prev_dues,10);

				                            str_html = str_html + "<td style='text-align: right !important'><span class='dimtext'>"+prev_dues+"</span></td>";

				                            if(obj.fetch_invoice_for_receipt[index].STATUS == 1){
					                            if(due_amount <= 0){
					                            	str_html = str_html + "<td style='text-align: right !important'><span class='dimtext' title='"+due_amount+"'>"+due_amount+"</span></td>";
					                            	str_html = str_html + "<td style='text-align: center !important'><i class='icon-play myreceipt' id='payFee_"+obj.fetch_invoice_for_receipt[index].INVDETID+"_"+obj.fetch_class_students[loop1].regid+"' style='color: #ff0000'></i></td>";
					                            	str_html = str_html + "<td style='text-align: center !important'><a href='"+site_url_+"/fee/print_latest_receipt/"+obj.fetch_invoice_for_receipt[index].INVDETID+"' target='_blank'><span class='print_invoice'><i class='icon-print print_latest_receipt' id='print_fee~"+obj.fetch_invoice_for_receipt[index].INVDETID+"'></i></span></a></td>";
					                            } else {
					                            	str_html = str_html + "<td style='text-align: right !important'><span class='red_' title='"+due_amount+"'>"+due_amount+"</span></td>";
					                            	str_html = str_html + "<td style='text-align: center !important'><i class='icon-play myreceipt' id='payFee_"+obj.fetch_invoice_for_receipt[index].INVDETID+"_"+obj.fetch_class_students[loop1].regid+"' style='color: #ff0000'></i></td>";
					                            	str_html = str_html + "<td style='text-align: center !important'><a href='"+site_url_+"/fee/print_latest_receipt/"+obj.fetch_invoice_for_receipt[index].INVDETID+"' target='_blank'><span class='print_invoice'><i class='icon-print print_latest_receipt' id='print_fee~"+obj.fetch_invoice_for_receipt[index].INVDETID+"'></i></span></a></td>";
					                            }
				                        	} else {
				                        		str_html = str_html + "<td style='text-align: right !important'><span class='dimtext' title='"+due_amount+"'>"+due_amount+"</span></td>";
				                            	str_html = str_html + "<td style='text-align: center !important'><i class='icon-play myreceipt' id='payFee_"+obj.fetch_invoice_for_receipt[index].INVDETID+"_"+obj.fetch_class_students[loop1].regid+"' style='color: #ff0000'></i></td>";
				                            	str_html = str_html + "<td style='text-align: center !important'><a href='"+site_url_+"/fee/print_latest_receipt/"+obj.fetch_invoice_for_receipt[index].INVDETID+"' target='_blank'><span class='print_invoice'><i class='icon-print print_latest_receipt' id='print_fee~"+obj.fetch_invoice_for_receipt[index].INVDETID+"'></i></span></a></td>";
				                        	}

				                            str_html = str_html + "</tr>";
			                        	} else {
			                        		str_html = str_html + "<td style='text-align: right !important'><span class='dimtext'></span></td>";
			                        		str_html = str_html + "<td></td>";
			                        		str_html = str_html + "<td style='text-align: right !important'><span class='dimtext'></span></td>";
			                        		str_html = str_html + "<td style='text-align: right !important'><span class='dimtext'></span></td>";
			                        		str_html = str_html + "<td style='text-align: center !important'></td>";
			                        		str_html = str_html + "<td style='text-align: center !important'></td>";
			                        		str_html = str_html + "<td style='text-align: center !important'><i class='icon-print' style='color: #a0a0a0'></i></td>";

				                            str_html = str_html + "</tr>";
			                        	}
			                        }

			                        str_html = str_html + "<tr class='gradeX'>";
		                            str_html = str_html + "<td colspan='6' style='text-align: right !important'>Total Fee for the class</td>";
		                            str_html = str_html + "<td style='text-align: right !important; color: #0000ff; font-weight: bold'>"+total_amount_for_class+"</td>";
		                            str_html = str_html + "<td></td>";
		                            str_html = str_html + "<td></td>";
		                            str_html = str_html + "</tr>";
			                    	str_html = str_html + '</tbody>';
		                			str_html = str_html + '</table>';
				                    $('#class_PayFee_here').html(str_html);
			                    } else {
			                        //$('#prev_receipt_month_info').html("");
			                        $('#class_PayFee_here').html('<div class="rear_message">No Invoice generated for the selected class.</div>');
			                    }
				                
			                }, error: function(xhr, status, error){
			                    callDanger(xhr.responseText);
			                }
			            });
					} else {
						callDanger("You must select all the data (class/Year & Month From/ year & Month To.");
					}
	        	}
	    	return false;
	    	});
			$('#cmdPayZeroReceipt').click(function(){
				if($('#cmbClassForInvoice').val() != "x"){
		            var class_ = $('#cmbClassForInvoice').val();
		            var year_from = parseInt($('#cmbYearFromForInvoice').val(),10);
	                var month_from = parseInt($('#cmbMonthFromForInvoice').val(),10);
	                var year_to = parseInt($('#cmbYearToForInvoice').val(),10);
	                var month_to = parseInt($('#cmbMonthToForInvoice').val(),10);
	                var total_amount_for_class = 0;
                	if(class_ != "x" && year_from != "" && month_from != "" && year_to != "" && month_to != ""){
                		data_ = $('#frmInvoice').serialize();
		            	url_ = site_url_ + "/fee/pay_zero_amount";
		            	$('#cmdPayZeroReceipt').val('Loading...');
		            	$.ajax({
		            		type: "POST",
		            		url: url_,
		            		data: data_,
		            		success: function(data){
		            			var obj = JSON.parse(data);
		            			var str = '';
		            			var sno = 0;
		            			if(obj.length > 1){
			            			str = str + "<table class='table table-bordered'>";
			            			str = str + "<tr>";
			            			str = str + "<th colspan='5' style='background: #3F3C3B !important; color: #ffffff !important'>Below are the Auto Receipts with zero payment.</th>";
			            			str = str + "</tr>";
			            			str = str + "<tr>";
			            			str = str + "<th>SNO</th>";
			            			str = str + "<th>Reg ID</th>"
			            			str = str + "<th>Discount</th>"
			            			str = str + "<th>Auto Paid Amount (Rs.)</th>"
			            			str = str + "<th>Receipt</th>";
			            			str = str + "</tr>";
			            			for(i=0; i<obj.length; i++){
			            				sno++;
			            				str = str + "<tr>";
			            				str = str + "<td>"+sno+"</td>";
			            				str = str + "<td>"+obj[i].zero_regid+"</td>";
			            				str = str + "<td>"+obj[i].discount+"</td>";
			            				str = str + "<td>Rs. 0/-</td>";
			            				str = str + "<td><a href='"+site_url_+"/fee/fee_print/"+obj[i].zero_receipt_id+"' class='view_invoice_1' target='_blank'>View</a></td>";
			            				str = str + "</tr>";
			            			}
		            				str = str + "</table>"
		            			} else {
		            				str = "No Data Found for 0 receipt."
		            			}
		            			$('#class_invoices_here').html(str);
		            			$('#cmdPayZeroReceipt').val('Zero Receipt');
		            		},
		            		error: function(xhr, status, error){
		            			$('#class_invoices_here').html(xhr.responsetext);
		            		}
		            	});
		            }
		        } else {
		        	alert('Please select class first.');
		        }
			});
			$('body').on('click', '.myreceipt_from_invoice', function(){
				var id_ = this.id;
				var class__ = 'cmbClassForInvoice';
				var container_ = 'class_invoices_here';
                call_myreceipt(id_, class__, container_);
			});
			$('body').on('click', '.myreceipt', function(){
				var id_ = this.id;
				var class__ = 'class_in_session_for_Receipt';
				var container_ = 'class_PayFee_here';
                call_myreceipt(id_, class__, container_);
			});
			function call_myreceipt(id_, class__, container_){

				/*
		            If need to change something in this code then also change the same in My_fee_model.php {pay_zero_amount AND evaluate_discount functions} 
		            because they both are doing the same operation. Actually pay_zero_amount AND evaluate_discount functions are used to prepare the receipt 
		            for zero amount
		        */

		        var arr = id_.split('_');
		        var invdetid = arr[1];
		        var regid_ = arr[2];
		        
		        data_ = "invdetid="+invdetid+"&clssessid="+$('#'+class__).val()+"&regid_="+regid_;
		        url_ = site_url_ + "/fee/show_student_data_for_receipt";
		        
		        $.ajax({
		            type: 'post',
		            url: url_,
		            data: data_,
		            success: function(data){
		                var obj = JSON.parse(data);
                        
		                var name_ = ((obj.fetch_receipt_data[0].FNAME == "-x-") ? "":obj.fetch_receipt_data[0].FNAME);
		                name_ = name_ + ((obj.fetch_receipt_data[0].MNAME == "-x-") ? "":" "+obj.fetch_receipt_data[0].MNAME);
		                name_ = name_ + ((obj.fetch_receipt_data[0].LNAME == "-x-") ? "":obj.fetch_receipt_data[0].LNAME);
		                
		                var nom_ = parseInt(obj.fetch_receipt_data[0].NOM);
		                //amount_ = parseFloat(obj.fetch_receipt_data[0].ACTUAL_AMOUNT)/parseInt(obj.fetch_receipt_data[0].NOM);
		                var amount_ = parseFloat(obj.fetch_receipt_data[0].DUE_AMOUNT);
		                var pay_amount = obj.fetch_receipt_data[0].DUE_AMOUNT;
		                var actual_ = parseFloat(obj.fetch_receipt_data[0].ACTUAL_AMOUNT);
		                var amount_to_apply_discount = parseFloat(obj.fetch_receipt_data[0].APPLICABLE_DISCOUNT_AMOUNT);
		                var due_actual = amount_ - parseFloat(obj.fetch_receipt_data[0].ACTUAL_AMOUNT);
		                var total_categ_discount_amount = 0;
		                var total_sibling_discount_amount = 0;
		                var total_other_discount_amount = 0;

		                if(due_actual < 0){
		                    due_actual = 0;
		                }
		                var fixed_heads = '';
		                if(obj.fetch_receipt_data[0].STATIC_HEADS_1_TIME != ''){
		                	var str = obj.fetch_receipt_data[0].STATIC_HEADS_1_TIME;
		                	var temp_static_heads_1_time = str.split(',');
		                	for(i=0;i<temp_static_heads_1_time.length;i++){
		                		fixed_heads = fixed_heads + ", " + temp_static_heads_1_time[i].split('@')[0];
		                	}
		            	}
		                if(obj.fetch_receipt_data[0].STATIC_HEADS_N_TIMES != ''){
		                	var str = obj.fetch_receipt_data[0].STATIC_HEADS_N_TIMES;
		                	var temp_static_heads_n_time = str.split(',');
		                	for(i=0;i<temp_static_heads_n_time.length;i++){
		                		fixed_heads = fixed_heads + ", " + temp_static_heads_n_time[i].split('@')[0];
		                	}
		            	}

		            	var flexi_heads = '';
		                if(obj.fetch_receipt_data[0].FLEXIBLE_HEADS_1_TIME != ''){
		                	flexi_heads = flexi_heads + obj.fetch_receipt_data[0].FLEXIBLE_HEADS_1_TIME;
		            	}
		                if(obj.fetch_receipt_data[0].FLEXIBLE_HEADS_N_TIMES != ''){
		                	flexi_heads = flexi_heads + ", " + obj.fetch_receipt_data[0].FLEXIBLE_HEADS_N_TIMES;
		            	}
		                
		                // Calculation of discount for category or sibling or Other discount
		                var total_other_discount_amount = 0;
		                var calculated_amount = 0;
		                var other_discount_items = '';

		                if(amount_to_apply_discount != 0){
		                	if(obj.other_discount_data.res_ == true){
		                		var other_discount_arr = (obj.other_discount_data.data_['DISCOUNT']).split(',');
		                		var other_discount_length = parseInt(other_discount_arr.length);

		                		if(other_discount_arr.length != 0){
		                			other_discount_items = obj.other_discount_data.data_['DISCOUNT'];
		                		}
                                
		                		for(d=0;d<parseInt(other_discount_arr.length);d++){
		                			for(k=0;k<parseInt(obj.fetch_other_discount_data.length);k++){
		                				calculated_amount = 0;
		                				if(other_discount_arr[d] == obj.fetch_other_discount_data[k].ITEM_){
		                					if(obj.fetch_other_discount_data[k].STATUS_ == 'Percentage'){
		                						calculated_amount = parseInt(parseInt(amount_to_apply_discount)*(parseInt(obj.fetch_other_discount_data[k].AMOUNT)/100));
		                					} else {
		                						calculated_amount = (obj.fetch_other_discount_data[k].AMOUNT*nom_);
		                					}
		                					total_other_discount_amount = parseInt(total_other_discount_amount) + parseInt(calculated_amount);
		                				}
		                			}
		                		}
		                	} else {
		                		var total_other_discount_amount = 0;
		                	}
		                }
		                	var discount_category = 'x';
		                	var total_sibling = 0;
		                	var total_sibling_discount_amount = 0;
		                	/* Here no need to calculate Sibling discount as this dicount is also calculated in other_discounts
		                	if(obj.sibling_discount != null){
		                		var sibling_arr = (obj.sibling_discount.SIBLINGS).split(',');
		                		var sibling_length = parseInt(sibling_arr.length);
		                		var discount_sibling_value = 0;
		                		if(obj.fetch_discount_data != null){
		                			var discount_sibling_value = obj.fetch_discount_data.AMOUNT;

		                			if(obj.fetch_discount_data.STATUS_ == 'Percentage'){
			                			var discount_amt = parseInt(parseInt(actual_)*(parseInt(discount_sibling_value)/100));
			                			var total_sibling_discount_amount = discount_amt;
			                			//var total_sibling_discount_amount = parseInt(discount_amt) * sibling_length;
			                		} else {
			                			var total_sibling_discount_amount = parseInt(discount_sibling_value) * parseInt(sibling_length);
			                		}
		                		}
		                		discount_category = 'SIBLINGS';
		                	} else {
		                		var total_sibling = 0;
		                		var total_sibling_discount_amount = 0;
		                	}
		                	*/
		                	//alert(total_sibling_discount_amount);
		                	if(obj.fetch_category_discount_data.res_ == true){
		                		var categ_discount_amnt = obj.fetch_category_discount_data.data_['AMOUNT'];
		                		if(obj.fetch_category_discount_data.data_['STATUS_'] == 'Percentage'){
		                			var total_categ_discount_amount = parseInt(parseInt(amount_to_apply_discount)*(parseInt(categ_discount_amnt)/100));
		                		} else {
		                			var total_categ_discount_amount = (categ_discount_amnt*nom_);
		                		}
		                		if(discount_category != 'x'){
		                			if(obj.fetch_category_discount_data.data_['ITEM_'] != 'GENERAL'){
		                				discount_category = discount_category + "," + obj.fetch_category_discount_data.data_['ITEM_'];
		                			}
		                		} else {
		                			if(obj.fetch_category_discount_data.data_['ITEM_'] != 'GENERAL'){
		                				discount_category = obj.fetch_category_discount_data.data_['ITEM_'];
		                			}
		                		}
		                	} else {
		                		var total_categ_discount_amount = 0;
		                	}
		                	
		                	if(obj.other_discount_data.res_ == true){
		                		discount_category = discount_category + "," + obj.other_discount_data.data_['DISCOUNT'] + ""
		                	}
		                	
		                	//alert(total_categ_discount_amount);
		                	var category_amount_to_store = '';
		                	if(total_sibling_discount_amount != 0){
		                		category_amount_to_store = category_amount_to_store + total_sibling_discount_amount;
		                	}
		                	if(total_categ_discount_amount != 0 && category_amount_to_store != ''){
		                		category_amount_to_store = category_amount_to_store + "," + total_categ_discount_amount;	
		                	} else if(total_categ_discount_amount != 0){
		                		category_amount_to_store = category_amount_to_store + total_categ_discount_amount;
		                	}

		                	if(total_other_discount_amount != 0){
		                		category_amount_to_store = category_amount_to_store + "," + total_other_discount_amount;
		                	}

		                	var discount_if_any = 0;
		                	discount_if_any = parseInt(discount_if_any) + parseInt(total_sibling_discount_amount) + parseInt(total_categ_discount_amount) + parseInt(total_other_discount_amount);
                            
		                // -----------------------------------------------
		                var fine_if_any = 0;
		                total_amount = (parseFloat(pay_amount)+parseInt(fine_if_any))-parseInt(discount_if_any);
		                /*
		                if(total_amount < 0){
		                    total_amount = 0;
		                }
		                */
		                var str_html='';
		                var total_amount_words = Math.abs(total_amount);
		                var words = inWords(total_amount_words);

		                str_html = "<center>";
		                str_html = str_html + "<form name='frmReceiptCreation' id='frmReceiptCreation'>";
		                str_html = str_html + "<input type='hidden' name='txtINVDETID' id='txtINVDETID' value='"+obj.fetch_receipt_data[0].INVDETID+"' />";
		                str_html = str_html + "<input type='hidden' name='txtREGID' id='txtREGID' value='"+obj.fetch_receipt_data[0].REGID+"' />";
		                str_html = str_html + "<input type='hidden' name='txtFlexiHeads' id='txtFlexiHeads' value='"+flexi_heads+"' />";
		                if(category_amount_to_store != ''){
		                	str_html = str_html + "<input type='hidden' name='txtDiscountCategory' id='txtDiscountCategory' value='"+discount_category+"|"+category_amount_to_store+"' />";
		            	} else {
		            		str_html = str_html + "<input type='hidden' name='txtDiscountCategory' id='txtDiscountCategory' value='"+discount_category+"' />";
		            	}
		                str_html = str_html + "<table style='width: 800px; font-size: 13px; font-family: verdana; border:#808080 solid 1px; background: #ffffff' class='table print_me'><tr height='100'>";
		                str_html = str_html + "<td align='left' style='width: 150px; padding: 0px 0px 0px 8px; vertical-align: middle'>Date: <u>"+obj.date_+"</u></td>";
		                str_html = str_html + "<td align='center' style='width: 500px;padding: 0px 0px 0px 8px; vertical-align: middle'><h4 align='center'><b>"+obj.sch_name+"</b><br />Receipt</h4></td>";
		                str_html = str_html + "<td align='right' style='width: 150px;font-size: 13px; padding: 0px 8px 0px 0px; vertical-align: middle'>Receipt No. <span style='border-radius: 5px; border: #000000 solid 1px; padding: 5px;' id='receiptNo'>?</span></td>";
		                str_html = str_html + "</tr>";
		                str_html = str_html + "<tr>";
		                str_html = str_html + "<td colspan='3'>";
		                str_html = str_html + "<table class='table'>";
		                str_html = str_html + "<tr><td>";
		                str_html = str_html + "<table class='table' style='border:#ff0000 solid 0px; width: 360px;'>";
		                str_html = str_html + "<tr>";
		                str_html = str_html + "<td width='100'>Reg. No. </td>";
		                str_html = str_html + "<td width='260'>: "+obj.fetch_receipt_data[0].REGID+"</td>";
		                str_html = str_html + "</tr>";
		                str_html = str_html + "<tr>";
		                str_html = str_html + "<td>Name </td>";
		                str_html = str_html + "<td>: "+name_+"</td>";
		                str_html = str_html + "</tr>";
		                str_html = str_html + "<tr>";
		                str_html = str_html + "<td>Class </td>";
		                str_html = str_html + "<td>: "+obj.fetch_receipt_data[0].CLASSID+"</td>";
		                str_html = str_html + "</tr>";
		                str_html = str_html + "<tr>";
		                str_html = str_html + "<td>Session </td>";
		                str_html = str_html + "<td>: "+obj.fetch_receipt_data[0].SESSID+"</td>";
		                str_html = str_html + "</tr>";
		                str_html = str_html + "<tr>";
		                str_html = str_html + "<td>Father </td>";
		                str_html = str_html + "<td>: "+obj.fetch_receipt_data[0].FATHER+"</td>";
		                str_html = str_html + "</tr>";
		                str_html = str_html + "<tr>";
		                str_html = str_html + "<td colspan='2' style='color: #900000; text-decoration: underline; padding: 10px 0px 0px 0px'>Fee Detail Below:</td>";
		                str_html = str_html + "</tr>";
		                str_html = str_html + "<tr style='background: #f0f0f0; color: #900000'>";
		                str_html = str_html + "<td>Actual Fee </td>";
		                str_html = str_html + "<td>: Rs. "+actual_+"/-</td>";
		                str_html = str_html + "</tr>";
		                str_html = str_html + "<tr style='background: #f0f0f0; color: #900000'>";
		                str_html = str_html + "<td>Previous Due </td>";
		                str_html = str_html + "<td>: Rs. "+due_actual+"/-</td>";
		                str_html = str_html + "</tr>";
		                str_html = str_html + "<tr style='background: #f0f0f0; color: #900000'>";
		                str_html = str_html + "<td><b>Total Due</b> </td>";
		                str_html = str_html + "<td>: <b>Rs. "+amount_+"/-</b></td>";
		                str_html = str_html + "</tr>";
		                str_html = str_html + "</table>";
		                str_html = str_html + "</td>";
		                str_html = str_html + "<td>";
		                str_html = str_html + "<table class='table' style='border-bottom: #000000 solid 1px; border:#ff0000 solid 0px; width: 360px; float: right'>";
		                str_html = str_html + "<tr>";
		                str_html = str_html + "<td width='200px'>Total Due <span style='float: right; padding: 8px 0px; font-size: 11px' class='fa fa-plus'></span></td>";
		                str_html = str_html + "<td width='160px'><label class='receipt_label'>: Rs. "+pay_amount+"</label><input type='hidden' id='due_amnt_input' name='due_amnt_input' value="+pay_amount+" style='width: 100px; padding: 0px; border:#f0f0f0 solid 1px' /></td>";
		                str_html = str_html + "</tr>";
		                str_html = str_html + "<tr>";
		                str_html = str_html + "<td style='color: #909000'>Discount? <span style='float: right; padding: 8px 0px; font-size: 11px' class='fa fa-minus'></span>";
		                str_html = str_html + "<div style='float: left; font-size: 8px; color: #0000ff; clear: both'>";
		                if(discount_category != '' && discount_category != 'x'){
		                str_html = str_html + discount_category;//+ "("+total_other_discount_amount;
		            	}
		                str_html = str_html + "</div>";
		                str_html = str_html + "</td>"
		                str_html = str_html + "<td><label class='receipt_label'>: Rs.</label><span class='receipt_content'><input type='text' id='_discount_' name='_discount_' value="+discount_if_any+" style='width: 100px; padding: 0px; background: #f0f000; border:#000000 solid 0px' />/-</span></td>";
		                str_html = str_html + "</tr>";
		                str_html = str_html + "<tr>";
		                str_html = str_html + "<td style='color: #909000'>Fine? <span style='float: right; padding: 8px 0px; font-size: 11px' class='fa fa-plus'></span></td>";
		                str_html = str_html + "<td><label class='receipt_label'>: Rs.</label><span class='receipt_content'><input type='text' id='_fine_' name='_fine_' value="+fine_if_any+" style='width: 100px; padding: 0px; background: #f0f000; border:#000000 solid 0px' />/-</span></td>";
		                str_html = str_html + "</tr>";
		                str_html = str_html + "<tr style='font-weight: bold'>"
		                str_html = str_html + "<td>Total </td>";
		                str_html = str_html + "<td><label class='receipt_label'>: Rs. </label><span class='receipt_content'><span class='total_amnt' id='total_amnt_display'>"+total_amount+"</span><input type='hidden' id='total_amnt' name='total_amnt' value='"+total_amount+"' style='width: 100px; padding: 0px; border:#000000 solid 0px; font-weight: bold' />/-</span></td>";
		                str_html = str_html + "</tr>";
		                str_html = str_html + "<tr>"
		                str_html = str_html + "<td><input type='button' class='btn btn-danger' style='border-radius: 3px; padding: 1px 3px; font-size: 11px' id='update_total' value='Update' /></td>";
		                str_html = str_html + "<td style='font-size: 10px; text-align: right; width: 200px'><span id='total_amnt_in_words'>"+words.toUpperCase()+"</span></td>";
		                str_html = str_html + "</tr>";
		                str_html = str_html + "<tr>";
		                str_html = str_html + "<td width='200px' style='background: #406373; color: #ffffff'>Paid Amount </td>";
		                str_html = str_html + "<td width='160px' style='background: #406373; color: #ffffff'><label class='receipt_label'>: Rs. </label><span class='receipt_content'><input type='text' id='paid_amount' name='paid_amount' placeholder='"+total_amount+"' value='"+total_amount+"' style='width: 100px; padding: 0px; border:#f0f0f0 solid 1px; color: #0000ff; font-weight: bold' />/-</span></td>";
		                str_html = str_html + "</tr>";
		                str_html = str_html + "<tr>";
		                str_html = str_html + "<td style='font-size: 13px; color: #0000ff; padding:8px 0px 0px 8px'>Payment Mode </td>";
		                str_html = str_html + "<td>";
		                str_html = str_html + ": <select name='cmbPaymentMode' id='cmbPaymentMode' style='color: #0000ff; font-size: 13px; width: 100px'>";
		                str_html = str_html + "<option value='cash'>Cash</option>";
		                str_html = str_html + "<option value='cheque'>Cheque</option>";
		                str_html = str_html + "<option value='DD'>Demand Draft</option>";
		                str_html = str_html + "</select><br />";
		                str_html = str_html + "<div style='border-radius: 5px; background: #505050; color: #ffffff; padding: 0px 3px; width: 100%; float: left; display: none; border: #ff0000 solid 0px' id='_noncashdetail'>";
		                str_html = str_html + "<div style='float: left'>";
		                str_html = str_html + "<b id='_ccdd_no' style='font-size: 9px'></b> No.<br /><input type='text' style='width: 75px; padding: 0px' name='txtCCDDNumber' id='txtCCDDNumber' />&nbsp;";
		                str_html = str_html + "</div>";
		                str_html = str_html + "<div style='float: right'>";
		                str_html = str_html + "<b id='_ccdd_dt' style='font-size: 9px'></b> Date<br /><input type='text' style='width: 75px; padding: 0px' name='txtCCDDDate' id='txtCCDDDate' />";
		                str_html = str_html + "</div>";
		                str_html = str_html + "</div>";
		                str_html = str_html + "</td>";
		                str_html = str_html + "</tr>";
		                str_html = str_html + "</table>";
		                str_html = str_html + "</td></tr>";
		                
		                str_html = str_html + "<tr><td colspan='2'>";
		                str_html = str_html + "<label>Any Remark?</label><div style='clear: both'></div><textarea name='txtDesc' id='txtDesc' style='width: 360px; height:80px' /></textarea>";
		                str_html = str_html + "</td></tr>";
		                str_html = str_html + "<tr><td colspan='2' style='font-size: 12px; text-align: center'>";
		                str_html = str_html + "<b>Address</b>: " + obj.sch_address + "<br />";
		                str_html = str_html + "<b>Mob.</b>: " + obj.sch_contact + " - ";
		                str_html = str_html + "<b>Email.</b>: " + obj.sch_email;
		                str_html = str_html + "</td></tr>";
		                str_html = str_html + "<tr><td colspan='2' style='font-size: 10px'>";
		                if(fixed_heads.trim() != ''){
		                	str_html = str_html + "<sup>*</sup>Fee Heads: "+fixed_heads;
		            	} else {
		            		str_html = str_html + "<sup>*</sup>Fee Heads: ";
		            	}
		                if(flexi_heads.trim() != ''){
		                    str_html = str_html + ", "+flexi_heads;
		                }
		                str_html = str_html + "</td></tr>";
		                
		                //if(total_amount > 0){
		                    display_ = 'visibility:visible;';
		                //} else {
		                //    display_ = 'visibility:hidden;';
		                //}
		                
		                str_html = str_html + "<tr><td colspan='2'>";
		                str_html = str_html + "<div class='col-sm-5' style='"+display_+"font-size: 10px; text-align: right' id='submit_print'>";
		                str_html = str_html + "<input type='button' value='Submit Fee' class='btn btn-primary' id='cmbReceiptButton' />";
		                str_html = str_html + "</div>";
		                str_html = str_html + "</td></tr></table>";
		                
		                str_html = str_html + "</form>";
		                str_html = str_html + "<center>";
		                
		                $('#'+container_).html(str_html);    
		                $('#'+class__).val("Class");
		                $('#s2id_'+class__+' span').text("Class");   
		            }, error: function (xhr, ajaxOptions, thrownError) {       
	                    $("#"+container_).append(xhr.responseText);
	                }
		        });
		    }
		    
			$('body').on('change', '#cmbPaymentMode', function(){
		        if($('#cmbPaymentMode').val() != 'cash'){
		            if($('#cmbPaymentMode').val() == 'cheque'){
		                $('#_ccdd_no').html('Cheque');
		                $('#_ccdd_dt').html('Cheque');
		            } else {
		                $('#_ccdd_no').html('DD');
		                $('#_ccdd_dt').html('DD');
		            }
		            $('#_noncashdetail').css({
		                'display':'block'
		            });
		        } else {
		            $('#_noncashdetail').css({
		                'display':'none'
		            });
		        }
		    });
		    
		    $('body').on('click', '#update_total', function(){
		        if($.trim($('#due_amnt_input').val()) != '' && $.trim($('#_discount_').val()) != '' && $.trim($('#_fine_').val()) != ''){
		            var due_amnt = parseInt($('#due_amnt_input').val());
		            var dis_ = parseInt($('#_discount_').val());
		            var fine = parseInt($('#_fine_').val());
		            var total_amnt = (due_amnt + fine) - dis_;
		            /*if(total_amnt < 0){
		                total_amnt = 0;
		            }
		            */
		            $('#total_amnt').val(total_amnt);
		            $('#total_amnt_display').html(total_amnt);
		            words_ = inWords(Math.abs(total_amount));
		            $('#total_amnt_in_words').html(words_.toUpperCase());
		            $('#paid_amount').val(total_amnt);
		            //if(total_amnt >= 0){
		                //desc_ = $('#txtDesc').val();
		                $('#submit_print').css({'visibility':'visible'});
		            //}
		        } else {
		            $('#total_amnt_in_words').html('Please Check all values.');
		            $('#submit_print').css({'visibility':'hidden'});
		        }
		    });
		    $('body').on('blur', '#paid_amount', function(){
		    	if($.trim($('#paid_amount').val())==''){
		    		$('#paid_amount').val('0');
		    	}
		    });
		    $('body').on('keyup', '#paid_amount', function(){
		    	if(isNaN($('#paid_amount').val())){
		    		$('#paid_amount').val('');
		    	}
		    });
		    $('body').on('keypress', '#actual_amnt_input', function(){
		        $('#actual_amnt_input').css({'border': '#f0f0f0 solid 1px'});
		        $('#submit_print').css({'visibility':'hidden'});
		    });
		    $('body').on('keypress', '#due_amnt_input', function(){
		        $('#due_amnt_input').css({'border': '#f0f0f0 solid 1px'});
		        $('#submit_print').css({'visibility':'hidden'});
		    });
		    $('body').on('blur', '#_discount_', function(){
		    	if($.trim($('#_discount_').val())==''){
		    		$('#_discount_').val('0');
		    	}
		    });
		    $('body').on('keyup', '#_discount_', function(){
		    	if(isNaN($('#_discount_').val())){
		    		$('#_discount_').val('');
		    	}
		    });
		    $('body').on('keypress', '#_discount_', function(){
		        $('#_discount_').css({'border': '#f0f0f0 solid 1px'});
		        $('#submit_print').css({'visibility':'hidden'});
		    });
		    $('body').on('blur', '#_fine_', function(){
		    	if($.trim($('#_fine_').val())==''){
		    		$('#_fine_').val('0');
		    	}
		    });
		    $('body').on('keyup', '#_fine_', function(){
		    	if(isNaN($('#_fine_').val())){
		    		$('#_fine_').val('');
		    	}
		    });
		    $('body').on('keypress', '#_fine_', function(){
		        $('#_fine_').css({'border': '#f0f0f0 solid 1px'});
		        $('#submit_print').css({'visibility':'hidden'});
		    });
		    $('body').on('click', '#cmbReceiptButton', function(){
		        if($.trim($('#txtDesc').val()) == ""){
		            $('#txtDesc').val('x');
		        }
		        
		        if($.trim($('#due_amnt_input').val()) == ''){
		            $('#due_amnt_input').focus();
		            $('#due_amnt_input').css({'border':'#ff0000 solid 1px'});
		        } else if($.trim($('#_discount_').val()) == ''){
		            $('#_discount_').focus();
		            $('#_discount_').css({'border':'#ff0000 solid 1px'});
		        } else if($.trim($('#_fine_').val()) == ''){
		            $('#_fine_').focus();
		            $('#_fine_').css({'border':'#ff0000 solid 1px'});
		        } else if($('#cmbPaymentMode').val()!='cash' && $.trim($('#txtCCDDNumber').val()) ==''){
		            $('#txtCCDDNumber').focus();
		                $('#txtCCDDNumber').css({'border':'#ff0000 solid 1px'});
		        } else if($('#cmbPaymentMode').val()!='cash' && $.trim($('#txtCCDDDate').val()) ==''){
		                $('#txtCCDDDate').focus();
		                $('#txtCCDDDate').css({'border':'#ff0000 solid 1px'});
		        } else {
		            var flag = 1;
		        	if($('#total_amnt').val() == 0) {
		        		if($.trim($('#txtDesc').val()) == ''){
		        			$('#txtDesc').focus();
		        			$('#txtDesc').css({'border':'#ff0000 solid 1px'});
		        			flag = 0;
		        		} else {
		        		    flag = 1;
		        		}
		        	} else {
		        	    flag =1;
		        	}
		        	    if(flag == 1){
				            data_ = $('#frmReceiptCreation').serialize();
				            url_ = site_url_ + "/fee/createReceipt";
				            $('#submit_print').html('Loading...');
				            $.ajax({
				                url: url_,
				                type: "POST",
				                data: data_,
				                success: function(data){
				                    obj = JSON.parse(data);
				                    if(obj.sms_check != 'NA'){
				                    	$('#myModal').modal('show');
				                    	$('#mobilenumbers').val(obj.student.MOBILE_S);
				                    	$feemsg_for_sms = $('#Fee_Message').val("Fee of Rs. "+obj.student.PAID+" against the Reg ID: "+obj.student.regid+" ("+obj.student.FNAME+") is successfully submitted today.")
				                	} else {
				                		$feemsg_for_sms = '';
				                		if(obj.receipt_id != 'x'){
				                			callSuccess(obj.receipt_msg);
				                		} else {
				                			callDanger(obj.receipt_msg);
				                		}
				                	}
				                    if(obj.receipt_id != 'x'){
				                    	$('#txtFeeSMS').val(obj.receipt_msg);
				                    	$('#submit_print').html("<div style='float: right; color: #ff0000; padding: 0px 0px 0px 0px'><a href='"+site_url_+'/fee/fee_print/'+obj.receipt_id+"' class='btn btn-danger' target='_blank'>Print Fee</a></div><div style='float: right; color: #ff0000; padding: 0px 10px 0px 0px'>"+obj.receipt_msg+"</div>");
				                    } else {
				                    	$('#txtFeeSMS').val(obj.receipt_msg);
				                    	$('#submit_print').html("<div style='float: right; color: #ff0000; padding: 0px 10px 0px 0px'>"+obj.receipt_msg+"</div>");
				                    }
				                    $('#receiptNo').html(obj.receipt_id);
				                }, error: function (xhr, ajaxOptions, thrownError) {       
				                    $("#submit_print").append(xhr.responseText);
				                }
				            });
				        } else {
				            callDanger('If you allowing 0 Amount Receipt then Please enter the reason.');
				        }
		        }
		    return false;
		    });

		    $('body').on('blur', '#txtDesc', function(){
		    	$('#txtDesc').css({'border':'#f0f0f0 solid 1px'});
		    });

		    $('.sendsmsForFee').click(function(){ 
	    	var url_ = site_url_ + "/fee/sendSMS";
	    	var str = this.id;
	    	var arr_ = str.split('_');
	    	var data_ = $('#frmFeeSMS').serialize()+"&check_sms="+arr_[1];
	    	$.ajax({
	    		type: "POST",
	    		url: url_,
	    		data: data_,
	    		success: function(data){
	    			var obj = JSON.parse(data);
	    			callSuccess($('#txtFeeSMS').val()+obj.msg_all);
	    			$('#myModal').modal('hide');
	    		}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
					$('#myModal').modal('hide');
				}
	    	});
	    	
	    	return false;
	    });
		$('.sendsmsForFee2').click(function(){$('.sendsmsForFee').click();});
			// -------------------------------
		$('.chkDiscountsForDiscountedStudents').click(function(){notifySelectedDiscounts();});
		function notifySelectedDiscounts(){
			var d_str = [];
			$('.chkDiscountsForDiscountedStudents:checked').each(function(){
				var x = $(this).val();
				var arr = x.split("~");
				var blocked_data = "<div class='selectedDiscountCSS'>"+arr[1]+"</div>" 
				d_str.push(blocked_data);
			});
			$('#discount_selected').html(d_str.join(' '));
		}
		$('#cmbClassesForDiscountedStudents').change(function(){
			var class_ = $(this).find('option:selected').text().toUpperCase();

			var url_ = site_url_ + "/fee/getDiscountedStudents/"+$(this).val();
			var d_str = [];

			if($('#cmbClassesForDiscountedStudents').val() != 'x' && $('input[name="chkDiscounts[]"]:checked').length > 0){
				var data_ = $('#frmDiscountedStudents').serialize();
				$('#discounted_students_here').html('<tr><td colspan=2>Wait its loading...</td></tr>');
				$.ajax({
					type: 'POST',
					url: url_,
					data: data_,
					success: function(data){
						//var d_str = [];
						var allVals = [];
						//var d_str = $('input[name="chkDiscounts"]:checked').serialize();
						var color_array= ['#900000', '#009000', '#000090', '#909000', '#009090', '#900090'];
						var lenofColors = color_array.length;
						var color_count = 0;
						var obj = JSON.parse(data);
						var str = '';
						var dis_arr = [];
						$('#caption_for_class_for_discounted_students').html('Selected Class - ' + '<span style="background: #ffff00; color: #ff0000; padding: 4px; border-radius: 5px">' + class_ + '</span>');
						$('#caption_for_total_discounted_students').html('<div style="float:right; font-size: 11px">'+obj.discounted_students.length+' Students availing discount(s).</div>')
						notifySelectedDiscounts();
						for(loop1=0; loop1<obj.discounted_students.length; loop1++){
							discount = obj.discounted_students[loop1].DISCOUNT;
							dis_arr = discount.split(',');
							if(dis_arr.length > 1){
								color_ = " style='color: "+color_array[color_count]+"; text-decoration: underline'";
								color_count = color_count + 1;
									if(color_count>lenofColors){ color_count = 0; }
							} else {
								color_ = '';
							}
							for(k=0; k<dis_arr.length; k++){
								str = str + "<tr"+color_+">"
								str = str + "<td>" + obj.discounted_students[loop1].regid + "</td>";
								str = str + "<td>" + obj.discounted_students[loop1].FNAME + "</td>";
								str = str + "<td>" + dis_arr[k]  + "</td>";
								str = str + "</tr>";
							}
						}
						
						$('#discounted_students_here').html(str);
					}
				});
			} else {
				$('#caption_for_class_for_discounted_students').html('Selected Class - ' + '<span style="background: #ffff00; color: #ff0000; padding: 4px; border-radius: 5px">NA</span>');
			}
		});

		$('#cmbShowDiscountedStudents').click(function(){
			$('#cmbClassesForDiscountedStudents').change();
			return false;
		});
	// ----------
	// Common Functions
		function get_months(num){
	        data = {
	                1 : 'January',
	                2 : 'February',
	                3 : 'March',
	                4 : 'April',
	                5 : 'May',
	                6 : 'June',
	                7 : 'July',
	                8 : 'August',
	                9 : 'September',
	                10: 'October',
	                11: 'November',
	                12: 'December'
	            };
	        return data[num];
	    }

	    function findIndex(key,arr) {
		    for(var i=0; i<arr.length; i++) {
		        if(arr[i].REGID == key) {
		            return i;
		        }
		    }
		    return -1;
		}

		var a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
		var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];

		function inWords (num) {
		    if(num == 0){
		        str = "ZERO ONLY";
		    } else {
		        if ((num = num.toString()).length > 9) return 'overflow';
		        n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
		        if (!n) return; var str = '';
		        str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
		        str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
		        str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
		        str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
		        str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'only' : '';
		    }
		    return str;
		}
	// ----------------
	// Promote Students
		$('#promote_student_optAdmission_').click(function(){                    
	        $("#undo_redo").empty();
	        $('#promotionFor').val($('#promote_student_optAdmission_').val());
	        url_ = site_url_ + '/promote/getClassForCurrentSessionAdmission';
	        data_ = 'PromotionFor='+$('#promotionFor').val();
	        $('#s2id_promote_student_cmbAdmFor span').text("...");
	        
	        $.ajax({
	            type    : 'POST',
	            url     : url_,
	            data    : data_,
	            success : function(data){
	                var obj = JSON.parse(data);
	                var str_html = "<option value=''>Select</option>";
	                for(loop1 = 0; loop1<obj.length; loop1++){
	                    str_html = str_html + "<option value='"+ obj[loop1].CLSSESSID +"'>Class "+ obj[loop1].CLASSID +"</option>"
	                }
	                $('#s2id_undo_redo').text('');
	                $("#promote_student_cmbAdmFor").empty();
	                $('#s2id_promote_student_cmbAdmFor span').text("Select");
	                $("#promote_student_cmbAdmFor").html(str_html);
	                $('#promote_student_cmbAdmFor').removeAttr('disabled');
	                $('#forcmbprevAdmSession').html("New Admitted Students for (" + _current_year___ + ")");
	                
	            },
	            error: function(xhr, status, error){
	            	callDanger(xhr.responseText);
	            }
	        });
	    });
	    
	    $('#promote_student_optPreviousSession_').click(function(){
	        $("#undo_redo").empty();
	        $('#promotionFor').val($('#promote_student_optPreviousSession_').val());
	        url_ = site_url_ + '/promote/getClassForCurrentSessionAdmission';
	        data_ = 'PromotionFor='+$('#promotionFor').val();
	        $('#s2id_promote_student_cmbAdmFor span').text("...");
	        
	        $.ajax({
	            type    : 'POST',
	            url     : url_,
	            data    : data_,
	            success : function(data){
	                var obj = JSON.parse(data);
	                var str_html = "<option value=''>Select</option>";
	                for(loop1 = 0; loop1<obj.length; loop1++){
	                    str_html = str_html + "<option value='"+ obj[loop1].CLSSESSID +"'>Class "+ obj[loop1].CLASSID +"</option>"
	                }
	                $('#s2id_undo_redo').text('');
	                $("#promote_student_cmbAdmFor").empty();
	                $('#s2id_promote_student_cmbAdmFor span').text("Select");
	                $("#promote_student_cmbAdmFor").html(str_html);
	                $('#promote_student_cmbAdmFor').removeAttr('disabled');
	                $('#forcmbprevAdmSession').html("Select Students to Promote (" + _previous_year___ + ")");
	                
	            },
	            error: function(xhr, status, error){
	            	callDanger(xhr.responseText);
	            }
	        });
	    });

	    $('#promote_student_cmbAdmFor').change(function(){
	        url_ = site_url_ + '/promote/getStudentForCurrentSession';
	        data_ = 'PromotionFor='+$('#promotionFor').val()+'&ClassSessid_='+$('#promote_student_cmbAdmFor').val();
	        $("#undo_redo").empty();
	        
	        $.ajax({
	            type    : 'POST',
	            url     : url_,
	            data    : data_,
	            success : function(data){
	                var obj = JSON.parse(data);
	                
	                var str_html = "";
	                for(loop1 = 0; loop1<obj.length; loop1++){
	                    str_html = str_html + "<option value='"+ obj[loop1].regid +"'>"+ obj[loop1].FNAME +"</option>"
	                }
	                $("#undo_redo").empty();
	                $("#undo_redo").append(str_html);
	                
	            }, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
	        });
	    });
	    $('.update_promotion').click(function(){
	    	if($('#cmbAdmFor').val() != ''){
	    		
	    		$("#undo_redo_to option").prop("selected",true);
	    		var x = $('#undo_redo_to').val();
	    		data_ = "promotionFor="+$('#promotionFor').val()+"&cmbAdmFor="+$('#cmbAdmFor').val()+"&to="+x.join();
	    		url_ = site_url_ + "/promote/promote_admit_Students_to_class";
	    		$.ajax({
	    			type: "POST",
	    			url: url_,
	    			data: data_,
	    			success: function(data){
	    				var obj = JSON.parse(data);
	    				if(obj.res_ == true){
	    					
	    					callSuccess(obj.msg_);
	    					resetPromoteForm();
	    					if($('#promotionFor').val() == 'Admission'){
	    						$('#promote_student_optAdmission_').click();
	    					} else {
	    						$('#promote_student_optPreviousSession_').click();
	    					}
	    				} else {
	    					callDanger(obj.msg_);
	    				}
	    			}, error: function(xhr, status, error){
	    				callDanger(xhr.ResponseText);
	    				
	    			}
	    		});
	    	} else {
	    		callDanger('Please choose class to promote');
	    		$('#cmbAdmFor').focus();
	    		$('#s2id_cmbAdmFor span').text('Choose Class');
	    	}
	    });
	    $('#cmbAdmittedStudents').change(function(){
	        url_ = site_url_ + '/promote/getStudentsofCurrentSession';
	        data_ = 'ClassSessid_='+$('#cmbAdmittedStudents').val();
	        
	        $("#undo_redo1").empty();
	        $("#undo_redo1").append('Loading...');
	        $.ajax({
	            type    : 'POST',
	            url     : url_,
	            data    : data_,
	            success : function(data){
	                var obj = JSON.parse(data);
	                var str_html = "";
	                for(loop1 = 0; loop1<obj.length; loop1++){
	                    str_html = str_html + "<option value='"+ obj[loop1].regid +"'>"+ obj[loop1].FNAME +"</option>"
	                }
	                $("#undo_redo1").append(str_html);
	                
	            },
	            error: function (xhr, ajaxOptions, thrownError) {
	                //alert(xhr.responseText);
	                str_html = "<option>"+thrownError+" !!</option>";
	                $("#undo_redo1").empty();
	                $("#undo_redo1").append(str_html);
	                
	            }
	        });
	    });
	    function resetPromoteForm(){
	    	$("#undo_redo_to").empty();
	    	$('#promote_student_cmbAdmFor').change();
	    	$("#undo_redo").text('');
	    	
	    }
	// ----------------
	// User Management Modules
		$('#cmbUserStatus').change(function(){
			$id_ = $('#'+this.id).val();
			$("#cmbStaff").empty();
			$('#s2id_cmbStaff span').text("Loading...");
			url_ = site_url_ + "/userManagement/getStaffData/"+$id_;
			
			$.ajax({
				type: "POST",
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					var str_html = "";
					$("#s2id_cmbStaff span").text('Select Member');
					str_html = str_html + "<option value=''>Select Member</option>";
	                for(loop1 = 0; loop1<obj.length; loop1++){
	                    str_html = str_html + "<option value='"+ obj[loop1].teacherID +"'>"+ obj[loop1].name +"</option>"
	                }
	                $("#cmbStaff").append(str_html);
	                
				}, error: function (xhr, ajaxOptions, thrownError) {
	                //alert(xhr.responseText);
	                str_html = "<option>"+thrownError+" !!</option>";
	                $("#cmbStaff").empty();
	                $("#cmbStaff").append(str_html);
	                $("#s2id_cmbStaff span").text(str_html);
	                
	            }
			});
		});
		$('.create-new-user').click(function(){
				$('#txtUser_').removeAttr('disabled');
				if($.trim($('#cmbUserStatus').val()) == ''){
					callDanger('Select User Status.');
				} else if($.trim($('#cmbStaff').val()) == '') {
					callDanger('Select Staff.');
				} else if($.trim($('#txtUser_').val()) == ''){
					callDanger('Enter User.');
				} else {
					if($('.create-new-user').val() != 'Update'){
						url_ = site_url_ + "/userManagement/createuser";
					} else {
						url_ = site_url_ + "/userManagement/updateuser";
					}
					data_ = $('#frmUserManagement').serialize();
					
					$.ajax({
						type: "POST",
						url: url_,
						data: data_,
						success:  function(data){
							var obj = JSON.parse(data);
							if(obj.res_ == true){
								callSuccess(obj.msg_);
								reset_createUserForm();
							} else {
								callDanger(obj.msg_);
							}
							
						}, error: function(xhr, status, error){
							callDanger(xhr.responseText);
						}
					});
				}
		});
		$('body').on('click', '.active-deactive-user', function(){
			var str = this.id;
			var arr = str.split('_');
			var modified_id = "action_user_"+arr[2];
			
			arr[1]
			arr[2]
			url_ = site_url_+"/userManagement/activeDeactiveUser/"+arr[2]+"/"+arr[1];
			$.ajax({
				type: "POST",
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					if(obj.res_ == true){
						if(arr[1] == 0){
							$('#'+modified_id).css('color', '#ff0000');
							$('#'+modified_id).html("<span class='icon-thumbs-down active-deactive-user' id='activedeactive_"+1+"_"+arr[2]+"'></span> | <span class='icon-pencil edituser' id='edit_"+arr[2]+"'></span>");
						} else {
							$('#'+modified_id).css('color', '#009000');
							$('#'+modified_id).html("<span class='icon-thumbs-up active-deactive-user' id='activedeactive_"+0+"_"+arr[2]+"'></span> | <span class='icon-pencil edituser' id='edit_"+arr[2]+"'></span>");
						}
						
					} else {

					}
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});

		});
		$('body').on('click', '.edituser', function(){
			var str = this.id;
			var arr = str.split('_');
			url_ = site_url_+"/userManagement/getUsers/"+arr[1];
			
			$.ajax({
				type: 'POST',
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					$('.create-update-user-form div').addClass('update_color');
					$('#cmbUserStatus').val(obj.CATEGORY_ID);
					$('#s2id_cmbUserStatus span').text(obj.STATUS);
					$('#cmbUserStatus').change();
					$('#cmbStaff').val(obj.STAFFID);
					$('#s2id_cmbStaff span').text(obj.name);
					$('#txtUser_').val(obj.USERNAME_);
					$('#txtUser_').attr('disabled', 'true');
					$('#txtUser_').css('opacity', '.5');
					$('#txtPwd_').val(obj.PASSWORD_);
					$('#create_update_user').val('Update');
					$('#create_update_user').removeClass('btn-success');
					$('#create_update_user').addClass('btn-danger');
					
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		});
	// ---------------
	// Attendance Module
		$('#cmbClassesForStudents').change(function(){
	        if($('#cmbClassesForStudents').val() != 'x' && $('#attendancedate').val() != 'x' && $('#attendanceHour').val() != 'x' && $('#attendanceMin').val() != 'x' && $('#attendanceAMPM').val() != 'x'){
	            classid = $('#cmbClassesForStudents').val();
	            class_ = $('#cmbClassesForStudents').find('option:selected').text();
	            date_ = $('#attendancedate').val();
	            time__ = $('#attendanceHour').val()+":"+$('#attendanceMin').val()+":"+$('#attendanceAMPM').val();

	            url_ = site_url_ + '/attendance/checkExistingAttendance';
	            checkdata_ = 'ClassSessid_='+classid+'&date_='+date_+'&time_='+time__;
	            $('#students_here').html('<tr><td colspan="4"><h6 style="text-align: center">Please wait its loading...</h6></td></tr>');
	            $.ajax({
	                type    : 'POST',
	                url     : url_,
	                data    : checkdata_,
	                success : function(data){
	                	var obj0 = JSON.parse(data);
	                	
	                    if(obj0.res_ == 1){
	                    	$('#status_of_editting').val('new');
	                        if($('#cmbClassesForStudents').find('option:selected').text() == 'Select'){
	                            $('#caption_for_class').html("ATTENDANCE FOR CLASS -");
	                        } else {
	                            $('#caption_for_class').html("ATTENDANCE FOR "+$('#cmbClassesForStudents').find('option:selected').text().toUpperCase());
	                        }
	                        $('#caption_for_class').css('color', '#666666');
	                        $('.student_class_info').css('background', '#efefef');
	                        $('#cmbAddClassSubmit').val('Submit Attendance');
	                        $('#cmbAddClassSubmit').removeClass('btn-danger');
	                        $('#cmbAddClassSubmit').addClass('btn-success');
	                        url_ = site_url_ + '/attendance/getstudentsforclass';
	                        data_ = 'ClassSessid_='+$('#cmbClassesForStudents').val();
	                        $.ajax({
	                            type    : 'POST',
	                            url     : url_,
	                            data    : data_,
	                            success : function(data){
	                            	var obj = JSON.parse(data);
	                            	var str_html = '';
	                            	for(i=0; i<obj.length; i++){
		                            	str_html = str_html + "<tr>";
		                            	str_html = str_html + "<td style='width:30px; text-align: center; background: #f0f0f0'>";
		                            	str_html = str_html + "<div style='float: left; padding: 0px 3px; text-align: center'><input type='checkbox' class='checkboxall' name='attendance_status' id='"+obj[i].regid+"' /></div>";
		                            	str_html = str_html + "<div style='float: left; text-align: center; border-radius:5px; padding: 0px 2px; background:transparent; color:#ff0000; font-weight: bold' class='attd_status' id='"+obj[i].regid+"_status'>Absent</div>"
		                            	str_html = str_html + "</td>";
		                            	str_html = str_html + "<td style='width:120px; text-align: left; background: #ffffff'>";
		                            	str_html = str_html + obj[i].regid;
		                            	str_html = str_html + "</td>";
		                            	str_html = str_html + "<td style='width:auto; text-align: left; background: #ffffff'>";
		                            	str_html = str_html + "<input type='hidden' class='attendance_0_1' name='hidden_attendance_status["+obj[i].regid+"]' id='"+obj[i].regid+"_' value='0' />"+obj[i].FNAME;
		                            	str_html = str_html + "</td>";
		                            	str_html = str_html + "</tr>";
	                            	}
	                                $('#students_here').html(str_html);
	                            }, error: function(xhr, status, error){
									callDanger(xhr.responseText);
								}
	                        });
	                    } else {
	                    	$('#status_of_editting').val('old');
	                    	//var str_html = '';
	                        //str_html = str_html + "<tr><td colspan='3' style='color: #ff0000; background: #ffffff; width:100%; border-radius: 5px; padding: 10px; text-align: center; font-size: 15px'>Attendance for <b>Class "+class_+"</b> with selected date & time is already entered. Please Select another class/ date/ time.</td></tr>";
	                        var str_html = '';
	                        if($('#cmbClassesForStudents').find('option:selected').text() == 'Select'){
	                            $('#caption_for_class').html("ATTENDANCE FOR CLASS -");
	                        } else {
	                            $('#caption_for_class').html("UPDATE ATTENDANCE FOR "+$('#cmbClassesForStudents').find('option:selected').text().toUpperCase());
	                        }
	                        $('#caption_for_class').css('color', '#ffffff');
	                        $('.student_class_info').css('background', '#ff0000');
	                        $('#cmbAddClassSubmit').val('Update Attendance');
	                        $('#cmbAddClassSubmit').removeClass('btn-success');
	                        $('#cmbAddClassSubmit').addClass('btn-danger');
	                            	for(i=0; i<obj0.record.length; i++){
		                            	str_html = str_html + "<tr>";
		                            	str_html = str_html + "<td style='width:30px; text-align: center; background: #f0f0f0'>";
		                            	if(obj0.record[i].STATUS == 0){
		                            		str_html = str_html + "<div style='float: left; padding: 0px 2px; text-align: center'><input type='checkbox' class='checkboxall' name='attendance_status' id='"+obj0.record[i].regid+"' /></div>";
		                            		str_html = str_html + "<div style='float: left; text-align: center; border-radius:5px; padding: 0px 2px; background:transparent; color:#ff0000; font-weight: bold' class='attd_status' id='"+obj0.record[i].regid+"_status'>Absent</div>"
		                            	} else {
		                            		str_html = str_html + "<div style='float: left; padding: 0px 2px; text-align: center'><input type='checkbox' checked='checked' class='checkboxall' name='attendance_status' id='"+obj0.record[i].regid+"' /></div>";
		                            		str_html = str_html + "<div style='float: left; text-align: center; border-radius:5px; padding: 0px 2px; background:transparent; color:#009000; font-weight: bold' class='attd_status' id='"+obj0.record[i].regid+"_status'>Present</div>"
		                            	}
		                            	str_html = str_html + "</td>";
		                            	str_html = str_html + "<td style='width:120px; text-align: left; background: #ffffff'>";
		                            	str_html = str_html + obj0.record[i].regid;
		                            	str_html = str_html + "</td>";
		                            	str_html = str_html + "<td style='width:auto; text-align: left; background: #ffffff'>";
		                            	if(obj0.record[i].STATUS == 0){
		                            	str_html = str_html + "<input type='hidden' class='attendance_0_1' name='hidden_attendance_status["+obj0.record[i].regid+"]' id='"+obj0.record[i].regid+"_' value='0' />"+obj0.record[i].FNAME;
		                            	} else {
		                            	str_html = str_html + "<input type='hidden' class='attendance_0_1' name='hidden_attendance_status["+obj0.record[i].regid+"]' id='"+obj0.record[i].regid+"_' value='1' />"+obj0.record[i].FNAME;	
		                            	}
		                            	str_html = str_html + "<input type='hidden' class='attendance_id' name='hidden_attendance_id["+obj0.record[i].regid+"]' id='"+obj0.record[i].ATTID+"_' value='"+obj0.record[i].ATTID+"' />";
		                            	str_html = str_html + "</td>";
		                            	str_html = str_html + "</tr>";
	                            	}
	                                $('#students_here').html(str_html);
	                        
	                    }
	                }, error: function(xhr, status, error){
						callDanger(xhr.responseText);
					}
	            });
	        } else {
	            $('#caption_for_class').html("ATTENDANCE FOR CLASS -");
	            $('#students_here').html('');
	        }
	    });
	    
	    $('#frmAddAttendance').submit(function(){
	            url_ = site_url_+'/attendance/takeattendance';
	            data_ = $('#frmAddAttendance').serialize();
	            class_ = $('#cmbClassesForStudents').find('option:selected').text();
	            
	            $.ajax({
	                type    : 'POST',
	                url     : url_,
	                data    : data_,
	                success : function(data){
	                    obj = JSON.parse(data);
	                    if(obj.no__['messageNo'] == 1){
	                        if(obj.no__['nos'].length != 0){
	                            str = '';
	                            moblength = obj.no__['nos'].length;
	                            if(obj.sms_check != 'NA' && $('#status_of_editting').val() == 'new'){
		                            /* // This below code will be used when you want to send sms to absantee's parents */
		                            for(i=0;i<moblength;i++){
		                                if(i < moblength-1){
		                                    str = str + $.trim(obj.no__['nos'][i].MOBILE_S) + ",";
		                                    str = $.trim(str);
		                                } else if(i == moblength-1){
		                                    str = str + $.trim(obj.no__['nos'][i].MOBILE_S); 
		                                    str = $.trim(str);   
		                                }
		                            }
		                            
		                            $('#mobilenumbers').val(str);

		                            d = obj.no__['nos'][0].DATE_;
		                            dt = d.split('-');
		                            dt_ = dt[2]+"/"+dt[1]+"/"+dt[0];
		                            $('#Absent_Message').val("Your ward is absent today i.e. ("+dt_+"). Please motivate him/her to attend classes regularly.");
		                            $('#MessageToPrint').val("Attendance for class <span style='font-weight: bold; color: #ffff00'>"+class_+"</span> successfully submitted.");
									$('#myModal').modal('show'); // This line will not execute at local machine when obj.sms_check is equals to 'NA'
									/**/
								}
								if($('#status_of_editting').val() == 'old'){
	                            	callSuccess("Attendance for class <span style='font-weight: bold; color: #ffff00'>"+class_+"</span> successfully updated.");
	                        	}
	                        }
	                    } else if(obj.no__['messageNo'] == 2){   
	                        $('#msg_here').html("Something goes wrong. Please try again...");
	                    } else if(obj.no__['messageNo'] == 3){
	                        $('#msg_here').html("Something goes wrong. Please try again...");
	                    }
	                    $('#students_here').html('');
	                    resetAttendanceForm();
	                    
	                }, error: function(xhr, status, error){
						callDanger(xhr.responseText);
					}
	            });
	        return false;
	    });
	    function resetAttendanceForm(){
	    	//$('#resetAttendForm').click();
	    	fillClasses_for_attendance();
	    	$('#atten_check').prop('checked', false);
			$('#uniform-atten_check span').removeClass('checked');
	    }
	    $('.sendsms').click(function(){ 
	    	var url_ = site_url_ + "/attendance/sendSMS";
	    	var str = this.id;
	    	var arr_ = str.split('_');
	    	var data_ = $('#frmSMS').serialize()+"&check_sms="+arr_[1];
	    	$.ajax({
	    		type: "POST",
	    		url: url_,
	    		data: data_,
	    		success: function(data){
	    			var obj = JSON.parse(data);
	    			callSuccess(obj.msg_all);
	    			$('#myModal').modal('hide');
	    		}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
					$('#myModal').modal('hide');
				}
	    	});
	    	
	    	return false;
	    });

	    $('#atten_check').change(function(){
	    	if($('#atten_check').prop('checked') == true){
	    		$(".checkboxall").prop('checked', true);
	    		$('#selectall_label').html('De-Select All');
	        	$('.attendance_0_1').val('1');
	        	$('.attd_status').html('Present');
	            $('.attd_status').css('color', '#009000');
	            $('.attd_status').css('background', 'transparent');
	    	} else {
	    		$(".checkboxall").prop('checked', false);
	    		$('#selectall_label').html('Select All');
	        	$('.attendance_0_1').val('0');
	        	$('.attd_status').html('Absent');
	            $('.attd_status').css('color', '#ff0000');
	            $('.attd_status').css('background', 'transparent');
	    	}
	    });
	    

	    $(".checkboxall").live('click', function(){
	        if($('#'+this.id).prop( "checked" ) == true){
	            $('#'+this.id+'_').val('1');
	            $('#'+this.id+'_status').html('Present');
	            $('#'+this.id+'_status').css('color', '#009000');
	            $('#'+this.id+'_status').css('background', 'transparent');
	        } else {
	            $('#'+this.id+'_').val('0');
	            $('#'+this.id+'_status').html('Absent');
	            $('#'+this.id+'_status').css('color', '#ff0000');
	            $('#'+this.id+'_status').css('background', 'transparent');
	        }
	    });

	    $('#attendancedate').change(function(){ 
	        $('#cmbClassesForStudents').change();
	    });

	    $('#attendanceHour').change(function(){
	        $('#cmbClassesForStudents').change();
	    });

	    $('#attendanceMin').change(function(){
	        $('#cmbClassesForStudents').change();
	    });

	    $('#attendanceAMPM').change(function(){
	        $('#cmbClassesForStudents').change();
	    });

	    $('#frmViewDaywiseAttendance').submit(function(){
	        var str_html = '';
	        class_ = $('#cmbClassesForStudents_view').find('option:selected').text();
	        url_ = site_url_+'/attendance/fetchdaywiseresult';
	        data_ = $('#frmViewDaywiseAttendance').serialize();
	        $('#printHead').html('Attendance -');
	        $('#view_day_wise_attendance').html('<h6 style="text-align: center">Please wait its loading...</h6>');
	        $.ajax({
	            type    : 'POST',
	            url     : url_,
	            data    : data_,
	            success : function(data){
	                var obj = JSON.parse(data);
	                if(obj.time_.length != 0){
	                    count = obj.time_.length;
	                    count = count + 3;

	                    var dt = $("#attendancedate").val();
	                    
	                    $('#printHead').html('Attendance for '+class_+' for ('+dt+')');

	                    str_html = str_html + '<table class="table table-bordered" border="1" cellpadding="2" cellspacing="0" width="100%">';
	                    str_html = str_html + '<thead>';
						str_html = str_html + '<tr>';
						str_html = str_html + '<th style="min-width: 10%">Reg. No.</th>'
						str_html = str_html + '<th style="min-width: 80%">Student Name</th>';

	                    for(tm=0; tm<obj.time_.length; tm++){
	                        str_html = str_html + "<th>"+obj.time_[tm].TIME_+"</th>";
	                    }
	                    str_html = str_html + "<th style='color: #0000ff; text-align: center'>Total</th>";
	                    str_html = str_html + "</tr>";

	                    for(loop1 = 0; loop1<obj.students.length; loop1++){
	                        str_html = str_html + "<tr>";
	                        str_html = str_html + "<td align='left'>" + obj.students[loop1].regid + "</td>";
	                        str_html = str_html + "<td align='left'>" + obj.students[loop1].FNAME + "</td>";
	                        var total = 0;
	                        for(tm=0; tm<obj.time_.length; tm++){
	                            for(loop2=0;loop2<obj.daywise.length; loop2++){
	                                if(obj.time_[tm].TIME_ == obj.daywise[loop2].TIME_ && obj.students[loop1].regid == obj.daywise[loop2].regid){
	                                    total = total + parseInt(obj.daywise[loop2].STATUS);
	                                    if(obj.daywise[loop2].STATUS==1){st_ = "<span style='font-weight: bold'>P</span>";}else{st_ = "<span style='color: #ff0000; font-weight: bold'>A</span>";}
	                                    str_html = str_html + "<td align='left'>" +st_+ "</td>";
	                                }
	                            }
	                        }
	                        str_html = str_html + "<td align='left'>" + total + "</td>";
	                        str_html = str_html + "</tr>";
	                    }
	                    $('#my_print_btn').css('visibility', 'visible');
	                } else {
	                    str_html = "<span style='color: #ff0000; padding: 10px'>No Attendance found for the selected Date</span>";
	                }   
	                $('#view_day_wise_attendance').html(str_html);
	                

	            }, error: function(xhr, status, error){
	            	callDanger(xhr.responsetext);
	            }
	        });
	    return false;
	    });

		$('#my_print_btn').click(function(){
			var divToPrint=document.getElementById("printTable");
		   newWin= window.open("");
		   newWin.document.write(divToPrint.outerHTML);
		   newWin.print();
		   //newWin.close();
		});

	    $('#frmViewConsolidateAttendance').submit(function(){
	        var str_html = '';
	        class_ = $('#cmbClassesForStudents_view').find('option:selected').text();
	        url_ = site_url_+'/attendance/fetchConsolidateresult';
	        data_ = $('#frmViewConsolidateAttendance').serialize();
	        $('#view_consolidate_attendance').html('<h6 style="text-align: center">Please wait its loading...');
	        $.ajax({
	            type    : 'POST',
	            url     : url_,
	            data    : data_,
	            success : function(data){
	                obj = JSON.parse(data);

	                var totalClasses = obj.time_.length; // It is used to store Total classes between the selected dates timewise
	                var limitpercentage = 75;
	                if(obj.date_.length != 0){
	                    var dt1 = $("#attendancedatefrom").val();
	                    var dt2 = $("#attendancedateto").val();
	                    $('#printHead').html('Attendance for '+class_+' from ('+dt1+') to ('+dt2+')');

	                    str_html = str_html + '<table class="table table-bordered" border="1" cellpadding="2" cellspacing="0" width="100%">';
	                    str_html = str_html + '<thead>';
						str_html = str_html + '<tr>';
						str_html = str_html + '<th style="min-width: 10%">Reg. No.</th>'
						str_html = str_html + '<th style="min-width: 80%">Student Name</th>';

	                    for(tm=0; tm<obj.date_.length; tm++){
	                        d = obj.date_[tm].DATE_;
	                        dt = d.split('-');
		                    dt_ = dt[2]+"/"+dt[1]+"/"+dt[0];
	                        str_html = str_html + "<th style='text-align: center !important'>"+dt_+"</th>";
	                    }
	                    str_html = str_html + "<th style='text-align: center !important'>Attended</th>";
	                    str_html = str_html + "<th style='color: #0000ff; text-align: center !important'>Total held</th>";
	                    str_html = str_html + "<th style='color: #ff0000; text-align: right !important'>%age</th>";
	                    str_html = str_html + "</tr>";

	                    for(loop1 = 0; loop1<obj.students.length; loop1++){
	                        str_html = str_html + "<tr>";
	                        str_html = str_html + "<td align='left'>" + obj.students[loop1].regid + "</td>";
	                        str_html = str_html + "<td align='left'>" + obj.students[loop1].FNAME + "</td>";
	                        var total = 0; // It is used to store the total classes attended by the student
	                        for(tm=0; tm<obj.date_.length; tm++){
	                            var t_ = 0; // It is a temporary variable to calculate the total attended classes datewise
	                            var stc_ = '';
	                            for(loop2=0;loop2<obj.consolidate.length; loop2++){
	                                if(obj.date_[tm].DATE_ == obj.consolidate[loop2].DATE_ && obj.students[loop1].regid == obj.consolidate[loop2].regid){
	                                   t_ = t_ + parseInt(obj.consolidate[loop2].STATUS);
	                                   if(obj.consolidate[loop2].STATUS==1){stc_ = stc_ + "<span style='font-weight: bold; margin: 0px 1px'>P</span>";}else{stc_ = stc_ + "<span style='color: #ff0000; font-weight: bold; margin: 0px 1px'>A</span>";}
	                                }
	                            }
	                            str_html = str_html + "<td style='text-align: center !important'>" + stc_ + "</td>";
	                            total = total + t_;
	                        }
	                        str_html = str_html + "<td style='text-align: center'>" + total + "</td>";
	                        str_html = str_html + "<td style='color: #0000ff;text-align: center !important'>" + totalClasses + "</td>";
	                        per = (total/totalClasses)*100;
	                        if(per < limitpercentage){
	                            str_html = str_html + "<td style='color: #ff0000;text-align: right !important'>" + per.toFixed(2) + "</td>";
	                        } else {
	                            str_html = str_html + "<td style='color: #009000;text-align: right !important'>" + per.toFixed(2) + "</td>";
	                        }
	                        str_html = str_html + "</tr>";
	                    }
	                    $('#my_print_btn').css('visibility', 'visible');
	                } else {
	                    str_html = "<span style='color: #ff0000; padding: 10px'>No Attendance found for the selected Dates</span>";
	                }
	                $('#view_consolidate_attendance').html(str_html);
	            }
	        });
	        
	    return false;
	    });

		$('#frmViewTotalAttendance').submit(function(){
	        var str_html = '';
	        class_ = $('#cmbClassesForStudents_view').find('option:selected').text();
	        url_ = site_url_+'/attendance/fetchConsolidateresult';
	        data_ = $('#frmViewTotalAttendance').serialize();
	        $('#printHead').html('Total Attendance for - ');
	        $('#view_consolidate_attendance').html('<h6 style="text-align: center">Please wait its loading...</h6>');
	        $.ajax({
	            type    : 'POST',
	            url     : url_,
	            data    : data_,
	            success : function(data){
	                obj = JSON.parse(data);

	                var totalClasses = obj.time_.length; // It is used to store Total classes between the selected dates timewise
	                var limitpercentage = 75;
	                if(obj.date_.length != 0){
	                    var dt1 = $("#attendancedatefrom").val();
	                    var dt2 = $("#attendancedateto").val();
	                    $('#printHead').html('Total Attendance for '+class_+' from ('+dt1+') to ('+dt2+')');

	                    str_html = str_html + '<table class="table table-bordered" border="1" cellpadding="2" cellspacing="0" width="100%">';
	                    str_html = str_html + '<thead>';
						str_html = str_html + '<tr>';
						str_html = str_html + '<th style="min-width: 10%">Reg. No.</th>'
						str_html = str_html + '<th style="min-width: 80%">Student Name</th>';

	                    for(tm=0; tm<obj.date_.length; tm++){
	                        DT_ = obj.date_[tm].DATE_;
	                        //str_html = str_html + "<th style='text-align: center'>"+DT_+"</th>";
	                    }
	                    str_html = str_html + "<th style='text-align: center !important'>Attended</th>";
	                    str_html = str_html + "<th style='color: #0000ff; text-align: center !important'>Total held</th>";
	                    str_html = str_html + "<th style='color: #ff0000; text-align: right !important'>%age</th>";
	                    str_html = str_html + "</tr>";

	                    for(loop1 = 0; loop1<obj.students.length; loop1++){
	                        str_html = str_html + "<tr>";
	                        str_html = str_html + "<td align='left'>" + obj.students[loop1].regid + "</td>";
	                        str_html = str_html + "<td align='left'>" + obj.students[loop1].FNAME + "</td>";
	                        var total = 0; // It is used to store the total classes attended by the student
	                        for(tm=0; tm<obj.date_.length; tm++){
	                            var t_ = 0; // It is a temporary variable to calculate the total attended classes datewise
	                            for(loop2=0;loop2<obj.consolidate.length; loop2++){
	                                if(obj.date_[tm].DATE_ == obj.consolidate[loop2].DATE_ && obj.students[loop1].regid == obj.consolidate[loop2].regid){
	                                   t_ = t_ + parseInt(obj.consolidate[loop2].STATUS);
	                                }
	                            }
	                            //str_html = str_html + "<td style='text-align: center'>" + t_ + "</td>";
	                            total = total + t_;
	                        }
	                        str_html = str_html + "<td style='text-align: center'>" + total + "</td>";
	                        str_html = str_html + "<td style='color: #0000ff;text-align: center !important'>" + totalClasses + "</td>";
	                        per = (total/totalClasses)*100;
	                        if(per < limitpercentage){
	                            str_html = str_html + "<td style='color: #ff0000;text-align: right !important'>" + per.toFixed(2) + "</td>";
	                        } else {
	                            str_html = str_html + "<td style='color: #009000;text-align: right !important'>" + per.toFixed(2) + "</td>";
	                        }
	                        str_html = str_html + "</tr>";
	                    }
	                    $('#my_print_btn').css('visibility', 'visible');
	                } else {
	                    str_html = "<span style='color: #ff0000; padding: 10px'>No Attendance found for the selected Dates</span>";
	                }
	                $('#view_consolidate_attendance').html(str_html);
	            }
	        });
	        
	    return false;
	    });
	// -----------------

	// Dashboard Reports
		$('body').on('click', '.inTotalClasses', function(){
			var str_id = this.id;
			var id_ = str_id.split('~');
			$('#txtSearchID').val(id_[0]);
			$('#frmStudentInfoSearch').submit();
		});
		$('body').on('click', '.show_students_as_per_class', function(){
			var id_ = this.id; 
			
			var strarray = id_.split('~');
			var data_ = "classessid="+strarray[0];

			var url_ = site_url_ + "/dashboardReports/get_students";
			$.ajax({
				type: "POST",
				url: url_,
				data: data_,
				success: function(data){
					var obj = JSON.parse(data);
					var str = '';
					for(i=0; i<obj.class_students.length; i++){

						str = str + "<tr>";
						str = str + "<td id='"+obj.class_students[i].regid+"~IntotalClassesID' class='inTotalClasses'>" + obj.class_students[i].regid + "</td>";
						str = str + "<td id='"+obj.class_students[i].regid+"~IntotalClassesName' class='inTotalClasses'>" + obj.class_students[i].FNAME + "</td>";
						str = str + "</tr>";
					}
					$('#class_name').html(strarray[1]);
					$('#student_data_here_as_per_class').html(str);
				}, error: function(xhr, status, error){
					$('#student_data_here_as_per_class').html(xhr.responsetext);
				}
			});

		});
		$('body').on('click', '.classwise_invoices', function(){
			var str = this.id;
			var arr_ = str.split('~');
			var data_ = "clssessid="+arr_[1];
			var show_class = arr_[3];
			var url_ = site_url_+'/dashboardReports/get_invoices_via_ajax';
			$('#invoice_for_class').html("Invoice(s) for <span style='background: #ffff00; color: #900000; font-weight: bold; padding: 0px 4px; border-radius: 3px'>Class "+show_class+"</span> in "+_current_year___);
			$.ajax({
				type: "POST",
				url: url_,
				data: data_,
				success: function(data){
					var obj = JSON.parse(data);
					var str = '';
					var total_invoices = obj.invoices.length;
					if(total_invoices > 0){
						for(i=0; i< total_invoices; i++){
							if(obj.invoices[i].STATUS == 1){
								var css_class = ' class="view_invoice_1"';
								str = str + '<tr class="gradeX">';
								var dueamnt = obj.invoices[i].DUE_AMOUNT;
							} else {
								var css_class = ' class="view_invoice_0"';
								str = str + '<tr class="gradeX" style="color: #B0B0B0; text-decoration: line-through;">';
								if(obj.invoices[i].DUE_AMOUNT != 0){
									var dueamnt = "(c/fwd) " + obj.invoices[i].DUE_AMOUNT;
								} else {
									var dueamnt = obj.invoices[i].DUE_AMOUNT;
								}
							}
							_url_ = site_url_+'/fee/print_invoice/'+obj.invoices[i].INVDETID+"/"+obj.invoices[i].CLSSESSID;
							str = str + '<td style="text-align: center">';
                            str = str + '<a href="'+_url_+'" target="_blank"'+css_class+'>View</a>';
                            str = str + '</td>';
                            str = str + '<td style="text-align: center">';
                            str = str + obj.invoices[i].INVDETID;
                            str = str + '</td>';
                            str = str + '<td style="text-align: center">';
                            str = str + obj.invoices[i].CLASSID;
                            str = str + '</td>';
                            str = str + '<td>';
                            str = str + obj.invoices[i].regid;
                            str = str + '</td>';
                            str = str + '<td>';
                            str = str + obj.invoices[i].FNAME;
                            str = str + '</td>';
                            str = str + '<td style="text-align: right">';
                            pd_amnt = parseInt(obj.invoices[i].PREV_DUE_AMOUNT,10);
                            str = str + pd_amnt;
                            str = str + '</td>';
                            str = str + '<td style="text-align: right">';
                            amnt = parseInt(obj.invoices[i].ACTUAL_DUE_AMOUNT,10);
                            str = str + amnt;
                            str = str + '</td>';
                            str = str + '<td style="text-align: right">';
                            str = str + dueamnt;
                            str = str + '</td>';
                            str = str + '<td style="text-align: center">';
                            str = str + '<a href="'+_url_+'" target="_blank"'+css_class+'>View</a>';
                            str = str + '</td>';
                            str = str + '</tr>';
						}
					} else {
						str = "<td colspan='8' style='color: #ff0000; text-align: center; font-weight: bold; padding:10px'>No Invoice Found...</td>";
					}
					$('#student_invoice_data_here').html(str);
				}, error: function(xhr, status, error){
					$('#student_invoice_data_here').html(xhr.responsetext);
				}
			});
		});
		$('body').on('click', '.classwise_receipts', function(){
			var str = this.id;
			var arr_ = str.split('~');
			var data_ = "clssessid="+arr_[1];
			var show_class = arr_[3];
			var url_ = site_url_+'/dashboardReports/get_receipts_via_ajax';
			$('#receipts_for_class').html("Receipt(s) for <span style='background: #ffff00; color: #900000; font-weight: bold; padding: 0px 4px; border-radius: 3px'>Class "+show_class+"</span> in "+_current_year___);
			$.ajax({
				type: "POST",
				url: url_,
				data: data_,
				success: function(data){
					var obj = JSON.parse(data);
					var str = '';
					var total_receipts = obj.receipts.length;
					if(total_receipts > 0){
						for(i=0; i< total_receipts; i++){
								var css_class = ' class="view_invoice_1"';
								str = str + '<tr class="gradeX">';
								var dueamnt = obj.receipts[i].DUE_AMOUNT;
							_url_ = site_url_+'/fee/fee_print/'+obj.receipts[i].RECPTID;
							str = str + '<td style="text-align: center">';
                            str = str + '<a href="'+_url_+'" target="_blank"'+css_class+'>View</a>';
                            str = str + '</td>';
                            str = str + '<td style="text-align: center">';
                            str = str + obj.receipts[i].RECPTID;
                            str = str + '</td>';
                            str = str + '<td style="text-align: center">';
                            str = str + obj.receipts[i].CLASSID;
                            str = str + '</td>';
                            str = str + '<td>';
                            str = str + obj.receipts[i].regid;
                            str = str + '</td>';
                            str = str + '<td>';
                            str = str + obj.receipts[i].FNAME;
                            str = str + '</td>';
                            str = str + '<td style="text-align: right">';
                            str = str + obj.receipts[i].ACTUAL_PAID_AMT;
                            str = str + '</td>';
                            str = str + '<td style="text-align: right">';
                            discount = (obj.receipts[i].DISCOUNT_AMOUNT != 0) ? obj.receipts[i].DISCOUNT_AMOUNT: '';
                            str = str + discount;
                            str = str + '</td>';
                            str = str + '<td style="text-align: right">';
                            $fine = (obj.receipts[i].FINE != 0) ? obj.receipts[i].FINE : '';
                            str = str + $fine;
                            str = str + '</td>';
                            str = str + '<td style="text-align: right">';
                            str = str + obj.receipts[i].PAID;
                            str = str + '</td>';
                            str = str + '<td style="text-align: center">';
                            str = str + '<a href="'+_url_+'" target="_blank"'+css_class+'>View</a>';
                            str = str + '</td>';
                            str = str + '</tr>';
						}
					} else {
						str = "<td colspan='8' style='color: #ff0000; text-align: center; font-weight: bold; padding:10px'>No Receipt Found...</td>";
					}
					$('#student_receipts_data_here').html(str);
				}, error: function(xhr, status, error){
					$('#student_receipts_data_here').html(xhr.responsetext);
				}
			});
		});

		$('body').on('click', '.classwise_dues', function(){
			$('#chkReminderALL').prop('checked', false);
			$('#uniform-chkReminderALL span').removeClass('checked');
			$('#selectall_reminder').html('Select All');
			var str = this.id;
			var arr_ = str.split('~');
			var data_ = "clssessid="+arr_[1];
			var show_class = arr_[3];
			var url_ = site_url_+'/dashboardReports/get_total_dues_via_ajax';
			$('#class_reminder').val(show_class);
			$('#dues_for_class').html("Total Due(s) in <span style='background: #ffff00; color: #900000; font-weight: bold; padding: 0px 4px; border-radius: 3px'>Class "+show_class+"</span> in "+_current_year___);
			$("#student_dues_data_here").html("<tr><td colspan='7'><h5 style='text-align: center'>Please wait...</h5></td></tr>");
			$('#dues_from_class').html("Amount Due (Rs.)<br>"+"<span style='color: #0000ff'></span>");
			$.ajax({
				type: "POST",
				url: url_,
				data: data_,
				success: function(data){
					var obj = JSON.parse(data);
					var str = '';
					var total_dues = obj.total_dues.length;
					$('#dues_from_class').html("Amount Due (Rs.)<br>"+"<span style='color: #0000ff'>Rs. "+obj.total_class_dues+"/-</span>")
					if(total_dues > 0){
						for(i=0; i< total_dues; i++){
							var duration = obj.total_dues[i].YEAR_FROM+", "+obj.fetch_month[obj.total_dues[i].MONTH_FROM]+" <b style='color:#000090'>to</b><br> "+obj.total_dues[i].YEAR_TO+", "+obj.fetch_month[obj.total_dues[i].MONTH_TO];
							var css_class = ' class="view_invoice_1"';
							str = str + '<tr class="gradeX">';
                            str = str + '<td style="text-align: center">';
                            str = str + obj.total_dues[i].INVDETID;
                            str = str + '</td>';
                            str = str + '<td style="text-align: left">';
                            str = str + '<div style="float: left; margin: 0px 2px">';
                            str = str + '<input type="checkbox" class="chkReminder" name="chkReminder" value="'+obj.total_dues[i].MOBILE_S+'" id="'+obj.total_dues[i].regid+'_'+obj.total_dues[i].INVDETID+'_'+obj.total_dues[i].MOBILE_S+'">';
                            str = str + '</div>';
                            str = str + '<div style="float: left" class="label_reminder" id="label_'+obj.total_dues[i].regid+'"></div>'
                            str = str + '</td>';
                            str = str + '<td style="text-align: left;">';
                            str = str + duration;
                            str = str + '</td>';
                            str = str + '<td style="text-align: left;">';
                            str = str + obj.total_dues[i].NOM;
                            str = str + '</td>';
                            str = str + '<td>';
                            str = str + obj.total_dues[i].regid;
                            str = str + '</td>';
                            str = str + '<td>';
                            str = str + obj.total_dues[i].FNAME;
                            str = str + '</td>';
                            str = str + '<td style="text-align: left">';
                            var sth1 = obj.total_dues[i].STATIC_HEADS_1_TIME;
                            var sth1 = sth1.split(',');
                            for(temp=0;temp<sth1.length;temp++){
                            	sth1[temp] = sth1[temp].split('@')[0];
                            }
                            var sthn = obj.total_dues[i].STATIC_HEADS_N_TIMES;
                            var sthn = sthn.split(',');
                            for(temp=0;temp<sthn.length;temp++){
                            	sthn[temp] = sthn[temp].split('@')[0];
                            }
                            var flx1 = obj.total_dues[i].FLEXIBLE_HEADS_1_TIME;
                            var flx1 = flx1.split(',');
                            for(temp=0;temp<flx1.length;temp++){
                            	flx1[temp] = flx1[temp].split('@')[0];
                            }temp
                            var flxn = obj.total_dues[i].FLEXIBLE_HEADS_N_TIMES;
                            var flxn = flxn.split(',');
                            for(temp=0;temp<flxn.length;temp++){
                            	flxn[temp] = flxn[temp].split('@')[0];
                            }
                            var heads_ =$.merge([], sth1);
                            heads_ = $.merge(heads_, sthn);
                            heads_ = $.merge(heads_, flx1);
                            heads_ = $.merge(heads_, flxn);
                            heads_ = heads_.join('| ')
                            str = str + heads_
                            str = str + '</td>';
                            str = str + '<td style="text-align: right" title="Dues">';
                            str = str + obj.total_dues[i].DUE_AMOUNT+" /-";
                            str = str + '</td>';
                            str = str + '</tr>';
						}
					} else {
						str = "<td colspan='8' style='color: #ff0000; text-align: center; font-weight: bold; padding:10px'>No Dues Left...</td>";
					}
					$('#student_dues_data_here').html(str);
				}
			});
			
		});


		$('body').on('click', '.classwise_paid_dues_discount', function(){
			$('#chkReminderALL').prop('checked', false);
			$('#uniform-chkReminderALL span').removeClass('checked');
			$('#selectall_reminder').html('Select All');
			var str = this.id;
			var arr_ = str.split('~');
			var data_ = "clssessid="+arr_[1];
			var show_class = arr_[3];
			var url_ = site_url_+'/dashboardReports/get_total_paid_dues_discount_via_ajax';
			$('#class_reminder').val(show_class);
			$('#dues_for_class').html("Total Due(s) in <span style='background: #ffff00; color: #900000; font-weight: bold; padding: 0px 4px; border-radius: 3px'>Class "+show_class+"</span> in "+_current_year___);
			$("#student_dues_data_here").html("<tr><td colspan='7'><h5 style='text-align: center'>Please wait...</h5></td></tr>");
			$('#dues_from_class').html("Amount Due (Rs.)<br>"+"<span style='color: #0000ff'></span>");
			$.ajax({
				type: "POST",
				url: url_,
				data: data_,
				success: function(data){
					var obj = JSON.parse(data);
					var str = '';
					var total_dues = obj.total_dues.length;
					$('#dues_from_class').html("Amount Due (Rs.)<br>"+"<span style='color: #0000ff'>Rs. "+obj.total_class_dues+"/-</span>")
					if(total_dues > 0){
						for(i=0; i< total_dues; i++){
							var css_class = ' class="view_invoice_1"';
							str = str + '<tr class="gradeX">';
                            str = str + '<td style="text-align: center">';
                            str = str + obj.total_dues[i].regid;
                            str = str + '</td>';
                            str = str + '<td style="text-align: left">';
                            str = str + obj.total_dues[i].FNAME;
                            str = str + '</td>';
                            str = str + '<td style="text-align: left;">';
                            str = str + obj.total_dues[i].DISCOUNT_AMOUNT;
                            str = str + '</td>';
                            str = str + '<td style="text-align: left;">';
                            str = str + obj.total_dues[i].TOTAL_PAID;
                            str = str + '</td>';
                            str = str + '<td>';
                            str = str + obj.total_dues[i].DUES;
                            str = str + '</td>';
                            str = str + '</tr>';
						}
					} else {
						str = "<td colspan='8' style='color: #ff0000; text-align: center; font-weight: bold; padding:10px'>Hurra!! No Dues Left...</td>";
					}
					$('#student_dues_data_here').html(str);
				}
			});
			
		});
	$('#chkReminderALL').click(function(){
		if($('.chkReminder').length != 0){
			if($('#chkReminderALL').prop('checked') == true){
					$('#selectall_reminder').html('De-Select All');
					$(".chkReminder").prop('checked', true);

					$('.label_reminder').removeClass('transparent-label');
					$('.label_reminder').addClass('for_reminder_label');
					$('.label_reminder').html('Fee Reminder');
			} else {
					$('#selectall_reminder').html('Select All');
					$(".chkReminder").prop('checked', false);

					$('.label_reminder').removeClass('for_reminder_label');
					$('.label_reminder').addClass('transparent-label');
					$('.label_reminder').html('');
			}
		} else {
			$("#chkReminderALL").prop('checked', false);
		}
	});

	$('body').on('click', '.chkReminder', function(){
		var chkbx_id = this.id;
		var regid = chkbx_id.split('_');

		if($('#'+this.id).prop('checked') == true){
			$('#label_'+regid[0]).removeClass('transparent-label');
			$('#label_'+regid[0]).addClass('for_reminder_label');
			$('#label_'+regid[0]).html('Fee Reminder')
		} else {
			$('#label_'+regid[0]).removeClass('for_reminder_label');
			$('#label_'+regid[0]).addClass('transparent-label');
			$('#label_'+regid[0]).html('')
		}
		
	});

	$('#send_fee_reminder').click(function(){
		var selected_nos = [];
		$.each($("input[name='chkReminder']:checked"), function(){            
                selected_nos.push($(this).val());
        });
        $('#mobilenumbers').val(selected_nos.join(", "))
		$('#myModal').modal('show');
	});
	$('.sendreminder').click(function(){
		var url_ = site_url_ + "/dashboardReports/sendReminder";
    	var str = this.id;
    	var arr_ = str.split('_');
    	var class__ = $('#class_reminder').val();
    	var data_ = $('#frmFeeReminder').serialize()+"&class_reminder="+class__+"&check_sms="+arr_[1];
    	$.ajax({
    		type: "POST",
    		url: url_,
    		data: data_,
    		success: function(data){
    			var obj = JSON.parse(data);
    			callSuccess(obj.msg_all);
    			$('#myModal').modal('hide');
    		}, error: function(xhr, status, error){
				callDanger(xhr.responseText);
				$('#myModal').modal('hide');
			}
    	});
    	
    	return false;
	});

	$('#cmdViewTotalFeeClasswise').click(function(){
		var url_ = '';
		var data = '';
		var class__ = $('#frmTotalFeeCOllectedClasswiseDurationwise').val();
		$('#show_message').css('display', 'none');
		$('#show_message').html("");

        $("#total_collection_classwise_durationwise").html("<h5 style='text-align: center'>Please wait...</h5>");
            // Fetching form data
            var datefrom = $('#txtDateFrom').val();
            var dateto = $('#txtDateTo').val();
            var total_amount_for_class = 0;
            //-------------------

			if(class__ != "x"){
				data_ = $('#frmTotalFeeCOllectedClasswiseDurationwise').serialize();
				url_ = site_url_ + "/dashboardReports/get_total_collection_classwise_durationwise";
				$.ajax({
					type: "GET",
					url: url_,
					data: data_,
					success: function(data){
						var obj = JSON.parse(data);
						if(obj.total_collection[0].totalPaid != null){
							$('#total_collection').html('Rs. '+'<span style="color: #0000ff">'+obj.total_collection[0].totalPaid+'</span>'+"/-");
						} else {
							$('#total_collection').html('');
						}
						$('#total_collection_classwise_durationwise').html('<div style="text-align: center; font-weight: bold">Wait its Printing..</div>');
						var str = '';
						str = str + '<table class="table table-bordered">';
						str = str + '<thead>';
						str = str + '<tr>';
						str = str + '<th></th>';
						str = str + '<th style="text-align: left">Receipt ID</th>';
						str = str + '<th style="text-align: left">Paid Date</th>';
						str = str + '<th>Class</th>';
						str = str + '<th style="text-align: left">INVOICE</th>';
						str = str + '<th style="text-align: right">COLLECTION (Rs.)</th>';
						str = str + '<th style="text-align: center">MODE</th>';
						str = str + '<th></th>';
						str = str + '</tr>';
						str = str + '</thead>';
						for(i=0; i<obj.fee_collection.length;i++){
							str = str + '<tr>';
                                str = str + '<td><a href="'+site_url_+'/fee/fee_print/'+obj.fee_collection[i].RECPTID+'" class="view_invoice_1" target="_blank">VIEW</a></td>';
                                str = str + '<td>'+obj.fee_collection[i].RECPTID+'</td>';
                                str = str + '<td>'+obj.fee_collection[i].DATE_+'</td>';
                                str = str + '<td style="text-align: center">'+obj.fee_collection[i].CLASSID+'</td>';
                                str = str + '<td style="text-align: center">'+obj.fee_collection[i].INVDETID+'</td>';
                                str = str + '<td style="text-align: right">'+obj.fee_collection[i].PAID+'</td>';
                                str = str + '<td style="text-align: center">'+obj.fee_collection[i].MODE+'</td>';
                                str = str + '<td><a href="'+site_url_+'/fee/fee_print/'+obj.fee_collection[i].RECPTID+'" class="view_invoice_1" target="_blank">VIEW</a></td>';
                            str = str + '</tr>';
						}
						$('#total_collection_classwise_durationwise').html(str);
					},
					error: function(xhr, status, error){
						console.log(xhr.responseText);
					}
				});
			}
	});
	// -----------------
	// Popup boxes
		function callDanger(message){
			$.gritter.add({
				title:	'Error . . .',
				text:	message,
				image: 	base_url_+'/assets_/img/demo/error-circle.png',
				sticky: false,
			});
		}
		function callSuccess(message){
			$.gritter.add({
				title:	'Congratulations!!',
				text:	message,
				image: 	base_url_+'/assets_/img/demo/envelope.png',
				sticky: false,
				class_name: 'gritter-success'
			});
		}
	// ---------------

	// Change Password
		$('#changepwdbutt').click(function(){
			if($.trim($('#old_pwd').val()) == ''){
				$('#msg_').html("X: Please mention your old password");
			} else if($.trim($('#new_pwd').val()) == ''){
				$('#msg_').html("X: New password should not be left blank.");
			} else if($.trim($('#new_pwd').val()) != $.trim($('#new_re-pwd').val())){
				$('#msg_').html("X: Please confirm the new password correctly.");
			} else {
				url_ = site_url_ + '/c_pwd/changepwd';
				data_ = $('#frm_cpwd').serialize();
				$.ajax({
					type: "POST",
					url: url_,
					data: data_,
					success: function(data){
						if(data == "All three chances over."){
							$('#fullform').css({'padding':'20px'});
							$('#fullform').html("Please contact administrator to reset your password.<br /><a href='"+site_url_+"/login/logout'>Logout</a>");
						} else {
							$('#msg_').html(data);	
						}
						$('#frm_cpwd')[0].reset();
					}
				});
			}
		});
	// ---------------

	// Day Book
		function fillCategory(){
			var url_ = site_url_ + "/daybook/getCategory";
			$('#daybook_category').html("<tr><td></td><td>Loading...</td></tr>");
			$.ajax({
				type: 'POST',
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					for(i=0; i<obj.dbcategory.length;i++){
						str_html = str_html + '<tr>';
						str_html = str_html + '<td>';
						str_html = str_html + '<input type="radio" name="optDBCategory" class="daybook_master_category" id="opt~'+obj.dbcategory[i].DBCATEGID+'" value="'+obj.dbcategory[i].DBCATEGID+'" />';
						str_html = str_html + '</td>';
						str_html = str_html + '<td>';
						str_html = str_html + obj.dbcategory[i].DBCATEGORY;
						str_html = str_html + '</td>';
						str_html = str_html + '</tr>';
					}
					$('#daybook_category').html(str_html);
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		}

		function fillSubheads(){
			var url_ = site_url_ + "/daybook/getSubHeadsAll/";
			$('#daybook_subhead').html("<tr><td></td><td>Loading...</td></tr>");
			$.ajax({
				type: 'POST',
				url: url_,
				success: function(data){
					$('#daybook_subhead').html(data);
					var obj = JSON.parse(data);
					var str_html = '';
					for(i=0; i<obj.dbSHead.length;i++){
						str_html = str_html + "<option value='"+obj.dbSHead[i].DBSUBHID+"'>"+obj.dbSHead[i].SUBHEAD+"</option>";
					}
					$('#txtDaybook_subhead').html(str_html);
				},
				error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}	
			});
		}

		$('body').on('click','.daybook_master_category', function(){
			var str = this.id;
			var id = str.split('~');
			var url_ = site_url_ + "/daybook/getHeads/"+id[1];
			$('#daybook_head').html("<tr><td></td><td>Loading...</td></tr>");
			$.ajax({
				type: 'POST',
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					for(i=0; i<obj.dbHead.length;i++){
						str_html = str_html + '<tr>';
						str_html = str_html + '<td>';
						str_html = str_html + '<input type="radio" name="optHead" class="daybook_master_head" id="opt~'+obj.dbHead[i].DBHID+'" value="'+obj.dbHead[i].DBHID+'" />';
						str_html = str_html + '</td>';
						str_html = str_html + '<td>';
						str_html = str_html + obj.dbHead[i].HEAD;
						str_html = str_html + '</td>';
						str_html = str_html + '</tr>';
					}
					$('#daybook_head').html(str_html);
				},
				error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		});

		$('body').on('click','.daybook_master_head', function(){
			var str = this.id;
			var id = str.split('~');
			var url_ = site_url_ + "/daybook/getSubHeads/"+id[1];
			$('#daybook_subhead').html("<tr><td></td><td>Loading...</td></tr>");
			$.ajax({
				type: 'POST',
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					for(i=0; i<obj.dbSHead.length;i++){
						str_html = str_html + '<tr>';
						str_html = str_html + '<td>';
						str_html = str_html + '<input type="radio" name="optSubHead" class="daybook_master_subhead" id="opt~'+obj.dbSHead[i].DBSUBHID+'" value="'+obj.dbSHead[i].DBSUBHID+'" />';
						str_html = str_html + '</td>';
						str_html = str_html + '<td>';
						str_html = str_html + obj.dbSHead[i].SUBHEAD;
						str_html = str_html + '</td>';
						str_html = str_html + '</tr>';
					}
					$('#daybook_subhead').html(str_html);
				},
				error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}	
			});
		});
	// --------

	// TC or CC
		$('#cmbRegistrationID_for_tccc').change(function(){
			if($('#cmbRegistrationID_for_tccc').val() != 'x'){
				$('#cmdTC').removeAttr('disabled');
				$('#cmdTC').removeClass('btn-default');
				$('#cmdTC').addClass('btn-primary');
				$('#cmdTC').val('Show TC');

				$('#cmdCC').removeAttr('disabled');
				$('#cmdCC').removeClass('btn-default');
				$('#cmdCC').addClass('btn-success');
				$('#cmdCC').val('Show CC');
			}else{
				$('#cmdTC').attr('disabled','disabled');
				$('#cmdTC').removeClass('btn-primary');
				$('#cmdTC').addClass('btn-default');
				$('#cmdTC').val('-');

				$('#cmdCC').attr('disabled','disabled');
				$('#cmdCC').removeClass('btn-success');
				$('#cmdCC').addClass('btn-default');
				$('#cmdCC').val('-');
			}
		});
		$('#cmdTC').click(function(){
			$('#txtCC_or_TC').val('TC');
			$('#frmTCCC').submit();
		});
		$('#cmdCC').click(function(){
			$('#txtCC_or_TC').val('CC');
			$('#frmTCCC').submit();
		});
	// --------

	// Sessionwise Detail e.g weight, height, left vision, right vision etc.
		$('#cmbClassesForSessionWiseDetail').change(function () {
	        var clssessid = $('#cmbClassesForSessionWiseDetail').val();
	        var className = $("#cmbClassesForSessionWiseDetail option:selected").text();
	        url_ = site_url_ + "/master/get_student_sessionwise_detail/" + clssessid;
	        $.ajax({
	            type: "POST",
	            url: url_,
	            success: function (data) {
	                var obj = JSON.parse(data);
	                var str_html = '';
	                for (i = 0; i < obj.Student.length; i++) {
	                    str_html = str_html + "<tr class='gradeX'>";
	                    str_html = str_html + "<td>" + obj.Student[i].regid + "</td>";
	                    str_html = str_html + "<td>" + obj.Student[i].FNAME + "</td>";
	                    str_html = str_html + "<td><input type='text' name='txtWeight' class='textB' id='txt_" + obj.Student[i].regid + "_txtWeight' value='" + obj.Student[i].MOBILE_S + "'></td>";
	                    str_html = str_html + '<td class="taskOptions">';
	                    str_html = str_html + "<a href='#' class='btn editStudentContact' id='" + obj.Student[i].regid + "'><i class='fa fa-arrow-circle-right fa-lg'></i></a>";
	                    str_html = str_html + '</td>';
	                    str_html = str_html + "</tr>";
	                }
	                $('#tabStudents').html(str_html);
	                $('#classHead').html('Student in <span style="color:blue">' + className + '</span>');
	            }
	        });
	    });
	// ---------------------------------------------------------------------

	// ----------Flexible Head Reports--------------------------------------
		$.fn.digits = function(){ 
		    return this.each(function(){ 
		        $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
		    })
		}
		$('#cmbShowFlexiHeadedStudents').click(function(){
			var url_ = site_url_ + "/fee/getTotalAmount_FlexiHeads_1_N_time";
			var data_ = $('#frmFlexiHeadedStudents').serialize();
			//$('#FlexiHeaded_students_here_N_time').html(data_);
			$.ajax({
				type: 'POST',
				url: url_,
				data: data_,
				success: function (data){
					$('#FlexiHeaded_students_here_N_time').html(data);
					var obj = JSON.parse(data);
					var len = obj.feeHeads.oneTime.length;
					var len1= obj.feeHeads.nTime.length;
					var str = '';
					var st = '';
					var amount;
					var totalAmount = 0;
					var totalEntries = 0;
					for(i=0; i<len;i++){
						st=i;
						amount = parseFloat(obj.feeHeads.oneTime[st].Amount);
						totalAmount = totalAmount + parseInt(obj.feeHeads.oneTime[st].Amount)
						totalEntries = totalEntries + parseInt(obj.feeHeads.oneTime[st].TotalStudents)
						str = str + "<tr>";
						str = str + "<td style='text-align: left'>"+obj.feeHeads.oneTime[st].heads+"</td>";
						str = str + "<td style='text-align: center'>"+obj.feeHeads.oneTime[st].TotalStudents+"</td>";
						str = str + "<td style='text-align: right' class='currency_'>"+amount+"</td>";
						str = str + "</tr>";
					}
					str = str + "<tr>";
					str = str + "<td style='text-align: right; font-weight: bold'>Total</td>";
					str = str + "<td style='text-align: center; font-weight: bold'>"+totalEntries+"</td>";
					str = str + "<td style='text-align: right; font-weight: bold' class='currency_'>"+totalAmount+"</td>";
					str = str + "</tr>";	
					$('#FlexiHeaded_students_here_1_time').html(str);
					$('.currency_').digits();
					totalEntries = 0;
					totalAmount = 0;
					str = '';
					for(j=0; j<len1;j++){
						st = j;
						amount = parseFloat(obj.feeHeads.nTime[st].Amount);
						totalAmount = totalAmount + parseInt(obj.feeHeads.nTime[st].Amount)
						totalEntries = totalEntries + parseInt(obj.feeHeads.nTime[st].TotalStudents)
						str = str + "<tr>";
						str = str + "<td style='text-align: left'>"+obj.feeHeads.nTime[st].heads+"</td>";
						str = str + "<td style='text-align: center'>"+obj.feeHeads.nTime[st].TotalStudents+"</td>";
						str = str + "<td style='text-align: right' class='currency_'>"+amount+"</td>";
						str = str + "</tr>";
					}
					str = str + "<tr>";
					str = str + "<td style='text-align: right; font-weight: bold'>Total</td>";
					str = str + "<td style='text-align: center; font-weight: bold'>"+totalEntries+"</td>";
					str = str + "<td style='text-align: right; font-weight: bold' class='currency_'>"+totalAmount+"</td>";
					str = str + "</tr>";
					//$('#FlexiHeaded_students_here_N_time').html(str);	
					$('.currency_').digits();

					if($('#cmbClassesForFlexiHeadedStudents').val() == 'all'){
						$('#felxiHeads_1_time_heading').html('Opted Fee to Collect (<b>1</b> Time) for <b style="color: #0000ff">'+$('#cmbClassesForFlexiHeadedStudents option:selected').text()+'</b> classes');
						$('#felxiHeads_N_time_heading').html('Opted Fee to Collect (<b><i>N</i></b> Time) for <b style="color: #0000ff">'+$('#cmbClassesForFlexiHeadedStudents option:selected').text()+'</b> classes');
					} else {
						$('#felxiHeads_1_time_heading').html('Opted Fee to Collect (<b>1</b> Time) for <b style="color: #0000ff">'+$('#cmbClassesForFlexiHeadedStudents option:selected').text()+'</b> class');
						$('#felxiHeads_N_time_heading').html('Opted Fee to Collect (<b><i>N</i></b> Time) for <b style="color: #0000ff">'+$('#cmbClassesForFlexiHeadedStudents option:selected').text()+'</b> class');
					}
				}
			});
		return false;
		});
		$('#selectnumber option:selected').text()
	// ---------------------------------------------------------------------

});