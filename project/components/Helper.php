<?php

class Helper extends CComponent{

    public static function cutStr($str, $len){
        if(strlen($str) < $len){
            return $str;
        }
        return mb_substr($str, 0, $len, 'utf-8').'...';
    }

    public static function is_dir_empty($dir) {
        if (!is_readable($dir)) return NULL;
        return (count(scandir($dir)) == 2);
    }
}