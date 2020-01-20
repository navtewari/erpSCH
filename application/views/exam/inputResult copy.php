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
                    <div class="span12" id="dwnldCSV" style="background: #ff9999; padding:1em; display:none">
                        <div class="control-group" style="float:right;">
                            <form name="frmdownloadExcel" class="form-horizontal" method="post" action="<?php echo site_url() . '/exporting/toCsvExam'; ?>">
                                <div class="control-group" style="background: #f2f2f2;padding-right:1em;">                                            
                                    <label class="control-label">Download CSV for bulk upload</label>
                                    <div class="controls">
                                        <input type="hidden" id="txtClassSessID" name="txtClassSessID" required/>
                                        <input type="hidden" id="txtClassName" name="txtClassName" required/>
                                        <input type="submit" value="Download CSV" class="btn btn-success"/>                                        
                                    </div>                                            
                                </div>
                            </form>
                        </div>                           
                    </div> 
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
                                                $options['3'] = 'DISCIPLINE';
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
                                                    'id' => 'cmbSubjectMarks',
                                                    'style' =>'width:98%;'
                                                );
                                                $options1 = array();
                                                $options1[''] = 'SELECT SUBJECT';
                                                echo form_dropdown($data, $options1);
                                                ?>
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

                                    <div class="control-group">
                                        <div class="control-group">
                                            <label class="control-label">Date of Exam</label>
                                            <div class="controls"> 
                                                <div  data-date="<?php echo date('d-m-Y'); ?>" class="input-append date datepicker">
                                                    <?php
                                                    $data = array(
                                                        'type' => 'text',
                                                        'class' => "required form-control span10",
                                                        'data-date-format' => "dd-mm-yyyy",
                                                        'autocomplete' => 'off',
                                                        'name' => 'txtExamDate',
                                                        'id' => 'txtExamDate',
                                                        'required' => 'required',
                                                        'style' => 'background:#D6F6FF;',
                                                        'value' => date('d-m-Y')
                                                    );
                                                    echo form_input($data);
                                                    ?>
                                                    <span class="add-on"><i class="icon-th"></i></span> 
                                                </div>
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
                                <h5 id="exitHeading">Student Marks</h5>
                            </div>
                            
                            <div class="control-group" id="uploadCsvFile" style="background: #f2f2f2;display:none">                                            
                                <label class="control-label">UPLOAD FILE</label>
                                <div class="controls">
                                    <input type="file" name="userfile" id="userfile" required="required"><br>
                                    <div id="__reg_err_msg" style="font-size:1em;"></div><br>
                                    <input type="button" name="submitCSV" id="submitCSV" value="Upload CSV with marks" class="btn btn-success">
                                    <input type="button" name="updateCSV" id="updateCSV" value="Upload CSV with marks" class="btn btn-primary">
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>                                   
                                            <th style="text-align:center;background: #000;color:yellow;">OR FILL MARKS BELOW INDIVIDUALLY</th>                                            
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            
                            <div class="widget-content nopadding" style="height:auto; overflow: scroll">  
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>                                   
                                            <th style="text-align:left;width:30%">Reg. No.</th>
                                            <th style="text-align:left;width:30%">Student Name</th>                                           
                                            <th style="text-align: center" id="trMarks">Marks</th>                                            
                                            <th style="text-align: center; width:15%">ABSENT</th>    
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