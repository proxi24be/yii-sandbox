<?php 
    $baseUrl = Yii::app()->baseUrl ;
    $this->beginContent('//layouts/bootstrap'); 
?>

<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/admin-theme/datatables.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/defaultTheme/aristo/Aristo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/defaultTheme/theme_base.css" />

<style>
    
    table
    {
        width:100%;
    }
    
    table label
    {
        display:inline;
        font-weight: bold;
    }
    
    table td {
        text-align:center;
    }
    
    table tr
    {
        height:40px;
    }

    div.yiibreadcrumbs
    {
        margin-bottom: 20px;
    }

    table thead th div.DataTables_sort_wrapper
    {
        padding-right: 15px;
        position: relative;
        vertical-align: middle;
    }

    table thead th div.DataTables_sort_wrapper span
    {
        margin-top: -8px;
        position: absolute;
        right: 0;
        top: 50%;
    }
    
</style>


<script src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

<div class="container yiibreadcrumbs">
    <div class="row">

        <?php if(isset($this->breadcrumbs)):
            $this->widget('zii.widgets.CBreadcrumbs', array(
                'links'=>$this->breadcrumbs,"htmlOptions"=>array("class"=>"span12")));
        endif;
        ?><!-- breadcrumbs -->

    </div>
</div>

<div class="container">
    <div class="row">
        <?php 
        $this->widget('zii.widgets.CMenu', array(
                'items'=>array(
        array('label'=>'1.Request availability', 'url'=>array("/shipment/translational/index")),
        array('label'=>'2.Pending sample availability', 'url'=>array('/shipment/translational/requestedSample')),
        array('label'=>'3.Sample confirmed for shipment', 'url'=>array('/shipment/translational/requestShipment'))
        ),"htmlOptions"=>array("class"=>"span12 nav nav-tabs")
        ));
    ?>
    </div>
</div>


<div id="content">
    <?php
	 echo $content; 
     ?>
</div><!-- content -->

<?php $this->endContent(); ?>