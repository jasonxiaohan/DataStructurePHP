<?php
/**
 * Created by PhpStorm.
 * User: tom
 * Date: 2018/8/3
 * Time: 12:03
 */

class Node
{
    public $next = [];
    public $value = 0;

    public function __construct($value = 0)
    {
        $this->next = array();
        $this->value = $value;
    }
}

class MapSum
{
    private $root;

    public function __construct()
    {
        $this->root = new Node();
    }

    public function insert($key, $val)
    {
        $cur = $this->root;
        $len = strlen($key);
        for ($i = 0; $i < $len; $i++) {
            if (!isset($cur->next[$key[$i]]))
                $cur->next[$key[$i]] = new Node();
            $cur = $cur->next[$key[$i]];
        }
        $cur->value = $val;
    }

    public function sum($prefix)
    {
        $cur = $this->root;
        $len = strlen($prefix);
        for ($i = 0; $i < $len; $i++) {
            if (!isset($cur->next[$prefix[$i]]))
                return 0;
            $cur = $cur->next[$prefix[$i]];
        }
        return $this->__sum($cur);
    }

    private function __sum($node)
    {
        $res = $node->value;
        $keys = array_keys($node->next);
        foreach ($keys as $val) {
            $res += $this->__sum($node->next[$val]);
        }
        return $res;
    }
}

$mapSum = new MapSum();
$mapSum->insert("apple", 3);
print($mapSum->sum("ap").PHP_EOL);
$mapSum->insert("app", 2);
print($mapSum->sum("ap").PHP_EOL);
