<?php

$hashmap = array(
    "name" => "Nguyen Van A",
    "age" => 30,
    "city" => "Ha Noi"
);

function addAtPosition(array $array, $position, $key, $value)
{
    $length = sizeof($array);

    if ($position < 0) {
        echo "position does not exist";
        return;
    }

    if ($length <= $position) {
        $array[$key] = $value;
        show($array);
        return;
    }

    show($array);
}

function show(array $array)
{
    if (empty($array)) {
        echo "Nothing";
    }

    foreach ($array as $key => $value) {
        echo "$key: $value\n";
    }
}

addAtPosition($hashmap, 5, "sex", "male");
// show($hashmap);