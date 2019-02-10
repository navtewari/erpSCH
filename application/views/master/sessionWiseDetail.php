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
                        'name' => 'frmAddSessionWiseDetail',
                        'id' => 'frmAddSessionWiseDetail',
                    );
                    ?>
                    <?php echo form_open('#', $attrib_); ?>
                    <div class="control-group">
                        <label class="control-label">Select Class</label>
                        <div class="controls">
                            <?php
                            $data = array(
                                'name' => 'cmbClassesForSessionWiseDetail',
                                'id' => 'cmbClassesForSessionWiseDetail',                                   
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
                <h5 id="classHead">Student in  Selected Class</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered">
                    <thead>
                        <tr style="text-align: left;">                            
                            <th>Reg No.</th>
                            <th>Name</th>
                            <th>Weight</th>                            
                            <th>Height</th>                            
                            <th>Vision Left</th>  
                            <th>Vision Right</th>
                        </tr>
                    </thead>
                    <tbody id="tabStudents"> 

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>