<?php
/*------------------------------------ Alert Box--------------------------------*/

function alertBox($status, $title, $icon, $path)
{
    $_SESSION['status'] = $status;
    $_SESSION['title'] = $title;
    $_SESSION['icon'] = $icon;
    echo $path;
    return true;
}

function passAlertBox($status, $title, $icon, $dangerMode, $path)
{
    $_SESSION['status'] = $status;
    $_SESSION['title'] = $title;
    $_SESSION['icon'] = $icon;
    $_SESSION['dangerMode'] = $dangerMode;
    echo $path;
    return true;
}

/*--------------------------- FIle size and extension ---------------------------*/

function checkExtensionAndSize($ext_name, $file_size)
{
    $allowed_extensions = array("jpeg", "jpg", "png");
    $max_file_size = 5242880; // 5 MB in bytes
    $error = '';
    if (!in_array($ext_name, $allowed_extensions)) {
        $error = "Please upload an image with a jpg, jpeg, or png extension.";
    } else if ($file_size > $max_file_size) {
        $error = 'File size cannot be more than 5 MB.';
    }
    return $error;
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
