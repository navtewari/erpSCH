<div class="row-fluid">
    <div class="span4">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>Grades</h5>
            </div>
            <div class="widget-content nopadding">
                <div class="control-group">
                    <?php
                    $attrib_ = array(
                        'class' => 'form-horizontal',
                        'name' => 'frmGrades',
                        'id' => 'frmGrades',
                    );
                    ?>
                    <?php echo form_open('#', $attrib_); ?>
                    <div class="control-group">
                        <label class="control-label">Select Class</label>
                        <div class="controls">
                            <?php
                            $data = array(
                                'name' => 'cmbClassofGrading',
                                'id' => 'cmbClassofGrading',
                                'required' => 'required'
                            );
                            $options = array();
                            ?>
                            <?php echo form_dropdown($data, $options, ''); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Minimum Marks</label>
                        <div class="controls">                        
                            <?php
                            $data = array(
                                'type' => 'text',
                                'class' => 'span11',
                                'name' => 'minMarks',
                                'id' => 'minMarks',
                                'required' => 'required'
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
                                'class' => 'span11',
                                'name' => 'maxMarks',
                                'id' => 'maxMarks',
                                'required' => 'required'
                            );
                            echo form_input($data);
                            ?>                                                  
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Grade</label>
                        <div class="controls">                        
                            <?php
                            $data = array(
                                'type' => 'text',
                                'class' => 'span11',
                                'name' => 'txtGrade',
                                'id' => 'txtGrade',
                                'required' => 'required'
                            );
                            echo form_input($data);
                            ?>                                                  
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Description (if any)</label>
                        <div class="controls">                        
                            <?php
                            $data = array(
                                'type' => 'text',
                                'class' => 'span11',
                                'name' => 'txtDesc',
                                'id' => 'txtDesc'
                            );
                            echo form_input($data);
                            ?>                                                  
                        </div>
                    </div>
                    <div class="form-actions" align="right">                        
                        <input type="button" value="Create Grading" class="btn btn-success gradingSubmit">
                        <button type="reset" class="btn btn-primary">Reset</button>                             
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>            
        </div>
    </div>

    <div class="span4">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5 id="exitHeading">Existing Grades</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered">
                    <thead>
                        <tr style="text-align: left;">                            
                            <th>Marks</th>
                            <th>Grade</th>
                            <th>Description</th>
                            <th>Action</th>                            
                        </tr>
                    </thead>
                    <tbody id="tabGrading"> 

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="span4" id="editGrade" style="display: none">
        <div class="widget-box">
            <div class="widget-title" style="color: #cc3300"> <span class="icon"> <i class="icon-pencil"></i> </span>
                <h5 style="color: #cc3300">Grades</h5>
            </div>
            <div class="widget-content nopadding">
                <div class="control-group">
                    <?php
                    $attrib_ = array(
                        'class' => 'form-horizontal',
                        'name' => 'frmGrades_Edit',
                        'id' => 'frmGrades_Edit',
                    );
                    ?>
                    <?php echo form_open('#', $attrib_); ?>
                    <div class="control-group">
                        <label class="control-label" style="color: #cc3300">Selected Class</label>
                        <div class="controls">
                            <?php
                            $data = array(
                                'type' => 'text',
                                'class' => 'span11 required',
                                'name' => 'ClassID_Edit',
                                'id' => 'ClassID_Edit',
                                'disabled' => 'disabled',
                                'required' => 'required'
                            );
                            echo form_input($data);

                            $data = array(
                                'type' => 'hidden',
                                'class' => 'span11',
                                'name' => 'gradeID_Edit',
                                'id' => 'gradeID_Edit',
                                'required' => 'required'
                            );
                            echo form_input($data);
                            
                            $data = array(
                                'type' => 'hidden',
                                'class' => 'span11',
                                'name' => 'classID_Edit',
                                'id' => 'classID_Edit',
                                'required' => 'required'
                            );
                            echo form_input($data);
                            ?>                            
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" style="color: #cc3300">Minimum Marks</label>
                        <div class="controls">                        
                            <?php
                            $data = array(
                                'type' => 'text',
                                'class' => 'span11',
                                'name' => 'minMarks_Edit',
                                'id' => 'minMarks_Edit',
                                'required' => 'required'
                            );
                            echo form_input($data);
                            ?>                                                  
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" style="color:#cc3300">Maximum Marks</label>
                        <div class="controls">                        
                            <?php
                            $data = array(
                                'type' => 'text',
                                'class' => 'span11',
                                'name' => 'maxMarks_Edit',
                                'id' => 'maxMarks_Edit',
                                'required' => 'required'
                            );
                            echo form_input($data);
                            ?>                                                  
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" style="color: #cc3300">Grade</label>
                        <div class="controls">                        
                            <?php
                            $data = array(
                                'type' => 'text',
                                'class' => 'span11',
                                'name' => 'txtGrade_Edit',
                                'id' => 'txtGrade_Edit',
                                'required' => 'required'
                            );
                            echo form_input($data);
                            ?>                                                  
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" style="color: #cc3300">Description (if any)</label>
                        <div class="controls">                        
                            <?php
                            $data = array(
                                'type' => 'text',
                                'class' => 'span11',
                                'name' => 'txtDesc_Edit',
                                'id' => 'txtDesc_Edit'
                            );
                            echo form_input($data);
                            ?>                                                  
                        </div>
                    </div>
                    <div class="form-actions" align="right">                        
                        <input type="button" value="Update Grading" class="btn btn-danger gradingEdit">
                        <button type="button" class="btn btn-primary gradingEditCancel">Cancel</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>            
        </div>
    </div>
</div>