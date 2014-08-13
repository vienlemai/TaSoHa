<?php

class Common {

    public static function randomPassword($len = 8) {
        $alphabet = 'abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $len; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public static function stringToInt($string) {
        return (int) (str_ireplace(' ', '', $string));
    }

    public static function IntToString($int) {
        $strrev = strrev($int);
        $arr = str_split($strrev, 3);
        $result = implode(' ', $arr);
        return (strrev($result));
    }

}

?>
