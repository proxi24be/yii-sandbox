<?php
/**
 * User: TRANN
 * Date: 6/21/13
 * Time: 12:30 PM
 */

namespace application\components\helper;

/**
 * Class HttpFormParam
 * @package application\components\helper
 *
 * When parameters are submitted through get/post method through the FORM.
 * The enctype is application/x-www-form-urlencoded
 * With PHP the parameters are available directly either under $_GET or $_POST
 */

class HttpFormParam extends HttpParamAbstract {

    public function convert()
    {
        if (isset($this->input))
        {
            if (!is_array($this->input))
                throw new \Exception ('The input is not an array !');

            // It should be an array.
            if (!array_key_exists('model', $this->input))
                throw new \Exception ('The attribute model does not exist.');

            $this->model = $this->input['model'];
            unset($this->input['model']);
            $this->data = $this->input;
            return true;
        }
        else
            return false;
    }

}