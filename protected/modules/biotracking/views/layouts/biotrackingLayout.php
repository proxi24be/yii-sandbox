<?php 
    Yii::import ("application.modules.biotracking.components.*");
    require_once("UserInterface.php");
    $baseUrl=Yii::app()->baseUrl;
    $this->beginContent('//layouts/bootstrap'); 
?>

<div class="container">
    <div class="row">
        <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
        'htmlOptions'=>array("class"=>"span12")
        )); ?><!-- breadcrumbs -->
    <?php endif?>
    </div>
</div>

<link href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/jquery-ui/redmond/redmond.css?v=2" />
<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/jquery-ui/smoothness/smoothness.css?v=2" />

<script src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

<style>
    
/*    div#userMenu li
    {
        line-height:25px;
    }
    
    div#userMenu li a
    {
        font-size: 0.9em;
        text-decoration:none;
    }
    div#userMenu li a:hover
    {
        color: orange;
    }*/
    
    h3.titleH3
    {
        color:#1d5987;
    }
    
    /*
        surcharge du CSS il faut le faire sinon certains elements du composant datatable ne s'affichent pas correctement
    */
    .smoothness .ui-button
    {
        padding-left: 10px;
        padding-right: 10px;
    }

    div.dataTables_info, div.dataTables_paginate, div.dataTables_length, div.dataTables_filter
    {
        padding:5px;
    }

    div.dataTables_length, div.dataTables_filter
    {
        padding-bottom:0px;
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

    div.dataTables_length select
    {
        width:80px;
    }
    
    table
    {
        font-size:0.8em;
    }
    
</style>

<div id="content" class="container">
    <div class="row">
        <div class="span3">
            <!--menu utilisateur-->
            
            <div id="userMenu">
            
                <?php 
//                    $itemMenu=  UserInterface::getInterfaceItems("principal investigator");
//                    $this->widget('application.views.widget.jquery-ui.Accordion', array("items"=>$itemMenu));
                
                    $this->widget('zii.widgets.CMenu', array(
                        'items'=>array(

                        array('label'=>'New Sample', "itemOptions"=>array("class"=>"nav-header")),
                        array('label'=>'Register sample', 'url'=>array('/biotracking/biosample/newsample')),
                        array('label'=>'Register PK sample', 'url'=>array('/#')),
                        array('label'=>'Update sample', 'url'=>array('#')),

                        array('label'=>'View Sample', "itemOptions"=>array("class"=>"nav-header")),
                        array('label'=>'List of registered samples', 'url'=>array('/biotracking/main/mySamples')),
                        array('label'=>'Sample PDF forms', 'url'=>array('/biotracking/main/sampleCompletedForm')),

                        array('label'=>'Request for Shipment', "itemOptions"=>array("class"=>"nav-header")),
                        array('label'=>'Sample shipment', 'url'=>array('#')),
                        array('label'=>'Sample return', 'url'=>array('#')),

                        array('label'=>'Data error report form', "itemOptions"=>array("class"=>"nav-header")),
                        array('label'=>'Submit a DERF', 'url'=>array('#')),
                        array('label'=>'DERF pdf version', 'url'=>array('#')),

                        array("itemOptions"=>array("class"=>"divider")),

                        array('label'=>'Help', "itemOptions"=>array("class"=>"nav-header")),
                        array('label'=>'Faqs', 'url'=>array('/biotracking/main/faq')),
                        array('label'=>'Biotracking manual', 'url'=>array('#')),
                        array('label'=>'Her2 form', 'url'=>array('#')),
                        array('label'=>'UICC TNM', 'url'=>array('#')),
                        array('label'=>'Biotracking security', 'url'=>array('#')),
                        array('label'=>'Contact us', 'url'=>array('/biotracking/main/contactus')),

                        ),"htmlOptions"=>array("class"=>"nav nav-list well")));
                ?>
            
            </div>
            
            <script type="text/javascript">
//                $("#userMenu").accordion();
            </script>  
            
        </div>
        
        <div class="span9">
            <?php echo $content; ?>
        </div>
    </div>
</div><!-- content -->

<?php $this->endContent(); ?>