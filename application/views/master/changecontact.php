<div class="row-fluid">
    <div class="span4">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>Class</h5>
            </div>
            <div class="widget-content">               
                    <?php
                    $attrib_ = array(
                        'class' => 'form-vertical',
                        'name' => 'frmStudentContact',
                        'id' => 'frmStudentContact',
                    );
                    ?>
                    <?php echo form_open('#', $attrib_); ?>
                    <div class="control-group">
                        <label class="control-label">Select Class</label>
                        <div class="controls">
                            <?php
                            $data = array(
                                'name' => 'stuClassID',
                                'id' => 'stuClassID',                                   
                                'required' => 'required'                                
                            );
                            $options = array();
                            ?>
                            <?php echo form_dropdown($data, $options, ''); ?>
                        </div>
                    </div>                                        
                    <?php echo form_close(); ?>                
            </div>            
        </div>
    </div>

    <div class="span7">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5 id="exitHeading">Student in  Selected Class</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered">
                    <thead>
                        <tr style="text-align: left;">                            
                            <th>Sr.No</th>
                            <th>Name</th>
                            <th>Father's Name</th>                            
                            <th>Contact</th>                            
                            <th>Action</th>  
                        </tr>
                    </thead>
                    <tbody id="tabStudents"> 

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>