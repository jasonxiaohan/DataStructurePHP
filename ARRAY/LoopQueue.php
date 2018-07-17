<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/7/15
 * Time: 20:30
 */
namespace Home\Classess;
use Home\Interfaces;
include('Queue.php');

class LoopQueue implements Interfaces\Queue
{
    private $data = [];
    // 队首
    private $front = 0;
    // 队尾
    private $tail = 0;

    // 队列的长度
    private $size = 0;

    public function __construct($capacity = 10)
    {
        for($i= 0; $i<= $capacity; $i++)
        {
            $this->data[$i] = 0;
        }
        $this->front = 0;
        $this->tail = 0;
        $this->size = 0;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function isEmpty()
    {
        return $this->tail == $this->front;
    }

    public function getCapacity()
    {
        return count($this->data) -1;
    }

    // 入队列
    public function enqueue($e)
    {
        // 判断队列是否已满
        if(($this->tail+1)%count($this->data) == $this->front)
        {
            $this->resize($this->getCapacity() * 2);
        }

        $this->data[$this->tail] = $e;
        $this->tail = ($this->tail+1)%count($this->data);
        $this->size += 1;
    }

    // 出队列
    public function dequeue()
    {
        if(!$this->data)
            throw new \Exception("Cannot dequeue from an empty queue.");
        $ret = $this->data[$this->front];
        $this->data[$this->front] = 0;
        $this->front = ($this->front+1)%count($this->data);
        $this->size -= 1;
        if($this->size == intval($this->getCapacity() /4) && intval($this->getCapacity() / 2) != 0)
            $this->resize($this->getCapacity() / 2);
        return $ret;
    }

    // 扩容/缩容
    private function resize($capacity)
    {
        $data = [];
       for($i = 0; $i< $capacity+1; $i++)
       {
           $data[] = 0;
       }
       for($i = 0; $i< $this->size; $i++)
       {
           $data[$i] = $this->data[($i+$this->front)%count($data)];
       }
       $this->data = $data;
       $this->front = 0;
       $this->tail = $this->size;
    }

    // 获取队首的元素
    public function getFront()
    {
        // TODO: Implement getFront() method.
        if($this->isEmpty())
            throw new \Exception("Queue is empty");
        return $this->data[$this->front];
    }

    public function __toString()
    {
        $res = sprintf('Queue:size = %d，capacity = %d'.PHP_EOL, $this->size, $this->getCapacity());
        $res .= "front [";
        $i = $this->front;
        while (true)
        {
            if($i == $this->tail)
                break;
            $res .= $this->data[$i];
            if(intval($i+1) % count($this->data) != $this->tail)
                $res .= ",";
            $i = intval($i +1 ) % count($this->data);
        }
        $res .= "] tail";
        return $res.PHP_EOL;
    }
}

$loopQueue = new LoopQueue();
for($i = 0; $i < 10; $i++)
{
    $loopQueue->enqueue($i);
    print($loopQueue);
    if($i % 3 == 2){
        $loopQueue->dequeue();
        print($loopQueue);
    }
}