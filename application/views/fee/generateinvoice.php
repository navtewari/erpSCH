<style>
    th{ text-align: left !important }
    .payFee{color: #ff0000; text-align: center !important}
</style>
<div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Invoice(s)</h5>
                <h5 style="float: right; color:#900000" id="reload_me">Reload</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Registration No</th>
                            <th>Name</th>
                            <th>Fix Fee Amount</th>
                            <th>Opted Fee</th>
                            <th style="text-align: right !important">Opted Fee Amount</th>
                            <th style="text-align: right !important">Total Fee</th>
                            <th>Action</th>
                            <th style="text-align: center !important">Pay Fee</th>
                        </tr>
                    </thead>
                    <tbody id="student_data_here">
                        <?php $roll = 1019201; ?>
                        <?php for($i=1; $i<=25; $i++){ ?>
                        <tr class="gradeX">
                            <td><?php echo $roll++; ?></td>
                            <td><i class="icon-user"></i> Nitin Deepak</td>
                            <td>2000X1=2000</td>
                            <td>Bus | Martial-Arts</td>
                            <td style="text-align: right">1500</td>
                            <td style="text-align: right">3500</td>
                            <td style="color: #900000">Generate Invoice</td>
                            <td class="payFee"><i class="icon-close"></i></td>
                        </tr>
                        <tr class="gradeX">
                            <td><?php echo $roll++; ?></td>
                            <td><i class="icon-user"></i> Omprakash Singh</td>
                            <td>2000X1=2000</td>
                            <td>Bus</td>
                            <td style="text-align: right">500</td>
                            <td style="text-align: right">2500</td>
                            <td style="color: #0000ff">Print/ View Invoice</td>
                            <td class="payFee"><i class="icon-play" title="Pay Fee"></i></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>