<style>
    .view_invoice_0{
         color: #808080; 
         background: #f0f0f0;
         color: #ff0000;
         border-radius: 4px;
         border: #A0A0A0 solid 1px;
         padding: 1px 5px;
         text-decoration: none !important;
    }
    .view_invoice_1{
         color: #B0B0B0; 
         background: #ffff00;
         color: #ff0000;
         border-radius: 4px;
         border: #A0A0A0 solid 1px;
         padding: 1px 5px;
    }
</style>
<div class="row-fluid">
    <div class="span6">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5 id="receipts_for_class">Today's Fee Collection</h5>
            </div>
            <div class="widget-content nopadding" style="overflow-y: scroll; overflow-x: auto; height: auto; padding: 5px">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th style="text-align: left">Receipt ID</th>
                            <th>Class</th>
                            <th style="text-align: left">INVOICE</th>
                            <th style="text-align: right">COLLECTION (Rs.)<br>Rs. <?php echo number_format($figure['todays_collection'],0,".",","); ?> /-</th>
                            <th style="text-align: right">MODE</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="todays_collection_here" style="font-size: 12px">
                        <?php foreach ($total_collection as $item) { ?>
                            <tr>
                                <td><a href="<?php echo site_url('/fee/fee_print/'.$item->RECPTID);?>" class="view_invoice_1" target="_blank">VIEW</a></td>
                                <td><?php echo $item->RECPTID; ?></td>
                                <td style="text-align: center"><?php echo $item->CLASSID; ?></td>
                                <td style="text-align: center"><?php echo $item->INVDETID; ?></td>
                                <td style="text-align: right"><?php echo number_format(($item->PAID), 0,'.', ','); ?></td>
                                <td style="text-align: center"><?php echo $item->MODE; ?></td>
                                <td><a href="<?php echo site_url('/fee/fee_print/'.$item->RECPTID);?>" class="view_invoice_1" target="_blank">VIEW</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
