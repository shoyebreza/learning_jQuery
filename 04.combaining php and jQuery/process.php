<?php

$response = 'dear'.$_POST['fullname'].',your information hasbeen saved.';

$response.= 'you entered the fllowing information';

$response.= '</br>';

$response.= '<strong>E-mail :</strong>'.$_POST['email'];

$response.= '</br>';

$response.= '<strong>Gender :</strong>'.$_POST['gender'];

$response.='</br>';

$response.= '<strong>Country :</strong>'.$_POST['country'];

header('content-type: text/html');

echo $response;



?>