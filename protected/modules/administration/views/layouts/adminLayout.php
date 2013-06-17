<?php

$this->beginContent('//layouts/bootstrap');
$baseUrl=Yii::app()->baseUrl;

?>

<link href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/defaultTheme/aristo/Aristo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/defaultTheme/theme_base.css" />
<script src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>


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