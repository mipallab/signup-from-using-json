<?php

/**
 * massage 
 */

function msg($msg, $type = "danger")
{
    return "<div class=\"alert alert-{$type} alert-dismissible fade show\" role=\"alert\"><strong>{$msg}</strong><button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button></div>";
}


/**
 * field empty error
 */

function fieldErr($field_val, $type = "danger")
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($field_val)) {
            return  "border-{$type} offset";
        }
    }
}


/*
* Field Value
*/


function old($oldField)
{
    return $_POST[$oldField] ?? '';
}
