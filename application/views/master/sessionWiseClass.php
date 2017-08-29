<style type="text/css">
    .msg_all{
        float: right;
        color: #ff0000;
    }
</style>

<section id="main-content">
    <section class="wrapper">            
        <!--overview start-->        
        <?php echo form_open('class_/setClassInSession', array('name'=>'frmClassInSession')); ?>
        <div class="row">
            <div class="col-xs-3">
                <h3>Total Classes</h3>
                <?php
                $data = array(
                    'class' => 'required form-control m-bot8',
                    'name' => 'cmbClassSection',
                    'id' => 'undo_redo',
                    'size' => '13',
                    'multiple' => 'multiple'
                );
                $options = array();
                    foreach ($totalclass_ as $item_) {
                        $options[$item_->CLASSID] = $item_->CLASSID;
                    }
                    echo form_dropdown($data, $options, '');
                ?>
            </div>

            <div class="col-xs-2">
                <h3>&nbsp;</h3>
                <!--<button type="button" id="undo_redo_undo" class="btn btn-primary btn-block">undo</button>-->
                <button type="button" id="undo_redo_rightAll" class="btn btn-block"><i class="fa fa-forward"></i></button>
                <button type="button" id="undo_redo_rightSelected" class="btn btn-block"><i class="fa fa-arrow-right"></i></button>
                <button type="button" id="undo_redo_leftSelected" class="btn btn-block"><i class="fa fa-arrow-left"></i></button>
                <button type="button" id="undo_redo_leftAll" class="btn btn-block"><i class="fa fa-backward"></i></button>
                <!--<button type="button" id="undo_redo_redo" class="btn btn-danger btn-block">redo</button>-->
            </div>

            <div class="col-xs-5">
                <h3>Classes in New Session (<?php echo $this->session->userdata('_current_year___'); ?>)</h3>
                <?php
                
                $data = array(
                    'class' => 'form-control',
                    'name' => 'to[]',
                    'id' => 'undo_redo_to',
                    'size' => '13',
                    'multiple' => 'multiple'
                );
                $options = array();
                    foreach ($totalclass_in_session as $item_) {
                        $options[$item_->CLASSID] = $item_->CLASSID;
                    }
                    echo form_dropdown($data, $options, '');
                ?>
            </div>
            <div class="col-xs-2">
                <h3 style="color: #A0A0A0">Used Classes </h3>
                <?php
                
                $data = array(
                    'class' => 'form-control',
                    'name' => 'used[]',
                    'id' => 'undo_redo',
                    'size' => '13',
                    'multiple' => 'multiple',
                    'disabled' => 'disabled'
                );
                $options = array();
                if(count($used_classes_) != 0){
                    foreach ($used_classes_ as $item_) {
                        $options[$item_->CLASSID] = $item_->CLASSID;
                    }
                } else {
                    $options['x'] = '-NA-';
                }
                    echo form_dropdown($data, $options, '');
                ?>
            </div>
        </div><!--/.row-->              
        <div class="row">
            <div class="form-group" style="margin-top:10px;">
                <div class="col-xs-6"></div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary col-sm-12" name="cmbAddClassSubmit" id="cmbAddClassSubmit">SUBMIT CLASSES TO SESSION</button>
                </div>  
                <div class="col-xs-2">
                </div> 
            </div>            
        </div>
    </section>
</section>
<!-- container section start -->
</script>