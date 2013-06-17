<?php
/**
 * User: TRANN
 * Date: 3/31/13
 * Time: 10:45 PM
 */

class MyJson {

    public static function convertToMap($jsonObject)
    {

        $map = array();
        $arrays = get_object_vars($jsonObject);
        foreach ($arrays as $key => $value)
        {
            if ($value instanceof stdClass)
            {
                $properties = get_object_vars($value);
                $map[$key] = $properties;
            }
            else
                $map[$key] = $value;
        }
        return $map;
    }

}