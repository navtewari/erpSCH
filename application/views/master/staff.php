<div class="row-fluid">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#newClassEntry">New Staff Members</a></li>                    
                </ul>
            </div>
            <div class="widget-content tab-content">
                <div class="tab-pane active" id="newClassEntry">
                    <div class="span4">
                        <div class="widget-box"  id="newClass">
                            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                                <h5>New Staff Member</h5>
                            </div>
                            <div class="widget-content padding">
                                <div class="control-group">
                                    <?php
                                    $attrib_ = array(
                                        'class' => 'form-vertical',
                                        'name' => 'frmTeacher',
                                        'id' => 'frmTeacher',
                                    );
                                    ?>
                                    <?php echo form_open('#', $attrib_); ?>
                                    <div class="control-group">
                                        <label class="control-label">Select Category</label>
                                        <div class="controls">
                                            <?php
                                            $data = array(
                                                'name' => 'CategoryID',
                                                'id' => 'CategoryID',
                                                'required' => 'required'
                                            );
                                            $options = array();
                                            ?>
                                            <?php echo form_dropdown($data, $options, ''); ?>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Member Name</label>
                                        <div class="controls">                        
                                            <?php
                                            $data = array(
                                                'type' => 'text',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'class' => 'span12',
                                                'name' => 'txtName',
                                                'id' => 'txtName',
                                                'value' => ''
                                            );
                                            echo form_input($data);
                                            ?>
                                        </div>
                                    </div>                                    
                                    <div>                        
                                        <input type="button" value="Submit New Teacher" class="btn btn-success teacherSubmit">
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
                                <h5 id="exitHeading">Existing Staff Members</h5>
                            </div>
                            <div class="widget-content nopadding" style="min-height:200px;max-height:400px; overflow: scroll">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>                                   
                                            <th style="text-align:left;width:55%">Name</th>                                           
                                            <th style="text-align:left;width:25%">Status</th> 
                                            <th style="text-align: center">Actions</th>         
                                        </tr>
                                    </thead>
                                    <tbody id="tabTeacher"> 

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="span3">                       
                        <div class="widget-box" id="editTeacher" style="display:none;">
                            <div class="widget-title"  style="color: #cc3300"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                                <h5 style="color: #cc3300">Edit Staff Member</h5>
                            </div>
                            <div class="widget-content padding">
                                <div class="control-group">
                                    <?php
                                    $attrib_ = array(
                                        'class' => 'form-vertical',
                                        'name' => 'frmUpdateTeacher',
                                        'id' => 'frmUpdateTeacher',
                                    );
                                    ?>
                                    <?php echo form_open('#', $attrib_); ?>
                                    <div class="control-group">
                                        <label class="control-label" style="color: #cc3300">Name</label>
                                        <div class="controls">                        
                                            <?php
                                            $data = array(
                                                'type' => 'text',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'class' => 'span12',
                                                'name' => 'txtName_Edit',
                                                'id' => 'txtName_Edit',
                                                'value' => ''
                                            );
                                            echo form_input($data);

                                            $data = array(
                                                'type' => 'hidden',
                                                'class' => 'required form-control m-bot8',
                                                'name' => 'teachID_Edit',
                                                'id' => 'teachID_Edit',
                                                'required' => 'required'
                                            );
                                            echo form_input($data);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" style="color: #cc3300">Status</label>
                                        <div class="controls">                                                                    
                                            <div class="controls span12" style="float: left; background:#f0f0f0; padding: 0px 10px; border: #E0E0E0 solid 1px; margin-bottom: 10px;">
                                                <label style="float: left;margin-top: 5px;" class="span6">
                                                    <input type="radio" name="optTeacherStatus" id="optTeacherStatustrue" value="1" />
                                                    Working</label>
                                                <label style="float: left;margin-top: 5px;" class="span6">
                                                    <input type="radio" name="optTeacherStatus" id="optTeacherStatusfalse" value="0" />
                                                    Not- Working</label>
                                            </div>                                                     
                                        </div>
                                    </div>
                                    <div>                        
                                        <input type="button" value="Update Teacher" class="btn btn-success teacherEdit">
                                        <button type="reset" class="btn btn-primary cancelUpdateTeacher">Cancel</button>                             
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>           
                        </div>
                    </div>
                </div>                               
            </div>
        </div>
    </div>    
</div>