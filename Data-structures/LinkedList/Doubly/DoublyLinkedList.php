<?php

class Node
{
    public $data;
    public $prev;
    public $next;

    public function __construct($data)
    {
        $this->data = $data;
        $this->prev = null;
        $this->next = null;
    }
}

class DoublyLinkedList
{
    public $head;
    public $tail;

    public function __construct()
    {
        $this->head = null;
        $this->tail = null;
    }

    // Hàm thêm một node vào đầu danh sách
    public function addAtBegin($data)
    {
        $newNode = new Node($data);

        if ($this->head === null) {
            $this->head = $newNode;
            $this->tail = $newNode;
        } else {
            $newNode->next = $this->head;
            $this->head->prev = $newNode;
            $this->head = $newNode;
        }
    }

    // Hàm thêm một node vào cuối danh sách
    public function addAtEnd($data)
    {
        $newNode = new Node($data);

        if ($this->head === null || $this->tail === null) {
            $this->head = $newNode;
            $this->tail = $newNode;
        } else {
            $newNode->prev = $this->tail;
            $this->tail->next = $newNode;
            $this->tail = $newNode;
        }
    }

    // Hàm thêm một node vào vị trí bất kì tính từ đầu danh sách
    public function addAtPosition($data, $position)
    {
        // thêm vào vị trí đầu tiên của linked list
        if ($position === 0) {
            $this->addAtBegin($data);
            return;
        }
        // thêm vào vị trí bất kì
        $newNode = new Node($data);

        $current = $this->head;
        $stt = 0;
        while (!is_null($current)) {
            if ($stt === $position - 1) {
                $newNode->next = $current->next;
                $newNode->prev = $current;
                $current->next = $newNode;
                break;
            }

            $stt++;
            $current = $current->next;
        }
    }

    // Hàm in danh sách
    public function list()
    {
        $current = $this->head;
        while (!is_null($current)) {
            echo $current->data . " ";
            $current = $current->next;
        }
        echo "\n";
    }
}

$list = new DoublyLinkedList();

$list->addAtBegin(10);
$list->addAtEnd(15);
$list->addAtBegin(5);

$list->addAtPosition(11, 2);
$list->addAtPosition(14, 3);

$list->list();
