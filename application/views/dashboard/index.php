<div class="quick-actions_homepage">
	<ul class="quick-actions">
		<li class="bg_lb"> <a href="<?php echo site_url('DashboardReports/total_students');?>"> <i class="icon-user"></i> <span class="label label-important"><?php echo $figure['count_reg_students']; ?></span> Total Registered Students in 2018-19 </a> </li>
		<li class="bg_ly"> <a href="<?php echo site_url('DashboardReports/total_classes');?>"> <i class="icon-inbox"></i> <span class="label label-success"><?php echo $figure['count_classes_in_session']; ?></span> Total CLasses </a> </li>
		<li class="bg_lb"> <a href="<?php echo site_url('DashboardReports/total_admitted_students');?>"> <i class="icon-dashboard"></i> <span class="label label-success"><?php echo $figure['count_students_in_a_session']; ?></span> Total Admitted Students in 2018-19  </a> </li>
	</ul>
</div>
