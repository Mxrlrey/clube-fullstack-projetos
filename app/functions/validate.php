<?php

function validate(array $fields) {
    $validate = [];
    $request = request();

    foreach ($fields as $field => $type) {
        $value = isset($request[$field]) ? $request[$field] : null;

        switch ($type) {
            case 's':
                $validate[$field] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
                break;
            case 'i':
                $validate[$field] = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
                break;
            case 'e':
                $validate[$field] = filter_var($value, FILTER_SANITIZE_EMAIL);
                break;
            default:
                $validate[$field] = $value;
        }
    }

    return (object) $validate;
}

function isEmpty() {
    $request = request();
    foreach ($request as $value){
        if (empty($value)) {
            return true;
        }
    }
    return false;
}
