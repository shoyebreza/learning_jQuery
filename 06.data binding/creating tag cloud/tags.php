<?php
$mysqli = new mysqli('localhost','root','','test');

if(mysqli_connect_errno())
{
    die('unable to connect');
}

$query= 'SELECT cityname, cityrating FROM cities';
$arr = Array();

if($result = $mysqli->query($query))
{
    if($result->nim_rows > 0 )
    {
        while($row = $result->fetch_assoc())
        {
            array_push($arr , array('city'=> $row['cityname'],'rating'=> $row['cityrating']));
        }
    }
}

$result = array('tags' => $arr);
header('content-type:text/json');
echo json_encode($result);

?>