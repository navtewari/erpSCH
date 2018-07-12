<!--Footer-part-->

<div class="row-fluid">
  <div id="footer" class="span12"> 2017 &copy; schoolname. Developed by <a href="http://teamfreelancers.com" target="_blank">Teamfreelancers.com</a></div>
</div>

<script src="<?php echo base_url('assets_/js/jquery.min.js');?>"></script> 
<script src="<?php echo base_url('assets_/js/jquery.ui.custom.js');?>"></script> 
<script src="<?php echo base_url('assets_/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets_/js/myjs.js');?>?version=1.31"></script>  
<script src="<?php echo base_url('assets_/js/navJS.js');?>?version=1.2"></script>
<script src="<?php echo base_url('assets_/js/jquery.gritter.min.js');?>"></script>
<script src="<?php echo base_url('assets_/js/bootstrap-colorpicker.js');?>"></script> 
<script src="<?php echo base_url('assets_/js/bootstrap-datepicker.js');?>"></script> 
<!--script src="<?php echo base_url('assets_/js/jquery.toggle.buttons.js');?>"></script--> 
<script src="<?php echo base_url('assets_/js/masked.js');?>"></script> 
<script src="<?php echo base_url('assets_/js/jquery.uniform.js');?>"></script> 
<script src="<?php echo base_url('assets_/js/select2.min.js');?>"></script> 
<script src="<?php echo base_url('assets_/js/matrix.js');?>"></script> 
<script src="<?php echo base_url('assets_/js/wysihtml5-0.3.0.js');?>"></script> 
<script src="<?php echo base_url('assets_/js/jquery.peity.min.js');?>"></script> 
<script src="<?php echo base_url('assets_/js/bootstrap-wysihtml5.js');?>"></script>
<script src="<?php echo base_url('assets_/js/jquery.dataTables.min.js');?>"></script> 
<script src="<?php echo base_url('assets_/js/matrix.tables.js');?>"></script>
<script src="<?php echo base_url('assets_/js/excanvas.min.js');?>"></script>
<script src="<?php echo base_url('assets_/js/matrix.form_common.js');?>"></script> 
<script src="<?PHP echo base_url() . 'assets_/multiSelect/js/multiselect.min.js'; ?>"></script>

<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
<script>
    var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);

    if (!isChrome){
        document.getElementById("doc__").innerHTML = "<div style='padding: 25px; text-align: center; font-size: 25px; color: #900000; font-weight: bold'>- Please switch to <span style='color: #ff0000'>google { chrome } browser</span> to use this school application. -</div>"; 
    } 
</script>
</body>
</html>
