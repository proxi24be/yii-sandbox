<?php 

$angularPath = Yii::getPathOfAlias('webroot.angularjs.biotracking.newsample');
$baseUrl= Yii::app()->baseUrl;

?>

<script type="text/javascript">

var myConfig =
{
    baseUrl : "<?php echo $baseUrl; ?>",
    currentStudy : "<?php echo $studyName; ?>",
    angularUrl : "<?php echo $baseUrl; ?>",
    extendScope : function(currentScope,studyScope)
    {
        /* This function is very useful to extend object */
        for (var element in studyScope)
            currentScope[element] = studyScope[element];
    }
}

</script>
<?php
Yii::app()->clientScript->registerPackage('angularjs');
?>
<style>
    
    div.defaultHidden , .defaultHidden
    {
        display:none;
    }
    
    form label
    {
        font-weight: bold;
    }

    legend.title
    {
        color: #483d8b;
        font-weight: bold;
    }
    h4.title
    {
        color: #1d5987;
    }

    p.additionalInfo{
        margin-top:5px;
        width:650px;
    }

    span.spanInfo
    {
        padding:5px 0;
        margin-left:0px;
    }

    div.notEditableContent .control-group {
        margin-bottom: 0;
    }

    div.marginLeft50
    {
        margin-left:50px;
    }

    span.help-block
    {
        width:450px;
    }

</style>

<div id="ng-app" ng-app="NewSample" class="ui-corner-all ui-widget-content ng-app:NewSample" style="border-style: solid;padding:20px;" >
    AngularJS is working because I can add : 1 + 2 =  {{ 1+2 }}

    <div ng-view></div>
    
</div>

<?php if ('aphinity'==strtolower($studyName)):?>
    <script src='<?php echo Yii::app()->getAssetManager()->publish("$angularPath/scope/AphinityScope.js");?>'></script>
<?php endif; ?>

<script src='<?php echo Yii::app()->getAssetManager()->publish("$angularPath/NewSample.js");?>'></script>
<script src='<?php echo Yii::app()->getAssetManager()->publish("$angularPath/controller/NewSampleController.js");?>'></script>
<script src='<?php echo Yii::app()->getAssetManager()->publish("$angularPath/controller/SampleDetailsController.js");?>'></script>
<script src='<?php echo Yii::app()->getAssetManager()->publish("$angularPath/model/NewSampleModel.js");?>'></script>
<script src='<?php echo Yii::app()->getAssetManager()->publish("$angularPath/model/SampleFormModel.js");?>'></script>

