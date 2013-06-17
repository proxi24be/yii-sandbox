<?php

abstract class ServerReport
{
    private $params;
    private $reportForm;
    public function __construct($reportForm=null)
    {
        if ($reportForm !=null)
        {
            $this->params=array();
            $this->reportForm=$reportForm;
            $this->params["queueID"]=$this->reportForm->QUEUE_ID;
            $this->params["reportID"]=$this->reportForm->REPORT_ID;
            $this->params["fileExt"]=$this->reportForm->FORMAT;
            $this->params["exec_file"]=$this->reportForm->EXEC_FILE;
            $this->params["outFileName"]=$this->reportForm->FILENAME;
            $this->params["desFolder"]=$this->reportForm->DEST_PATH;
        }
    }
    
    public function getQueueID()
    {
        return $this->queueID;
    }
    
    public function createGenericParam()
    {
        return $this->params;
    }
    
    public function updateQueue($filePath)
    {
        $queue = Queue::model()->findByPk($this->params["queueID"]);
        if ($queue != null)
        {
            $queue->FILEPATH=$filePath;
            $queue->save();
        }
    }
    
    public function getReport($activeRecord)
    {
        $path=$activeRecord["FILEPATH"];
    }

    abstract protected function generateReport(array $params);
}

?>
