<?php 

if($_GET['what'] == 'good')
{
    $names = array("john smith ","homeless ","molles "," mugli","bittu");
    echo getHTML($names);
}

elseif($_GET['what'] == 'bad')
{
    $names = array("nut ","boltu","daroga ","boro babu"," mittir anti"," vablai");
    echo getHTML($names);
}

function getHTML($names){
    $strResult = '<ul>';

    for($i=0; $i<count($names); $i++)
    {
        $strResult.= '<li>'.$names[$i].'<li>';
    }

    $strResult.= '<ul>';

    return $strResult;
}

?>