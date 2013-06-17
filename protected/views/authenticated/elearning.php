<?php 

$this->breadcrumbs=array(
	'eLearning status',
);

?>

<?php 

    $status = strtolower($status);
    if ($status!='success' && $status!='error')
            $status='none';
?>

<div class="grid_12">
    
<?php if ($status =='success') {?>

<h3 class="title">Congratulation</h3>

<p>You have successfully passed the e-learning assessment.</p>	

<p>The RDC Website link is now available in your BrEAST tools page.</p>

<?php    } ?>

<?php  if ($status =='error') {  ?>

<p>Dear User,</p>
<p>I am very sorry an error has occured your training assessment might not be correctly saved.</p>
<p>Please contact the BrEAST technical if the issue still remains</p>
        
<?php    } ?>

<?php  if ($status =='none') {  ?>

<p>Dear User,</p>
<p>Please contact the BrEAST technical if you are not here by accident.</p>
        
<?php    } ?>


</div>
