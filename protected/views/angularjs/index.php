<?php 
$assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('webroot.angularjs'));
?>

<script type="text/javascript" src="<?php echo $assetsUrl ;?>/DynamicTable/DynamicTable.js"> </script>
<script type="text/javascript" src="<?php echo $assetsUrl ;?>/DynamicTable/controller/DynamicTableController.js"> </script>
<script type="text/javascript" src="<?php echo $assetsUrl ;?>/DynamicTable/model/DynamicTableModel.js"> </script>

<script type="text/javascript">
function angularClock($scope)
{
    $scope.currentTime=new Date();
}
</script>


<div class="container">
    <div class="row">
        <div class="span6" ng-app="DynamicTable">
            <p ng-controller="angularClock">{{currentTime | date:'HH:mm'}}</p>
            <h2>Angular dynamic table</h2>
            <div ng-view> </div>
        </div>
    </div>
</div>

