<?php

// include 'Singly/SinglyLinkedList.php';
include 'Doubly/DoublyLinkedList.php';
// include 'Circular/CircularSinglyLinkedList.php';
// include 'Circular/CircularDoublyLinkedList.php';

/**
 * Bài toán:
 *      Đảo ngược LinkedList
 *      list = [1,2,3,4,5,6,7,8,9]
 *      output = [9,8,7,6,5,4,3,2,1]
 */
function reverse(array $array)
{
    // $linkedList = new SinglyLinkedList();

    $linkedList = new DoublyLinkedList();

    // $linkedList = new CircularSinglyLinkedList();

    // $linkedList = new CircularDoublyLinkedList();

    $linkedList->build($array);

    $linkedList->show();

    $linkedList->reverse();

    $linkedList->show();
}

reverse([1, 2, 3, 4, 5, 6, 7, 8, 9]);
