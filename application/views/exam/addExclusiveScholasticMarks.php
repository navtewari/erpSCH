<div class="tab-pane active" id="newClassEntry">  
<?php
    $attrib_ = array(
        'class' => 'form-horizontal',
        'name' => 'frmExclusiveScholastic',
        'id' => 'frmExclusiveScholastic',
    );
    ?>
<?php echo form_open('#', $attrib_); ?>
    <div class="span3">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5 id="exitHeading">Select Class</h5>
            </div>
            <div class="widget-content nopadding" id="fillexclusiveclass" style="max-height:240px; overflow: scroll">
            </div>
        </div>
    </div>      
    <div class="span4">        
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5 id="exitHeading">Exclusive Scholastic items present in Class</h5>
            </div>
            <div class="widget-content nopadding" id="fillexclusivescholastic">
            </div>
        </div>
    </div>        
        
    <div class="span5">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5 id="exitHeading1">Subject Associated with Class</h5>
            </div>
            <div class="widget-content nopadding">
                <div class="control-group" id="subjectHidden">
                    <div class="control-group">
                        <label class="control-label">Select Subject</label>
                        <div class="controls">                                            
                            <?php
                            $data = array(
                                'class' => 'required form-control m-bot8',
                                'name' => 'cmbExclusiveSubjectMarks',
                                'id' => 'cmbExclusiveSubjectMarks',
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
                    <label class="control-label">Maximum Marks</label>
                    <div class="controls">                        
                        <?php
                        $data = array(
                            'type' => 'text',
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'class' => 'span11',
                            'name' => 'txtExclusiveScholasticMarks',
                            'id' => 'txtExclusiveScholasticMarks',
                            'value' => ''
                        );
                        echo form_input($data);
                        ?>                                                    
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Minimum Marks</label>
                    <div class="controls">                        
                        <?php
                        $data = array(
                            'type' => 'text',
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'class' => 'span11',
                            'name' => 'txtExclusiveScholasticMinMarks',
                            'id' => 'txtExclusiveScholasticMinMarks',
                            'value' => ''
                        );
                        echo form_input($data);
                        ?>                                                    
                    </div>
                </div>
                <div class="form-actions" align="right">                        
                    <input type="button" value="Update Marks" class="btn btn-success submitExclusiveScholastic">
                    <button type="reset" class="btn btn-primary">Reset</button>                             
                </div>
            </div>
        </div>
    </div>    

    <?php echo form_close();?>    
    
</div>                                          