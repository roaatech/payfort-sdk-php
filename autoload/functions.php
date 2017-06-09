<?php

if (!function_exists('json')) {

    function json(array $data) {
        header("Content-Type:application/json; charset=UTF-8");
        echo json_encode($data);
        die;
    }

}

if (!function_exists('dd')) {

    function dd() {
        foreach (func_get_args() as $value) {
            var_dump($value);
        }
        die;
    }

}