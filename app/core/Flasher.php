<?php

session_start();

class Flasher {

    public static function setFlash($message, $message_type) {

        $_SESSION['flash'] = [
            "message" => $message,
            "message_type" => $message_type
        ];

    }

    public static function flash() {
        if(isset($_SESSION['flash'])) {
            echo
                "<div class='alert alert-" . $_SESSION['flash']['message_type'] . " alert-dismissible fade show' role='alert'>
                    <h5 class='mb-0 alert-heading'>
                        ". $_SESSION['flash']['message'] ."
                    </h5>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <i class='fa fa-times'></i>
                    </button>
                </div>"
            ;
            unset($_SESSION['flash']);
        }
    }

}