<div class="row-fluid">
    <div class="span5">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>Subject</h5>
            </div>
            <div class="widget-content nopadding">
                <div class="control-group">
                    <?php
                    $attrib_ = array(
                        'class' => 'form-horizontal',
                        'name' => 'frmSubject',
                        'id' => 'frmSubject',
                    );
                    ?>
                    <?php echo form_open('#', $attrib_); ?>
                    <div class="control-group">
                        <label class="control-label">Select Class</label>
                        <div class="controls">
                            <?php
                            $data = array(
                                'name' => 'subClassID',
                                'id' => 'subClassID',
                                'required' => 'required'
                            );
                            $options = array();
                            ?>
                            <?php echo form_dropdown($data, $options, ''); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Subject Name</label>
                        <div class="controls">                        
                            <?php
                            $data = array(
                                'type' => 'text',
                                'class' => 'span11',
                                'name' => 'txtSubject',
                                'id' => 'txtSubject',
                                'required' => 'required'
                            );
                            echo form_input($data);
                            ?>                                                  
                        </div>
                    </div>                                        
                    <div class="control-group">
                        <label class="control-label">Status</label>
                        <div class="controls">                               
                            <div class="col-sm-12">
                                <h4><input type="checkbox" name="chkSubStatusTH" id="chkSubStatusTH" value="TH"> Theory</h4>                                        
                            </div>
                            <div class="col-sm-12">
                                <h4><input type="checkbox" name="chkSubStatusPR" id="chkSubStatusPR" value="PR"> Practical</h4>
                            </div>                                                  
                        </div>
                    </div>
                    <div class="form-actions" align="right">                        
                        <input type="button" value="Create Subject" class="btn btn-success subjectSubmit">
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
                            <th>Status</th>                            
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