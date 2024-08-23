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
    public $head;
    public $tail;
    public $size;

    public function __construct()
    {
        $this->head = null;
        $this->tail = null;
        $this->size = 0;
    }

    public function build(array $data)
    {
        $length = count($data);
        if ($length === 0) {
            echo "CircularSinglyLinkedList is empty";
            return;
        }

        if ($length === 1) {
            $newNode = new Node(current($data));
            $this->head = $newNode;
            $this->head->next = $newNode;

            $this->tail = $newNode;
            $this->tail->next = $newNode;

            $this->size += 1;
            return;
        }

        $stt = 1;
        foreach ($data as $val) {
            $newNode = new Node($val);

            if ($stt === 1) {
                $this->tail = $newNode;
            }

            $newNode->next = $this->head;
            $this->head = $newNode;

            $this->size += 1;
            $stt++;
        }
        // gán lại next của tail trỏ đến head
        $this->tail->next = $this->head;
    }

    public function add($data, $position = 0)
    {
        $newNode = new Node($data);
        // thêm vào list chưa có node nào
        if (is_null($this->head)) {
            $this->head = $newNode;
            $this->head->next = $newNode;

            $this->tail = $newNode;
            $this->tail->next = $newNode;

            $this->size += 1;
            return;
        }
        // thêm vào vị trí đầu
        if ($position === 0) {
            $newNode->next = $this->head;
            $this->tail->next = $newNode;
            $this->head = $newNode;

            $this->size += 1;
            return;
        }
        // thêm vào vị trí cuối
        if ($position >= $this->size) {
            $newNode->next = $this->head;
            $this->tail->next = $newNode;
            $this->tail = $newNode;

            $this->size += 1;
            return;
        }
        // thêm vào vị trí giữa bất kì
        $current = $this->head;
        $stt = 1;
        while (!is_null($current)) {
            if ($stt === $position) {
                $newNode->next = $current->next;
                $current->next = $newNode;
                $this->size += 1;
                break;
            }

            $stt++;
            $current = $current->next;
        }
    }

    public function remove($data)
    {
        if ($this->head === null) {
            echo "CircularSinglyLinkedList is empty\n";
            return;
        }
        // list chỉ có 1 node
        if ($this->size < 1) {
            $this->head = null;
            $this->tail = null;
            $this->size = 0;
            return;
        }
        // xóa value ở vị trí đầu tiên
        if ($this->head->data === $data) {
            $this->head = $this->head->next;
            $this->tail->next = $this->head;

            $this->size -= 1;
            return;
        }
        // xóa value ở vị trí giữa
        $current = $this->head;
        $prev = $this->tail;
        do {
            if ($current->data === $data) {
                $prev->next = $current->next;
                $this->size -= 1;
            } else {
                $prev = $current;
            }

            $current = $current->next;
        } while ($current !== $this->head);
        // xóa value ở vị trí cuối cùng
        if ($current->data === $data) {
            $this->tail = $prev;
            $this->tail->next = $this->head;
            $this->size -= 1;
        }
    }

    public function find($data)
    {
        $flag = false;
        $current = $this->head;
        do {
            if ($current->data === $data) {
                $flag = true;
                break;
            }
            $current = $current->next;
        } while ($current !== $this->head);

        echo $flag ? "CircularSinglyLinkedList has element = $data" : "CircularSinglyLinkedList does not element = $data";
        echo "\n";

        return $current;
    }

    public function first()
    {
        echo "CircularSinglyLinkedList first element = " . $this->head->data . "\n";
        return $this->head;
    }

    public function last()
    {
        echo "CircularSinglyLinkedList last element = ". $this->tail->data . "\n";
        return $this->tail;
    }

    public function size()
    {
        echo "CircularSinglyLinkedList size = ". $this->size . "\n";
        return $this->size;
    }

    public function reverse()
    {
        if ($this->head === null) {
            echo "Nothing to reverse\n";
            return;
        }

        if ($this->size === 1) {
            return;
        }
        // TO DO: reverse
        $current = $this->head;
        $prev = $this->tail;
        do {
            $next = $current->next;
            $current->next = $prev;
            $prev = $current;
            $current = $next;
        } while ($current !== $this->tail);

        echo $current->data . " - " . $prev->data . "\n";
    }

    public function show()
    {
        if (is_null($this->head)) {
            echo "Empty list";
            return;
        }

        echo "CircularSinglyLinkedList content: ";
        $current = $this->head;
        do {
            echo $current->data . " ";
            $current = $current->next;
        } while ($current !== $this->head);
        echo "\n";
    }
}

$list = new CircularSinglyLinkedList();

$list->build([1, 2, 3, 3, 4, 5]);

// $list->add(6);

// $list->show();

// $list->first();

// $list->last();

// $list->remove(2);

$list->show();

$list->reverse();

$list->show();
