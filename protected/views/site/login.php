<style>
    
    input.sizeInput
    {
        width:20em; /*merci IE*/
    }
    
    div.myError
    {
        margin-top:5px;
        width:200px;
    }
    
</style>

<?php 
$this->breadcrumbs=array(
	'login details',
);
?>

<div class="container">
    
    <div class="row-fluid">
        <div class="span8 offset2">
        <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'login-form',
                    'enableClientValidation'=>false,
                    'clientOptions'=>array('validateOnSubmit'=>true),
                    'htmlOptions'=>array("class"=>"form-horizontal"),
                    'action'=> Yii::app()->createUrl('site/checkLogin')
            )); ?>

        <legend>Login information</legend>
                <p class="note">Fields with <span class="required">*</span> are required.</p>
                <div class="control-group">
                    <?php 
                        echo $form->labelEx($model,'username',array("class"=>"control-label")); 
                        echo '<div class="controls">';
                        echo $form->textField($model,'username',array("class"=>"sizeInput"));
                        echo $form->error($model,'username',array("class"=>"alert alert-error myError"));
                        echo '</div>';
                    ?> 
                </div>

                <div class="control-group">
                    <?php
                            echo $form->labelEx($model,'password', array("class"=>"control-label"));
                            echo '<div class="controls">';
                            echo $form->passwordField($model,'password',array("class"=>"sizeInput"));
                            echo CHtml::tag("span",array("class"=>"help-block"),"the password is case <b>sen</b>sitive");
                            echo $form->error($model,'password',array("class"=>"alert alert-error myError"));
                            echo '</div>';
                        ?>
                </div>

                <div class="form-actions">
                    <a href="<?php echo Yii::app()->createUrl('site/login'); ?>" class="btn btn-link">Cancel</a>
                    <?php echo CHtml::submitButton('login',array("class"=>"btn btn-primary")); ?>
                </div>

        <?php $this->endWidget(); ?>
        </div>
        
    </div>
    
    
</div>


