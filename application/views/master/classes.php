<div class="row-fluid">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#newClass">New Class</a></li>
                    <li><a data-toggle="tab" href="#sessionClass">Session Wise Class</a></li>                    
                </ul>
            </div>
            <div class="widget-content tab-content">
                <div id="newClass" class="tab-pane active">
                    <div class="span6">
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                                <h5>New Class</h5>
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
                <div id="sessionClass" class="tab-pane">
                    <p> waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end.multiple paragraphs and is full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end. </p>
                </div>                
            </div>
        </div>
    </div>    
</div>