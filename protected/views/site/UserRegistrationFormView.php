<?php

$this->breadcrumbs=array(
	'Registration',
);
?>

<style>
    
    .form-horizontal .control-label
    {
        width:190px;
    }
    
    dl.roleDescription dt
    {
        margin-top:10px;
    }

    
</style>

<script>

var userRegistration =
    {
        init : function()
        {
            userRegistration.checkStudy();
        },
        
        checkStudy :function()
        {
            if ($("#UserForm_STUDY_ID").find("option:selected").text().toLowerCase()=="aphinity")
            {
                var url='<?php echo CController::createUrl('site/dynamicRole'); ?>';
                var param=$("#UserForm_STUDY_ID").serialize();
                var defaultValue='<?php echo $model->ROLE_STUDY_ID; ?>';
                $.post(url,param,function(data)
                {
                   $("#UserForm_ROLE_STUDY_ID").html(data);
                }).complete(function(){
                    $("#UserForm_ROLE_STUDY_ID option").each(function()
                    {
                       if ($(this).val()==defaultValue) 
                           $(this).attr('selected',true);
                    });
                });
            };
        }
    }

$(document).ready(function(){
    userRegistration.init();
})

</script>

<div class="container">
    
    <div class="row-fluid">
        
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'UserRegistrationForm',
            'enableAjaxValidation'=>false,
            'htmlOptions'=>array("class"=>"span6 form-horizontal")
    )); ?>

    <h3>Account information</h3>
            <p class="note">Fields with <span class="required">*</span> are required.</p>
            <p class="muted"><strong>To register</strong>, please fill in this form below :</p>

            <div class="control-group">
                <?php 
                    echo $form->labelEx($model,'FIRSTNAME',array("class"=>"control-label")); 
                    echo '<div class="controls">';
                    echo $form->textField($model,'FIRSTNAME',array("class"=>""));
                    echo $form->error($model,'FIRSTNAME',array("class"=>"alert alert-error myError"));
                    echo '</div>';
                ?> 
           </div>

            <div class="control-group">
                <?php 
                    echo $form->labelEx($model,'LASTNAME',array("class"=>"control-label")); 
                    echo '<div class="controls">';
                    echo $form->textField($model,'LASTNAME',array("class"=>""));
                    echo $form->error($model,'LASTNAME',array("class"=>"alert alert-error myError"));
                    echo '</div>';
                ?> 
           </div>

            <div class="control-group">
                <?php 
                    echo $form->labelEx($model,'EMAIL_ADDRESS',array("class"=>"control-label")); 
                    echo '<div class="controls">';
                    echo $form->textField($model,'EMAIL_ADDRESS',array("class"=>""));
                    echo CHtml::tag("span",array("class"=>"help-block"),"<small>So that we can verify your identity, and keep you updated</small>");
                    echo $form->error($model,'EMAIL_ADDRESS',array("class"=>"alert alert-error myError"));
                    echo '</div>';
                ?> 
           </div>

            <div class="control-group">
                <?php 
                    echo $form->labelEx($model,'EMAIL_ADDRESS_CONFIRMED',array("class"=>"control-label")); 
                    echo '<div class="controls">';
                    echo $form->textField($model,'EMAIL_ADDRESS_CONFIRMED',array("class"=>""));
                    echo $form->error($model,'EMAIL_ADDRESS_CONFIRMED',array("class"=>"alert alert-error myError"));
                    echo '</div>';
                ?> 
           </div>
            <hr/>

            <div class="control-group">
                <?php 
                    echo $form->labelEx($model,'STUDY_ID',array("class"=>"control-label")); 
                    echo '<div class="controls">';
                    echo $form->dropDownList($model,'STUDY_ID',MyUtils::addEmpty($studies),array(
                    'ajax' => array (
                    'type' => 'POST',
                    'url' =>CController::createUrl('site/dynamicRole'),
                    'update' =>'#UserForm_ROLE_STUDY_ID',
                    ),
                ));
                    echo $form->error($model,'STUDY_ID',array("class"=>"alert alert-error myError"));
                    echo '</div>';
                ?> 
           </div>

            <div class="control-group">
                <?php 
                    echo $form->labelEx($model,'ROLE_STUDY_ID',array("class"=>"control-label")); 
                    echo '<div class="controls">';
                    echo $form->dropDownList($model,'ROLE_STUDY_ID',array());
                    echo CHtml::tag("span",array("class"=>"help-block"),"<small>Please refer to the table beside</small>");
                    echo $form->error($model,'ROLE_STUDY_ID',array("class"=>"alert alert-error myError"));
                    echo '</div>';
                ?> 
           </div>

              <div class="control-group">
                <?php 
                    echo $form->labelEx($model,'COUNTRY',array("class"=>"control-label")); 
                    echo '<div class="controls">';
                    echo $form->dropDownList($model,'COUNTRY',MyUtils::addEmpty($countries));
                    echo $form->error($model,'COUNTRY',array("class"=>"alert alert-error myError"));
                    echo '</div>';
                ?> 
              </div>  

              <div class="control-group">
                <?php 
                    echo $form->labelEx($model,'CENTRE',array("class"=>"control-label")); 
                    echo '<div class="controls">';
                    echo $form->textField($model,'CENTRE');
                    echo CHtml::tag("span",array("class"=>"help-block"),"<small>Not applicable for monitors/CRA</small>");
                    echo $form->error($model,'CENTRE',array("class"=>"alert alert-error myError"));
                    echo '</div>';
                ?> 
              </div>
            <hr/>

            <div class="control-group">
                <?php 
                    echo $form->labelEx($model,'PASSWORD',array("class"=>"control-label")); 
                    echo '<div class="controls">';
                    echo $form->textField($model,'PASSWORD');
                    echo CHtml::tag("span",array("class"=>"help-block"),"<small>Your password must be at least 8 digits long and terminate with 4 numbers (ex: abcd1234)</small>");
                    echo $form->error($model,'PASSWORD',array("class"=>"alert alert-error myError"));
                    echo '</div>';
                ?> 
              </div>

            <div class="control-group">
                <?php 
                    echo $form->labelEx($model,'PASSWORD_CONFIRMED',array("class"=>"control-label")); 
                    echo '<div class="controls">';
                    echo $form->textField($model,'PASSWORD_CONFIRMED');
                    echo $form->error($model,'PASSWORD_CONFIRMED',array("class"=>"alert alert-error myError"));
                    echo '</div>';
                ?> 
              </div>
            
            <div class="form-actions">
                    <a href="<?php echo Yii::app()->createUrl('site/registration'); ?>" class="btn btn-link">Cancel</a>
                    <?php echo CHtml::submitButton('Register',array("class"=>"btn btn-primary")); ?>
            </div>

    <?php $this->endWidget(); ?>

    <div class="span5 well">
            <h3>Role descriptions</h3>
            <dl class="roleDescription">
                <dt>Country coordinator (or CSM)</dt>
                <dd>A country coordinator is responsible for the monitoring team in one country (or region). He or she is working with the sponsor (or sub-contracted CRO). 
                                    He or she is overseeing the monitoring activities within the country/region.</dd>
                <dt>Laboratory contact</dt>
                <dd>A laboratory contact is a person working in or in close collaboration with the pathology laboratory at the site. 
                            This role can include (but is not limited to) sample collection, handding, storage, shipping and tracking.</dd>

                <dt>Monitor</dt>
                <dd>The main function of a monitor or clinical research associate (CRA) is to monitor the clinical trial. 
                            He or she may work directly with the sponsor, for a Contract Research Organization (CRO) or for an (academic) research organization. 
                            He or she ensures compliance with the protocol, checks site activities, makes on-site visits, reviews Case Report Forms (CRFs), 
                            performs Source Document Verification (SDV) and communicates with investigators.</dd>

                <dt>Principal investigator</dt>
                <dd>The principal investigator has absolute responsibility for the overall conduct of the trial in a site, 
                            including but not limited to medical, financial, regulatory compliance, translational sample collection and tracking, 
                            electronic data submission (eCRF) and administrative aspects.</dd>

                <dt>Study coordinator</dt>
                <dd>A study coordinator is responsible for conducting the clinical trial at the site, 
                            in compliance with good clinical practice (GCP), under the auspices of the Principal Investigator. 
                            This role can include (but is not limited to) informed consent collection, recruitment, patient care, 
                            ensuring protocol compliance, regulatory compliance, translational sample collection and tracking, electronic data submission (eCRF), 
                            and administrative aspects. This job profile is also called 'research nurse'.</dd>
                <dt>Sub-investigator</dt>
                <dd>A sub-investigator is a researcher in a clinical trial or clinical study. It's a member of the medical clinical trial team designated 
                            and supervised by the principal investigator at a trial site to perform critical trial-related procedures and/or to make important trial-related decisions 
                            and who has the authority to sign Case Report Forms (e.g., associates, residents, research fellows).</dd>
            </dl>
    </div>    
        
    </div> <!-- end row-fluid-->
    
</div>




