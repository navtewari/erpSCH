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
			url_ = site_url_ + "/reg_adm/getstudents_for_dropdown";

			$.ajax({
				type: "POST",
				url: url_,
				success:  function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					str_html = str_html + "<option value='new' selected='selected'>New | New Student</option>";
					for(i=0;i<obj.students_.length; i++){
						str_html = str_html + "<option value='"+obj.students_[i].regid+"'>"+obj.students_[i].regid+" | "+obj.students_[i].FNAME+"</option>";
					}
					$('#cmbRegistrationID').html(str_html);
				}
			});
		}
		function fillClasses(){
			url_ = site_url_ + "/reg_adm/getClasses_in_session/2017-18";
			$.ajax({
				type: "POST",
				url: url_,
				success:  function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					str_html = str_html + "<option value='' selected='selected'>Choose Class</option>";
					for(i=0;i<obj.class_in_session.length; i++){
						str_html = str_html + "<option value='"+obj.class_in_session[i].CLSSESSID+"'>Class "+obj.class_in_session[i].CLASSID+"</option>";
					}
					$('#cmbClassofAdmission').html(str_html);
				}
			});
		}
		function fillStates(selector){
			url_ = site_url_ + "/reg_adm/getState";
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
					$('#'+selector).html(str_html);
				}
			});
		}
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