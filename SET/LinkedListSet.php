<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/7/19
 * Time: 17:50
 */

require_once '../ARRAY/LinkedList.php';
require_once 'Set.php';

class LinkedListSet implements Set
{
    public $list;
    public function __construct()
    {
        $this->list = new \Home\Interfaces\LinkedList();
    }

    public function add($e)
    {
        // TODO: Implement add() method.
        if(!$this->list->contains($e))
            $this->list->addFirst($e);
    }

    public function remove($e)
    {
        // TODO: Implement remove() method.
        $this->list->removeElement($e);
    }

    public function contains($e)
    {
        // TODO: Implement contains() method.
        return $this->list->contains($e);
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
}