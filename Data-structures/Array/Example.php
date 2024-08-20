<?php

// In ra tất cả các phẩn tử thỏa mãn điều kiện là lớn hơn tất cả các phẩn từ ở bên phải của nó

$array = [8, 6, 9, 1, 0, 5, 2, 3];
// output: 9,5,3

// ============================================================================================
/*
* Ý tưởng: Sử dụng 2 vòng lặp để in ra kết quả
* Time Complexity : O(n * n) với n là tổng số phần tử mảng
* Space Complexity : O(1)
*/

function findElement(array $arr)
{
    $length = sizeof($arr);
    for ($i = 0; $i < $length; $i++) {
        for ($j = $i + 1; $j < $length; $j++) {
            if ($arr[$i] <= $arr[$j]) {
                break;
            }
        }

        if ($j === $length) {
            echo "[$arr[$i]]";
        }
    }
}

// findElement($array);

// ============================================================================================
/*
* Ý tưởng: Duyệt từ cuối mảng. Gán một biến bằng phần tử cuối cùng(phần tử cuối chắc chắn thuộc tệp output).
*          Khi duyệt mà giá trị tối đa thay đổi thì gán lại biến và in kết quả
* Time Complexity : O(n) với n là tổng số phần tử mảng
* Space Complexity : O(1)
*/
function findEle(array $arr)
{
    $length = sizeof($arr);
    $max = $arr[$length - 1];
    echo "[$max]";

    for ($i = $length - 2; $i >= 0; $i--) {
        if ($max < $arr[$i]) {
            $max = $arr[$i];
            echo "[$arr[$i]]";
        }
    }
}

findEle($array);
