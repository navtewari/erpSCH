<div class="row-fluid">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <ul class="nav nav-tabs">
                    <li class="<?php echo $static_head;?>"><a data-toggle="tab" href="#static_head">Manage Static Heads</a></li>
                    <li class="<?php echo $flexible_head;?>"><a data-toggle="tab" href="#flexible_head">Manage Flexible Heads</a></li>
                    <li class="<?php echo $associate_static;?>"><a data-toggle="tab" href="#associate_static">Associate Static Heads</a></li>
                    <li class="<?php echo $associate_flexible;?>"><a data-toggle="tab" href="#associate_flexible">Associate Flexible Heads</a></li>
                </ul>
            </div>
            <div class="widget-content tab-content">
                <div id="static_head" class="tab-pane<?php echo $static_head;?>">
                	<?php
				        $attrib_ = array(
				            'class' => 'form-vertical',
				            'name' => 'frmStaticFee',
				            'id' => 'frmStaticFee',
				        );
				        echo form_open('#', $attrib_); 
				    ?>
                    <?php $this->load->view('master/tabfee/static_heads'); ?>
                    <?php echo form_close();?>
                </div>
                <div id="flexible_head" class="tab-pane<?php echo $flexible_head;?>">
                	<?php
				        $attrib_ = array(
				            'class' => 'form-vertical',
				            'name' => 'frmFlexibleFee',
				            'id' => 'frmFlexibleFee',
				        );
				        echo form_open('#', $attrib_); 
				    ?>
                    <?php $this->load->view('master/tabfee/flexible_heads'); ?>
                    <?php echo form_close();?>
                </div>
                <div id="associate_static" class="tab-pane<?php echo $associate_static;?>">
                	<?php
				        $attrib_ = array(
				            'class' => 'form-vertical',
				            'name' => 'frmAssociateStaticFee',
				            'id' => 'frmAssociateStaticFee',
				        );
				        echo form_open('#', $attrib_); 
				    ?>
                    <?php $this->load->view('master/tabfee/associate_static'); ?>
                    <?php echo form_close();?>
                </div>
                <div id="associate_flexible" class="tab-pane<?php echo $associate_flexible;?>">
                	<?php
				        $attrib_ = array(
				            'class' => 'form-vertical',
				            'name' => 'frmAssociateFlexibleFee',
				            'id' => 'frmAssociateFlexibleFee',
				        );
				        echo form_open('#', $attrib_); 
				    ?>
                    <?php $this->load->view('master/tabfee/associate_flexible'); ?>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>