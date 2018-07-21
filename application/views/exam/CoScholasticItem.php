<div class="row-fluid">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#newClassEntry">New Co-Scholastic Item</a></li>
                    <li><a data-toggle="tab" href="#sessionClass">Add Co-Scholastic items to Class</a></li>                    
                </ul>
            </div>
            <div class="widget-content tab-content">
                <div class="tab-pane active" id="newClassEntry">
                    <div class="span4">
                        <div class="widget-box"  id="newClass">
                            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                                <h5>New Co-Scholastic Item</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <div class="control-group">
                                    <?php
                                    $attrib_ = array(
                                        'class' => 'form-horizontal',
                                        'name' => 'frmCoScholastic',
                                        'id' => 'frmCoScholastic',
                                    );
                                    ?>
                                    <?php echo form_open('#', $attrib_); ?>
                                    <div class="control-group">
                                        <label class="control-label">Co-Scholastic Item</label>
                                        <div class="controls">                        
                                            <?php
                                            $data = array(
                                                'type' => 'text',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'class' => 'span11',
                                                'name' => 'txtCoScholasticItem',
                                                'id' => 'txtCoScholasticItem',
                                                'value' => ''
                                            );
                                            echo form_input($data);
                                            ?>                                                  
                                        </div>
                                    </div>                                   
                                    <div class="form-actions" align="right">                        
                                        <input type="button" value="Add Co-Scholastic Item" class="btn btn-success submitCoScholastic">
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
                                <h5 id="exitHeading">Co-Scholastic items already present</h5>
                            </div>
                            <div class="widget-content nopadding" style="height:200px; overflow: scroll">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>                                   
                                            <th style="text-align:left;width:40%">Co-Scholastic Item</th>                                            
                                            <th style="text-align: center">Actions</th>         
                                        </tr>
                                    </thead>
                                    <tbody id="tabCoScholastic"> 

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
                <div id="sessionClass" class="tab-pane">
                    <?php  $this->load->view('exam/addCoScholasticClass'); ?>
                </div>                
            </div>
        </div>
    </div>    
</div>