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
            echo "DoublyLinkedList is empty";
            return;
        }

        $stt = 1;
        foreach ($data as $val) {
            $newNode = new Node($val);

            if ($stt === 1) {
                $this->head = $newNode;
                $this->tail = $newNode;
                $this->size += 1;
                $stt++;
                continue;
            }

            $this->head->prev = $newNode;
            $newNode->next = $this->head;
            $this->head = $newNode;

            $this->size += 1;
            $stt++;
        }
    }

    public function add($data, $position = 0)
    {
        $newNode = new Node($data);
        // thêm vào vị trí đầu tiên của linked list
        if ($position === 0) {
            if ($this->head === null) {
                $this->head = $newNode;
                $this->tail = $newNode;
            } else {
                $newNode->next = $this->head;
                $this->head->prev = $newNode;
                $this->head = $newNode;
            }

            $this->size += 1;
            return;
        }
        // thêm vào cuối cùng
        if ($position >= $this->size) {
            if ($this->head === null || $this->tail === null) {
                $this->head = $newNode;
                $this->tail = $newNode;
            } else {
                $newNode->prev = $this->tail;
                $this->tail->next = $newNode;
                $this->tail = $newNode;
            }

            $this->size += 1;
            return;
        }
        // thêm vào vị trí bất kì
        $current = $this->head;
        $stt = 1;
        while (!is_null($current)) {
            if ($stt === $position) {
                $newNode->next = $current->next;
                $newNode->prev = $current;
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
            echo "Nothing to remove\n";
            return;
        }
        // list chỉ có 1 node
        if ($this->size === 1) {
            $this->head = null;
            $this->tail = null;
            $this->size = 0;
        }

        $current = $this->head;
        // xóa value ở vị trí đầu tiên
        if ($current->data === $data) {
            $current->next->prev = null;
            $this->head = $current->next;
            $this->size -= 1;
            return;
        }
        // xóa vị trí giữa
        while ($current->next !== null) {
            if ($current->data === $data) {
                $current->prev->next = $current->next;
                $this->size -= 1;
                break;
            }
            $current = $current->next;
        };
        // xóa value ở vị trí cuối cùng
        if ($current->next === null && $current->data === $data) {
            $current->prev->next = null;
            $this->tail = $current->prev;
            $this->size -= 1;
        }
    }

    public function find($data)
    {
        $flag = false;
        $current = $this->head;

        while (!is_null($current)) {
            if ($current->data === $data) {
                $flag = true;
                break;
            }
            $current = $current->next;
        }

        echo $flag ? "DoublyLinkedList has element = $data" : "DoublyLinkedList does not have element = $data";
        echo "\n";

        return $current;
    }
    /**
     * Ý tưởng: 
     *      Hoán đổi lại 2 giá trị next và prev ở từng node
     *      Set lại các giá trị head và tail
     */
    public function reverse()
    {
        if ($this->head === null) {
            echo "Nothing to reverse\n";
            return;
        }

        if ($this->size === 1) {
            return;
        }

        $current = $this->head;
        $stt = 1;

        while ($current !== null) {
            $prev = $current->prev;
            $current->prev = $current->next;
            $current->next = $prev;

            if ($stt === 1) {
                $this->tail = $current;
            }

            $this->head = $current;

            $current = $current->prev;
            $stt++;
        }
    }

    public function first()
    {
        echo "DoublyLinkedList first element = " . $this->head->data. "\n";
        return $this->head;
    }

    public function last()
    {
        echo "DoublyLinkedList last element = ". $this->tail->data. "\n";
        return $this->tail;
    }

    public function size()
    {
        echo "DoublyLinkedList size = " . $this->size . "\n";
        return $this->size;
    }
    // Hàm in danh sách
    public function show()
    {
        echo "DoublyLinkedList content: ";
        $current = $this->head;
        while (!is_null($current)) {
            echo $current->data . " ";
            $current = $current->next;
        }
        echo "\n";
    }
}

// $list = new DoublyLinkedList();

// $list->build([1, 2, 3, 4, 5, 6, 7, 8]);

// $list->add(10);

// $list->add(10, 7);

// $list->size();

// $list->remove(1);

// $list->first();

// $list->last();

// $list->size();

// $list->show();

// $list->reverse();

// $list->first();

// $list->last();

// $list->show();
