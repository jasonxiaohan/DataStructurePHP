<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/7/17
 * Time: 7:11
 */

namespace Home\Interfaces;
include 'Stack.php';
include 'LinkedList.php';

class LinkedListStack implements Stack
{
    private $list = [];

    public function __construct()
    {
        $this->list = new LinkedList();
    }

    public function getSize()
    {
        // TODO: Implement getSize() method.
        return $this->list->getSize();
    }

    public function isEmpty()
    {
        // TODO: Implement isEmpty() method.
        return $this->list->isEmpty();
    }

    public function push($e)
    {
        // TODO: Implement push() method.
        $this->list->addFirst($e);
    }

    public function pop()
    {
        // TODO: Implement pop() method.
        return $this->list->removeFirst();
    }

    public function peek()
    {
        // TODO: Implement peek() method.
        return $this->list->getFirst();
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        $res = "Stack：top ";
        $res .= (string)$this->list;
        return $res;
    }
}

/*$stack = new LinkedListStack();
for($i = 0; $i < 5; $i++)
{
    $stack->push($i);
    print $stack;
}
$stack->pop();
print $stack;*/
