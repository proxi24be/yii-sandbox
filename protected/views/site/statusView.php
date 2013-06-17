<?php

$this->pageTitle="Status request";
$this->breadcrumbs=array(
	'Status request',
);

?>

<style>
    
    div.status p
    {
        
    }
    
    
</style>

<div class="status">

    <?php if (strtolower($status)==='success') 
    {
    ?>
    <p class="tipReset"><span class="ui-icon ui-icon-info" style="float:left"></span>
        <span style="margin-left:20px; display:block"><b>Thank you ! Your request has been successfully submitted</b></span> </p>
    <?php
    }
    ?>
    
    <?php if (strtolower($status)==='failed') 
    {
    ?>
        <p class="tipReset"><span class="ui-icon ui-icon-info" style="float:left"></span>
        <span style="margin-left:20px; display:block">This is very embarrassing it seems that <b>an issue did occur during your request</b>.<br/><br/>
            If that issue still remains could you please contact the BrEAST technical ?<br/><br/><br/>
            Please accept our apologies for this inconvenience.</span> </p>
    <?php
    }
    ?>
        
    <?php if (strtolower($status)==='registration') 
    {
    ?>
        <p class="tipReset"><span class="ui-icon ui-icon-info" style="float:left"></span>
        <span style="margin-left:20px; display:block"><b>Thank you for your registration !</b><br/><br/>
            You will receive an email , within the next minutes, for further instructions.<br/><br/>
            Please feel free to contact us if you do not see that email.</span> </p>
        
    <?php
    }
    ?>
            
    <?php if (strtolower($status)==='nomatchingemail') 
    {
    ?>
        <p class="tipReset"><span class="ui-icon ui-icon-info" style="float:left"></span>
        <span style="margin-left:20px; display:block">
           Dear User, <br/></br>
           We are very sorry but <b>your email address does not seem to be reported in our contact list</b> therefore your registration can not go further.<br/><br/>
           Please contact breast.technical@bordet.be if you have any questions.<br/><br/>
           Thank you for your understanding.
        </span> </p>
    <?php
    }
    ?>
            
            
    <?php if (strtolower($status)==='nomatchingrole') 
    {
    ?>
        <p class="tipReset"><span class="ui-icon ui-icon-info" style="float:left"></span>
        <span style="margin-left:20px; display:block">
            Dear User, <br/></br>
            <b>The selected role does not match the one granted by the sponsor</b>.  Therefore the registration can not go further.<br/><br/>
           Please contact breast.technical@bordet.be if you have any questions.<br/><br/>
           Thank you for your understanding.
        </span> </p>
        
    <?php
    }
    ?>
            
   <?php if (strtolower($status)==='accountalreadyexist') 
    {
    ?>
        <p class="tipReset"><span class="ui-icon ui-icon-info" style="float:left"></span>
        <span style="margin-left:20px; display:block">
            Dear User, <br/></br>
           You have already a BrEAST user account therefore the registration can not go further<br/><br/>
           Please contact breast.technical@bordet.be if you have any questions.<br/><br/>
           Thank you for your understanding.
        </span> </p>
        
    <?php
    }
    ?>

</div>