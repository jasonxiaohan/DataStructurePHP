<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/7/24
 * Time: 8:05
 */

require_once "../ARRAY/ArrayList.php";

/** 最大堆
 * Class MaxHeap
 */
class MaxHeap
{
    private $data = null;

    public function __construct($capacity=10, $arr=null)
    {
        $this->data = new ArrayList($capacity, $arr);
        if($arr != null)
        {
            $len = count($arr);
            for ($i = $len; $i >= 0; $i--)
                $this->siftDown($i);
        }
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        $res = sprintf("Array:size = %d, capacity = %d", $this->size(), $this->data->getCapacity()).PHP_EOL;
        $res .= "[";
        for ($i = 0; $i < $this->data->getSize(); $i++)
        {
            $res .= $this->data->get($i);
            if($i != $this->data->getSize() - 1)
                $res .= ",";
        }
        $res .= "]".PHP_EOL;
        return $res;
    }

    public function size()
    {
        return $this->data->getSize();
    }

    public function isEmpty()
    {
        return $this->data->isEmpty();
    }

    /** 返回二叉树的数组表示中，一个索引所表示的元素父亲节点的索引
     * @param $index
     */
    private function parent($index)
    {
        try
        {
            if ($index == 0){
                throw new Exception("index-0 doesn't have parent.");
            }
        }catch (Exception $e) {
            print $e->getMessage();
        }
        return intval(($index - 1)/2);
    }

    /** 返回二叉树的数组表示中，一个索引所表示的元素的左孩子节点的索引
     * @param $index
     * @return float|int
     */
    private function leftChild($index)
    {
        return ($index * 2) + 1;
    }

    /** 返回二叉树的数组表示中，一个索引所表示的元素的右孩子节点的索引
     * @param $index
     * @return float|int
     */
    private function rightChild($index)
    {
        return ($index * 2) + 2;
    }

    /** 向堆中添加元素
     * @param $e
     */
    public function add($e)
    {
        $this->data->addLast($e);
        $this->siftUp($this->data->getSize()-1);
    }

    private function siftUp($k)
    {
        while ($k > 0 && $this->data->get($this->parent($k)) < $this->data->get($k))
        {
            $this->data->swap($k, $this->parent($k));
            $k = $this->parent($k);
        }
    }

    public function findMax()
    {
        try{
            if ($this->data->getSize() == 0)
                throw new Exception("Can not findMax when heap is empty.");
        } catch (Exception $e)
        {
            print $e->getMessage();
        }
        return $this->data->get(0);
    }

    public function extractMax()
    {
        $ret = $this->findMax();
        $this->data->swap(0, $this->data->getSize() - 1);
        $this->data->removeLast();
        $this->siftDown(0);
        return $ret;
    }

    private function siftDown($k)
    {
        while ($this->leftChild($k) < $this->data->getSize())
        {
            $j = $this->leftChild($k);
            if ($j+1 < $this->data->getSize() && $this->data->get($j+1) > $this->data->get($j))
                $j++;

            // $this->data[j]是leftChild 和 rightChild中的最大值
            if ($this->data->get($k) > $this->data->get($j))
                break;
            $this->data->swap($k, $j);
            $k = $j;
        }
    }
}

/*$maxHeap = new MaxHeap();
$n = 100;
for ($i = 0; $i < $n ; $i++)
{
   $maxHeap->add(rand(1000, 1000000));
}
$data = [];
for ($i = 0; $i < $n; $i++)
{
    $data[$i] = $maxHeap->extractMax();
}
for ($i = 1; $i < $n; $i++)
{
    try{
        if($data[$i - 1] < $data[$i])
            throw new Exception("Error：".$data[$i-1]." prev：".$data[$i]);
    } catch (Exception $e) {
        print "An exception：".$e->getMessage();
    }
}
print("Test MaxHeap completed.");*/