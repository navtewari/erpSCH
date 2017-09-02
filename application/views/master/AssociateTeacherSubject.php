<div class="row-fluid">
    <div class="span5">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>Associate Subject to Teacher for session <?php echo $this->session->userdata('_current_year___');?></h5>
            </div>
            <div class="widget-content nopadding">
                <div class="control-group">
                    <?php
                    $attrib_ = array(
                        'class' => 'form-horizontal',
                        'name' => 'frmAssociateSubject',
                        'id' => 'frmAssociateSubject',
                    );
                    ?>
                    <?php echo form_open('#', $attrib_); ?>
                    <div class="control-group">
                        <label class="control-label">Select Teacher</label>
                        <div class="controls">
                            <?php
                            $data = array(
                                'name' => 'txtTeacherID',
                                'id' => 'txtTeacherID',
                                'required' => 'required'
                            );
                            $options = array();
                            ?>
                            <?php echo form_dropdown($data, $options, ''); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Select Class</label>
                        <div class="controls">
                            <?php
                            $data = array(
                                'name' => 'subClassTeacherID',
                                'id' => 'subClassTeacherID',
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
                                'name' => 'cmbSubject',
                                'id' => 'cmbSubject',
                                'required' => 'required'
                            );
                            $options = array();
                            ?>
                            <?php echo form_dropdown($data, $options, ''); ?>                                               
                        </div>
                    </div>                                                            
                    <div class="form-actions" align="right">                        
                        <input type="button" value="Associate" class="btn btn-success SubmitAssociate">
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
                <h5 id="exitHeading">Associated Subjects</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered">
                    <thead>
                        <tr> 
                            <th style="text-align: left;">Class</th>
                            <th style="text-align: left;">Subject Name</th>
                            <th style="text-align: left;">Status</th>                            
                            <th>Action</th>                            
                        </tr>
                    </thead>
                    <tbody id="tabAssociatedSubjects"> 

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>