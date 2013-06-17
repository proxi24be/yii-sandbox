<?php
    $this->breadcrumbs=array(
            'Registration completed',
    );
?>

<style>
    
div.form fieldset label 
{
    padding-top:0;
    padding-bottom:0;
}

div.form fieldset, div.form p
{
    width:700px;
    margin-left:auto;
    margin-right: auto;
}

div.form p.tipReset
{
    background-color: #F3F3F3;
    border-color: #D4D4D4;
    text-align: justify;
    font-size:0.9em;
    padding:10px;
}

div.form fieldset li
{
    height:30px;
    font-size:1.1em;
}

div.form fieldset label
{
    font-size:1.1em;
}

</style>

<div class="form" >

    <p class="tipReset"><span class="ui-icon ui-icon-info" style="float:left"></span><span style="margin-left:20px; display:block">Thank you, your registration is now completed. 
            Please find below your account details</span> </p>

<fieldset>
    <h3>Account details</h3>
    <ul>
        <li><label>First name:</label><?php echo $user->FIRSTNAME ;?></li>
        <li><label>Last name:</label><?php echo $user->LASTNAME ;?></li>
        <li><label>Email:</label><?php echo $user->EMAIL_ADDRESS ;?></li>
        <li><label>Role:</label><?php echo $user->ROLE_DESCRIPTION ;?></li>
        <li><label>Study:</label><?php echo $user->STUDY_DESCRIPTION ;?></li>
        <li><label>Username:</label><?php echo $user->USERNAME ;?></li>
    </ul>
</fieldset>
    
</div><!-- form -->
