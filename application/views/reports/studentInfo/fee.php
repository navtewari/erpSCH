<div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
	<?php
      	$inv_amt = 0;
      	$dscnt_amt = 0;
      	$fine = 0;
      	$total_paid = 0;
      	$nom = 0;
      	$arr = end($allInvoices);
    ?>
	        	<h5 style="float: left">Fee Detail</h5>
	        	<h5 style="float: right"><?php if($arr->DUE_AMOUNT > 0){echo "<span style='color: #ff0000'>";}else{echo "<span>";}?>Dues: Rs. <?php echo $arr->DUE_AMOUNT;?>/-</span></h5>
	        	</div>
		            <div class="row-fluid">
		            	<div class="span12">
		            		<div class="widget-title"> 
				            <h5>Invoices &amp; Its Payment Detail</h5>
				          </div>
				          <div class="widget-content nopadding">
				          	<?php
				              	$inv_amt = 0;
				              	$dscnt_amt = 0;
				              	$fine = 0;
				              	$total_paid = 0;
				              	$nom = 0;
				              	$arr = end($allInvoices);
				            ?>
				            <table class="table table-bordered data-table">
				              <thead>
				                <tr>
				                  <th style="text-align: left !important">CLASS</th>
				                  <th style="text-align: right !important">INVOICE</th>
				                  <th style="text-align: left !important">INVOICE DURATION</th>
				                  <th style="text-align: center !important" title="Number of Months">NOM</th>
				                  <th style="text-align: right !important">INVOICE AMOUNT (Rs.)</th>
				                  <th style="text-align: right !important">DISCOUNT AMOUNT (Rs.)</th>
				                  <th style="text-align: right !important">ANY FINE (Rs.)</th>
				                  <th style="text-align: right !important">PAID AMOUNT (Rs.)</th>
				                  <th style="text-align: right !important">INVOICE DUES (Rs.)</th>
				                </tr>
				              </thead>
				              <tbody>
				              	<?php foreach($allInvoices as $invoiceitem){?>
					                <tr class="gradeX">
					                  <td style="text-align: left"><?php echo $invoiceitem->CLASSID?></td>
					                  <td style="text-align: right">
					                  	<?php echo anchor('reports/invoice_receipt_detail/'.$invoiceitem->INVDETID,'<div class="discount_lable" style="float: right">'.$invoiceitem->INVDETID.'</div>', 'target=_blank');?>
					                  	</a>
					                  </td>
					                  <td>
					                  	<span style="color: #0000ff">
					                  		<?php echo $invoiceitem->YEAR_FROM.", ".$this->my_library->getMonthsName($invoiceitem->MONTH_FROM)." <b>to</b> ".$invoiceitem->YEAR_TO.", ".$this->my_library->getMonthsName($invoiceitem->MONTH_TO);?>
					                  	</span>
					                  </td>
					                  <td style="text-align: center"><?php echo $invoiceitem->NOM; ?></td>
					                  <td style="text-align: right"><?php echo $invoiceitem->ACTUAL_DUE_AMOUNT;?></td>
					                  <td style="text-align: right"><?php echo $invoiceitem->DISCOUNT_AMOUNT;?></td>
					                  <td style="text-align: right"><?php echo $invoiceitem->FINE;?></td>
					                  <td style="text-align: right"><?php echo $invoiceitem->PAID;?></td>
					                  <td style="text-align: right"><?php echo $final_due = $invoiceitem->DUE_AMOUNT;?></td>
					                  <?php $nom = $nom + $invoiceitem->NOM; ?>
					                  <?php $inv_amt = $inv_amt + $invoiceitem->ACTUAL_DUE_AMOUNT; ?>
					                  <?php $dscnt_amt = $dscnt_amt + $invoiceitem->DISCOUNT_AMOUNT; ?>
					                  <?php $fine = $fine + $invoiceitem->FINE; ?>
					                  <?php $total_paid = $total_paid + $invoiceitem->PAID; ?>
					                </tr>
				            	<?php } ?>
				            		<tr style="font-weight: bold">
										<td style="text-align: center"></td>
										<td style="text-align: center"></td>
										<td style="text-align: right;">Total</td>
										<td style="color: #ff0000; background: #ffff00; text-align: center"><?php echo $nom; ?></td>
										<td style="color: #ff0000; background: #ffff00; text-align: right"><?php echo $inv_amt;?></td>
										<td style="color: #ff0000; background: #ffff00; text-align: right"><?php echo $dscnt_amt;?></td>
										<td style="color: #ff0000; background: #ffff00; text-align: right"><?php echo $fine;?></td>
										<td style="color: #ff0000; background: #ffff00; text-align: right"><?php echo $total_paid;?></td>
										<td style="color: #ff0000; background: #ffff00; text-align: right"><?php echo $final_due;?></td>
									</tr>
				              </tbody>
				            </table>
				          </div>
				      </div>
		            </div>


