<div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Data table</h5>
                <h5 style="float: right; color:#900000" id="reload_me">Reload</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                        <th>Registration No</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Class of Admission</th>
                        <th>Date of Admission</th>
                        </tr>
                    </thead>
                    <tbody id="student_data_here">
                        <?php foreach ($student_in_current_session as $studentitem) { ?>
                        <tr class="gradeX">
                            <td><?php echo $studentitem->regid;?></td>
                            <td><?php echo $studentitem->FNAME;?></td>
                            <td><?php echo $studentitem->GENDER;?></td>
                            <td class="center"><?php echo $studentitem->CLASSID;?></td>
                            <td class="center"><?php echo $studentitem->DOA;?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>