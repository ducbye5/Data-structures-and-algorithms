<?php

require 'MinHeap.php';
require 'MaxHeap.php';

// Sắp xếp một mảng theo thứ tự tăng dần
$array = [10, 8, 9, 1, 14, 16, 18, 4, 5];
// output sắp xếp tăng dần: 1, 4, 5, 8, 9, 10, 14, 16, 18
// output sắp xếp giảm dần dần: 18, 16, 14, 10, 9, 8, 5, 4, 1

// ============================================================================================
/*
* Ý tưởng: Sử dụng min heap
* Time Complexity : 
* Space Complexity : 
*/
function sortArray(array $array, $order = 'asc')
{
    $heap = $order === "desc" ? new MaxHeap() : new MinHeap();
    $heap->build($array);

    $stt = 0;
    $length = $heap->size();
    while ($stt < $length) {
        $element = $heap->peek();
        echo "$element ";
        $heap->remove($element);
        $stt++;
    }
    echo "\n";
}

sortArray($array);
sortArray($array, 'desc');
