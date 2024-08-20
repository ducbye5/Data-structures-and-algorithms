<?php

class Node
{
    public $data;
    public $next;

    public function __construct($data)
    {
        $this->data = $data;
        $this->next = null;
    }
}

class SinglyLinkedList
{
    public $head;

    public function __construct()
    {
        $this->head = null;
    }

    // Hàm thêm một node vào vị trí bất kì tính từ đầu danh sách
    public function addAtPosition($data, $position)
    {
        $newNode = new Node($data);

        // thêm vào vị trí đầu tiên của linked list
        if ($position === 0) {
            $newNode = new Node($data);
            $newNode->next = $this->head;
            $this->head = $newNode;
            return;
        }

        $current = $this->head;
        $stt = 0;
        while (!is_null($current)) {
            if ($stt === $position - 1) {
                $newNode->next = $current->next;
                $current->next = $newNode;
                break;
            }

            $stt++;
            $current = $current->next;
        }
    }

    public function removeAtPosition($data, $position)
    {
        
    }

    // Hàm in danh sách
    public function show()
    {
        $current = $this->head;
        while ($current !== null) {
            echo $current->data . " ";
            $current = $current->next;
        }
    }
}

$list = new SinglyLinkedList();

$list->addAtPosition(3, 2);

$list->show();
