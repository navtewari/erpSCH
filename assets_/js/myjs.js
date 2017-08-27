$(function(){
	$("#txtStudentPhone").mask("(999) 999-9999");
	$( window ).on( "load", function(){
		if($('#frmAdmission').length != 0){
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
				}
			});
		}
		function fillClasses(){
			$('#s2id_cmbClassofAdmission span').text("Loading...");
			url_ = site_url_ + "/reg_adm/getClasses_in_session/2017-18";
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
				$.ajax({
					type: 'post',
					url: url_,
					success: function(data){
						//address_permanent
						//address_correspondance
						//contact
						var obj = JSON.parse(data);
						alert(obj.personal_academics[0].CLASS_OF_ADMISSION);
						$('#cmbClassofAdmission').val(obj.personal_academics.CLASS_OF_ADMISSION);
						$('#s2id_cmbClassofAdmission span').text("Class "+obj.personal_academics.CLASSID);
						if(obj.personal_academics.DOA != ''){
							$('#txtDOA').val(obj.personal_academics.DOA);
						}
						$('#txtFullName').val(obj.personal_academics.FNAME);
						if(obj.personal_academics.DOB_ != ''){
							$('#txtStudDOB').val(obj.personal_academics.DOB_);
						}
						alert(obj.contact.MOBILE_S);
						$('#txtStudentPhone').val(obj.contact.MOBILE_S);
					}, error: function(xhr, status, error){
						alert(xhr.responseText);
					}
				});
			}
		});
		$('.reset_button_template').click(function(){
			reset_admission_form();
		});
		$('.submit_or_update_admission').click(function(){
			if($('#cmbClassofAdmission').val() == ''){
				callDanger("Please select Class of Admission !!");
			} else if($('#txtFullName').val() == '') {
				callDanger("Please fill student Name !!");
			} else if($("#optStuMale").prop("checked")==false && $("#optStuFemale").prop("checked") == false){
				callDanger("Please select gender. !!");
			} else {
				data_ = $('#frmAdmission').serialize();
				url_ = site_url_ + "/reg_adm/update_Admission";

				$.ajax({
					type: 'POST',
					url: url_,
					data: data_,
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
	// -----------

});