<?php
/**
 * User: TRANN
 * Date: 6/4/13
 * Time: 1:26 PM
 */

$this->breadcrumbs = array(
    $this->module->id,
);

Yii::app()->clientScript->registerPackage('angularjs');
$angularPath = Yii::getPathOfAlias('webroot.angularjs.prototype');
$baseUrl = Yii::app()->baseUrl;
$publish = Yii::app()->getAssetManager()->publish($angularPath);

?>

<div class='alert alert-info'>
    Welcome to the metadata interface.
</div>