<?php

class ImportArrayIntoTable
{

    public function actionBatchAll(array $data, $table)
    {
        try
        {
            if (count($data) == 0)
                throw new Exception ("$table: array is empty");

            $keys = $this->getKeys(array_keys($data[0]));
            $values = $this->computeValues($keys);
            $sql = "insert into $table (" . implode(',', $keys) . ") values (:$values)";

            $connection = Yii::app()->db;
            $transaction = $connection->beginTransaction();
            $command = $connection->createCommand($sql);

            $cpt = 0;

            foreach ($data as $row)
            {
                foreach ($row as $key => $value)
                    $command->bindParam(":$key", str_replace("'", "''", $value));

                $cpt = $cpt + $command->execute();
            }

            $transaction->commit();
            echo "$table rows inserted : $cpt";
        }
        catch (Exception $e)
        {
            $transaction->rollBack();
            echo $e->getMessage();
        }
    }

    private function computeValues(array $keys)
    {
        return implode(",:", $keys);
    }

    private function getKeys(array $row)
    {
        $keys = array();
        foreach ($row as $key)
            $keys[] = $key;
        return $keys;
    }

    private function displayRow($row)
    {
        foreach ($row as $key => $value)
            echo "$key => $value |";
    }

}


class SetupTableCommand extends CConsoleCommand
{
    public function actionInitTables()
    {
        include_once ("SetupTable/lab2_received_files.php");
        $importArrayIntoTable = new ImportArrayIntoTable();
        $importArrayIntoTable->actionBatchAll($lab2_received_files, "RECEIVED_FILES");
    }
}
