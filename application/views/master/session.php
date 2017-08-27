<div class="row-fluid">
    <div class="span6">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>New Session</h5>
            </div>
            <div class="widget-content nopadding">
                <div class="control-group">
                    <?php
                    $attrib_ = array(
                        'class' => 'form-horizontal',
                        'name' => 'frmSession',
                        'id' => 'frmSession',
                    );
                    ?>
                    <?php echo form_open('#', $attrib_); ?>
                    <label class="control-label">Session Start</label>
                    <div class="controls">                        
                        <?php
                        $data = array(
                            'type' => 'text',
                            'class' => 'datepicker span11',
                            'data-date-format' => 'mm-dd-yyyy',
                            'name' => 'startYear',
                            'id' => 'startYear',
                            'value' => date('d-m-Y'),
                            'required' => 'required'
                        );
                        echo form_input($data);
                        ?>                                                   
                    </div>
                    <label class="control-label">Session End</label>
                    <div class="controls">                        
                        <?php
                        $data = array(
                            'type' => 'text',
                            'class' => 'datepicker span11',
                            'data-date-format' => 'mm-dd-yyyy',
                            'name' => 'endYear',
                            'id' => 'endYear',
                            'value' => date('d-m-Y'),
                            'required' => 'required'
                        );
                        echo form_input($data);
                        ?>                                                   
                    </div>
                    <div class="form-actions" align="right">                        
                        <input type="button" value="Create New Session" class="btn btn-success sessionSubmit">
                        <button type="reset" class="btn btn-primary">Reset</button>                             
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>            
        </div>
    </div>

    <div class="span6">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Existing Sessions</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>                            
                            <th>Session</th>
                            <th>Session Start</th>
                            <th>Session End</th>
                        </tr>
                    </thead>
                    <tbody id="tabSession1"> 
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>