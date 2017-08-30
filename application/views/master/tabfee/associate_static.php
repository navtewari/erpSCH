<div class="row-fluid">
	<div class="controls span4">
		<div class="widget-box">
            <div  style="border: #ff0000 solid 0px; width: 50px; height:50px; float: right; right: 0px; z-index: 2222; position: absolute;" id="student_photo_here"></div>
            <div class="widget-title"> <span class="icon"> <i class="icon-ok-sign"></i> </span>
                <h5>Static Heads</h5>
            </div>
            <div class="widget-content">
                <div class="control-group">
                    <label class="control-label">Select Head</label>
                    <div class="controls">
                        <?php
                            $data = array(
                                'name' => 'cmbStaticHeads',
                                'id' => 'cmbStaticHeads',
                                'class' => 'span12',
                                'required' => 'required'
                            );
                            $options = array();
                            $options['x'] = 'Select Head';
                            foreach ($static_heads__ as $itemStaticHeadtoSelect) {
                            	$options[$itemStaticHeadtoSelect->ST_HD_ID] = $itemStaticHeadtoSelect->FEE_HEAD;
                            }
                        ?>
                        <?php echo form_dropdown($data, $options, 'x'); ?>
                    </div>
                </div>
                 <div class="control-group">
                    <label class="control-label">Amount</label>
                    <div class="controls">
                        <?php
                            $data = array(
                                'type' => 'text',
                                'class'=>"span12 text",
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'name' => 'txtFeeStaticHeadAmt',
                                'id' => 'txtFeeStaticHeadAmt'
                            );
                            echo form_input($data);
                        ?>
                    </div>
                </div>
            </div>
        </div>
	</div>
	<div class="controls span3">
		<div class="widget-box">
          <div class="widget-title"> <span class="icon">
            <input type="checkbox" id="title-checkbox" name="title-checkbox" />
            </span>
            <h5>Classes in Session <?php echo $this->session->userdata('_current_year___'); ?></h5>
          </div>
          <div class="widget-content nopadding" style="overflow: auto; height: 350px">
            <table class="table table-bordered table-striped with-check">
              <thead>
                <tr>
                  <th><i class="icon-resize-vertical"></i></th>
                  <th style="text-align: left">Select Classe(s)</th>
                </tr>
              </thead>
              <tbody id="classes_associates_staticHeads">
                
              </tbody>
            </table>
          </div>
	   </div>
       <div class="control-group">
            <div class="controls">
                <input type="button" value="Add Fee to selected Class" class="btn btn-success span9" id="associate_static_head_with_classes">
                <input type="reset" value="X" class="btn btn-danger cancel_static_associates_classes span3">
            </div>
        </div>
    </div>
    <div class="controls span5" id="accordion_staticHeads_in_classes">
        <div class="accordion" id="collapse-group">
            <div class="accordion-group widget-box">
                <div class="accordion-heading">
                    <div class="widget-title"> 
                        <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse"> 
                            <span class="icon"><i class="icon-plus-sign"></i></span>
                            <h5>Accordion option1</h5>
                        </a> 
                    </div>
                </div>

                <div class="collapse in accordion-body" id="collapseGOne">
                    <div class="widget-content"> This is opened by default </div>
                </div>
            </div>
        </div>
    </div>
</div>