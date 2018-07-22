<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/7/22
 * Time: 16:07
 */

require_once 'Map.php';

class Node
{
    public $key = null;
    public $value = null;
    public $next = null;

    public function __construct($key, $value, $next = null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->next = $next;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return (string)$this->key;
    }
}

class LinkedListMap implements Map
{
    // 虚拟头节点
    private $dummyHead = null;
    // 链表元素个数
    private $size = 0;

    public function __construct()
    {
        $this->dummyHead = new Node(null, null, null);
    }

    public function add($key, $value)
    {
        $node = $this->getNode($key);
        if($node == null)
        {
            $this->dummyHead->next = new Node($key, $value, $this->dummyHead->next);
            $this->size += 1;
        }else
        {
            $node->value = $value;
        }
    }

    public function remove($key)
    {
        // TODO: Implement remove() method.
        $prev = $this->dummyHead;
        while ($prev->next != null)
        {
            if($prev->next->key == $key)
                break;
            $prev = $prev->next;
        }

        if($prev->next != null)
        {
            $delNode = $prev->next;
            $prev->next = $delNode->next;
            $delNode->next = null;
            $this->size -= 1;
            return $delNode->value;
        }
        return null;
    }

    public function contains($key)
    {
        // TODO: Implement contains() method.
        return $this->getNode($key);
    }

    public function get($key)
    {
        // TODO: Implement get() method.
        $node = $this->getNode($key);
        return $node!=null?$node->value:null;
    }

    public function set($key, $value)
    {
        // TODO: Implement set() method.
        $node = $this->getNode($key);
        if($node == null)
        {
           throw new Exception(" doesn't exist!");
        }
        $node->value = $value;
    }

    public function getSize()
    {
        // TODO: Implement getSize() method.
        return $this->size;
    }

    public function isEmpty()
    {
        // TODO: Implement isEmpty() method.
        return $this->size == 0;
    }

    private function getNode($key)
    {
        $cur = $this->dummyHead->next;
        while ($cur != null)
        {
            if($cur->key === $key)
                return $cur;
            $cur = $cur->next;
        }
        return null;
    }
}