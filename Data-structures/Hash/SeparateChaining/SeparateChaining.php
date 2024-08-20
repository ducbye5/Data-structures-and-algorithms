<?php

class HashTable {
    public $table;
    public $tableSize;

    public function __construct()
    {
        $this->table = [];
        $this->tableSize = 0;
    }

    public function create(array $array)
    {
        $this->tableSize = sizeof($array);
        foreach ($array as $val)  {
            $index = $this->hash($val);

            $this->separateChaining($index, $val);
        }
    }

    public function set($val)
    {
        $index = $this->hash($val);

        $this->separateChaining($index, $val);
    }

    public function get($val, $returnPosition = false)
    {
        $index = $this->hash($val);

        if (!isset($this->table[$index])) {
            echo "Không tồn tại giá trị này trong hash table\n";
            return [$index, null];
        }

        $subIndex = null;
        foreach ($this->table[$index] as $key => $v) {
            if ($v === $val) {
                $subIndex = $key;
                break;
            }
        }

        if (is_null($subIndex)) {
            echo "Không tồn tại giá trị này trong hash table\n";
            return [$index, null];
        }

        if ($returnPosition) {
            return [$index, $subIndex];
        }

        echo "Giá trị cần tìm kiếm: [$index] - [$subIndex] - $val\n";
    }

    public function remove($val)
    {
        [$index, $subIndex] = $this->get($val, true);

        if ($index === null || $subIndex === null) {
            echo "Không tồn tại giá trị $val trong hash table\n";
            return;
        }

        if (sizeof($this->table[$index]) === 1) {
            unset($this->table[$index]);
        } else {
            unset($this->table[$index][$subIndex]);
        }
    }

    public function show()
    {
        foreach ($this->table as $key => $val) {
            echo "[$key] - " . implode($val, ", ") . "\n";
        }
        echo "========================================================\n";
    }

    private function hash($key)
    {
        $characters = str_split(trim($key));
        $ASCII = 0;
        foreach ($characters as $val) {
            $ASCII += ord($val);
        }

        $index = $ASCII % $this->tableSize;

        return (string) $index;
    }

    private function separateChaining($index, $val)
    {
        if (isset($this->table[$index])) {
            $this->table[$index][] = $val;
        } else {
            $this->table[$index] = [$val];
        }
    }
}

// $hashTable = new HashTable();

// $array = ['apple', 'elppa', 'plepa', 'Banana', 'Cherry', 'Date', 'Elderberry', 'Fig', 'gFi', 'yrCher'];

// $hashTable->create($array);

// $hashTable->set('orange');

// $hashTable->show();

// $hashTable->remove('Banana');

// $hashTable->show();

// $hashTable->get('Banana');
