<?php

$numericArray1 = array(1, 2, 3, 4, 5);

$numericArray2 = [1, 2, 3, 4, 5];

$numericArray3 = [];
$numericArray3[] = 1;
$numericArray3[] = 2;
$numericArray3[] = 3;
$numericArray3[] = 4;
$numericArray3[] = 5;

$numericArray4 = range(1, 5);

// Tạo mảng đa chiều
$multiDimensionalArray = [
    ["name" => "Nguyen Van A", "age" => 30, "city" => "Ha Noi"],
    ["name" => "Nguyen Van B", "age" => 30, "city" => "Ha Noi"],
    ["name" => "Nguyen Van C", "age" => 30, "city" => "Ha Noi"]
];

// tương tự array_splice()
function addAtPosition(array $array, $newData, $position)
{
    $length = sizeof($array);

    if ($position < 0) {
        echo "position does not exist";
        return;
    }

    if ($length <= $position) {
        $array[] = $newData;
        show($array);
        return;
    }

    $newArray = [];

    for ($i = 0; $i < $length; $i++) {
        if ($i === $position) {
            $newArray[] = $newData;
            continue;
        }

        if ($position < $i) {
            $newArray[] = $array[$i - 1];
            continue;
        }

        $newArray[] = $array[$i];
    }

    $newArray[] = $array[$length - 1];

    show($newArray);
}

function deleteAtPosition(array $array, $position)
{
    $length = sizeof($array);

    if ($length <= $position || $position < 0) {
        echo "position does not exist";
        return;
    }

    for ($i = $position; $i < $length; $i++) {
        if ($i + 1 !== $length) {
            $array[$i] = $array[$i + 1];
            continue;
        }

        unset($array[$i]);
    }

    show($array);
}

function findPositonOfElement(array $array, $value)
{
    $length = sizeof($array);

    for ($i = 0; $i < $length; $i++) {
        if ($array[$i] === $value) {
            echo $i + 1;
            return;
        }
    }

    echo "position does not exist";
}

function show(array $array)
{
    if (empty($array)) {
        echo "Nothing";
    }

    foreach ($array as $item) {
        echo $item . " ";
    }
}

addAtPosition($numericArray1, 6, 5);

// deleteAtPosition($numericArray1, 0);
