<html>
    <head>
        <title>Excel</title>
    </head>
    <body>
        <table border="1" id="student_table">
        <tr>
            <td colspan="2"><?php echo $className;?></td>
            <td colspan="2">Subject = <?php echo $subjectName;?></td>
        </tr>
            <tr>
                <td>SrNO</td>
                <td>Reg ID</td>
                <td>Student Name</td>
                <?php if ($assArea==1){?>
                    <?php foreach($sch_data_class as $sch){?>
                    <td>
                        <?php echo $sch->item;?>
                    </td>
                    <?php }?>
                <?php }elseif($assArea==2){?>
                    <?php foreach($cosch_data_class as $sch){?>
                    <td>
                        <?php echo $sch->coitem;?>
                    </td>
                    <?php }?>
                <?php }elseif($assArea==3){?>
                    <?php foreach($discipline_data_class as $sch){?>
                    <td>
                        <?php echo $sch->disciplineitem;?>
                    </td>
                    <?php }?>
                <?php }?>
            </tr>
            <?php $num=1;
                foreach($studentdata as $classStudent){?>
                    <tr>
                        <td><?php echo $num;?></td>
                        <td><?php echo $classStudent->regid;?></td>
                        <td><?php echo $classStudent->FNAME;?></td>
                        <?php if ($assArea==1){?>
                            <?php foreach($sch_data_class as $sch){ 
                                $print=0;?>                        
                                <?php foreach($studentMarks as $stuMarks) {?>
                                    <?php if($stuMarks->regid==$classStudent->regid && $sch->itemID == $stuMarks->itemID){?>
                                        <td>
                                            <?php echo $stuMarks->marks; $print=1;?>
                                        </td>
                                    <?php }?>
                                <?php }?>
                                <?php 
                                    if($print==0){
                                        echo "<td></td>";
                                    }
                                ?>
                            <?php }?>
                        <?php }elseif($assArea==2){?>
                            <?php foreach($cosch_data_class as $sch){
                                $print=0;?>                        
                                <?php foreach($studentMarks as $stuMarks) {?>
                                    <?php if($stuMarks->regid==$classStudent->regid && $sch->coitemID == $stuMarks->coitemID){?>
                                        <td>
                                            <?php echo $stuMarks->grade; $print=1;?>
                                        </td>
                                    <?php }?>
                                <?php }?>
                                <?php 
                                    if($print==0){
                                        echo "<td></td>";
                                    }
                                ?>
                            <?php }?>
                        <?php }elseif($assArea==3){?>
                            <?php foreach($discipline_data_class as $sch){
                                $print=0;?>                        
                                <?php foreach($studentMarks as $stuMarks) {?>
                                    <?php if($stuMarks->regid==$classStudent->regid && $sch->disciplineID == $stuMarks->disciplineID){?>
                                        <td>
                                            <?php echo $stuMarks->grade; $print=1;?>
                                        </td>
                                    <?php }?>
                                <?php }?>
                                <?php 
                                    if($print==0){
                                        echo "<td></td>";
                                    }
                                ?>
                            <?php }?>
                        <?php }?>
                    </tr>
            <?php $num++;}?>
        </table>
    </body>
</html>
<script src="<?php echo base_url('assets_/js/jquery.min.js'); ?>"></script> 
<script src="<?php echo base_url(). 'assets_/js/jquery.table2excel.js'?>"></script>
<script>  
    var filename_ = "Marks_for_" + <?php echo '"' . $className . '"';?> + "_" + <?php echo '"' .$subjectName . '"';?>;    
	$(document).ready(function() {        
        $("#student_table").table2excel({
            // exclude CSS class
            exclude: ".noExl",
            name: "Worksheet Name",
            filename: filename_, //do not include extension
            fileext: ".xls", // file extension
            preserveColors:false
        });
        window.close();  
});
 
</script>  