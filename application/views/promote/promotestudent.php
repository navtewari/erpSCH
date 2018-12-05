<?php echo form_open('#', array('id' => 'frmPromotionFor', 'name' => 'frmPromotionFor')); ?>
<div class="row-fluid">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>Promote students from</h5>
            </div>
            <div class="widget-content" style="overflow: hidden">
                <label class="span3 control-label">
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
                <label class="span9 control-label">
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
<?php echo form_close(); ?>
<?php echo form_open('#', array('id' => 'frmClassInSession', 'name' => 'frmClassInSession')); ?>
<div class="row-fluid">
    <div class="span12">
        <div class="span4">
            <div class="widget-box">         
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5 id="forcmbprevAdmSession" style="color: #000090"></h5>
                </div>          
                <div class="widget-content">
                    <div class="control-group">
                        <div class="controls">
                            <?php
                            $data = array(
                                'name' => 'promote_student_cmbAdmFor',
                                'id' => 'promote_student_cmbAdmFor',
                                'required' => 'required',
                                'class' => 'span6',
                            );
                            $options = array();
                            $options[''] = 'Select';
                            ?>
                            <?php echo form_dropdown($data, $options, ''); ?>
                            <span class="mendatory1">*</span>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <?php
                                $data = array(
                                    'class' => 'span12',
                                    'name' => 'cmbClassSection',
                                    'id' => 'undo_redo',
                                    'style' => 'height:300px;',
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
        <?php echo form_close(); ?>
        <div class="span1">
            <h3>&nbsp;</h3>
            <!--<button type="button" id="undo_redo_undo" class="btn btn-primary btn-block">undo</button>-->
            <button type="button" id="undo_redo_rightAll" class="btn btn-block"><i class="fa fa-forward"></i></button>
            <button type="button" id="undo_redo_rightSelected" class="btn btn-block"><i class="fa fa-arrow-right"></i></button>
            <button type="button" id="undo_redo_leftSelected" class="btn btn-block"><i class="fa fa-arrow-left"></i></button>
            <button type="button" id="undo_redo_leftAll" class="btn btn-block"><i class="fa fa-backward"></i></button>
            <!--<button type="button" id="undo_redo_redo" class="btn btn-danger btn-block">redo</button>-->
        </div>
        <?php echo form_open('#', array('id' => 'frmPromoteToSelectedClass', 'name' => 'frmPromoteToSelectedClass')); ?>
        <div class="span4">
            <div class="widget-box">         
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Students in New Session (<?php echo $this->session->userdata('_current_year___'); ?>)</h5>
                </div>
                <div class="widget-content">
                    <div class="control-group">
                        <div class="controls">
                            <?php
                            $data = array(
                                'name' => 'cmbAdmFor',
                                'id' => 'cmbAdmFor',
                                'required' => 'required',
                                'class' => 'span6'
                            );
                            $options = array();
                            $options[''] = 'Select';
                            ?>
                            <?php echo form_dropdown($data, $options, 'x'); ?>
                            <span class="mendatory1">&nbsp;*</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <?php
                        $data = array(
                            'class' => 'span12 selectMe',
                            'name' => 'to',
                            'id' => 'undo_redo_to',
                            'style' => 'height:300px;',
                            'multiple' => 'multiple'
                        );
                        $options = array();
                        echo form_dropdown($data, $options, '');
                        ?>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <input type="button" value="Promote Students to class" class="btn btn-success update_promotion">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
        <div class="span3">
            <div class="widget-box">         
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>View Students (<?php echo $this->session->userdata('_current_year___'); ?>)</h5>
                </div>  
                <div class="widget-content">
                    <div class="control-group">
                        <div class="controls">
                            <?php
                            $data = array(
                                'name' => 'cmbAdmittedStudents',
                                'id' => 'cmbAdmittedStudents',
                                'required' => 'required',                                
                                'class' => 'span8',
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
                                'style' => 'height:300px;',
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
<?php echo form_close(); ?>