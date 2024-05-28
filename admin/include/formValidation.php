<?php

function is_valid_name($name)
{
    $pattern = '/^[a-zA-Z]+(([\' -][a-zA-Z ])?[a-zA-Z]*)*$/';
    return preg_match($pattern, $name);
}

// function is_valid_username($username) {
//     $pattern = '/^[a-zA-Z0-9_-]{3,16}$/';
//     return preg_match($pattern, $username);
// }

function is_valid_email($email)
{
    $email = trim($email);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true; // Valid email address
    } else {
        return false; // Invalid email address
    }
}

function is_valid_phone($phoneNumber)
{

    $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

    if (preg_match('/^(98|97|96)\d{8}$/', $phoneNumber) || preg_match('/^01\d{8}$/', $phoneNumber)) {
        return true;
    } else {
        return false;
    }
}

function is_valid_password($password)
{
    $min_length = 8;
    $uppercase_required = true;
    $lowercase_required = true;
    $number_required = true;
    $special_character_required = true;

    if (strlen($password) < $min_length) {
        return false;
    }

    // Check uppercase requirement
    if ($uppercase_required && !preg_match('/[A-Z]/', $password)) {
        return false;
    }

    // Check lowercase requirement
    if ($lowercase_required && !preg_match('/[a-z]/', $password)) {
        return false;
    }

    // Check number requirement
    if ($number_required && !preg_match('/[0-9]/', $password)) {
        return false;
    }

    // Check special character requirement
    if ($special_character_required && !preg_match('/[^a-zA-Z0-9]/', $password)) {
        return false;
    }

    return true;
}


function checkExtensionAndSize($ext_name, $file_size)
{
    $allowed_extensions = array("jpeg", "jpg", "png");
    $max_file_size = 5242880; // 5 MB in bytes
    $errors = "";

    if (!in_array($ext_name, $allowed_extensions)) {
        $errors = "Please upload with a jpg, jpeg, or png extension.";
    }

    if (empty($errors)) {
        if ($file_size > $max_file_size) {
            $errors = 'File size cannot be more than 5 MB.';
            return $errors;
        }
    } else {
        return $errors;
    }
}


function checkExtensionAndSizeFile($ext_name, $file_size)
{
    $allowed_extensions = array("pdf", "txt", "doc", "docx", "xls", "xlsx", "ppt", "pptx");
    $max_file_size = 10485760; // 10 MB in bytes
    $errors = "";

    if (!in_array($ext_name, $allowed_extensions)) {
        $errors = "Please upload with a jpg, jpeg, or png extension.";
    }

    if (empty($errors)) {
        if ($file_size > $max_file_size) {
            $errors = 'File size cannot be more than 10 MB.';
            return $errors;
        }
    } else {
        return $errors;
    }
}
