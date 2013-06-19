<?php
/**
 * User: TRANN
 * Date: 6/18/13
 * Time: 3:15 PM
 */

use \application\components\helper as helper;

/**
 * RelationBehavior will automatically create a record in the "relation table".
 *
 * The action is triggered on afterSave event (see below).
 *
 * Therefore use that behavior if you are sure this is what you want. !!!
 *
 * Otherwise a validation error could rise up on the "relation table" because missing parameter.
 * Despite the record in the owner table has been created succesfully !!!
 *
 * You may specify an active record model to use this behavior like so:
 * !!! Do not forget to merge the array if there is already a behavior defined for the model !!!
 *
 * <pre>
 *
 * $newBehavior = array(
 *          'RelationBehavior' => array(
 *          'class' => 'ext.behaviors.RelationBehavior',
 *          'model' => 'ModelName',
 *          'attributes' => array('attribute_pk' => 'attribute_fk', 'attribute' => 'attribute_fk')
 *           )
 *       );
 *
 * </pre>
 *
 * The {@link model} is by default it is not set so you have to configure it.
 * The {@link attributes} is a map the key and the value respectively is used for the mapping.
 */

class RelationBehavior extends \CActiveRecordBehavior {

    // The is the model used for the creation of the relation.
    public $model ;
    // $attributes is a map
    // the key is the attribute of the activerecord that we want to save
    // the value is the attribute of the current activerecord
    public $attributes = array();

    // !!! if the function afterSave is declared as protected it will not be triggered.
    public function afterSave($event)
    {
        // we retrieve an instance of the model used to store the relation.
        $relationModel = helper\AdmCRUDSimpleFactory::getInstance($this->model);
        foreach ($this->attributes as $key => $value)
            $relationModel->$value = $this->getOwner()->$key;

        if (!$relationModel->save())
            throw new \Exception(print_r($relationModel->getErrors(), true));

        return parent::afterSave($event);
    }

}