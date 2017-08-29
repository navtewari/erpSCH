<div class="row-fluid">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#newClassEntry">New Class</a></li>
                    <li><a data-toggle="tab" href="#sessionClass">Add Class in Session</a></li>                    
                </ul>
            </div>
            <div class="widget-content tab-content">
                <div class="tab-pane active" id="newClassEntry">
                    <div class="span6">
                        <div class="widget-box"  id="newClass">
                            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                                <h5>New Class</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <div class="control-group">
                                    <?php
                                    $attrib_ = array(
                                        'class' => 'form-horizontal',
                                        'name' => 'frmClasses',
                                        'id' => 'frmClasses',
                                    );
                                    ?>
                                    <?php echo form_open('#', $attrib_); ?>
                                    <div class="control-group">
                                        <label class="control-label">New Class</label>
                                        <div class="controls">                        
                                            <?php
                                            $data = array(
                                                'type' => 'text',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'class' => 'span11',
                                                'name' => 'txtAddClass_',
                                                'id' => 'txtAddClass_',
                                                'value' => ''
                                            );
                                            echo form_input($data);
                                            ?>                                                  
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Section</label>
                                        <div class="controls">                        
                                            <?php
                                            $data = array(
                                                'class' => 'required form-control m-bot8',
                                                'name' => 'cmbClassSection',
                                                'id' => 'cmbClassSection',
                                                'required' => 'required'
                                            );
                                            $options = array();
                                            $options['-'] = 'No Section';
                                            for ($class_ = 65; $class_ <= 90; $class_++) {
                                                $options[chr($class_)] = chr($class_);
                                            }
                                            echo form_dropdown($data, $options, '-');
                                            ?>                                                   
                                        </div>
                                    </div>
                                    <div class="form-actions" align="right">                        
                                        <input type="button" value="Create New Class" class="btn btn-success classSubmit">
                                        <button type="reset" class="btn btn-primary">Reset</button>                             
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>            
                        </div>
                        
                        <div class="widget-box" id="editClass" style="display:none;">
                            <div class="widget-title" style="background:#ff3333; color:#fff"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                                <h5 style="color:#fff">Edit Class</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <div class="control-group">
                                    <?php
                                    $attrib_ = array(
                                        'class' => 'form-horizontal',
                                        'name' => 'frmClasses_Edit',
                                        'id' => 'frmClasses_Edit',
                                    );
                                    ?>
                                    <?php echo form_open('#', $attrib_); ?>
                                    <div class="control-group">
                                        <label class="control-label">Class</label>
                                        <div class="controls">                        
                                            <?php
                                            $data = array(
                                                'type' => 'hidden',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'class' => 'span11',
                                                'name' => 'txtEditClass_ID',
                                                'id' => 'txtEditClass_ID',
                                                'value' => ''
                                            );
                                            echo form_input($data);
                                            ?>                                                  
                                            
                                            <?php
                                            $data = array(
                                                'type' => 'text',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'class' => 'span11',
                                                'name' => 'txtEditClass_',
                                                'id' => 'txtEditClass_',
                                                'value' => ''
                                            );
                                            echo form_input($data);
                                            ?>  
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Section</label>
                                        <div class="controls">                        
                                            <?php
                                            $data = array(
                                                'class' => 'required form-control m-bot8',
                                                'name' => 'cmbEditSection',
                                                'id' => 'cmbEditSection',
                                                'required' => 'required'                                                
                                            );
                                            $options = array();
                                            $options['-'] = 'No Section';
                                            for ($class_ = 65; $class_ <= 90; $class_++) {
                                                $options[chr($class_)] = chr($class_);
                                            }
                                            echo form_dropdown($data, $options, '-');
                                            ?>                                                   
                                        </div>
                                    </div>
                                    <div class="form-actions" align="right">                        
                                        <input type="button" value="Update Class" class="btn btn-success classUpdate">
                                        <button type="reset" class="btn btn-primary classUpdateCancel">Cancel</button>                             
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>            
                        </div>
                    </div>

                    <div class="span6">
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                                <h5>Existing Classes</h5>
                            </div>
                            <div class="widget-content nopadding" style="height:400px; overflow: scroll">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Options</th>                                            
                                            <th style="text-align:left;width:80%">Class Name</th>                                           
                                        </tr>
                                    </thead>
                                    <tbody id="tabClass"> 

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