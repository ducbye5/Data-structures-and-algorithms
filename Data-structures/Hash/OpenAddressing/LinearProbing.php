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

            $this->linearProbing($index, $val);
        }
    }

    public function set($val)
    {
        $index = $this->hash($val);

        $this->linearProbing($index, $val);
    }

    public function get($val, $returnPosition = false)
    {
        $index = $this->hash($val);

        if (!isset($this->table[$index])) {
            echo "Không tồn tại giá trị này trong hash table";
            return null;
        }

        while (isset($this->table[$index]) && $this->table[$index] !== $val) {
            $index = ($index + 1) % $this->tableSize;
        }

        if ($returnPosition) {
            return $index;
        }

        echo "Giá trị cần tìm kiếm: [$index] - $val";
    }

    public function remove($val)
    {
        $index = $this->get($val, true);

        if (!is_null($index)) {
            unset($this->table[$index]);
        } else {
            echo "Không tồn tại giá trị $val trong hash table\n";
        }

    }

    public function show()
    {
        foreach ($this->table as $key => $val) {
            echo "[$key] - $val\n";
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

    private function linearProbing($index, $val)
    {
        while (isset($this->table[$index])) {
            $index = ($index + 1) % $this->tableSize;
        }

        $this->table[$index] = $val;
    }
}

$hashTable = new HashTable();

$array = ['apple', 'elppa', 'plepa', 'Banana', 'Cherry', 'Date', 'Elderberry', 'Fig', 'gFi'];

$hashTable->create($array);

// $hashTable->set('orange');

// $hashTable->show();

// $hashTable->remove('elppa');

$hashTable->show();

// $hashTable->get('Banana');
