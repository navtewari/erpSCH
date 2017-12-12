<style>
    .selectMe{       
        display:block !important;
    }
</style>
<?php echo form_open('#', array('id' => 'frmPromotionFor', 'name' => 'frmPromotionFor')); ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box" style="overflow: hidden">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Promote students from</h5>
                </div>
                <div class="control-group span12" style="margin-top: 10px;">             
                    <label class="span3 control-label" style="padding: 5px">
                        <?php
                        $data = array(
                            'type' => 'radio',
                            'name' => 'promote_student_cmbAdmFor[]',
                            'id' => 'promote_student_optAdmission_',
                            'value' => 'Admission',
                            'style' => 'float: left'
                        );
                        echo form_input($data);
                        ?>
                        <span style="padding: 0px 0px 0px 5px">Admission</span>
                    </label>
                    <label class="span9 control-label" style="padding: 5px">
                        <?php
                        $data = array(
                            'type' => 'radio',
                            'name' => 'promote_student_cmbAdmFor[]',
                            'id' => 'promote_student_optPreviousSession_',
                            'value' => 'PreviousSession',
                            'style' => 'float: left'
                        );
                        echo form_input($data);
                        ?>
                        <span style="padding: 0px 0px 0px 5px">Previous Session</span>
                        <?php
                        $datahidden = array(
                            'type' => 'hidden',
                            'name' => 'promotionFor',
                            'id' => 'promotionFor',
                            'value' => 'x'
                        );
                        echo form_input($datahidden);
                        ?>
                        
                    </label>
                </div>
            </div>
        </div>
    </div>
<?php echo form_close();?>
<?php echo form_open('#', array('id' => 'frmClassInSession', 'name' => 'frmClassInSession')); ?>
<div class="row-fluid">
    <div class="span12">
        <div class="span4">
            <div class="widget-box">         
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5 id="forcmbprevAdmSession">Select Students to Promote</h5>
                </div>          
                <div class="widget-content">
                    <div class="control-group">
                        <label class="control-label">Select Class <span class="mendatory1">*</span></label>
                        <div class="controls">
                            <?php
                                $data = array(
                                    'name' => 'promote_student_cmbAdmFor',
                                    'id' => 'promote_student_cmbAdmFor',
                                    'required' => 'required',
                                    'class' => 'span11',
                                );
                                $options = array();
                                $options[''] = 'Select';
                            ?>
                            <?php echo form_dropdown($data, $options, ''); ?>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <?php
                                $data = array(
                                    'class' => 'span11 selectMe',
                                    'name' => 'cmbClassSection',
                                    'id' => 'undo_redo',
                                    'style' => 'height:300px; margin-left:7px;',
                                    'multiple' => 'multiple'
                                );
                                $options = array();

                                echo form_dropdown($data, $options, '');
                                ?>
                            </div>
                        </div>
                    </div>  
                </div> 
            </div>
        </div>

        <div class="span1">
            <h3>&nbsp;</h3>
            <!--<button type="button" id="undo_redo_undo" class="btn btn-primary btn-block">undo</button>-->
            <button type="button" id="undo_redo_rightAll" class="btn btn-block"><i class="fa fa-forward"></i></button>
            <button type="button" id="undo_redo_rightSelected" class="btn btn-block"><i class="fa fa-arrow-right"></i></button>
            <button type="button" id="undo_redo_leftSelected" class="btn btn-block"><i class="fa fa-arrow-left"></i></button>
            <button type="button" id="undo_redo_leftAll" class="btn btn-block"><i class="fa fa-backward"></i></button>
            <!--<button type="button" id="undo_redo_redo" class="btn btn-danger btn-block">redo</button>-->
        </div>

        <div class="span4">
            <div class="widget-box">         
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Students in New Session (<?php echo $this->session->userdata('_current_year___'); ?>)</h5>
                </div>
                <div class="widget-content">
                    <div class="control-group">
                        <label class="control-label">Select Class <span class="mendatory1">*</span></label>
                        <div class="controls">
                            <?php
                                $data = array(
                                    'name' => 'cmbAdmFor',
                                    'id' => 'cmbAdmFor',
                                    'required' => 'required',
                                    'class' => 'span11'
                                );
                                $options = array();
                                $options[''] = 'Select';
                            ?>
                            <?php echo form_dropdown($data, $options, 'x'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <?php
                        $data = array(
                            'class' => 'span11 selectMe',
                            'name' => 'to[]',
                            'id' => 'undo_redo_to',
                            'style' => 'height:300px; margin-left:7px;',
                            'multiple' => 'multiple'
                        );
                        $options = array();
                        echo form_dropdown($data, $options, '');
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="span3">
            <div class="widget-box">         
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>View Students (<?php echo $this->session->userdata('_current_year___'); ?>)</h5>
                </div>  
                <div class="widget-content">
                    <div class="control-group">
                        <label class="control-label">Select Class <span class="mendatory1">*</span></label>
                        <div class="controls">
                            <?php
                                $data = array(
                                    'name' => 'cmbAdmittedStudents',
                                    'id' => 'cmbAdmittedStudents',
                                    'required' => 'required',
                                    'class' => 'span11',
                                );
                                $options = array();
                                $options[''] = 'Select';
                            ?>
                            <?php echo form_dropdown($data, $options, 'x'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <?php
                            $data = array(
                                'class' => 'span11 selectMe',
                                'name' => 'used[]',
                                'id' => 'undo_redo1',
                                'multiple' => 'multiple',
                                'style' => 'height:300px; margin-left:7px;',
                                'disabled' => 'disabled'
                            );
                            $options = array();
                            
                            echo form_dropdown($data, $options, '');
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.row-->   
</div>
<?php echo form_close();?>