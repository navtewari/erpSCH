<div class="span12">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
                <h5>Select Class &amp; duration to view total collected Fee</h5>
                <h5 class="show_message" id="show_message"></h5>
            </div>
            <div class="widget-content" style="overflow: hidden">
                <div class="control-group span2">
                    <label class="control-label">Select Class</label>
                    <div class="controls">
                        <?php
                            $data = array(
                                'name' => 'cmbClassForTotalCollection',
                                'id' => 'cmbClassForTotalCollection',
                                'required' => 'required',
                                'class' => 'span12'
                            );
                            $options = array();
                            $options['x'] = 'Class';
                            foreach ($class_in_session as $item) {
                                $options[$item->CLSSESSID] = 'Class ' . $item->CLASSID;
                            }
                            echo form_dropdown($data, $options, '');
                        ?>
                    </div>
                </div>
                <div class="control-group span1"></div>
                <div class="control-group span2">
                    <label class="control-label">Year From</label>
                        <div class="controls">
                            <?php
                                $data = array(
                                    'name' => 'cmbYearFromForTotalCollection',
                                    'id' => 'cmbYearFromForTotalCollection',
                                    'required' => 'required',
                                    'class' => 'span12'
                                );
                                $options = array();
                                for($i=date('Y'); $i<=(date('Y')+1);$i++){
                                    $options[$i] = $i;
                                }
                            ?>
                            <?php echo form_dropdown($data, $options, date('Y')); ?>
                        </div>
                </div>
                <div class="control-group span2">
                    <label class="control-label">Month From</label>
                        <div class="controls">
                            <?php
                                $data = array(
                                    'name' => 'cmbMonthFromForTotalCollection',
                                    'id' => 'cmbMonthFromForTotalCollection',
                                    'required' => 'required',
                                    'class' => 'span12'
                                );
                                $options = array();
                                foreach($fetch_month as $key => $value){
                                    $options[$key] = $value;
                                }
                            ?>
                            <?php echo form_dropdown($data, $options, (date('m'))); ?>
                        </div>
                </div>
                <div class="control-group span1"></div>
                <div class="control-group span2">
                    <label class="control-label">Year To</label>
                        <div class="controls">
                            <?php
                                $data = array(
                                    'name' => 'cmbYearToForTotalCollection',
                                    'id' => 'cmbYearToForTotalCollection',
                                    'required' => 'required',
                                    'class' => 'span12'
                                );
                                $options = array();
                                for($i=date('Y'); $i<=(date('Y')+1);$i++){
                                    $options[$i] = $i;
                                }
                            ?>
                            <?php echo form_dropdown($data, $options, date('Y')); ?>
                        </div>
                </div>
                <div class="control-group span2">
                    <label class="control-label">Month To</label>
                        <div class="controls">
                            <?php
                                $data = array(
                                    'name' => 'cmbMonthToForTotalCollection',
                                    'id' => 'cmbMonthToForTotalCollection',
                                    'required' => 'required',
                                    'class' => 'span12'
                                );
                                $options = array();
                                foreach($fetch_month as $key => $value){
                                    $options[$key] = $value;
                                }
                            ?>
                            <?php echo form_dropdown($data, $options, date('m')); ?>
                            
                        </div>
                </div>
            </div>
        </div>
    </div>