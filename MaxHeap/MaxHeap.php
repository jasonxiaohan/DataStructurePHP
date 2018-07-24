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

    public function __construct($capacity)
    {
        for ($i = 0; $i < $capacity; $i++)
            $this->data[$i] = 0;
    }

    public function size()
    {
        return count($this->data);
    }

    public function isEmpty()
    {
        return $this->data == null;
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
     */
    private function leftChild($index)
    {
        
    }
}