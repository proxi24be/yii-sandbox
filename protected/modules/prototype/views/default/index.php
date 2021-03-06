<?php
/**
 * User: TRANN
 * Date: 6/4/13
 * Time: 1:26 PM
 */

$this->breadcrumbs=array(
    $this->module->id,
);

Yii::app()->clientScript->registerPackage('angularjs');
$angularPath = Yii::getPathOfAlias('webroot.angularjs.prototype');
$baseUrl = Yii::app()->baseUrl;
$publish = Yii::app()->getAssetManager()->publish($angularPath);
?>

<script type="text/javascript">

    var myConfig =
    {
        baseUrl : "<?php echo $baseUrl; ?>",
        angularUrl : "<?php echo $baseUrl; ?>",
        extendScope : function(currentScope,studyScope)
        {
            // This function is very useful to extend object.
            for (var element in studyScope)
                currentScope[element] = studyScope[element];
        }
    }

    var httpParam =
    {
        params : <?php echo $httpParam; ?>,
        // Data is redundant with params.data
        // however for better performance with push
        // it is better to not go through too many level ( httpParam.data vs httpParam.params.data)
        data : [],

        resetParams : function () {
            httpParam.params.data = [];
            httpParam.params.model = '';
            httpParam.data = [];
        },

        setModel : function (modelName) {
            httpParam.params.model = modelName;
        },

        setData : function (data) {
            httpParam.data = data;
        },

        flushParams : function () {
            httpParam.params.data = httpParam.data;
            // Create a temporary copy.
            var params = {};
            for (var p in httpParam.params)
                params[p] = httpParam.params[p];

            // Reset the current data otherwise it could be
            // troublesome to send the same data !
            httpParam.resetParams();

            return params ;
        },

        pushData : function (newData) {
            httpParam.data.push(newData);
        }
    }

</script>

<div id='ng-app' ng-app='SetupPrototype' class='ui-corner-all ui-widget-content ng-app:SetupPrototype'>
    <ul id='prototype_menu_setup' class="nav nav-tabs">
        <li><a href='study'>Study</a></li>
        <li><a href='visit'>Visit</a></li>
        <li><a href='sample'>Sample</a></li>
        <li><a href='form'>Form</a></li>
    </ul>

    <div ng-view><!--The content is dynamically replaced--></div>

</div>

<script src='<?php echo "$publish/SetupPrototype.js";?>'></script>
<script src='<?php echo "$publish/controller/StudyController.js";?>'></script>
<script src='<?php echo "$publish/controller/VisitController.js";?>'></script>
<script src='<?php echo "$publish/controller/SampleController.js";?>'></script>
<script src='<?php echo "$publish/controller/FormController.js";?>'></script>
<script src='<?php echo "$publish/model/GenericModel.js";?>'></script>
<script src='<?php echo "$publish/model/StudyVisitModel.js";?>'></script>
<script src='<?php echo "$publish/model/VisitSampleModel.js";?>'></script>

<script type='text/javascript'>

// Configure the top menu behavior.
var documentHref = document.location.href;
$('#prototype_menu_setup').delegate('a', 'click', function(e){
    e.preventDefault();
    $('#prototype_menu_setup').find('li').removeClass('active');
    $(this).parent().addClass('active');
    document.location = documentHref + '#/' + $(this).attr('href');
});

</script>
