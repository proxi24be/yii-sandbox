<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<div class="container">
    
    <div class="row">
        
        <div class="span12">
            
            <h4>Error <?php echo $code; ?></h4>

            <div class="error">
            <?php echo CHtml::encode($message); ?>
            </div>
        </div>
        
    </div>
    
</div>
