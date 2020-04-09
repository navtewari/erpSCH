<div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Data table (Total <?php echo count($figure['count_view_result']);?> students)</h5>
                <h5 style="float: right; color:#900000" id="reload_me">Reload</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                        <th>Registration No</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Class</th>
                        <th>Result View Date</th>
                        </tr>
                    </thead>
                    <tbody id="student_data_here">
                        <?php foreach ($student_in_current_session as $studentitem) { ?>
                        <tr class="gradeX">
                            <td style="text-align: center"><?php echo $studentitem->regid;?></td>
                            <td style="text-align: center"><?php echo $studentitem->FNAME;?></td>
                            <td style="text-align: center">
                                <?php if($studentitem->GENDER == 'M' || $studentitem->GENDER == 'Male' || $studentitem->GENDER == 'MALE'){ ?>
                                    <div style="width: auto"><img src="<?php echo base_url('assets_/img/male.png');?>" style="width: 16px" title="<?php echo $studentitem->GENDER;?>"></div>
                                    <div style="width: auto; display: none">1</div>
                                <?php } else { ?>
                                    <div style="width: auto"><img src="<?php echo base_url('assets_/img/female.png');?>" style="width: 16px" title="<?php echo $studentitem->GENDER;?>"></div>
                                    <div style="width: auto; display: none">0</div>
                                <?php } ?>
                            </td>
                            <td style="text-align: center;"><?php echo $studentitem->CLASSID;?></td>
                            <td style="text-align: center"><?php echo $studentitem->DATE_;?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>