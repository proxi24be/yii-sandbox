<ul>

<li><a href="<?php echo Yii::app()->createUrl(''); ?>">BrEAST Website</a></li>

<?php 
	
	if ($this->applications != null)
	{
		foreach ($this->applications as $app)
			echo "<li><a href='#'>$app->APP_NAME</a></li>";	
	}

?>

<li><a href="<?php echo Yii::app()->createUrl('site/logout'); ?>">Log out</a></li>

</ul>