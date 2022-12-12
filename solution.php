<?php

$input = readline('Enter your Ingredients: ');
$myArray = explode(',', $input);


foreach ($myArray as $value) {
    if ($value != "") {
        fetchDrink(trim($value));
    }
}


function fetchDrink($value)
{

    $ch = curl_init();
    $url = "https://www.thecocktaildb.com/api/json/v1/1/filter.php?i=" . $value;

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $serverResponse = curl_exec($ch);


    if ($e = curl_error($ch)) {
        echo $e;
    } else {
        $decodedResponse = json_decode($serverResponse, true);
        if ($decodedResponse == "") {
            echo $value . " : Ingredient Not in database" . "\r\n";
        } else {
            echo "The Drinks containing " . $value . " are:" . "\r\n";
            foreach ($decodedResponse['drinks'] as $value) {
                echo $value['strDrink'] . "\r\n";
            }
        }
    }
    curl_close($ch);
}
