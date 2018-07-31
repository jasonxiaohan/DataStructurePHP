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

    /** 返回区间[queryL, queryR]的值
     * @param $queryL
     * @param $queryR
     */
    public function query($queryL, $queryR)
    {
        try
        {
            if ($queryL < 0 || $queryL >= count($this->data) || $queryR < 0 || $queryR >= count($this->data) || $queryL > $queryR)
                throw new Exception("Index is illegal.");
        }catch (Exception $e){
            print $e->getMessage();
            return;
        }
        return $this->__query(0, 0, count($this->data) - 1, $queryL, $queryR);
    }

    /** 在以treeID为根的线段树中[l....r]的范围里，搜索区间[queryL,queryR]的值
     * @param $treeIndex
     * @param $l
     * @param $r
     * @param $queryL
     * @param $queryR
     */
    private function __query($treeIndex, $l, $r, $queryL, $queryR)
    {
        if ($l == $queryL && $r == $queryR) {
            return $this->tree[$treeIndex];
        }
        $mid = intval($l + ($r - $l)/2);
        $leftTreeIndex = $this->leftChild($treeIndex);
        $rightTreeIndex = $this->rightChild($treeIndex);

        if ($queryL >= intval($mid + 1))
            return $this->__query($rightTreeIndex, $mid + 1, $r, $queryL, $queryR);
        if ($queryR <= $mid)
            return $this->__query($leftTreeIndex, $l, $mid, $queryL, $queryR);

        $leftResult = $this->__query($leftTreeIndex, $l, $mid, $queryL, $mid);
        $rightResult = $this->__query($rightTreeIndex, $mid + 1, $r, $mid + 1, $queryR);
        return $this->merger->merge($leftResult, $rightResult);
    }

    /**  将index位置的值，更新为e
     * @param $index
     * @param $e
     */
    public function set($index, $e)
    {
        $this->__set(0, 0, count($this->data) - 1, $index, $e) ;
    }

    private function __set($treeIndex, $l, $r, $index, $e)
    {
        if ($l == $r) {
            $this->tree[$index] = $e;
            return;
        }
        $leftTreeIndex = $this->leftChild($treeIndex);
        $rightTreeIndex = $this->rightChild($treeIndex);

        $mid = intval($l + ($r - $l) / 2);
        if ($index >= ($mid + 1))
            $this->__set($rightTreeIndex, $mid + 1, $r, $index, $e);
        else
            $this->__set($leftTreeIndex, $l, $mid, $index, $e);
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