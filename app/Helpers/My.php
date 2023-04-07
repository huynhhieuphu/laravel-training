<?php

function isUpperCase($value, $message, $fail) {
    if($value !== mb_strtoupper($value)) {
        $fail($message);
    }
    return true;
}
