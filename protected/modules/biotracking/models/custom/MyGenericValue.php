<?php

class MyGenericValue
{
    public static function filteredByGenericValue(array $rows, array $filter, $propertyName)
    {
        $textField = "TEXT";

        $filteredModel = array();
        foreach ($rows as $row) {
            if (in_array($row[$textField], $filter))
                $filteredModel[] = array($propertyName => $row[$textField]);
        }
        return $filteredModel;
    }
}
