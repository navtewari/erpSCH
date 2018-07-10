<div class="row-fluid">
    <div class="span5">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>Enter Subject Marks</h5>
            </div>
            <div class="widget-content nopadding">
                <div class="control-group">
                    <?php
                    $attrib_ = array(
                        'class' => 'form-horizontal',
                        'name' => 'frmSubjectMarks',
                        'id' => 'frmSubjectMarks',
                    );
                    ?>
                    <?php echo form_open('#', $attrib_); ?>
                    <div class="control-group">
                        <label class="control-label">Select Class</label>
                        <div class="controls">
                            <?php
                            $data = array(
                                'name' => 'subClassMarksID',
                                'id' => 'subClassMarksID',
                                'required' => 'required'
                            );
                            $options = array();
                            ?>
                            <?php echo form_dropdown($data, $options, ''); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Select Subject</label>
                        <div class="controls">
                            <?php
                            $data = array(
                                'name' => 'cmbSubject',
                                'id' => 'cmbSubject',
                                'required' => 'required'
                            );
                            $options = array();
                            ?>
                            <?php echo form_dropdown($data, $options, ''); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Maximum Marks</label>
                        <div class="controls">
                            <?php
                                $data = array(
                                    'type' => 'text',
                                    'autocomplete' => 'off',
                                    'required' => 'required',
                                    'class' => 'span11',
                                    'name' => 'txtmaxMarks',
                                    'id' => 'txtmaxMarks',
                                    'value' => ''
                                );
                                echo form_input($data);
                                ?>  
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Maximum Marks</label>
                        <div class="controls">
                            <?php
                                $data = array(
                                    'type' => 'text',
                                    'autocomplete' => 'off',
                                    'required' => 'required',
                                    'class' => 'span11',
                                    'name' => 'txtpassMarks',
                                    'id' => 'txtpassMarks',
                                    'value' => ''
                                );
                                echo form_input($data);
                            ?>  
                        </div>
                    </div>
                    <div class="form-actions" align="right">                        
                        <input type="button" value="Submit Marks" class="btn btn-success subjectMarksSubmit">
                        <button type="reset" class="btn btn-primary">Reset</button>                             
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>            
        </div>
    </div>

    <div class="span5">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5 id="exitHeading">Existing Subjects</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered">
                    <thead>
                        <tr style="text-align: left;">                            
                            <th>Subject Name</th>
                            <th>Maximum Marks</th>                            
                            <th>Passing Marks</th>                            
                            <th>Action</th>                            
                        </tr>
                    </thead>
                    <tbody id="tabSubjects"> 

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>