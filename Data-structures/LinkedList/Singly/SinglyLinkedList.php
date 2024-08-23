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
            echo "SinglyLinkedList is empty";
            return;
        }

        if ($length === 1) {
            $newNode = new Node(current($data));
            $this->head = $newNode;
            $this->tail = $newNode;

            $this->size = 1;
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
    }

    public function add($data, $position = 0)
    {
        $newNode = new Node($data);
        // thêm vào node đầu
        if ($this->head === null || $position === 0) {
            $newNode->next = $this->head;
            $this->head = $newNode;
            $this->size += 1;
            return;
        }
        // thêm vào node cuối
        if ($position >= $this->size) {
            $this->tail->next = $newNode;
            $this->tail = $newNode;
            $this->size += 1;
            return;
        }
        // thêm vào vị trí bất kì
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
            echo "Nothing to remove\n";
            return;
        }
        // list chỉ có 1 node
        if ($this->size === 1) {
            $this->head = null;
            $this->tail = null;
            $this->size = 0;
        }
        // xóa value ở vị trí đầu tiên
        if ($this->head->data === $data) {
            $this->head = $this->head->next;
            $this->size -= 1;
            return;
        }
        // xóa value ở vị trí giữa
        $current = $this->head;
        while ($current->next->next !== null) {
            if ($current->next->data === $data) {
                $current->next = $current->next->next;
                $this->size -= 1;
            }

            $current = $current->next;
        }
        // xóa value ở vị trí cuối cùng
        if ($current->next->data === $data) {
            $current->next = null;
            $this->tail = $current;
            $this->size -= 1;
        }
    }

    public function find($data)
    {
        $flag = false;
        $current = $this->head;
        while ($current !== null) {
            if ($current->data === $data) {
                $flag = true;
                break;
            }

            $current = $current->next;
        }

        echo $flag ? "SinglyLinkedList has element = $data" : "SinglyLinkedList does not have element = $data";
        echo "\n";

        return $current;
    }

    public function first()
    {
        echo "SinglyLinkedList first element = " . $this->head->data. "\n";
        return $this->head;
    }

    public function last()
    {
        echo "SinglyLinkedList last element = ". $this->tail->data. "\n";
        return $this->tail;
    }

    public function size()
    {
        echo "SinglyLinkedList size = " . $this->size . "\n";
        return $this->size;
    }

    // Hàm in danh sách
    public function show()
    {
        echo "SinglyLinkedList content: ";
        $current = $this->head;
        while ($current !== null) {
            echo $current->data . " ";
            $current = $current->next;
        }
        echo "\n";
    }

    /**
     * Ý tưởng: Sử dụng vòng lặp
     *      Sử dụng prev để lưu lại con trỏ trước đó
     *      Mỗi lần lặp sẽ trỏ lại next tới prev
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
        $prev = null;
        $stt = 1;
        while ($current !== null) {
            $next = $current->next;
            $current->next = $prev;
            $prev = $current;

            if ($stt === 1) {
                $this->tail = $current;
            }

            $this->head = $current;

            $current = $next;
            $stt++;
        }
    }
}

// $list = new SinglyLinkedList();

// $list->build([1, 2, 4, 5, 6]);

// $list->add(7, 1);

// $list->add(0, 7);

// $list->remove(7);

// $list->find(8);

// $list->show();

// $list->reverse();

// $list->show();

// $list->size();
