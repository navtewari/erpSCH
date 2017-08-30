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
		if($('#frmAssociateStaticFee').length != 0){
			fillClasses_for_current_session();
			fill_accordion_showing_classes_associates_staticHeads();
		}
	});
	// Registration and Admission Forms scripts
		function reloadme(){
			location.reload(true);
		}
		function fillStudents_in_table(){
			//student_data_here
			url_ = site_url_ + "/reg_adm/getstudents_for_dropdown";
			str = '';
			str = '<tr class="gradeX odd"><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr>';
			str = str + '<tr class="gradeX even"><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td></tr>';
			$('#student_data_here').html(str);
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
		$('#reload_me').click(function(){
			reloadme();
		});
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

	// Master Fee -----------------------------
		/**/// Flexible Heads below
		function rest_static_head_form(){
			$('#txtFeeStaticHead').val('');
		}
		$('#add_static_head').click(function(){
			if($.trim($('#txtFeeStaticHead').val()) != ''){
				url_ = site_url_ + "/master_fee/submit_static_fee_head";
				data_ = 'txtFeeStaticHead='+$('#txtFeeStaticHead').val();
				$.ajax({
					type: "POST",
					url: url_,
					data: data_,
					success: function(data){
						var obj = JSON.parse(data);
						if(obj.res_ == true){
							callSuccess(obj.msg_);
							fill_static_fee_heads();
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
			loading_process();
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
						str_html = str_html + '<td class="taskOptions">';
						str_html = str_html + '<a href="#" class="tip edit_static_head_" id="EditStaticHead~'+ obj.static_heads[i].ST_HD_ID + '~'+ obj.static_heads[i].FEE_HEAD + '"><i class="icon-pencil"></i></a> | ';
						str_html = str_html + '<a href="#" class="tip delete_static_head_" id="'+ obj.static_heads[i].ST_HD_ID + '"><i class="icon-remove"></i></a>';
						str_html = str_html + '</td>';
						str_html = str_html + '</tr>'
					}
					$('#static_fee_heads_here').html(str_html);
					hide_loading_process();
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
				data_ = "txtFeeStaticHead_edit="+$('#txtFeeStaticHead_edit').val()+"&txtID_edit="+$('#txtID_edit').val();
				$.ajax({
					type: "POST",
					url: url_,
					data: data_,
					success: function(data){
						$('#txtFeeStaticHead_edit').val("");
						$('#txtID_edit').val("");
						$('#edit_static_head_panel').css('display', 'none');
						var obj = JSON.parse(data);
						if(obj.res_ == true){
							callSuccess(obj.msg_);
							fill_static_fee_heads();
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
				data_ = 'txtFeeFlexibleHead='+$('#txtFeeFlexibleHead').val()+'&txtFeeFlexibleHeadAmt='+$.trim($('#txtFeeFlexibleHeadAmt').val());
				$.ajax({
					type: "POST",
					url: url_,
					data: data_,
					success: function(data){
						var obj = JSON.parse(data);
						if(obj.res_ == true){
							callSuccess(obj.msg_);
							fill_flexible_fee_heads();
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

		function fill_flexible_fee_heads(){
			url_ = site_url_ + "/master_fee/get_flexible_heads";
			loading_process();
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
						str_html = str_html + '<td class="taskOptions">';
						str_html = str_html + '<a href="#" class="tip edit_flexible_head_" id="EditFlexibleHead~'+ obj.flexi_heads[i].FLX_HD_ID + '~'+ obj.flexi_heads[i].FEE_HEAD + '~' + obj.flexi_heads[i].AMOUNT + '"><i class="icon-pencil"></i></a> | ';
						str_html = str_html + '<a href="#" class="tip delete_flexible_head_" id="'+ obj.flexi_heads[i].FLX_HD_ID + '"><i class="icon-remove"></i></a>';
						str_html = str_html + '</td>';
						str_html = str_html + '</tr>'
					}
					$('#flexible_fee_heads_here').html(str_html);
					hide_loading_process();
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
			$('#txtFlexibleHead_edit').focus();
		});

		$('#update_flexible_head').click(function(){
			if($.trim($('#txtFlexibleHead_edit').val()) != '' && $.trim($('#txtFlexibleHeadAmt_edit').val()) != '' && isNaN($('#txtFlexibleHeadAmt_edit').val()) == false){
				url_ = site_url_ + "/master_fee/update_flexible_head";
				data_ = "txtFlexibleHead_edit="+$('#txtFlexibleHead_edit').val()+"&txtFlexID_edit="+$('#txtFlexID_edit').val()+"&txtFlexibleHeadAmt_edit="+$('#txtFlexibleHeadAmt_edit').val();
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
					} else {
						callDanger(obj.msg_);
					}
				}, error: function(xhr, status, error){
					callDanger(xhr.responseText);
				}
			});
		});

		// Asociate Static Heads with Classes
		
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
			loading_process();
			$.ajax({
				type: 'POST',
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					for(i=0; i<obj.classes_.length;i++){
						str_html = str_html + '<tr>';
						str_html = str_html + '<td>';
						str_html = str_html + '<input type="checkbox" name="ckhClass_[]" id="ckh~'+obj.classes_[i].CLSSESSID+'" value="'+obj.classes_[i].CLSSESSID+'" style="border: #f0f0f0 dashed 1px"/>';
						str_html = str_html + '</td>';
						str_html = str_html + '<td>';
						str_html = str_html + 'Class ' + obj.classes_[i].CLASSID;
						str_html = str_html + '</td>';
						str_html = str_html + '</tr>';
					}
					$('#classes_associates_staticHeads').html(str_html);
					hide_loading_process();
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
			    	loading_process();
			    	$.ajax({
			    		type: 'POST',
			    		url: url_,
			    		data: data_,
			    		success: function(data){
			    			var obj = JSON.parse(data);
			    			if(obj.res_ == true){
			    				callSuccess(obj.msg_);
			    				$('.cancel_static_associates_classes').click();
			    				fill_accordion_showing_classes_associates_staticHeads();
			    			} else {
			    				callDanger(obj.msg_);
			    			}
			    			hide_loading_process();
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
	// ----------
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