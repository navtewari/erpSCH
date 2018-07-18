<style>
    .selectMe{       
        display:block !important;
    }
</style>
<?php echo form_open('#', array('id' => 'frmClassInSession', 'name' => 'frmClassInSession')); ?>
<div class="row-fluid">
    <div class="span12">
        <div class="span3">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Total Classes</h5>
                </div>                
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

        <div class="span2">
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
                    <h5>Classes in New Session (<?php echo $this->session->userdata('_current_year___'); ?>)</h5>
                </div>
                <?php
                $data = array(
                    'class' => 'span11 selectMe',
                    'name' => 'to[]',
                    'id' => 'undo_redo_to',
                    'style' => 'height:300px; margin-left:9px;',
                    'multiple' => 'multiple'
                );
                $options = array();
                echo form_dropdown($data, $options, '');
                ?>
            </div>
        </div>
        <div class="span3">
            <div class="widget-box">         
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Used Classes</h5>
                </div>  
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
    </div><!--/.row-->   
</div>

<div class="row-fluid">
    <div class="form-group" style="margin-top:10px;">
        <div class="col-xs-6"></div>
        <div class="col-xs-4">
            <button type="button" class="btn btn-primary col-sm-12" name="btnAddSessionClassSubmit" id="btnAddSessionClassSubmit">SUBMIT CLASSES TO SESSION <?php echo $this->session->userdata('_current_year___'); ?></button>
        </div>  
        <div class="col-xs-2">
        </div> 
    </div>            
</div>
<?php echo form_close();?>