<div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
	        	<h5>Fee Detail</h5>
	        	</div>
		            <div class="row-fluid">
		            	<div class="span12">
		            		<div class="widget-title"> 
				            <h5>Invoices</h5>
				          </div>
				          <div class="widget-content nopadding">
				            <table class="table table-bordered data-table">
				              <thead>
				                <tr>
				                  <th style="text-align: left !important">CLASS</th>
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
					                  <td style="text-align: right"><?php echo $invoiceitem->DUE_AMOUNT;?></td>
					                </tr>
				            	<?php } ?>
				              </tbody>
				            </table>
				          </div>
				      </div>
		            	<div class="span12">
		            		2
		            	</div>
		            </div>


