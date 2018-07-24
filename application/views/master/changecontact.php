<div class="row-fluid">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>Class</h5>
            </div>
            <div class="widget-content nopadding">
                <div class="control-group">
                    <?php
                    $attrib_ = array(
                        'class' => 'form-horizontal',
                        'name' => 'frmSubject',
                        'id' => 'frmSubject',
                    );
                    ?>
                    <?php echo form_open('#', $attrib_); ?>
                    <div class="control-group">
                        <label class="control-label">Select Class</label>
                        <div class="controls">
                            <?php
                            $data = array(
                                'name' => 'subClassID',
                                'id' => 'subClassID',                                
                                'required' => 'required'
                            );
                            $options = array();
                            ?>
                            <?php echo form_dropdown($data, $options, ''); ?>
                        </div>
                    </div>                                        
                    <?php echo form_close(); ?>
                </div>
            </div>            
        </div>
    </div>

    <div class="span5">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5 id="exitHeading">Existing Subjects</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered">
                    <thead>
                        <tr style="text-align: left;">                            
                            <th>Subject Name</th>
                            <th>Status</th>                            
                            <th>Action</th>                            
                        </tr>
                    </thead>
                    <tbody id="tabSubjects"> 

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>