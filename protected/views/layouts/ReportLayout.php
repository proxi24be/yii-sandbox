<?php 
    
    $this->beginContent('//layouts/bootstrap');
    $baseUrl=Yii::app()->baseUrl;

?>

<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/defaultTheme/aristo/Aristo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/defaultTheme/theme_base.css" />

<div class="container">
    <div class="row">
        <?php 
        $this->widget('zii.widgets.CMenu', array(
                'items'=>array(
        array('label'=>'Order report', 'url'=>array("/reports/default/index")),
        array('label'=>'View report', 'url'=>array('/reports/default/reviewreport'))
        ),"htmlOptions"=>array("class"=>"span12 nav nav-tabs")
        ));
    ?>
    </div>
</div>

<div class="container">
    <div class="row">
        
        <?php if(isset($this->breadcrumbs)):
            $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,"htmlOptions"=>array("class"=>"span12"))); 
            endif;
        ?><!-- breadcrumbs -->
        
    </div>
</div>

<div id="content">
    <?php
	 echo $content; 
     ?>
</div><!-- content -->

<?php $this->endContent(); ?>