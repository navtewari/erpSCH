<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"> Menu </a>              
    <ul>         
        <li><img src='<?php echo base_url('assets_/' . $this->session->userdata('db2') . '/logo/' . $this->session->userdata('logo')); ?>?ver=<?php echo _NITIN_IMG_VERSION_; ?>' width="80" style=" display: block;margin-left: auto;margin-right: auto;"/></li>
        <?php foreach ($menu as $menu_item) {?>
            <?php 
                $cls = '';
                if($menu_item->PATH_ == 'x'){ 
                    $cls = 'submenu'; 
                    if($menu_item->ID_ == $active){ 
                        $cls = $cls . ' active';
                    }
                } else {
                    if($menu_item->ID_ == $active){ 
                        $cls = 'active';
                    }
                }
                if($cls != ''){$cls = ' class="'.$cls.'"';}
            ?>        
            <li<?php echo $cls;?>><a href="<?php if($menu_item->PATH_ == 'x') { echo "#"; } else { echo site_url($menu_item->PATH_); } ?>"><i class="<?php echo $menu_item->PRE_ICON;?>"></i> <span><?php echo $menu_item->MENU;?></span> <?php if($menu_item->PATH_ == 'x') { echo '<span style="float: right; padding: 0px 5px 0px 5px"><i class="icon-chevron-down"></i></span>'; } ?></a> 
                <?php if($menu_item->PATH_ == 'x') { ?>
                <ul>
                <?php } ?>
                <?php foreach ($sub_menu as $submenu_item) { ?>
                    <?php if($menu_item->ID_ == $submenu_item->ID_){?>
                        <li>
                            <a href="<?php echo site_url($submenu_item->PATH_); ?>"><?php echo $submenu_item->SUBMENU; ?></a>
                        </li>
                    <?php } ?>
                <?php } ?>
                <?php if($menu_item->PATH_ == 'x') { ?>
                </ul>
                <?php } ?>
            </li>
        <?php } ?>
    </ul>
</div>
<!--sidebar-menu-->