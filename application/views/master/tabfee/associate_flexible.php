<div class="row-fluid">
	<div class="controls span4">
            <div class="widget-box">
	          <div class="widget-title">
	            <h5>Flexible Heads</h5>
	          </div>
	          <div class="widget-content nopadding" style="overflow: auto; height: 200px">
	            <table class="table table-bordered table-striped with-check">
	              <thead>
	                <tr>
	                  <th><i class="icon-resize-vertical"></i></th>
	                  <th style="text-align: left">Select Flexible Head</th>
	                </tr>
	              </thead>
	              <tbody id="flexibleHeads_for_associating_Students">
	              </tbody>
	            </table>
	          </div>
	        </div>
        </div>
	<div class="controls span3">
		<div class="widget-box">
          <div class="widget-title"> 
            <h5>Classes in Session <?php echo $this->session->userdata('_current_year___'); ?></h5>
          </div>
          <div class="widget-content nopadding" style="overflow: auto; height: 350px">
            <table class="table table-bordered table-striped with-check">
              <thead>
                <tr>
                  <th><i class="icon-resize-vertical"></i></th>
                  <th style="text-align: left">Select Class</th>
                </tr>
              </thead>
              <tbody id="classes_to_find_students">
                
              </tbody>
            </table>
          </div>
	   </div>
    </div>
    <div class="controls span5">
      <div class="control-group">
        <div class="widget-box">
          <div class="widget-title">
            <div style="float: left; padding: 5px; border:#C0C0C0 solid 1px; width: 20px;height: 25px; text-align: center">
              <input type="checkbox" id="classes_associates_students_for_flexibleHeads_check_boxes" />
            </div>
            <h5 id="name_of_class_for_students"></h5>
            <div style="clear: both"></div>
          </div>
          <div class="widget-content nopadding" style="overflow: auto; height: 300px">
            <table class="table table-bordered table-striped with-check">
              <thead>
                <tr>
                  <th><i class="icon-resize-vertical"></i></th>
                  <th style="text-align: left">Select Classe(s)</th>
                </tr>
              </thead>
              <tbody id="students_for_selected_class">
                
              </tbody>
            </table>
          </div>
      </div>
     </div>
     <div class="control-group">
            <div class="controls">
                <input type="button" value="Add Fee to selected Student(s)" class="btn btn-success span9" id="associate_flexible_head_with_Students">
                <input type="reset" value="X" class="btn btn-danger cancel_sassociate_flexible_head_with_Student span3" style="float: right">
            </div>
        </div>
    </div>
</div>
<hr />
<h4>View Associated Flexible Heads</h4>
<div class="row-fluid">
    <div class="controls span12">
      <?php $this->load->view('master/tabfee/view_associated_flexible_heads_to_students');?>
    </div>
</div>