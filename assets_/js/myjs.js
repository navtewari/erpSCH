$(function(){
	$( window ).on( "load", function(){
		if($("#frmFindStudent").length != 0) {
			$('#frmFindStudent').change();
		}
	});

	// Registration and Admission Forms scripts
		$('#frmFindStudent').change(function(){
			url_ = site_url_ + "/reg_adm/getstudents_for_dropdown";
			$.ajax({
				type: "POST",
				url: url_,
				success:  function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					for(i=0;i<obj.students_.length; i++){
						str_html = str_html + "<option value='"+obj.students_[i].regid+"'>"+obj.students_[i].regid+" | "+obj.students_[i].FNAME+"</option>";
					}
					$('#cmbRegistrationID').html(str_html);
				}
			});
		})
	// ----------------------------------------
});
