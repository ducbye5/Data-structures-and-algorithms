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

class CircularSinglyLinkedList
{
    public $last;

    public function __construct()
    {
        $this->last = null;
    }

    // Hàm thêm node
    public function add($data)
    {
        $newNode = new Node($data);

        if (is_null($this->last)) {
            $this->last = $newNode;
            $this->last->next = $newNode;
        } else {
            $newNode->next = $this->last->next;
            $this->last->next = $newNode;
        }

        return $this->last;
    }

    // Hàm in danh sách
    public function list()
    {
        if (is_null($this->last)) {
            echo "Empty list";
            return;
        }

        $current = $this->last->next;
        do {
            echo $current->data . " ";
            $current = $current->next;
        } while ($current !== $this->last->next);
    }
}

$list = new CircularSinglyLinkedList();

$list->add(1);
$list->add(5);
$list->add(8);
$list->add(3);

$list->list();
