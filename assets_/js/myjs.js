$(function(){
	$("#txtStudentPhone").mask("(999) 999-9999");
	$( window ).on( "load", function(){
		if($('#frmAdmission').length != 0){
			$('input[type=radio]').css('opacity', '1');
			fillStudents();
			fillClasses();
			fillStates('cmbPState');
			fillStates('cmbCState');
		}
	});

	// Registration and Admission Forms scripts
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
					alert(xhr.responseText);
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
				}
			});
		}
		function reset_admission_form(){
			// Resetting whole Form
				$('#reset_me').click();
				$('#uniform-optStuMale span').removeClass('checked');
				$('#uniform-optStuFemale span').removeClass('checked');
				$('.filename').text("No file selected");
				fillStudents();
				fillClasses();
				fillStates('cmbPState');
				fillStates('cmbCState');
			// --------------------
		}
		$('#cmbRegistrationID').change(function(){
			if($('#cmbRegistrationID').val() == 'new'){
				reset_admission_form();
			} else {
				url_ = site_url_ + "/reg_adm/get_admision_detail/"+$('#cmbRegistrationID').val();
				loading_process();
				$.ajax({
					type: 'post',
					url: url_,
					success: function(data){
						var obj = JSON.parse(data);
						// Filling Personal & Academics Detail
						if(jQuery.isEmptyObject(obj.personal_academics) == false){
							$('#student_photo_here').html('<img src='+base_url_+'/assets_/student_photo/'+obj.personal_academics.PHOTO_+' />');
							$('#cmbClassofAdmission').val(obj.personal_academics.CLASS_OF_ADMISSION);
							$('#s2id_cmbClassofAdmission span').text("Class "+obj.personal_academics.CLASSID);
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
								if(obj.personal_academics.GENDER == 'M'){
									$('#optStuMale').prop('checked', true);
									//$('#uniform-optStuMale').addClass('focus');
								} else {
									$('#optStuFemale').prop('checked', true);
									//$('#uniform-optStuFemale').addClass('focus');
								}
							}
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
						hide_loading_process();
					}, error: function(xhr, status, error){
						alert(xhr.responseText);
					}
				});
			}
		});
		$('.reset_button_template').click(function(){
			reset_admission_form();
		});
		$('.submit_or_update_admission').click(function(e){
			e.preventDefault();

			if($('#cmbClassofAdmission').val() == ''){
				callDanger("Please select Class of Admission !!");
			} else if($('#txtFullName').val() == '') {
				callDanger("Please fill student Name !!");
			} else if($("#optStuMale").prop("checked")==false && $("#optStuFemale").prop("checked") == false){
				callDanger("Please select gender. !!");
			} else {
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
						callSuccess(obj.msg_);
					}, error: function(xhr, status, error){
						callSuccess(xhr.responseText);
					}
				});
			}
		});
	// ----------------------------------------

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
		function loading_process(){
			$('#loading_process').css('opacity', '1');
			$('#loading_process').css('display', 'inline-block');
			$('#loading_process').html('<img src="'+base_url_+'/assets_/img/spinner.gif" /> Its Loading...');
		}
		function hide_loading_process(){
			$('#loading_process').css('opacity', '1');
			$('#loading_process').css('display', 'none');
			$('#loading_process').html('');	
		}
	// -----------

});