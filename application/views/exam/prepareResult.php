<div class="row-fluid">
    <div class="span4">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>Select Class to see Result</h5>
            </div>
            <div class="widget-content nopadding">
                <div class="control-group">
                    <?php
                    $attrib_ = array(
                        'class' => 'form-horizontal',
                        'name' => 'frmDisplayResult',
                        'id' => 'frmDisplayResult',
                    );
                    ?>
                    <?php echo form_open('#', $attrib_); ?>
                    <div class="control-group">
                        <label class="control-label">Select Class</label>
                        <div class="controls">
                            <?php
                            $data = array(
                                'name' => 'cmbClassforResult',
                                'id' => 'cmbClassforResult',
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
    <div class="span7" id="divInfo" style="display:none;">
        <div class="widget-box">
            <div class="widget-content nopadding" style="background:#fdebeb;"> </span>
                <p id="information" style="color:red; padding:10px;font-size:13px;"></p>
            </div>
        </div>
    </div>

    <div class="span11">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5 id="exitHeading">Select Above Class to see students</h5>
            </div>
            <div class="widget-content nopadding">
                <?php
                $attrib_ = array(
                    'class' => 'form-horizontal',
                    'name' => 'frmSubmitRemarks',
                    'id' => 'frmSubmitRemarks',
                );
                ?>
                <?php echo form_open('#', $attrib_); ?>
                <table class="table table-bordered">
                    <thead>
                        <tr style="font-weight:bold;">                            
                            <td style="width:80px;">View Result</td>
                            <td>Reg. ID</td>
                            <td>Name</td>
                            <td><input type="button" value="All" class="btn btn-success btnCopyRemarks"/> Teacher's Remarks </td>
                            <td><input type="button" value="All" class="btn btn-success btnCopyPromoted"/> Promoted to Class </td>                            
                        </tr>
                    </thead>

                    <tbody id="tabStudentForResult"> 

                    </tbody>

                </table>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>    
</div>