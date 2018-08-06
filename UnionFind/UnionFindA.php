<?php
/**
 * Created by PhpStorm.
 * User: tom
 * Date: 2018/8/6
 * Time: 10:43
 */
require_once "UF.php";

/** 使用数组实现并查集
 * Class UnionFindA
 */
class UnionFindA implements UF
{
    private $id=[];
    public function __construct($size)
    {
        for ($i = 0; $i < $size; $i++)
            $this->id[$i] = $i;
    }

    public function getSize()
    {
        // TODO: Implement getSize() method.
        return count($this->id);
    }

    /** 合并元素p和元素q所对应的集合编号
     *  O(n) 复杂度
     * @param $p
     * @param $q
     */
    public function unionElements($p, $q)
    {
        // TODO: Implement unionElements() method.
        $pID = $this->find($p);
        $qID = $this->find($q);

        $count = count($this->id);
        for ($i = 0; $i < $count; $i++) {
            if ($this->id[$i] == $pID)
                $this->id[$i] = $qID;
        }
    }

    /** 查找元素p和元素q是否所属一个集合
     *  O(1)复杂度
     * @param $p
     * @param $q
     */
    public function isConnected($p, $q)
    {
        // TODO: Implement isConnected() method.
        return $this->find($p) == $this->find($q);
    }

    private function find($p)
    {
        try
        {
            if ($p < 0 && $p >= count($this->id))
                throw new Exception("p is out of bound.");
        }catch (Exception $e) {
            print($e->getMessage());
            return;
        }
        return $this->id[$p];
    }
}