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

	$("#txtStudentPhone").mask("(999) 999-9999");
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
	});
	// Common Function to reload the current Page via http
	function reloadme(){
		location.reload(true);
	}
	// ---------------------------------------------------

	// Function definitions need to call when needed
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
		function fillSiblings(){
			$('#s2id_cmbSiblingRegistrationID span').text("Loading...");
			url_ = site_url_ + "/reg_adm/getstudents_for_dropdown";
			$('#cmbRegistrationID').empty();
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
				$('#student_photo_here').html('<img src='+base_url_+'/assets_/student_photo/no-image.jpg'+' />');
				$('.filename').text("No file selected");
				$('#show_siblings').html('');
				$('#show_discount').html('');
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
			reloadme();
		});
		$('#cmbRegistrationID').change(function(){
			if($('#cmbRegistrationID').val() == 'new'){
				reset_admission_form();
			} else {
				url_ = site_url_ + "/reg_adm/get_admision_detail/"+$('#cmbRegistrationID').val();
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
								if(obj.personal_academics.GENDER == 'Male' || obj.personal_academics.GENDER == 'M'){
									$('#optStuMale').prop('checked', true);
									$('#uniform-optStuMale').addClass('focus');
								} else if (obj.personal_academics.GENDER == 'Female' || obj.personal_academics.GENDER == 'F') {
									$('#optStuFemale').prop('checked', true);
									$('#uniform-optStuFemale').addClass('focus');
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
									$('#show_discount').html($('#show_discount').html()+design_cover_for_discount_representation(arrDiscount[i]));
								}
							}
						}
						if(jQuery.isEmptyObject(obj.personal_academics) == false){
							$('#cmbCategory').val(obj.personal_academics.CATEGORY);
							$('#s2id_cmbCategory span').text(obj.personal_academics.CATEGORY);
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

		function design_cover_for_discount_representation(current_selection){
			var temp = "<div style='float: left; padding: 2px' id='_"+current_selection+"_id'><div style='float: left; padding: 2px; background: #ffffff; color: #000000; border:#808080 solid 1px; border-radius: 5px; font-size: 10px'>"+current_selection+"&nbsp;<span id='"+current_selection+"_id' class='deleteme_as_discount icon-trash' style='color: #ff0000; font-size:11px;z-index:99'></span></div></div>";
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
				var current_selection_ = design_cover_for_discount_representation(current_selection);
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
			var id_ = $.trim(arr[0]);
			
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
			if($('#txtItem').val() == ''){
				callDanger("Please fill the name of discounted item !!");
			} else if($('#cmdStatus').val() == 'x'){
				callDanger("Please select the status of discounted category !!");
			} else if($('#txtAmount').val() == '') {
				callDanger("Please select the status of discounted category !!");
			} else {
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
						$('#s2id_cmdStatus span').removeClass('edit_color_content');
						$('#txtAmount').removeClass('edit_color_content');
						$('#txtDesc').removeClass('edit_color_content');
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
						$('#txtAmount').val(obj.AMOUNT);
						$('#txtDesc').val(obj.DESC_);
						$('#txtItem').focus();
					}, error: function(xhr, status, error){
						callDanger(xhr.responseText);
					} 
				});
			} else if(xarr[0] == 'Delete'){
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
	// ----------------------------------------
	// Master Fee -----------------------------
		/**/// Static Heads below
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
		$("#classes_for_static_heads_check_boxes").click(function(){  //"select all" change 
		    var status = this.checked; // "select all" checked status
		    $('.classes_for_static_heads').each(function(){ //iterate all listed checkbox items
		        this.checked = status; //change ".checkbox" checked status
		    });
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
			    				$('.cancel_static_associates_classes').click();
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

		$('body').on('click', '.View_Students_for_flexible_heads', function () {
			str = this.id;
			arr = str.split('~');
			clssessid = arr[1];
			url_ = site_url_ + "/master_fee/get_flexible_fee_head_for_class/"+clssessid;
			
			$.ajax({
				type:"POST",
				url:url_,
				success: function(data){
					var obj = JSON.parse(data);
					var str_html = '';
					var flexi_heads;
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
		// --------------------------------------------------

		// Invoice code below -------------------------------
		$('#cmbYearFromForInvoice').change(function(){$('#cmbClassForInvoice').change();});
	    $('#cmbMonthFromForInvoice').change(function(){$('#cmbClassForInvoice').change();});
	    $('#cmbYearToForInvoice').change(function(){$('#cmbClassForInvoice').change();});
	    $('#cmbMonthToForInvoice').change(function(){$('#cmbClassForInvoice').change();});
	    
		$('#cmbClassForInvoice').change(function(){
			var year_upto=0, month_upto=0;
			var global_bool;
			var $class__ = $('#cmbClassForInvoice').val();
			$('#show_message').css('display', 'none');
			$('#show_message').html("");
			data_ = $('#frmInvoice').serialize();
	        
                // Fetching form data
                var year_from = parseInt($('#cmbYearFromForInvoice').val(),10);
                var month_from = parseInt($('#cmbMonthFromForInvoice').val(),10);
                var year_to = parseInt($('#cmbYearToForInvoice').val(),10);
                var month_to = parseInt($('#cmbMonthToForInvoice').val(),10);
                var total_amount_for_class = 0;
                //-------------------
                //alert(year_from + " - " + month_from + " - " + year_to + " - " + month_to + " - " + $('#cmbClassForInvoice').val());

				if($class__ != "x" && year_from != "" && month_from != "" && year_to != "" && month_to != ""){
			        if(year_from <= year_to){
			        	if(year_from  == year_to && month_from > month_to){
			        		$("#class_invoices_here").html("<div style='text-align: center; padding: 5px'><b>Month-from</b> should be less than or equals to <b>Month-to</b></div>");
			        	} else {
			        		total_months = calculate_no_months(year_from, month_from, year_to, month_to);
				            data_ = $('#frmInvoice').serialize();
				            url_ = site_url_ + "/fee/show_invoice_needs_to_be_generated";
				            $.ajax({
				                type : 'POST',
				                url : url_,
				                data : data_,
				                success : function(data){
				                    var str_html = '';
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
					                            str_html = str_html + "<td colspan='6' style='vertical-align: middle'> <div style='float:  left'>Standard Fix Fee for this class-&nbsp;&nbsp;</div>"+fixHeads+'<div style="clear: both"></div>';
					                            str_html = str_html + "<div style='float: left'><b>Note: </b>Generate/ Print Invoice for "+total_months+" month(s). </div></td>"
					                            str_html = str_html + "<td colspan='2' style='text-align: right; vertical-align: middle'></td></tr>";
					                            str_html = str_html + "<tr>";
					                            
					                            str_html = str_html + "<tr class='gradeX'>";
					                            str_html = str_html + "<th>Registration No</th>";
					                            str_html = str_html + "<th>Name</th>";      
					                            str_html = str_html + "<th style='text-align: right !important'>Fix Fee Amount</th>";
					                                str_html = str_html + "<th style='min-width: 100px; max-width: 200px'>Opted Fee</th>";
					                                str_html = str_html + "<th style='text-align: right !important'>Amount</th>";
					                            str_html = str_html + "<th width='100' style='text-align: right !important'>Total Fee</th>";
					                            str_html = str_html + "<th width='100' style='text-align: center !important'>Invoice</th>";
					                            str_html = str_html + "<th width='100' style='text-align: center !important'>Undo Invoice</th>";
					                            str_html = str_html + "</tr>";
					                        for(loop1=0;loop1<obj.fetch_class_students.length; loop1++){
					                        	invoice_already_generated = false;
					                        	for(pinvoiceloop=0;pinvoiceloop<obj.previous_invoice.length;pinvoiceloop++){
					                        		if(obj.previous_invoice[pinvoiceloop].REGID == obj.fetch_class_students[loop1].regid){
					                        			invoice_already_generated = true;
					                        			var invdetid = obj.previous_invoice[pinvoiceloop].INVDETID;
					                        			break;
					                        		}
					                        	}
					                            str_html = str_html + "<tr class='gradeX'>";
					                            str_html = str_html + "<td>"+obj.fetch_class_students[loop1].regid+"</td>";
					                            str_html = str_html + "<td>"+obj.fetch_class_students[loop1].FNAME+"</td>";
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
					                            	str_html = str_html + "<td style='text-align: center !important' id='"+obj.fetch_class_students[loop1].regid+"_for_invoice_print'><a href='"+site_url_+"/fee/print_invoice/"+invdetid+"/"+$class__+"' target='_blank'><span class='print_invoice'><i class='icon-print' title='Print Invoice'></i></span></a></td>";
					                            	str_html = str_html + "<td style='text-align: center !important'><span class='payFee'><i class='icon-undo undoinvoice' title='Undo Invoice' id='undoinvoice_"+invdetid+"_"+obj.fetch_class_students[loop1].regid+"'></i></span></td>";
					                        	} else {
					                        		str_html = str_html + "<td style='text-align: center !important' id='"+obj.fetch_class_students[loop1].regid+"_for_invoice_print'><span class='generate_invoice' id='"+obj.fetch_class_students[loop1].regid+"'><i class='icon-lock' title='Generate Invoice'></i></span></td>";
					                        		str_html = str_html + "<td style='text-align: center !important' class='place_for_undo' id='place_for_undo_"+obj.fetch_class_students[loop1].regid+"'></td>";
					                        	}
					                            str_html = str_html + "</tr>";
					                        }
					                        str_html = str_html + "<tr class='gradeX'>";
				                            str_html = str_html + "<td colspan='5' style='text-align: right !important'>Total Fee for the class</td>";
											str_html = str_html + "<td style='text-align: right !important; color: #0000ff; font-weight: bold'>"+total_amount_for_class+"</td>";
				                            str_html = str_html + "<td colspan='2'></td>";
				                            str_html = str_html + "</tr>";
					                    } else {
					                    	$('#total_students').html('');
					                        str_html = "<div class='rear_message'><i class='icon-ban-circle'></i> <b>No Fee</b> adjusted for the <b>class</b> yet.</div>";
					                    }
					                    str_html = str_html + '</tbody>';
		                				str_html = str_html + '</table>';
					                    $("#class_invoices_here").html(str_html);
					                    
					                //} else {
					                	//hide_loading_process();
					                //}
				                },
				                error: function (xhr, ajaxOptions, thrownError) {       
				                    //alert(xhr.responseText);
				                    str_for_html = thrownError;
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
            			$('#place_for_undo_'+regid_).html("<span class='payFee'><i class='icon-undo undoinvoice' title='Undo Invoice' id='undoinvoice_"+obj.invdetid+"_"+regid_+"'></i></span>");
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
			var url_ = site_url_ + '/fee/undo_invoice/'+arr_[1]+'/'+regid_;
			
			$.ajax({
				type: "POST",
				url: url_,
				success: function(data){
					var obj = JSON.parse(data);
					if(obj.bool_ == 2){
						$('#place_for_undo_'+regid_).html('');
						$('#'+regid_+"_for_invoice_print").html("<span class='generate_invoice' id='"+regid_+"'><i class='icon-lock' title='Generate Invoice'></i></span>");	
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
			$('#class_in_session_for_Receipt').change(function(){
	        	if($('#class_in_session_for_Receipt').val() != ""){
		            class_ = $('#class_in_session_for_Receipt').find('option:selected').text();
		            data_ = $('#class_in_session_for_Receipt').serialize();
		            url_ = site_url_ + "/fee/show_class_for_receipt";

		            
		            $.ajax({
		                type : 'POST',
		                url : url_,
		                data : data_,
		                success : function(data){
		                	var tot_fixAmount_1_time = 0, tot_fixAmount_n_time = 0, fixHeads_1='',fixHeads_n='';
		                    var obj = JSON.parse(data);
		                    var len_ = obj.fetch_invoice_for_receipt.length;
		                    //alert(len_);
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
			                    		fixHeads_1 = fixHeads_1 + "<div class='fee_heads_static' title='"+parseInt(fixH1_amt[i],10)+"'>"+fixH1[i]+'</div>';
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
			                    		fixHeads_n = fixHeads_n + "<div class='fee_heads_static' title='"+parseInt(fixHn_amt[i],10)+"'>"+fixHn[i]+'</div>';
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
			                            
			                            if(due_amount <= 0){
			                            	str_html = str_html + "<td style='text-align: right !important'><span class='dimtext' title='"+due_amount+"'>"+due_amount+"</span></td>";
			                            	str_html = str_html + "<td style='text-align: center !important'><i class='icon-play' style='color: #DE9797'></i></td>";
			                            	str_html = str_html + "<td style='text-align: center !important'><a href='"+site_url_+"/fee/print_latest_receipt/"+obj.fetch_invoice_for_receipt[index].INVDETID+"' target='_blank'><span class='print_invoice'><i class='icon-print print_latest_receipt' id='print_fee~"+obj.fetch_invoice_for_receipt[index].INVDETID+"'></i></span></a></td>";
			                            } else {
			                            	str_html = str_html + "<td style='text-align: right !important'><span class='red_' title='"+due_amount+"'>"+due_amount+"</span></td>";
			                            	str_html = str_html + "<td style='text-align: center !important'><i class='icon-play myreceipt' id='pay_fee~"+obj.fetch_invoice_for_receipt[index].INVDETID+"~"+obj.fetch_class_students[loop1].regid+"' style='color: #ff0000'></i></td>";
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
	        	}
	    	return false;
	    	});
			$('body').on('click', '.myreceipt', function(){
		        var id_ = this.id;
		        var arr = id_.split('~');
		        var invdetid = arr[1];
		        var regid_ = arr[2];
		        
		        data_ = "invdetid="+invdetid+"&clssessid="+$('#class_in_session_for_Receipt').val()+"&regid_="+regid_;
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
		                
		                //amount_ = parseFloat(obj.fetch_receipt_data[0].ACTUAL_AMOUNT)/parseInt(obj.fetch_receipt_data[0].NOM);
		                amount_ = parseFloat(obj.fetch_receipt_data[0].DUE_AMOUNT);
		                pay_amount = obj.fetch_receipt_data[0].DUE_AMOUNT;
		                actual_ = parseFloat(obj.fetch_receipt_data[0].ACTUAL_AMOUNT);
		                due_actual = amount_ - parseFloat(obj.fetch_receipt_data[0].ACTUAL_AMOUNT);
		                
		                if(due_actual < 0){
		                    due_actual = 0;
		                }
		                var fixed_heads = '';
		                if(obj.fetch_receipt_data[0].STATIC_HEADS_1_TIME != ''){
		                	fixed_heads = fixed_heads + obj.fetch_receipt_data[0].STATIC_HEADS_1_TIME;
		            	}
		                if(obj.fetch_receipt_data[0].STATIC_HEADS_N_TIMES != ''){
		                	fixed_heads = fixed_heads + ", " + obj.fetch_receipt_data[0].STATIC_HEADS_N_TIMES;
		            	}

		            	var flexi_heads = '';
		                if(obj.fetch_receipt_data[0].FLEXIBLE_HEADS_1_TIME != ''){
		                	flexi_heads = flexi_heads + obj.fetch_receipt_data[0].FLEXIBLE_HEADS_1_TIME;
		            	}
		                if(obj.fetch_receipt_data[0].FLEXIBLE_HEADS_N_TIMES != ''){
		                	flexi_heads = flexi_heads + ", " + obj.fetch_receipt_data[0].FLEXIBLE_HEADS_N_TIMES;
		            	}
		                
		                // Calculation of discount for category or sibling
		                var discount_category = 'x';
		                	if(obj.sibling_discount != null){
		                		var sibling_arr = (obj.sibling_discount.SIBLINGS).split(',');
		                		var sibling_length = parseInt(sibling_arr.length);
		                		var discount_sibling_value = obj.fetch_discount_data.AMOUNT;

		                		if(obj.fetch_discount_data.STATUS_ == 'Percentage'){
		                			var discount_amt = parseInt(parseInt(actual_)*(parseInt(discount_sibling_value)/100));
		                			var total_discount_amount = parseInt(discount_amt) * sibling_length;
		                		} else {
		                			var total_discount_amount = parseInt(discount_sibling_value) * parseInt(sibling_length);
		                		}
		                		discount_category = 'SIBLINGS';
		                	} else {
		                		var total_sibling = 0;
		                		var total_discount_amount = 0;
		                	}
		                	if(obj.fetch_category_discount_data != null){
		                		var categ_discount_amnt = obj.fetch_category_discount_data.AMOUNT;
		                		if(obj.fetch_category_discount_data.STATUS_ == 'Percentage'){
		                			var total_categ_discount_amount = parseInt(parseInt(actual_)*(parseInt(categ_discount_amnt)/100));
		                		} else {
		                			var total_categ_discount_amount = categ_discount_amnt;
		                		}
		                		if(discount_category != 'x'){
		                			if(obj.fetch_category_discount_data.ITEM_ != 'GENERAL'){
		                				discount_category = discount_category + "," + obj.fetch_category_discount_data.ITEM_;
		                			}
		                		} else {
		                			if(obj.fetch_category_discount_data.ITEM_ != 'GENERAL'){
		                				discount_category = obj.fetch_category_discount_data.ITEM_;
		                			}
		                		}
		                	} else {
		                		var total_categ_discount_amount = 0;
		                	}
		                	var category_amount_to_store = '';
		                	if(total_discount_amount != 0){
		                		category_amount_to_store = category_amount_to_store + total_discount_amount;
		                	}
		                	if(total_categ_discount_amount != 0 && category_amount_to_store != ''){
		                		category_amount_to_store = category_amount_to_store + "," + total_categ_discount_amount;	
		                	} else if(total_categ_discount_amount != 0){
		                		category_amount_to_store = category_amount_to_store + total_categ_discount_amount;
		                	}

		                	var discount_if_any = 0;
		                	discount_if_any = parseInt(discount_if_any) + parseInt(total_discount_amount) + parseInt(total_categ_discount_amount);
		                // -----------------------------------------------
		                var fine_if_any = 0;
		                total_amount = (parseFloat(pay_amount)+parseInt(fine_if_any))-parseInt(discount_if_any);
		                if(total_amount < 0){
		                    total_amount = 0;
		                }
		                var str_html='';
		                var words = inWords(total_amount);

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
		                str_html = str_html + "<td width='200px'>Pay <span style='float: right; padding: 8px 0px; font-size: 11px' class='fa fa-plus'></span></td>";
		                str_html = str_html + "<td width='160px'><label class='receipt_label'>: Rs. </label><span class='receipt_content'><input type='text' id='due_amnt_input' name='due_amnt_input' value="+pay_amount+" style='width: 100px; padding: 0px; border:#f0f0f0 solid 1px' />/-</span></td>";
		                str_html = str_html + "</tr>";
		                str_html = str_html + "<tr>";
		                str_html = str_html + "<td style='color: #909000'>Discount? <span style='float: right; padding: 8px 0px; font-size: 11px' class='fa fa-minus'></span>";
		                str_html = str_html + "<div style='float: left; font-size: 8px; color: #0000ff'>";
		                str_html = str_html + "Sibling: "+total_discount_amount+" + "+"Category: "+total_categ_discount_amount+".";
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
		                if(total_amount > 0){
		                    display_ = 'visibility:visible;';
		                } else {
		                    display_ = 'visibility:hidden;';
		                }
		                str_html = str_html + "<tr><td colspan='2'>";
		                str_html = str_html + "<div class='col-sm-5' style='"+display_+"font-size: 10px; text-align: right' id='submit_print'>";
		                str_html = str_html + "<input type='button' value='Submit Fee' class='btn btn-primary' id='cmbReceiptButton' />";
		                str_html = str_html + "</div>";
		                str_html = str_html + "</td></tr></table>";
		                
		                str_html = str_html + "</form>";
		                str_html = str_html + "<center>";
		                
		                $('#class_PayFee_here').html(str_html);    
		                $('#class_in_session_for_Receipt').val("Class");
		                $('#s2id_class_in_session_for_Receipt span').text("Class");   
		            }, error: function (xhr, ajaxOptions, thrownError) {       
	                    $("#class_PayFee_here").append(xhr.responseText);
	                }
		        });
		    });
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
		            if(total_amnt < 0){
		                total_amnt = 0;
		            }
		            $('#total_amnt').val(total_amnt);
		            $('#total_amnt_display').html(total_amnt);
		            words_ = inWords(total_amnt);
		            $('#total_amnt_in_words').html(words_.toUpperCase());
		            if(total_amnt > 0){
		                //desc_ = $('#txtDesc').val();
		                $('#submit_print').css({'visibility':'visible'});
		            }
		        } else {
		            $('#total_amnt_in_words').html('Please Check all values.');
		            $('#submit_print').css({'visibility':'hidden'});
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
		    
		    $('body').on('keypress', '#_discount_', function(){
		        $('#_discount_').css({'border': '#f0f0f0 solid 1px'});
		        $('#submit_print').css({'visibility':'hidden'});
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
		            data_ = $('#frmReceiptCreation').serialize();
		            url_ = site_url_ + "/fee/createReceipt";
		            $('#submit_print').html('Loading...');
		            $.ajax({
		                url: url_,
		                type: "POST",
		                data: data_,
		                success: function(data){
		                    obj = JSON.parse(data);
		                    if(obj.receipt_id != 'x'){
		                    	$('#submit_print').html("<div style='float: right; color: #ff0000; padding: 0px 0px 0px 0px'><a href='"+site_url_+'/fee/fee_print/'+obj.receipt_id+"' class='btn btn-danger' target='_blank'>Print Fee</a></div><div style='float: right; color: #ff0000; padding: 0px 10px 0px 0px'>"+obj.receipt_msg+"</div>");
		                    } else {
		                    	$('#submit_print').html("<div style='float: right; color: #ff0000; padding: 0px 10px 0px 0px'>"+obj.receipt_msg+"</div>");
		                    }
		                    $('#receiptNo').html(obj.receipt_id);
		                }, error: function (xhr, ajaxOptions, thrownError) {       
		                    $("#submit_print").append(xhr.responseText);
		                }
		            });
		        }
		    return false;
		    });
			// -------------------------------
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
	            
	            $.ajax({
	                type    : 'POST',
	                url     : url_,
	                data    : checkdata_,
	                success : function(data){
	                    if(data == 1){
	                        if($('#cmbClassesForStudents').find('option:selected').text() == 'Select'){
	                            $('#caption_for_class').html("STUDENTS FOR CLASS -");
	                        } else {
	                            $('#caption_for_class').html("STUDENTS FOR "+$('#cmbClassesForStudents').find('option:selected').text().toUpperCase());
	                        }
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
		                            	str_html = str_html + "<td style='width:30px; text-align: left; background: #f0f0f0'>";
		                            	str_html = str_html + "<input type='checkbox' class='checkboxall' name='attendance_status' id='"+obj[i].regid+"' />";
		                            	str_html = str_html + "</td>";
		                            	str_html = str_html + "<td style='width:120px; text-align: left; background: #ffffff'>";
		                            	str_html = str_html + obj[i].regid;
		                            	str_html = str_html + "</td>";
		                            	str_html = str_html + "<td style='width:auto; text-align: left; background: #f0f0f0'>";
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
	                    	var str_html = '';
	                        str_html = str_html + "<tr><td colspan='3' style='color: #ff0000; background: #ffffff; width:100%; border-radius: 5px; padding: 10px; text-align: center; font-size: 15px'>Attendance for <b>Class "+class_+"</b> with selected date & time is already entered. Please Select another class/ date/ time.</td></tr>";
	                        $('#students_here').html(str_html);
	                        
	                    }
	                }, error: function(xhr, status, error){
						callDanger(xhr.responseText);
					}
	            });
	        } else {
	            $('#caption_for_class').html("STUDENTS FOR CLASS -");
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
	                    if(obj.messageNo == 1){
	                        if(obj.nos.length != 0){
	                            str = '';
	                            moblength = obj.nos.length;
	                            /* // This below code will be used when you want to send sms to absantee's parents
	                            for(i=0;i<moblength;i++){
	                                if(i < moblength-1){
	                                    str = str + $.trim(obj.nos[i].MOBILE_S) + ",";
	                                    str = $.trim(str);
	                                } else if(i == moblength-1){
	                                    str = str + $.trim(obj.nos[i].MOBILE_S); 
	                                    str = $.trim(str);   
	                                }
	                            }
	                            $('#mobilenumbers').val(str);
	                            d = obj.nos[0].DATE_;
	                            dt = d.split('-');
	                            dt_ = dt[2]+"/"+dt[1]+"/"+dt[0];
	                            $('#Absent_Message').val("Your ward is absent today i.e. ("+dt_+"). Please motivate him/her to attend classes regularly.");
	                            $('#MessageToPrint').val("Attendance for class <span style='font-weight: bold; color: #ffff00'>"+class_+"</span> successfully submitted.");
								//$('#myModal').modal('show');
								*/
	                            callSuccess("Attendance for class <span style='font-weight: bold; color: #ffff00'>"+class_+"</span> successfully submitted.");
	                        }
	                    } else if(obj.messageNo == 2){   
	                        $('#msg_here').html("Something goes wrong. Please try again...");
	                    } else if(obj.messageNo == 3){
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
	    	$('#resetAttendForm').click();
	    	fillClasses_for_attendance();
	    	$('#s2id_attendanceHour span').text('HR');
	    	$('#s2id_attendanceMin span').text('MIN');
	    	$('#s2id_attendanceAMPM span').text('AM/PM');
	    	$('#atten_check').prop('checked', false);
			$('#uniform-atten_check span').removeClass('checked');
	    }
	    $('#frmSMS').submit(function(){ 
	    	var url_ = site_url_ + "/attendance/sendSMS";
	    	var data_ = $('#frmSMS').serialize();
	    	
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
	        	$('.attendance_0_1').val('1');
	    	} else {
	    		$(".checkboxall").prop('checked', false);
	        	$('.attendance_0_1').val('0');
	    	}
	    });
	    

	    $(".checkboxall").live('click', function(){
	        if($('#'+this.id).prop( "checked" ) == true){
	            $('#'+this.id+'_').val('1');
	        } else {
	            $('#'+this.id+'_').val('0');
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
	                                    str_html = str_html + "<td align='left'>" + obj.daywise[loop2].STATUS + "</td>";
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
	                        DT_ = obj.date_[tm].DATE_;
	                        str_html = str_html + "<th style='text-align: center'>"+DT_+"</th>";
	                    }
	                    str_html = str_html + "<th style='text-align: center'>Attended</th>";
	                    str_html = str_html + "<th style='color: #0000ff; text-align: center'>Total held</th>";
	                    str_html = str_html + "<th style='color: #ff0000; text-align: center'>%age</th>";
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
	                            str_html = str_html + "<td style='text-align: center'>" + t_ + "</td>";
	                            total = total + t_;
	                        }
	                        str_html = str_html + "<td style='text-align: center'>" + total + "</td>";
	                        str_html = str_html + "<td style='color: #0000ff;text-align: center'>" + totalClasses + "</td>";
	                        per = (total/totalClasses)*100;
	                        if(per < limitpercentage){
	                            str_html = str_html + "<td style='color: #ff0000;text-align: center'>" + per.toFixed(2) + "</td>";
	                        } else {
	                            str_html = str_html + "<td style='color: #009000;text-align: center'>" + per.toFixed(2) + "</td>";
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
	                    str_html = str_html + "<th style='text-align: center'>Attended</th>";
	                    str_html = str_html + "<th style='color: #0000ff; text-align: center'>Total held</th>";
	                    str_html = str_html + "<th style='color: #ff0000; text-align: center'>%age</th>";
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
	                        str_html = str_html + "<td style='color: #0000ff;text-align: center'>" + totalClasses + "</td>";
	                        per = (total/totalClasses)*100;
	                        if(per < limitpercentage){
	                            str_html = str_html + "<td style='color: #ff0000;text-align: center'>" + per.toFixed(2) + "</td>";
	                        } else {
	                            str_html = str_html + "<td style='color: #009000;text-align: center'>" + per.toFixed(2) + "</td>";
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
						str = str + "<td>" + obj.class_students[i].regid + "</td>";
						str = str + "<td>" + obj.class_students[i].FNAME + "</td>";
						str = str + "</tr>";
					}
					$('#class_name').html(strarray[1]);
					$('#student_data_here_as_per_class').html(str);
				}, error: function(xhr, status, error){
					$('#student_data_here_as_per_class').html(xhr.responsetext);
				}
			});

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
	// -----------

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

});