<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午8:07
 */


if (!function_exists('dd')) {

    function dd($arr)
    {
        echo "<pre>";
        var_dump($arr);
        echo "</pre>";
        exit;
    }
}
if (!function_exists('ed')) {

    function ed($arr)
    {
        echo "<pre>";
       var_export($arr);
       echo "</pre>";
        exit;
    }
}

if (!function_exists('d')) {

    function d($arr)
    {
        echo "<pre>";
        var_dump($arr);
        echo "</pre>";
    }
}
if (!function_exists('e')) {

    function e($arr)
    {
        echo "<pre>";
        var_export($arr);
        echo "</pre>";
    }
}