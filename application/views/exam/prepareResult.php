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

    <div class="span11" id="divclassData">
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
                            <td style="width:80px;padding-left: 20px;" align="center" id="printAll">View Result</td>
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

    <div class="span11" id="divmarksheetPanel" style="display:none">

    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Select Marksheet Layout</h4>
            </div>
            <div class="modal-body">
                <?php
                $attrib_ = array(
                    'class' => 'form-horizontal',
                    'name' => 'frmgetResult',
                    'id' => 'frmgetResult',
                    'target' => '_blank',
                );
                ?>
                <?php echo form_open('exam/fetchResult', $attrib_); ?>

                <table border='0' width="100%" cellpadding="10">
                    <tr>
                        <td align='center' width="33%" style="background: #eff2f2">                                                        
                            <h4>CLASS<br><span style="color: #006dcc"> I - VIII</span></h4>
                            <input type='radio' value='1' name='reportLayout' class='form-control' required/>
                        </td>

                        <td align='center' width="33%" style="background: #f0e6ef">                              
                            <h4>CLASS<br> IX - XII</h4>
                            <input type='radio' value='1' name='reportLayout' class='form-control'/>                           
                        </td>

                        <td align='center' width="34%" style="background: #eff2f2">                              
                            <h4>CLASS<br> Nursery - UKG</h4>
                            <input type='radio' value='1' name='reportLayout' class='form-control'/>                           
                        </td>
                    </tr>
                </table>               

                <input type='hidden' id='stuHiddenID' name='stuHiddenID' value='0'/>
                <input type='hidden' id='classSessHiddenID' name='classSessHiddenID' value='0' />                                                  

                <div class="form-actions" align="right">                        
                    <input type="submit" value="Check Result" class="btn btn-success btncheckResult">                                            
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>    