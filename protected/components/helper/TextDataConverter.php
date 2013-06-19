<?php
/**
 * User: TRANN
 * Date: 6/19/13
 * Time: 12:37 PM
 */

namespace application\components\helper;

class TextDataConverter extends DataConverterAbstract {

    /**
     * @throws \Exception
     * @return boolean true if the conversion did complete successfully otherwise false.
     */
    protected function convert()
    {
        // It should be an array.
        if (!array_key_exists('model', $this->input))
            throw new \Exception ('The attribute model does not exist.');

        $this->modelName = $this->input['model'];
    }
}