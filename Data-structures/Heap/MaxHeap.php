<?php

class MaxHeap {
    public $heap;
    public $heapSize;

    public function __construct()
    {
        $this->heap = [];
        $this->heapSize = 0;
    }

    public function build(array $array)
    {
        $this->heap = $array;
        $this->heapSize = count($array);
        for ($parentNodeIndex = floor($this->heapSize / 2) - 1; $parentNodeIndex >= 0; $parentNodeIndex--) {
            $this->heapify($parentNodeIndex);
        }
    }

    /**
     * Ý tưởng:
     *         Bắt đầu từ nút cha cuối cùng
     *         Thực hiện kiểm tra gán lại giá trị của các nút thỏa mãn thuộc tính heap
     * Time Complexity : O(n)
     * Space Complexity : 
     */
    public function heapify($parentNodeIndex)
    {
        while (true) {
            $smallestNodeIndex = $parentNodeIndex;  // Gán nút hiện tại làm nút cha
            $leftNodeIndex = 2 * $parentNodeIndex + 1;  // Tìm index của nút con trái
            $rightNodeIndex = 2 * $parentNodeIndex + 2;  // Tìm index của nút con phải

            if ($leftNodeIndex < $this->heapSize && $this->heap[$leftNodeIndex] > $this->heap[$smallestNodeIndex]) {
                $smallestNodeIndex = $leftNodeIndex;
            }

            if ($rightNodeIndex < $this->heapSize && $this->heap[$rightNodeIndex] > $this->heap[$smallestNodeIndex]) {
                $smallestNodeIndex = $rightNodeIndex;
            }

            if ($smallestNodeIndex === $parentNodeIndex) {
                break;
            }

            $temp = $this->heap[$parentNodeIndex];
            $this->heap[$parentNodeIndex] = $this->heap[$smallestNodeIndex];
            $this->heap[$smallestNodeIndex] = $temp;

            $parentNodeIndex = $smallestNodeIndex;
        }
    }

    /**
     * Ý tưởng:
     *         Thêm phần tử mới vào cuối heap, ở vị trí có sẵn tiếp theo ở cấp cuối cùng của cây
     *         So sánh phần tử mới với phần tử cha của nó. Nếu phần tử cha nhỏ hơn phần tử mới, hãy hoán đổi chúng
     *         Lặp lại bước 2 cho đến khi phần tử cha lớn hơn hoặc bằng phần tử mới hoặc cho đến khi phần tử mới đạt đến gốc của cây
     * Time Complexity : O(log(n)) ( trong đó n là số phần tử trong heap )
     * Space Complexity : O(n)
     */
    public function add($node)
    {
        $this->heap[] = $node;
        $this->heapSize = $this->heapSize + 1;
        $newNodeIndex = $this->heapSize - 1;

        while (true) {
            $parentNodeIndex = ceil(($newNodeIndex - 2) / 2) < 0 ? 0 : ceil(($newNodeIndex - 2) / 2);

            $parentNode = $this->heap[$parentNodeIndex];
            $newNode = $this->heap[$newNodeIndex];

            if ($parentNode >= $newNode) {
                break;
            }
            // Hoán đổi giá trị
            $temp = $parentNode;
            $this->heap[$parentNodeIndex] = $newNode;
            $this->heap[$newNodeIndex] = $temp;

            $newNodeIndex = $parentNodeIndex;
        }
    }

    /**
     * Ý tưởng:
     *         Thay thế phần tử cần xóa bằng phần tử cuối cùng
     *         Xóa phần tử cuối cùng khỏi Heap
     *         Heapify phần tử vừa được thay thế vào nút vừa xóa
     * Time Complexity : O(log n) trong đó n là số phần tử trong heap
     * Space Complexity : O(n)
     */
    public function remove($node)
    {
        foreach ($this->heap as $key => $val) {
            if (!isset($this->heap[$key])) {
                return;
            }

            if ($val === $node) {
                // case heap có nhiều node giống nhau
                while ($this->heapSize > 0 && $this->heap[$this->heapSize - 1] === $node) {
                    unset($this->heap[$this->heapSize - 1]);
                    $this->heapSize = $this->heapSize - 1;
                }

                if ($this->heapSize < 1) {
                    break;
                }

                $this->heap[$key] = $this->heap[$this->heapSize - 1];
                unset($this->heap[$this->heapSize - 1]);
                $this->heapSize = $this->heapSize - 1;
                $this->heapify($key);
            }
        }
    }

    public function size()
    {
        return $this->heapSize;
    }

    public function peek()
    {
        $root = current($this->heap);
        // echo "Root node max heap: $root\n";
        return $root;
    }

    public function show()
    {
        echo "Max heap : " . implode(" - ", $this->heap) . "\n";
    }
}

// $maxHeap = new MaxHeap();

// $maxHeap->buildMaxHeap([1, 5, 3, 4, 2, 6]);

// $maxHeap->show();

// $maxHeap->add(1);

// $maxHeap->show();

// $maxHeap->remove(3);

// $maxHeap->show();

// $maxHeap->peek();
