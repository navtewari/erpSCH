<div class="tab-pane active" id="newClassEntry">  

    <div class="span4">
        <?php
        $attrib_ = array(
            'class' => 'form-horizontal',
            'name' => 'frmcoScholasticAddClass',
            'id' => 'frmcoScholasticAddClass',
        );
        ?>
        <?php echo form_open('#', $attrib_); ?>
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5 id="exitHeading">Co-Scholastic items present</h5>
            </div>
            <div class="widget-content nopadding" id="fillcoscholastic">
            </div>
        </div>
    </div>    

    <div class="span4">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5 id="exitHeading">Select Class</h5>
            </div>
            <div class="widget-content nopadding" id="fillcoclass" style="max-height:300px; overflow: scroll">
            </div>
        </div>
    </div>
    <div class="span4">        
        <div class="control-group" style="padding-top:15px;">
            <div class="controls">
                <input type="button" value="Add Co-Scholastic Item to class" class="btn btn-success Add_coscholastic_class">
            </div>
        </div>        
    </div>
    <?php echo form_close(); ?>

    <div class="span4">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5 id="exitHeading1">Co-Scholastic Item already Associated with Class</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered">
                    <thead>
                        <tr style="text-align: left;">                            
                            <th>Co-Scholastic Item Name</th>                                                     
                            <th>Action</th>                            
                        </tr>
                    </thead>
                    <tbody id="fillAssociatedcoScholastic"> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>                                          