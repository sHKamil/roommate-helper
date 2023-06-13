<?php

namespace app\Services;

class ModelHandler
{

    public static function prepareFillableForSQL($fillable)
    {
        $rows_names = '';
        foreach ($fillable as $row) {
            $rows_names .= ', '.$row.'';
        }
        return substr($rows_names, 1);
    }

    public static function preparePlaceholders($fillable)
    {
        $rows_names = ':';
        foreach ($fillable as $row) {
            $rows_names .= ', :'.$row.'';
        }
        return substr($rows_names, 3);
    }

    public static function createDictionaryParams($keys, $values)
    {
        $dictionary = [];
        try {
            if(count($keys) === count($values)) {
                foreach ($keys as $i => $key) {
                    $dictionary[$key] = $values[$i];
                }
            } else {
                throw new \Exception("Implemented array of keys have different number of elements than values array.");
            }
        } catch (\Exception $e) {
            die("Error: " . $e->getMessage());
        }
        return $dictionary;
    }
}
