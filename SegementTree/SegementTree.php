<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/7/29
 * Time: 22:00
 */

/** 线段树
 * Class SegementTree
 */
require_once "Merger.php";

class SegementTree
{
    private $data = [];
    private $tree = [];
    private $merger;
    public function __construct($arr, $merger)
    {
        for ($i = 0; $i < count($arr); $i++)
            $this->data[$i] = $arr[$i];
        for ($i = 0; $i < 4 * count($arr); $i++)
            $this->tree[$i] = null;
        $this->merger = $merger;
        $this->buildSegementTree(0, 0, count($arr) - 1);
    }

    /** 在treeIndex位置创建表示区间[l...r]的线段树
     * @param $treeIndex
     * @param $l
     * @param $r
     */
    private function buildSegementTree($treeIndex, $l, $r)
    {
        if ($l == $r){
            $this->tree[$treeIndex] = $this->data[$l];
            return;
        }
        $leftTreeIndex = $this->leftChild($treeIndex);
        $rightTreeIndex = $this->rightChild($treeIndex);
        $mid = intval($l + (($r - $l) / 2));
        $this->buildSegementTree($leftTreeIndex, $l, $mid);
        $this->buildSegementTree($rightTreeIndex, $mid + 1, $r);
        $this->tree[$treeIndex] = $this->merger->merge($this->tree[$leftTreeIndex], $this->tree[$rightTreeIndex]);
    }

    /** 返回二叉树的数组表示中，一个索引所表示的元素左孩子节点的索引
     * @param $index
     */
    private function leftChild($index) {
        return intval((2 * $index) + 1);
    }

    /** 返回二叉树的数组表示中，一个索引所表示的元素右孩子节点的索引
     * @param $index
     */
    private function rightChild($index){
        return intval((2 * $index) + 2);
    }

    public function get($index) {
        try
        {
            if($index < 0 || $index > count($this->data))
                throw new Exception("index is illegal.");
        } catch (Exception $e) {
            print $e->getMessage();
            return;
        }
    }

    public function getSize() {
        return count($this->data);
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        $res = "[";
        $count = count($this->tree);
        foreach ($this->tree as $key=>$val) {
            if($val !== null) {
                $res .= $val;
            } else {
                $res .= "null";
            }
            if($key != $count - 1)
                $res .= " , ";
        }
        $res .= "]";
        return $res;
    }
}