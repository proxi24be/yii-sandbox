<?php
$baseUrl=Yii::app()->baseUrl;
$this->beginContent('//layouts/bootstrap');
?>
    <div class="container" style='margin-bottom: 20px;'>
        <div class="row">
            <?php if(isset($this->breadcrumbs)):?>
                <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
        'htmlOptions'=>array("class"=>"span12")
        )); ?><!-- breadcrumbs -->
            <?php endif?>
        </div>
    </div>

    <div id="content" class="container">
        <div class="row">
            <div class="span3">
                <!--menu admin-->
                <div id="userMenu">
                    <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'items'=>array(
                            array('label'=>'BrEAST administration', "itemOptions"=>array("class"=>"nav-header")),
                            array('label'=>'Configure internal/external account', 'url'=>array('#')),
                            array('label'=>'Add/update BrEAST news', 'url'=>array('#')),
                            array("itemOptions"=>array("class"=>"divider")),

                            array('label'=>'Biotracking administration', "itemOptions"=>array("class"=>"nav-header")),
                            array("itemOptions"=>array("class"=>"divider")),

                            array('label'=>'Prototype trials', "itemOptions"=>array("class"=>"nav-header")),
                            array('label'=>'Define metadata', 'url'=>array('/prototype/default/metadata')),
                            array('label'=>'Set-up prototype', 'url'=>array('/prototype/default/index')),
                            array('label'=>'Export prototype', 'url'=>array('#')),

                        ),"htmlOptions"=>array("class"=>"nav nav-list well")));
                    ?>
                </div>
            </div>

            <div class="span9">
                <?php echo $content; ?>
            </div>
        </div>
    </div><!-- content -->

<?php $this->endContent(); ?>