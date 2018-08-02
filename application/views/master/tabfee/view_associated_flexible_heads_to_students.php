<div class="controls span4">
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
          <tbody id="classes_to_View_Students_status">
            
          </tbody>
        </table>
      </div>
    </div>
</div>
<div class="controls span8">
  <div class="widget-box">
    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
        <h5>Associated Heads for the Selected Class</h5>
    </div>
    <input type="hidden" value="NA" id="AssociatedClass_to_FlexiHead">
    <div class="widget-content" style="overflow: hidden" id="AssociatedHeads_against_selectedClass">
        &nbsp;
    </div>
  </div>
<div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Students with there Felxible Heads</h5>
                <h5 style="float: right;"><a href="" class="icon-print"></a></h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered" id="print_associated_flex_with_students" style="text-align: left">
                    <thead>
                        <tr>
                        <th style="text-align: left">Registration No</th>
                        <th style="text-align: left">Name</th>
                        <th style="text-align: left">Flexible Heads</th>
                        </tr>
                    </thead>
                    <tbody id="student_associated_flexibleheads_classwise">
                    </tbody>
                </table>
            </div>
        </div>
    </div>