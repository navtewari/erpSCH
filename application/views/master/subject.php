<div class="row-fluid">    
    <div class="span4">
        <?php
        $attrib_ = array(
            'class' => 'form-horizontal',
            'name' => 'frmSubject',
            'id' => 'frmSubject',
        );
        ?>
        <?php echo form_open('#', $attrib_); ?>  
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>Subject</h5>
            </div>
            <div class="widget-content nopadding">
                <div class="control-group">

                    <div class="control-group">
                        <label class="control-label">Subject Name</label>
                        <div class="controls">                        
                            <?php
                            $data = array(
                                'type' => 'text',
                                'class' => 'span11',
                                'name' => 'txtSubject',
                                'id' => 'txtSubject',
                                'required' => 'required'
                            );
                            echo form_input($data);
                            ?>                                                  
                        </div>
                    </div>                                                                                

                </div>
            </div>            
        </div>
    </div>    

    <div class="span4">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5 id="exitHeading">Select Class</h5>
            </div>
            <div class="widget-content nopadding" id="fillclassforSub" style="max-height:500px; overflow: scroll">
            </div>
        </div>
    </div>
    <div class="span4">        
        <div class="control-group" style="padding-top:15px;">
            <div class="controls">
                <input type="button" value="Add Subject to class" class="btn btn-success subjectSubmit">
            </div>
        </div>        
    </div>
    <?php echo form_close(); ?>

    <div class="span4">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5 id="exitHeading1">Subject already Associated with Class</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered">
                    <thead>
                        <tr style="text-align: left;">                            
                            <th>Subject Name</th> 
                            <th style="width:100px;">Set Priority</th> 
                            <th>Action</th>                            
                        </tr>
                    </thead>
                    <tbody id="fillAssociatedSubject"> 

                    </tbody>
                </table>
            </div>
        </div>
    </div>    
</div>