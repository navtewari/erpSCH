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
                                                'name' => 'txtScholasticItem',
                                                'id' => 'txtScholasticItem',
                                                'value' => ''
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
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'class' => 'span11',
                                                'name' => 'txtScholasticMarks',
                                                'id' => 'txtScholasticMarks',
                                                'value' => ''
                                            );
                                            echo form_input($data);
                                            ?>                                                    
                                        </div>
                                    </div>
                                    
                                    <div class="control-group">
                                        <label class="control-label">Passing Marks</label>
                                        <div class="controls">                        
                                            <?php
                                            $data = array(
                                                'type' => 'text',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'class' => 'span11',
                                                'name' => 'txtScholasticminMarks',
                                                'id' => 'txtScholasticminMarks',
                                                'value' => ''
                                            );
                                            echo form_input($data);
                                            ?>                                                    
                                        </div>
                                    </div>
                                    
                                    <div class="form-actions" align="right">                        
                                        <input type="button" value="Add Scholastic Item" class="btn btn-success submitScholastic">
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
                            <div class="widget-content nopadding" style="height:300px; overflow: scroll">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>                                   
                                            <th style="text-align:left;width:40%">Scholastic Item</th>
                                            <th style="text-align:left;width:40%">Max Marks</th>                                           
                                            <th style="text-align:left;width:40%">Passing Marks</th>                                           
                                            <th style="text-align: center">Priority</th>         
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
                                        <label class="control-label" style="color:#cc3300">Maximum Marks</label>
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
                                    <div class="control-group">
                                        <label class="control-label" style="color:#cc3300">Passing Marks</label>
                                        <div class="controls">                        
                                            <?php
                                            $data = array(
                                                'type' => 'text',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'class' => 'span11',
                                                'name' => 'txtScholasticminMarks_edit',
                                                'id' => 'txtScholasticminMarks_edit',
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
                    <?php  $this->load->view('exam/addScholasticClass'); ?>
                </div>                
            </div>
        </div>
    </div>    
</div>