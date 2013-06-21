<?php
/**
 * User: TRANN
 * Date: 6/21/13
 * Time: 11:25 AM
 */

namespace application\components\helper;

class HttpJsonParam extends HttpParamAbstract {

    /**
     * @throws \Exception
     * @return boolean true if the conversion did complete successfully otherwise false.
     */
    public function convert()
    {
        if (isset($this->input))
        {
            $json = json_decode($this->input);

            if ($json === null)
                throw new \Exception ('json decode issue: are you sure this is a json object ?');

            if (!isset($json->model))
                throw new \Exception ('Constraint error: property model is null !');

            if (!isset($json->data))
                throw new \Exception ('Constraint error: property data is null !');

            // Fetch the model name.
            $this->model = $json->model;

            // Init the data array.
            if (is_array($json->data))
            {
                foreach ($json->data as $data)
                    $this->addData($data);
            }
            else
                $this->addData($json->data);

            return true;
        }
        else
            return false;
    }

    private function addData ($newData)
    {
        $temp = get_object_vars($newData);
        if (count($temp) > 0)
            $this->data[] = $temp ;
    }
}