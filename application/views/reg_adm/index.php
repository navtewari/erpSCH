<div class="row-fluid">
    <div class="span6">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>Registration</h5>
            </div>
            <div class="widget-content nopadding">
                <div class="control-group">
                    <form class="form-horizontal" method="post" action="#" name="basic_validate" id="basic_validate" novalidate="novalidate">
                        <div class="control-group">
                            <label class="control-label">Select input</label>
                            <div class="controls">
                                <select >
                                    <option>First option</option>
                                    <option>Second option</option>
                                    <option>Third option</option>
                                    <option>Fourth option</option>
                                    <option>Fifth option</option>
                                    <option>Sixth option</option>
                                    <option>Seventh option</option>
                                    <option>Eighth option</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>            
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span6">
        <div class="widget-box">
            <div class="widget-title">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#Personal">Personal Detail</a></li>
                    <li><a data-toggle="tab" href="#Academics">Academics Detail</a></li>
                    <li><a data-toggle="tab" href="#Address">Address</a></li>
                </ul>
            </div>
            <div class="widget-content tab-content">
                <div id="Personal" class="tab-pane active">
                    <?php $this->load->view('reg_adm/tabs/personal'); ?>
                </div>
                <div id="Academics" class="tab-pane">
                    <?php $this->load->view('reg_adm/tabs/academics'); ?>
                </div>
                <div id="Address" class="tab-pane">
                    <?php $this->load->view('reg_adm/tabs/contact'); ?>
                </div>
            </div>
        </div>
    </div>
</div>