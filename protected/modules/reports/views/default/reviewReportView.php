<?php $baseUrl = Yii::app()->baseUrl ; ?>

<link type="text/css" href="<?php echo $baseUrl ;?>/css/datatable/demo_table_jui.css" rel="Stylesheet" />
<link type="text/css" href="<?php echo $baseUrl ;?>/css/datatable/demo_page.css" rel="Stylesheet" />
<link type="text/css" href="<?php echo $baseUrl ;?>/css/datatable/demo_table.css" rel="Stylesheet" />

<script type="text/javascript" src="<?php echo $baseUrl; ?>/javascript/DataTables-1.8.1/jquery.dataTables.min.js"></script>
<script type="text/javascript">

$(document).ready(function()
{
   $("table.reportView").dataTable
   ({
       "bJQueryUI" : true,
       "sPaginationType": "full_numbers",
       "aaSorting": [], //no initial sorting
       "aoColumnDefs": [{ "bSortable": false, "bSearchable":false ,"aTargets": [4] }]
       
   });
});

</script>

<style>
    
    table.reportView
    {
        width: 100%;
    }
    
    table.reportView th
    {
        text-transform: uppercase;
    }
    
    table.reportView tr:hover
    {
        background-color: #EFEFEF;
    }
    
    table.reportView tr
    {
        height:30px;
    }
    
    table.reportView td.CREATED
    {
        color:green;
        font-weight: bold;
    }
    
    table.reportView td.FAILED
    {
        color:firebrick;
        font-weight: bold;
    }
    
</style>

<?php

$this->breadcrumbs=array(
	"review report"
);
?>

<div class="container" style="margin-top:20px;">
    <div class="row">
        <div class="span12">
        <p style="float:right">Page Refreshed <b><?php echo date('F j, Y, g:i a');?></b><a href="<?php echo Yii::app()->createAbsoluteUrl('reports/default/reviewreport');?>" style="margin-left:10px">refresh</a></p>
        <p class="tipReset"><span class="ui-icon ui-icon-info" style="float:left"></span>
            <span style="margin-left:20px; display:block">Please click on the <a href="<?php echo Yii::app()->createAbsoluteUrl('reports/default/reviewreport');?>">refresh</a> link to check the availability of your report</span></p>

        <table class="reportView">
            <thead>
                <tr><th>Report Name</th> <th>Status</th> <th>Date order</th> <th>Date available</th><th>Review</th> </tr>
            </thead> 

            <tbody>
                <?php 
                    $url=Yii::app()->createUrl("reports/default/getReport");
                    $cpt=1;
                    foreach ($results as $row)
                    {
                        $tr="<td>$row->FILENAME</td>";
                        $tr= $tr. "<td class='$row->STATUS'>$row->STATUS</td>";
                        $tr= $tr. "<td>$row->STAMP_CREATE</td>";
                        $tr= $tr. "<td>$row->STAMP_FINISHED</td>";
                        $urlQueueID="$url?QID=$row->QUEUE_ID";

                        if (file_exists ($row["FILEPATH"]))
                            $tr= $tr. "<td><a href='$urlQueueID'>download</a></td>";
                        else if ($row["STATUS"]=='FAILED')
                            $tr= $tr. "<td>NA</td>";
                        else
                            $tr= $tr. "<td></td>";

                        echo "<tr>$tr</tr>\n";
                        $cpt++;
                    }
                ?>
            </tbody>

        </table>
        </div>
    </div>
</div>