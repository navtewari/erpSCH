<div class="row-fluid">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#newClassEntry">New Scholastic Item</a></li>
                    <li><a data-toggle="tab" href="#sessionClass">Add Scholastic items to Class</a></li>                    
                </ul>
            </div>
            <div class="widget-content tab-content">
                <div class="tab-pane active" id="newClassEntry">
                    <div class="span4">
                        <div class="widget-box"  id="newClass">
                            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                                <h5>New Scholastic Item</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <div class="control-group">
                                    <?php
                                    $attrib_ = array(
                                        'class' => 'form-horizontal',
                                        'name' => 'frmScholastic',
                                        'id' => 'frmScholastic',
                                    );
                                    ?>
                                    <?php echo form_open('#', $attrib_); ?>
                                    <div class="control-group">
                                        <label class="control-label">Scholastic Item</label>
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
                                        <label class="control-label">Marks Allotted</label>
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
                                    <div class="form-actions" align="right">                        
                                        <input type="button" value="Add Scholastic Item" class="btn btn-success classSubmit">
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
                                <h5 id="exitHeading">Scholastic items already present</h5>
                            </div>
                            <div class="widget-content nopadding" style="height:200px; overflow: scroll">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>                                   
                                            <th style="text-align:left;width:40%">Scholastic Item</th>
                                            <th style="text-align:left;width:40%">Allotted Marks</th>                                           
                                            <th style="text-align: center">Actions</th>         
                                        </tr>
                                    </thead>
                                    <tbody id="tabScholastic"> 

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="span4">                       
                        <div class="widget-box" id="editClass" style="display:none;">
                            <div class="widget-title"  style="color: #cc3300"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                                <h5  style="color: #cc3300">Edit Class</h5>
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
                                        <label class="control-label" style="color: #cc3300">Class</label>
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
                                        <label class="control-label" style="color: #cc3300">Section</label>
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
                                        <input type="button" value="Update Class" class="btn btn-danger classUpdate">
                                        <button type="reset" class="btn btn-primary classUpdateCancel">Cancel</button>                             
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>            
                        </div>
                    </div>
                </div>
                <div id="sessionClass" class="tab-pane">
                    <?php // $this->load->view('master/sessionWiseClass'); ?>
                </div>                
            </div>
        </div>
    </div>    
</div>