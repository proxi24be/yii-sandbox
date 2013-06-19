<?php
/**
 * User: TRANN
 * Date: 6/18/13
 * Time: 4:55 PM
 */

namespace application\components\helper;

class JsonDataConverter extends DataConverterAbstract {

    /**
     * @throws \Exception
     * @return boolean true if the conversion did complete successfully otherwise false.
     */
    public function convert()
    {
        try
        {
            $json = json_decode($this->input);
            if ($json === null)
                throw new \Exception ('json decode issue: are you sure this is a json object ?');

            if (!isset($json->model))
                throw new \Exception ('Constraint error: property model is null !');

            if (!isset($json->data))
                throw new \Exception ('Constraint error: property data is null !');

            // Fetch the model name.
            $this->modelName = $json->model;

            // Init the data array.
            if (is_array($json->data))
            {
                foreach ($json->data as $data)
                    $this->addData($data, 'There is one element in the array that is not an object.');
            }
            else
                $this->addData($json->data, 'property data is not an object !');

            return true;
        }
        catch (\Exception $e)
        {
            $this->errorMessage = $e->getMessage();
            return false;
        }
    }

    private function addData ($newData, $errorMessage)
    {
        if (!is_object($newData))
            throw new \Exception ($errorMessage);

        $temp = get_object_vars($newData);
        if (count($temp) > 0)
            $this->data[] = $temp ;
    }
}