<?php 
$this->breadcrumbs=array(
	'Reset password form',
);
?>

<div class="container">
    <div class="row">
        
        <p class="well span8 offset2">
            <span class="ui-icon ui-icon-info" style="float:left"></span><span style="margin-left:20px; display:block">If you've lost your password or forgot it, you can use this form to reset it. 
                Enter your username in the field below. 
        The username is case <b>in</b>sensitive.<br/>Once you have submitted the form, you will receive an email containing a link that you must click for further instruction.</span> </p>
        
        <div class="span8 offset2">
            
            <?php $class= empty($status) ? "":"alert alert_orange";?>
            <p class="<?php echo $class;?>"><?php echo $status;?></p>
            <?php 
            $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'resetForm',
                            'enableClientValidation'=>false,
                            'clientOptions'=>array(
                                    'validateOnSubmit'=>true,
                            ),
                            'htmlOptions'=>array("class"=>"form-horizontal")
                    )); ?>

                <h3>Reset password form</h3>
                <p class="note">Fields with <span class="required">*</span> are required.</p>
                
                <div class="control-group">
                <?php 
                    echo $form->labelEx($model,'usernameOrEmail',array("class"=>"control-label")); 
                    echo '<div class="controls">';
                    echo $form->textField($model,'usernameOrEmail');
                    echo $form->error($model,'usernameOrEmail',array("class"=>"alert alert-error myError"));
                    echo '</div>';
                ?> 
              </div>
                
                <hr/>
                <?php if(CCaptcha::checkRequirements()):?>
                    <div class="control-group">
                    <?php 
                            echo Chtml::label("Verify code","", array("class"=>"control-label")); 
                            echo '<div class="controls">';
//                            echo $this->widget('CCaptcha');
                            echo $form->error($model,'usernameOrEmail',array("class"=>"alert alert-error myError"));
                            echo '</div>';
                    ?> 
                    </div>

                    <div class="control-group">
                    <?php 
                            echo Chtml::label("Enter verify code","", array("class"=>"control-label")); 
                            echo '<div class="controls">';
                            echo $form->textField($model,'verifyCode');
                            echo CHtml::tag("span",array("class"=>"help-block"),"Please enter the letters as they are shown in the image above.
                            <br/>Letters are not case-sensitive.");
                            echo $form->error($model,'verifyCode',array("class"=>"alert alert-error myError"));
                            echo '</div>';
                    ?> 
                    </div>
                <?php endif; ?>
                
                <hr/>
                
                <div class="form-actions">
                    <a href="<?php echo Yii::app()->createUrl('site/resetPassword'); ?>" class="btn btn-link">Cancel</a>
                    <?php echo CHtml::submitButton('Proceed',array("class"=>"btn btn-primary")); ?>
                </div>
                
            <?php $this->endWidget(); ?>
            
        </div>
        
    </div>
</div>



