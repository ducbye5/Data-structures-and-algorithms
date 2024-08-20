<?php

require 'SeparateChaining/SeparateChaining.php';

// Kiểm tra array có phải tập con trong array gốc hay không?
$originalArray = ['apple', 'elppa', 'plepa', 'Banana', 'Cherry', 'Date', 'Elderberry', 'Fig', 'gFi', 'yrCher'];
$searchArray = ['apple', 'Banana', 'Fig'];
// output: $searchArray là tập con của $originalArray

// ============================================================================================
/*
* Ý tưởng: Sử dụng 2 vòng lặp để kiểm tra
* Time Complexity : O(m * n) với m là tổng số phần tử mảng originalArray, n là tổng số phần tử mảng searchArray
* Space Complexity : O(1)
*/
function checkArrayInArrayUseTwoFor(array $originalArray, array $searchArray)
{
    $flag = false;
    for ($i = 0; $i < sizeof($searchArray); $i++) {
        $flag = false;
        for ($j = 0; $j < sizeof($originalArray); $j++) {
            if ($originalArray[$j] === $searchArray[$i]) {
                $flag = true;
                break;
            }
        }

        if (!$flag) {
            $flag = false;
            break;
        }
    }

    if ($flag) {
        echo "Mảng tìm kiếm là tập con của mảng gốc\n";
    } else {
        echo "Mảng tìm kiếm không phải là tập con của mảng gốc\n";
    }
}

// ============================================================================================
/*
* Ý tưởng: Sử dụng hash table để cho tập $originalArray. 
*          Sau đó dùng vòng lặp để kiểm tra từng phần tử trong $searchArray có nằm trong $originalArray không
* Time Complexity : O(m + n) với m là tổng số phần tử mảng originalArray, n là tổng số phần tử mảng searchArray
* Space Complexity : O(m)
*/
function checkArrayInArrayUseHashTable(array $originalArray, array $searchArray)
{
    $hashTable = new HashTable();
    $hashTable->create($originalArray);

    foreach ($searchArray as $val) {
        [$index, $subIndex] = $hashTable->get($val, true);

        if ($index === null || $subIndex === null) {
            echo "Mảng tìm kiếm không phải là tập con của mảng gốc\n";
            return;
        }
    }

    echo "Mảng tìm kiếm là tập con của mảng gốc\n";
}

checkArrayInArrayUseTwoFor($originalArray, $searchArray);

checkArrayInArrayUseHashTable($originalArray, $searchArray);
