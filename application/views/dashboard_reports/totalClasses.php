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
                    </thead>
                    <tbody id="student_data_here" style="font-size: 12px">
                        <?php $i = 1; ?>
                        <?php foreach ($total_classes as $class_) { ?>
                            <tr class="gradeX">
                                <td>
                                    <div style="font-size: 12px; padding: 0px 2px;">
                                        <?php echo 'Class ' . $class_->CLASSID;?>        
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="span5">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Student(s) in class</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: left; width: auto">Class</th>
                            <th style="width: 100px">Total Student(s)</th>
                            <th style="width: 80px">Download</th>
                            <?php if($this->session->userdata('_status_') == 'adm' && ($this->session->userdata('_user___') == 'nitin' || $this->session->userdata('_user___') == 'gopal' || $this->session->userdata('_user___') == 'naveen')){?>
                            <th style="width: 80px">For ID Card</th>
                        <?php } ?>
                        </tr>
                    </thead>
                    <tbody id="student_data_here" style="font-size: 12px">
                        <?php foreach ($total_students as $stduents) { ?>
                            <?php if($stduents->TOTAL_STUDENTS != 0){ ?>
                            <tr class="gradeX">
                                <td>
                                    <div style="font-size: 12px; padding: 0px 2px;">
                                        <?php echo 'Class ' . $stduents->CLASSID;?>        
                                    </div>
                                </td>
                                <td style="text-align: center">
                                    <center>
                                        <div style="background: #00AFEC; color: #ffffff; padding: 0px 2px; min-width: 10px; max-width: 50px; border-radius: 8px">
                                            <a href="#" id="<?php echo $stduents->CLSSESSID."~".$stduents->CLASSID;?>" style="color: #ffffff" class="show_students_as_per_class"><?php echo $stduents->TOTAL_STUDENTS; ?></a>
                                        </div>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                    <a href="<?php echo site_url('exporting/toCsv/'.$stduents->CLSSESSID.'/'.$stduents->CLASSID);?>">
                                        <div style="padding: 0px 3px; background: #65c71d; color: #ffffff; font-weight: bold; width: 50px; border-radius: 5px"><li class="icon-download-alt">.csv</li></div>
                                    </a>
                                    </center>
                                </td>
                                <?php if($this->session->userdata('_status_') == 'adm' && ($this->session->userdata('_user___') == 'nitin' || $this->session->userdata('_user___') == 'gopal' || $this->session->userdata('_user___') == 'naveen')){?>
                                <td>
                                    <center>
                                    <a href="<?php echo site_url('exporting/toCsv2/'.$stduents->CLSSESSID.'/'.$stduents->CLASSID);?>">
                                        <div style="padding: 0px 3px; background: #FFC300; color: #ffffff; font-weight: bold; width: 50px; border-radius: 5px"><li class="icon-download-alt">.csv</li></div>
                                    </a>
                                    </center>
                                </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5><div style="float: left">Student(s) in class&nbsp;</div><div id="class_name" style="float: left; background: #ffff00; color: #000090; font-weight"></div></h5>
            </div>
            <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped with-check">
                        <thead>
                            <tr>
                                <th style="text-align: left">ID</th>
                                <th style="text-align: left">Student Name</th>
                            </tr>
                        </thead>
                        <tbody id="student_data_here_as_per_class" style="font-size: 12px" style="height: 250px; overflow: auto">
                            
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>