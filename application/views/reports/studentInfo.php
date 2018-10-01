<?php if($bool_ == 0){ ?>
	<div class="row-fluid"><hr>
	    <div class="span12">
	        <div class="widget-box">
	        	No data found.
	        </div>
	    </div>
	</div>
<?php } else { ?>
	<div class="row-fluid">
	    <div class="span12">
	        <div class="widget-box">
	        	<?php $this->load->view('reports/studentInfo/personal');?>
			</div>
			<div class="widget-box">
				<?php $this->load->view('reports/studentInfo/fee');?>
			</div>
		</div>
	</div>
<?php } ?>
