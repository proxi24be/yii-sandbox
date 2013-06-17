<?php 

    $this->beginContent('//layouts/bootstrap'); 
    $baseUrl=Yii::app()->baseUrl;

?>

<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/defaultTheme/aristo/Aristo.css" />

<div class="container">
    <div class="row-fluid">
        <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
        'htmlOptions'=>array("class"=>"span12")
        )); ?><!-- breadcrumbs -->
    <?php endif?>
    </div>
</div>


<div id="content">
	<?php echo $content; ?>
</div><!-- content -->

<?php $this->endContent(); ?>