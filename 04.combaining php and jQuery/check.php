<?php 

    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
    {
        echo 'yess request successfull!!';
    }else {
        echo 'this is not a ajax request. this page cannot access directly';
    }


?>