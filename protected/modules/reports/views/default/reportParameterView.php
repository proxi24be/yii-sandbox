<?php 
    
    $path = Yii::getPathOfAlias("webroot.javascript.report");
    $assetUrl = Yii::app()->assetManager->publish($path);
    Yii::app()->clientScript->registerScriptFile("$assetUrl/ReportUtil.js");

?>

<style>
    select#ReportForm_REPORT_ID
    {
        width:auto;
    }
    
    div.wizardStep
    {
        font-size: 2em;
    }
    
    p.reportDescription
    {
        font-style: italic;
        font-size:0.8em;
    }
    
    div.report select
    {
        min-height: 200px;
    }
    
</style>

<?php
$this->breadcrumbs=array(
	$this->module->id,
);
?>

<div class="container" >
    <div class="row form">
        <?php 
            $form=$this->beginWidget('CActiveForm', array(
            'id'=>'ReportForm',
            'action'=>Yii::app()->createUrl("reports/default/orderReport"),
            'enableAjaxValidation'=>false,
             "htmlOptions"=>array("class"=>"span12 form-horizontal"))); 
        ?>
        
        <h3>Order a new Report</h3>
        <div class="span1 wizardStep muted">1</div>
        <?php 
        echo "<div class='span5 control-group'>";
        echo $form->labelEx($model,'REPORT_ID', array("class"=>"control-label")); 
        echo $form->dropDownList($model,'REPORT_ID',MyUtils::addEmpty($reports));
        echo "</div>"
        ?>
        <div class="span5">
            <p class="reportDescription"></p>            
        </div>
        
        <div class="clearfix"></div>
        
        <div class="reportDynamic">

        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/dojo/1.7.2/dojo/dojo.js" data-dojo-config="async: true"> </script>
<script type="text/javascript">

    var reportDescription= <?php echo $reportLongDescription;?>;

    var url='<?php echo Yii::app()->createUrl('reports/default/GetReportParamView'); ?>';
    application.init(url);
    url= '<?php echo Yii::app()->createUrl('reports/default/GetAllParametersOfUser');?>',
    reportParam.initUserParams(url);
    
</script>




