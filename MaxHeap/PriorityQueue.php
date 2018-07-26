<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/7/24
 * Time: 16:42
 */
require_once "../ARRAY/Queue.php";

/** 优先队列
 * Class PriorityQueue
 */
class PriorityQueue implements \Home\Interfaces\Queue
{
    private $maxHeap;

    public function __construct()
    {
        $this->maxHeap = new MaxHeap();
    }
    public function getSize()
    {
        // TODO: Implement getSize() method.
        return $this->maxHeap->size();
    }

    public function isEmpty()
    {
        // TODO: Implement isEmpty() method.
        return $this->maxHeap->isEmpty();
    }

    public function enqueue($e)
    {
        // TODO: Implement enqueue() method.
        $this->maxHeap->add($e);
    }

    public function dequeue()
    {
        // TODO: Implement dequeue() method.
        return $this->maxHeap->extractMax();
    }

    public function getFront()
    {
        // TODO: Implement getFront() method.
        return $this->maxHeap->findMax();
    }
}