<div class="row-fluid">
    <div class="controls span4">
        <div class="widget-box">
          <div class="widget-title">
            <h5>Discount(s) in <?php echo $this->session->userdata('_current_year___'); ?></h5>
          </div>
          <div class="widget-content nopadding" style="overflow: auto; height: 200px">
            <table class="table table-bordered table-striped with-check">
              <thead>
                <tr>
                  <th><i class="icon-resize-vertical"></i></th>
                  <th style="text-align: left">Select Discount</th>
                </tr>
              </thead>
              <tbody id="fee_heads_here">
              </tbody>
            </table>
          </div>
        </div>
    </div>
    <div class="controls span3">
        <div class="widget-box">
          <div class="widget-title">
            <div style="float: left; padding: 5px; border:#C0C0C0 solid 1px; width: 20px;height: 25px; text-align: center">
                <input type="checkbox" id="classes_for_static_heads_check_boxes" name="title-checkbox" />
            </div>
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
                <input type="reset" value="X" class="btn btn-danger cancel_static_associates_classes span3" style="float: right">
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