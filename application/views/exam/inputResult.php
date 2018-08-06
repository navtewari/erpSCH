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
                    <?php
                    $attrib_ = array(
                        'class' => 'form-horizontal',
                        'name' => 'frmInputResult',
                        'id' => 'frmInputResult',
                    );
                    ?>
                    <?php echo form_open('#', $attrib_); ?>
                    <div class="span5">
                        <div class="widget-box"  id="newClass">
                            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                                <h5>Input Students Marks</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <div class="control-group">                                    
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

                                    <div class="control-group" style="display:none" id="subjectHidden">
                                        <div class="control-group">
                                            <label class="control-label">Select Subject</label>
                                            <div class="controls">                                            
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

                                </div>
                            </div>            
                        </div>

                    </div>

                    <div class="span7">
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                                <h5 id="exitHeading">Scholastic items already present</h5>
                            </div>
                            <div class="widget-content nopadding" style="height:auto; overflow: scroll">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>                                   
                                            <th style="text-align:left;width:40%">Reg. No.</th>
                                            <th style="text-align:left;width:40%">Student Name</th>                                           
                                            <th style="text-align: center" id="trMarks">Marks</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody id="tabStudentsMarks"> 

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="form-actions" align="right" id="divSubmitResultMarks" style="display: none;">                        
                            <input type="button" value="Submit Marks" class="btn btn-success submitMarks" style="width:300px;">                                                        
                        </div>
                        
                        <div class="form-actions" align="right" id="divUpdateResultMarks" style="display: none;">                        
                            <input type="button" value="Update Marks" class="btn btn-success updateMarks" style="width:300px;">                                                        
                        </div>
                    </div> 
                    <?php echo form_close(); ?>
                </div>
                <div id="sessionClass" class="tab-pane">
                    <?php $this->load->view('exam/addExamTerm'); ?>
                </div>                
            </div>
        </div>
    </div>    
</div>