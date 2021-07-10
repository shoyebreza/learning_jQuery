<?php
    
    if (isset($_POST['vote']))
    {
        if(isset($_COOKIE['voted']))
        {
            $message = 'you have already voted. you cannot vote more than once per day ';
        }
        else {
            $message = 'your vote hasbeen saved';

            $dom = new DOMDocument();

            $dom->load('browsers.xml');

            $xpath = new domXpath($dom);

            $units = $xpath->query('//browser');

            foreach ($units as $unit)
            {
                $value = $unit->getAttribute('value');
                if($value == $_POST['browser'])
                {
                    $votes = $unit->getAttribute('votes');
                    $unit->setAttribute('votes', ++$votes);
                    setcookie("voted",true , time()+ (24*60*60)); /* expire in 24 hours */
                    break;
                    
                }
            }
            $dom->save('browsers.xml');
        }
    }
    
    
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>creating voting </title>
    <style>
    body{
      font-family: Verdana, Geneva, Tahoma, sans-serif;
      width: 550px;
    }

    ul{
        list-style: none;
    }
    li{
        height: 35px;
    }
    span{
        background-color: red;
        color: #fff;
        float: left;
    }
    </style>
</head>
<body>
    
    <form action="" method="post">
        <fieldset>
            <legend>which is your favourite browser</legend>
            <ul>
                <?php 

                
                $dom = new DOMDocument();
                $dom->load('browsers.xml');

                $xpath = new domXpath($dom);

                $browsers = $xpath->query('//browser');
                
                foreach ($browsers as $browser)
                {
                    $checked = isset($_POST['vote'] ) == $browser->getAttribute('value')? 'checked':'';
                    echo '<li> <input type="radio" '.$checked.' name="browser" value="'.$browser->getAttribute('value').'">'.$browser->getAttribute('name').' </li>';
                }

                ?>


                <li style="color:red;"> <?php echo $message; ?> </li>
                <li> <input type="submit" value="vote" name="vote"></li>
            </ul>
        </fieldset>
    </form>

    <fieldset>
        <legend>pool result</legend>
        <?php
            $dom = new DOMDocument();
            $dom->load('browsers.xml');
            $xpath = new domXpath($dom);
            $browsers = $xpath->query('//browser');

            echo '<ul>';

            foreach($browsers as $browser)
            {
                $name = $browser->getAttribute('name');

                $votes = $browser->getAttribute('votes');
                echo '<li>'.$name.'-'.$votes.' votes</li>';
                echo '<li><span style="width:'.$votes.'px;"> &nbsp; </span>  </li>'; 
            }

            echo '</ul>';
        
        ?>
    </fieldset>
</body>
</html>