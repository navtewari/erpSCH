
<div class="tab-pane active" id="newClassEntry">   
    <div class="span4">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5 id="exitHeading">Scholastic items present</h5>
            </div>
            <div class="widget-content nopadding" style="height:200px; overflow: scroll">
                <?php
                $attrib_ = array(
                    'class' => 'form-horizontal',
                    'name' => 'frmScholasticAddClass',
                    'id' => 'frmScholasticAddClass',
                );
                ?>
                <?php echo form_open('exam/associateScholastic_with_class', $attrib_); ?>
                <?php
                $data = array(
                    'class' => 'span11 selectMe',
                    'name' => 'txtScholasticHeadSelected',
                    'id' => 'txtScholasticHeadSelected',
                    'style' => 'height:300px; margin-left:7px;',
                    'multiple' => 'multiple'
                );
                $options = array();

                echo form_dropdown($data, $options, '');
                ?>
                <?php
                $data = array(
                    'name' => 'ScholasticClassID',
                    'id' => 'ScholasticClassID',
                    'required' => 'required'
                );
                $options = array();
                ?>
                <?php echo form_dropdown($data, $options, ''); ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>    

    <div class="span4">
        <div class="widget-box"  id="newClass">
            <div class="widget-content nopadding">
                <div class="control-group">                    

                </div>
            </div>            
        </div>

    </div>
</div>                                          