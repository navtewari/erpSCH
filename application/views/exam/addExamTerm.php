<div class="tab-pane active" id="newTermEntry">     
    <div class="span4">
        <div class="widget-box"  id="newClass">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>New Exam Term</h5>
            </div>
            <div class="widget-content nopadding">
                <div class="control-group">
                    <?php
                    $attrib_ = array(
                        'class' => 'form-horizontal',
                        'name' => 'frmExamTerm',
                        'id' => 'frmExamTerm',
                    );
                    ?>
                    <?php echo form_open('#', $attrib_); ?>
                    <div class="control-group">
                        <label class="control-label">Exam Term</label>
                        <div class="controls">                        
                            <?php
                            $data = array(
                                'type' => 'text',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'class' => 'span11',
                                'name' => 'txtExamTerm',
                                'id' => 'txtExamTerm',
                                'value' => ''
                            );
                            echo form_input($data);
                            ?>                                                  
                        </div>
                    </div>                                   
                    <div class="form-actions" align="right">                        
                        <input type="button" value="Add Term" class="btn btn-success submitExamTerm">
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
                <h5 id="exitHeading1">Exam Term already present</h5>
            </div>
            <div class="widget-content nopadding" style="height:300px; overflow: scroll">
                <table class="table table-bordered">
                    <thead>
                        <tr>                                   
                            <th style="text-align:left;width:55%">Exam Term</th>                               
                            <th style="text-align: center">Actions</th>         
                        </tr>
                    </thead>
                    <tbody id="tabExamTerm"> 

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="span4">                       
        <div class="widget-box" id="editcoScholasticDiv" style="display:none;">
            <div class="widget-title"  style="color: #cc3300"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5 style="color: #cc3300">Update Co-Scholastic Item</h5>
            </div>
            <div class="widget-content nopadding">
                <div class="control-group">
                    <?php
                    $attrib_ = array(
                        'class' => 'form-horizontal',
                        'name' => 'frmcoScholastic_edit',
                        'id' => 'frmcoScholastic_edit',
                    );
                    ?>
                    <?php echo form_open('#', $attrib_); ?>
                    <div class="control-group">
                        <label class="control-label" style="color:#cc3300">Co-Scholastic Item</label>
                        <div class="controls">  
                            <?php
                            $data = array(
                                'type' => 'hidden',
                                'class' => 'span11 required',
                                'name' => 'coScholasticID_Edit',
                                'id' => 'coScholasticID_Edit',
                                'required' => 'required'
                            );
                            echo form_input($data);


                            $data = array(
                                'type' => 'text',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'class' => 'span11',
                                'name' => 'txtcoScholasticItem_edit',
                                'id' => 'txtcoScholasticItem_edit',
                                'value' => ''
                            );
                            echo form_input($data);
                            ?>                                                  
                        </div>
                    </div>                                    
                    <div class="form-actions" align="right">                        
                        <input type="button" value="Update Co-Scholastic Item" class="btn btn-success submitcoScholastic_edit">
                        <button type="reset" class="btn btn-primary">Reset</button>                             
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>            
        </div>
    </div>
</div>                                     