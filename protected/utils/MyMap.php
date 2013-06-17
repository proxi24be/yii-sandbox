<?php
/**
 * User: TRANN
 * Date: 3/20/13
 * Time: 4:20 PM
 */

class MyMap
{
    /**
     * @param $keySearch
     * @param array $map
     * @return mixed if key is found then return the value associated to the key, otherwise false
     */
    public static function elementExist($keySearch, array $map)
    {
        $found = false;
        if (count($map) > 0) {
            foreach ($map as $key => $value)
            {
                if ($key === $keySearch)
                    $found = $value;

                else {
                    if (is_array($value))
                        $found = MyMap::elementExist($keySearch, $value);
                }

                if ($found !== false)
                    break;
            }
        }
        return $found;
    }

    /**
     * @param array $keys
     * @param array $search A map
     * @return array
     */
    public static function fetchAttributes(array $keys, array $search)
    {
        $mapToReturn = array();
        foreach ($keys as $key)
        {
            $found = MyMap::elementExist($key, $search);
            if ($found !== false)
                $mapToReturn[$key] = $found;
        }
        return $mapToReturn;
    }
}