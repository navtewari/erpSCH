<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current"><?php echo $title_; ?></a>
    </div>
  </div>
<!--End-breadcrumbs-->

  <div class="container-fluid">
    <?php $this->load->view($page_."/".$inner_page); ?>
  </div>
</div>