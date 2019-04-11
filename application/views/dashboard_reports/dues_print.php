<style type="text/css">
    .for_reminder_label{
        background:#FE8A8A;
        color:#ffff00;
        font-size:10px;
        border-radius: 5px;
        padding: 2px;
    }
    .transparent-label{
        background: transparent;
        color: #ffffff;
    }
</style>
<div class="row-fluid">
    <div class="span3">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Classes in <?php echo $this -> session -> userdata('_current_year___'); ?></h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: left">Class</th>
                        </tr>
           
                    <tbody id="student_data_here" style="font-size: 12px">
                        <?php $i = 1; ?>
                        <?php foreach ($total_classes as $class_) { ?>
                            <tr class="gradeX">
                                <td>
                                    <div style="font-size: 12px; padding: 0px 2px;">
                                        <a href="#" id="class~<?php echo $class_->CLSSESSID;?>~ID~<?php echo $class_->CLASSID;?>" class="classwise_paid_dues_discount">
                                            <?php echo 'Class ' . $class_->CLASSID;?>       
                                        <div style="background: #CCFCF9; padding: 0px 5px; border: #96EAFD solid 1px; border-radius: 5px; width: auto; float: right">Rs. <?php echo $class_->DUES; ?> /-</div>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="span9">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5 style="float: left" id="dues_for_class">Total Due(s) in <?php echo $this -> session -> userdata('_current_year___'); ?></h5>
                <h5 style="float: right">Total Dues: <b style="color:#ff0000">Rs. <?php echo number_format($figure['total_dues_in_a_session'],0,".",","); ?> /-</b></h5>
            </div>
            <div class="widget-content nopadding" style="overflow-y: scroll; overflow-x: auto; height: 450px; padding: 5px">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Reg ID</th>
                            <th style="text-align: left; vertical-align: middle;">Name</th>
                            <th style="text-align: left; vertical-align: middle;">Discount</th>
                            <th style="text-align: left; width: 100px; vertical-align: middle;">Paid</th>
                            <th style="text-align: right; vertical-align: middle;" id="dues_from_class">Amount Due (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody id="student_dues_data_here" style="font-size: 12px">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>