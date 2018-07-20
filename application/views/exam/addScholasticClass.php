<div class="tab-pane active" id="newClassEntry">  

    <div class="span4">
        <?php
        $attrib_ = array(
            'class' => 'form-horizontal',
            'name' => 'frmScholasticAddClass',
            'id' => 'frmScholasticAddClass',
        );
        ?>
        <?php echo form_open('#', $attrib_); ?>
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5 id="exitHeading">Scholastic items present</h5>
            </div>
            <div class="widget-content nopadding" id="fillscholastic">
            </div>
        </div>
    </div>    

    <div class="span4">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5 id="exitHeading">Select Class</h5>
            </div>
            <div class="widget-content nopadding" id="fillclass" style="max-height:300px; overflow: scroll">
            </div>
        </div>
    </div>
    <div class="span4">        
        <div class="control-group" style="padding-top:15px;">
            <div class="controls">
                <input type="button" value="Add Scholastic Item to class" class="btn btn-success Add_scholastic_class">
            </div>
        </div>        
    </div>
    <?php echo form_close(); ?>

    <div class="span4">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5 id="exitHeading1">Scholastic Item already Associated with Class</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered">
                    <thead>
                        <tr style="text-align: left;">                            
                            <th>Scholastic Item Name</th>                                                     
                            <th>Action</th>                            
                        </tr>
                    </thead>
                    <tbody id="fillAssociatedScholastic"> 

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>                                          