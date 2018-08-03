<div class="row-fluid">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#newClassEntry">Input Students Marks</a></li>
                    <li><a data-toggle="tab" href="#sessionClass">Manage Exam Term</a></li>                    
                </ul>
            </div>
            <div class="widget-content tab-content">
                <div class="tab-pane active" id="newClassEntry">
                    <div class="span5">
                        <div class="widget-box"  id="newClass">
                            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                                <h5>Input Students Marks</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <div class="control-group">
                                    <?php
                                    $attrib_ = array(
                                        'class' => 'form-horizontal',
                                        'name' => 'frmInputResult',
                                        'id' => 'frmInputResult',
                                    );
                                    ?>
                                    <?php echo form_open('#', $attrib_); ?>
                                    <div class="control-group">
                                        <div class="control-group">
                                            <label class="control-label">Select Exam Term</label>
                                            <div class="controls">
                                                <?php
                                                $data = array(
                                                    'name' => 'cmbExamTerm',
                                                    'id' => 'cmbExamTerm',
                                                    'required' => 'required'
                                                );
                                                $options = array();
                                                ?>
                                                <?php echo form_dropdown($data, $options, ''); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="control-group">
                                            <label class="control-label">Select Class</label>
                                            <div class="controls">
                                                <?php
                                                $data = array(
                                                    'name' => 'cmbClassofResult',
                                                    'id' => 'cmbClassofResult',
                                                    'required' => 'required'
                                                );
                                                $options = array();
                                                ?>
                                                <?php echo form_dropdown($data, $options, ''); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="control-group">
                                            <label class="control-label">Select Assessment Area</label>
                                            <div class="controls">
                                                <?php
                                                $data = array(
                                                    'name' => 'cmbAssessment',
                                                    'id' => 'cmbAssessment',
                                                    'required' => 'required'
                                                );
                                                $options = array();
                                                $options['0'] = 'Choose Assessment Area';
                                                $options['1'] = 'SCHOLASTIC';
                                                $options['2'] = 'CO-SCHOLASTIC';
                                                ?>
                                                <?php echo form_dropdown($data, $options, ''); ?>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="control-group">
                                        <div class="control-group">
                                            <label class="control-label">Select Assessment Item</label>
                                            <div class="controls">
                                                <?php
                                                $data = array(
                                                    'name' => 'cmbAssessmentItem',
                                                    'id' => 'cmbAssessmentItem',
                                                    'required' => 'required'                                                    
                                                );
                                                $options = array();
                                                $options['0'] = 'Select Above Assessment Area';
                                                ?>
                                                <?php echo form_dropdown($data, $options, ''); ?>
                                            </div>
                                        </div>
                                    </div> 

                                    <div style="display:none" id="subjectHidden">
                                        <h3>Select Subject</h3>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <?php
                                                $data = array(
                                                    'class' => 'required form-control m-bot8',
                                                    'name' => 'cmbSubjectMarks',
                                                    'id' => 'cmbSubjectMarks'
                                                );
                                                $options1 = array();
                                                $options1[''] = 'SELECT SUBJECT';
                                                echo form_dropdown($data, $options1);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>            
                        </div>

                    </div>

                    <div class="span7">
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                                <h5 id="exitHeading">Scholastic items already present</h5>
                            </div>
                            <div class="widget-content nopadding" style="height:200px; overflow: scroll">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>                                   
                                            <th style="text-align:left;width:40%">Reg. No.</th>
                                            <th style="text-align:left;width:40%">Student Name</th>                                           
                                            <th style="text-align: center">Marks</th>                                                            
                                        </tr>
                                    </thead>
                                    <tbody id="tabStudentsMarks"> 

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="span4">                       
                        <div class="widget-box" id="editScholasticDiv" style="display:none;">
                            <div class="widget-title"  style="color: #cc3300"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                                <h5 style="color: #cc3300">Update Scholastic Item</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <div class="control-group">
                                    <?php
                                    $attrib_ = array(
                                        'class' => 'form-horizontal',
                                        'name' => 'frmScholastic_edit',
                                        'id' => 'frmScholastic_edit',
                                    );
                                    ?>
                                    <?php echo form_open('#', $attrib_); ?>
                                    <div class="control-group">
                                        <label class="control-label" style="color:#cc3300">Scholastic Item</label>
                                        <div class="controls">  
                                            <?php
                                            $data = array(
                                                'type' => 'hidden',
                                                'class' => 'span11 required',
                                                'name' => 'ScholasticID_Edit',
                                                'id' => 'ScholasticID_Edit',
                                                'required' => 'required'
                                            );
                                            echo form_input($data);


                                            $data = array(
                                                'type' => 'text',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'class' => 'span11',
                                                'name' => 'txtScholasticItem_edit',
                                                'id' => 'txtScholasticItem_edit',
                                                'value' => ''
                                            );
                                            echo form_input($data);
                                            ?>                                                  
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" style="color:#cc3300">Marks Allotted</label>
                                        <div class="controls">                        
                                            <?php
                                            $data = array(
                                                'type' => 'text',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'class' => 'span11',
                                                'name' => 'txtScholasticMarks_edit',
                                                'id' => 'txtScholasticMarks_edit',
                                                'value' => ''
                                            );
                                            echo form_input($data);
                                            ?>                                                    
                                        </div>
                                    </div>
                                    <div class="form-actions" align="right">                        
                                        <input type="button" value="Update Scholastic Item" class="btn btn-success submitScholastic_edit">
                                        <button type="reset" class="btn btn-primary">Reset</button>                             
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>            
                        </div>
                    </div>
                </div>
                <div id="sessionClass" class="tab-pane">
                    <?php $this->load->view('exam/addExamTerm'); ?>
                </div>                
            </div>
        </div>
    </div>    
</div>