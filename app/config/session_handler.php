<?php

if (!isset($_SESSION)) {
    session_start();

    if(!empty($_SESSION['username'])){
        $timeout = 6000;
        $elapsed = time() - $_SESSION['start'];
        if ($elapsed >= $timeout) {
            session_destroy();
            echo '<script type="text/javascript">alert("Session expired."); window.location = "' . BASE_URL . '/Login/index"</script>';
        }
    }
    else{
        header('location:' . BASE_URL . '/Login/index');
    }
}