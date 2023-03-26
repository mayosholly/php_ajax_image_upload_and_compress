<?php

class Util
{
    // input sanitization

    public function testInput($data)
    {
        //remove all white spaces
        $data = trim($data);
        // remove all slashes
        $data = stripcslashes($data);
        // convert special char to html input
        $data = htmlspecialchars($data);
        // remove html tags
        $data = strip_tags($data);

        return $data;
    }

    // method to displaying success and error messages
    public function showMessage($type, $message)
    {
        return '<div class="alert alert-' . $type . ' alert-dismissible ">
            <strong>' . $message . '</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="close"></button></div>';
    }
}
