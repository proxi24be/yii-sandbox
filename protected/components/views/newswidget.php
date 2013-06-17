<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bluenight
 * Date: 20/01/13
 * Time: 19:13
 */
?>

<?php foreach ($news as $new): ?>

    <h6><?php echo $new->DESCRIPTION ; ?></h6>
    <p class="muted published"><small><?php echo "published on " . date_format(new DateTime($new->LAST_UPDATED), 'd-m-Y');?></small></p>
    <p><a href="<?php echo Yii::app()->createAbsoluteUrl('news/show').'?id='.$new->ID;?>">Read more</a></p>

<?php endforeach; ?>


