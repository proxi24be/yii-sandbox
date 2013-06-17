<?php

class MyException extends Exception
{
    private $sendException = true;

    public function __construct($message, $currentObject = null)
    {
        $this->message = $message;

        if (null != $currentObject) {
            $class = get_class($currentObject);
            $this->message = $this->message . "\nException raised on [$class].";
        }

        if ($this->sendException) {
            if (!error_log($this->message, 1, Yii::app()->params['adminEmail'])) {
                $this->message = $this->message . "\nImpossible to send the email to the admin. Is the sftp has been set-up ?";
            }
        }
    }
}
