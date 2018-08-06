<?php
/**
 * Created by PhpStorm.
 * User: tom
 * Date: 2018/8/6
 * Time: 11:27
 */

require_once "UF.php";

class UnionFindD implements UF
{
    private $parent = [];
    private $rank = [];

    public function __construct($size)
    {
        for ($i = 0; $i < $size; $i++){
            $this->parent[$i] = $this->rank[$i] = $i; # rank[i]表是以i为根的集合所表示的树的层数
        }
    }

    public function getSize()
    {
        // TODO: Implement getSize() method.
        return count($this->parent);
    }

    /** 合并元素p和元素q所属的集合
     *  O(h)复杂度，h为树的高度
     * @param $p
     * @param $q
     */
    public function unionElements($p, $q)
    {
        // TODO: Implement unionElements() method.
        $pRoot = $this->find($p);
        $qRoot = $this->find($q);

        if ($pRoot == $qRoot)
            return;
        if ($this->rank[$pRoot] < $this->rank[$qRoot]) {
            $this->parent[$pRoot] = $qRoot;
        } elseif ($this->rank[$qRoot] < $this->rank[$pRoot]) {
            $this->parent[$qRoot] = $pRoot;
        }else {
            $this->parent[$qRoot] = $pRoot;
            $this->rank[$pRoot] += 1;
        }
    }

    /** 查找元素p和元素q是否属于同一集合
     * O(h)复杂度，h为树的高度
     * @param $p
     * @param $q
     * @return bool
     */
    public function isConnected($p, $q)
    {
        // TODO: Implement isConnected() method.
        return $this->find($p) == $this->find($q);
    }

    /** 查找过程，查找元素p所对应的集合
     * O(h)复杂度，h为树的高度
     * @param $p
     */
    private function find($p)
    {
        try
        {
            if ($p < 0 && $p >= count($this->parent))
                throw new Exception("p is out of bound.");
        }catch (Exception $e) {
            print($e->getMessage());
            return;
        }
        while ($p != $this->parent[$p])
            $p = $this->parent[$p];
        return $p;
    }
}