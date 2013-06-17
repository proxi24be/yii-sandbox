<?php

$this->breadcrumbs=array(
	'Update password',
);

?>

<style>
    
div.form p.tipReset
{
    background-color: #F3F3F3;
    border-color: #D4D4D4;
    text-align: justify;
    font-size:0.9em;
    padding:10px;
}

</style>

<div class="container form">
    <div class="row">
    
<?php 
        $form=$this->beginWidget('CActiveForm', array(
		'id'=>'updatePwdForm',
		'enableClientValidation'=>false,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
                'htmlOptions'=>array('class'=>'span8 offset2 form-horizontal')
            )); ?>

            <h3 class="title">Update password form</h3>
            <?php if ($status=='default'){?>
            <p class="tipReset"><span class="ui-icon ui-icon-info" style="float:left"></span><span style="margin-left:20px; display:block">You are seeing this page because you have requested a reset of password.  
                    In order to complete the reset password procedure you will need to complete the below fields.<br/>
                    Once your new password has been accepted you will be able to use it for log into the BrEAST website. </span> </p>
            <?php }?>

            <?php if ($status==="passwordExpired"){?>
                    <p class="tipReset"><span class="ui-icon ui-icon-info" style="float:left"></span><span style="margin-left:20px; display:block">You are seeing this page because your <b>password has expired</b>.  
                    Please complete the below form in order to renew your password.<br/>
                    Once your new password has been accepted you will be able to use it for log into the BrEAST website. </span> </p>
            <?php }?>

            <?php
                if (empty($message))
                    $class="";
                else
                {
                    if (strpos($message, "error")>0)
                            $class="alert alert_red";
                    else
                        $class="alert alert_green";
                }
                echo "<p class='$class'>$message</p>";
            ?>

            <p>Fields with <span class="required">*</span> are required.</p>
                
                <div class="control-group">
                    <?php 
                        echo $form->labelEx($model,'updatePassword',array("class"=>"control-label")) ; 
                        echo '<div class="controls">';
                        echo $form->passwordField($model,'updatePassword',array('size'=>'20'));
                        echo CHtml::tag("span",array("class"=>"help-block"),"<small>Your password must have at least 8 characters and terminate with 4 numbers</small>");
                        echo $form->error($model,'updatePassword',array("class"=>"alert alert-error myError"));
                        echo "</div>"
                    ?>
                </div>
            
                <div class="control-group">
                    <?php 
                        echo $form->labelEx($model,'updatePasswordConfirmed',array("class"=>"control-label"));
                        echo '<div class="controls">';
                        echo $form->passwordField($model,'updatePasswordConfirmed',array('size'=>'20'));
                        echo $form->error($model,'updatePasswordConfirmed',array("class"=>"alert alert-error myError"));
                        echo "</div>";
                    ?>
                </div>
            
                <?php echo $form->hiddenField($model,'userID');?>
            
            <div class="form-actions">
                    <a href="<?php echo Yii::app()->createUrl('site/updatePassword'); ?>" class="btn btn-link">Cancel</a>
                    <?php echo CHtml::submitButton('Proceed',array("class"=>"btn btn-primary")); ?>
            </div>
            
	<?php $this->endWidget(); ?>
        </div>
</div><!-- form -->