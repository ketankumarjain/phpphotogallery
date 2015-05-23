<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 4/28/2015
 * Time: 10:44 AM
 */

namespace utility;


class ParseArray {
    public static function doParse($object)
    {
        $seed=5;
        if("Photograph"==get_class($object)){
           $seed=11;
        }
        if("Comment"==get_class($object)){
            $seed=8;
        }

        return self::convert($object,$seed);
    }


    private static function convert($object,$seed)
    {
        $arraylist=(array)$object;//convert into array
        $arrayobj = array();
        foreach ($arraylist as $key => $value) {

            $subkey = substr(trim($key), $seed);
            $arrayobj[$key] = $value;
        }

        return $arrayobj;
    }
}
?>