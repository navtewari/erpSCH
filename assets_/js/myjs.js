$(function(){
	$("#txtStudentPhone").mask("(999) 999-9999");
	$( window ).on( "load", function(){
		if($("#frmFindStudent").length != 0) {
			fillStudents();
		}
		if($('#frmAdmission').length != 0){
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
					str_html = str_html + "<option value='new'>New | New Student</option>";
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
					str_html = str_html + "<option value='' selected='selected'>Select Class</option>";
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
		function submit_or_update_admission(){
			alert('submit_or_update_admission');
		}
	// ----------------------------------------
});

