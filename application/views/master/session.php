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
                        <button type="submit" class="btn btn-success">Create New Session</button>
                        <button type="submit" class="btn btn-primary">Reset</button>                             
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
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>Session</th>
                            <th>Session Start</th>
                            <th>Session End</th>                 
                        </tr>
                    </thead>
                    <tbody id="tabSession"> 
                        <?php foreach ($session as $item) { ?>
                            <tr class='gradeX'>
                                <td><?php echo $item->SESSID; ?></td>
                                <td><?php echo $item->SESSSTART; ?></td>
                                <td><?php echo $item->SESSEND; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>