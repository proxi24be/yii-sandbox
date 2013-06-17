<?php
$this->breadcrumbs=array(
	$this->module->id,"BrEAST"
);

$newsFeed = Yii::app()->createUrl("administration/breastfeed/index");
$breast=Yii::app()->createUrl("administration/breast/specialuserprivilege");
$breastInternal=Yii::app()->createUrl("administration/breast/accessDBOfInternalUsers");
?>

<div class="container">
    <div class="row">
        
        
    <ul class="span12">
        <li><a href="<?php echo $breast ; ?>">BrEAST administration</a></li>
        <li><a href="<?php echo $breastInternal ; ?>">BrEAST access of internal users</a></li>
        <li><a href="<?php echo $newsFeed ; ?>">NewsFeed administration</a></li>
    </ul>
        
    </div>
    
</div>

