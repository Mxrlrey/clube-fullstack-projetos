<?php

function validate(array $fields) {
    $validate = [];

    foreach ($fields as $field => $type) {
        $request = request();
        switch ($type) {
            case 's':
                $validate[$field] = filter_var($request[$field], FILTER_SANITIZE_STRING);
                break;
        }

        switch ($type) {
            case 'i':
                $validate[$field] = filter_var($request[$field], FILTER_SANITIZE_NUMBER_INT);
                break;
        }

        switch ($type) {
            case 'e':
                $validate[$field] = filter_var($request[$field], FILTER_SANITIZE_EMAIL);
                break;
        }

    }

    return (object) $validate;

}

function isEmpty(){

    $request = request();
    $empty = false;

    foreach ($request as $key => $value){
        if(empty($request[$key])){
        $empty = true;
        }
    }

    return $empty;
}

