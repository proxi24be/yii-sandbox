<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bluenight
 * Date: 20/01/13
 * Time: 21:59
 */

$this->breadcrumbs=array(
    'News',
);

?>

<div class="container">
    <div class="row">

        <?php foreach ($news as $new): ?>

        <div class="span8">
        <h5><?php echo $new->DESCRIPTION; ?></h5>
        <p class="muted"><small><?php echo "published on ". date_format(new DateTime($new->LAST_UPDATED), 'd-m-Y');?></small></p>
            <!--   content html    -->
        <blockquote><?php echo $new->MESSAGE;?></blockquote>
        <hr>
        </div>

        <?php endforeach; ?>

    </div>

</div>



