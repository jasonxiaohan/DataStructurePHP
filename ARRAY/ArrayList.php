<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/7/23
 * Time: 22:54
 */

/**
 *  实现array数组底层结构
 * Class ArrayList
 */
class ArrayList{
    private $data = [];
    private $size;

    public function __construct($capacity=10)
    {
        for ($i = 0; $i < $capacity; $i++)
        {
            $this->data[$i] = 0;
        }
        $this->size = 0;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        $res = sprintf("Array:size = %d, capacity = %d",$this->size, count($this->data)).PHP_EOL;
        $res .="[";
        for ($i = 0; $i < $this->size; $i++){
            $res.= $this->data[$i];
            if($i != $this->size - 1)
                $res .= ",";
        }
        $res .= "]";
        return $res.PHP_EOL;
    }

    /**
     *  获取数组的容量
     */
    public function getCapacity()
    {
        return count($this->data);
    }

    /** 获取数组中元素的个数
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /** 返回数组是否为空
     * @return bool
     */
    public function isEmpty()
    {
        return $this->size == 0;
    }

    /**
     * 在所有元素前添加一个新元素
     */
    public function addFirst($e)
    {
        $this->add(0, $e);
    }

    public function addLast($e)
    {
        $this->add($this->size, $e);
    }

    /** 在第index位置插入一个元素e
     * @param $index
     */
    public function add($index, $e)
    {
        if ($index < 0 || $index > $this->size){
            try
            {
                throw new Exception("Add failed.Require index >=0 and index < size.");
            } catch(Exception $e) {
                print($e->getMessage());
            }
        }

        if($this->size == intval(count($this->data) - 1))
        {
            $this->resize(count($this->data) * 2);
        }

        for ($i = $this->size - 1; $i >= $index; $i--){
            $this->data[$i+1] = $this->data[$i];
        }
        $this->data[$index] = $e;
        $this->size++;
    }

    /** 动态数组扩容/缩容
     * @param $capacity
     */
    private function resize($capacity)
    {
        $newData = [];
        for ($i = 0; $i < $capacity; $i++)
        {
            $newData[$i] = $i <= count($this->data) - 1 ? $this->data[$i]:0;
        }
        $this->data = $newData;
        unset($newData);
    }

    /** 读取index位置的索引
     * @param $index
     */
    public function get($index)
    {
        try
        {
           if ($index < 0 || $index >= $this->size)
               throw new Exception("Get Failed.Index is illegal.");
        }catch (Exception $e)
        {
            print($e->getMessage());
        }
        return $this->data[$index];
    }

    public function getFirst()
    {
        return $this->get(0);
    }

    public function getLast()
    {
        return $this->get($this->size-1);
    }

    /** 修改index索引位置的元素为e
     * @param $index
     * @param $e
     */
    public function set($index, $e)
    {
        try
        {
            if ($index < 0 || $index >= $this->size)
                throw new Exception("Set Failed.Index is illegal.");
        }catch (Exception $e)
        {
            print($e->getMessage());
        }
        $this->data[$index] = $e;
    }

    /** 查询数组中是否有元素e
     * @param $e
     */
    public function contains($e)
    {
        for($i= 0; $i < $this->size; $i++)
        {
            if ($this->data[$i] == $e)
                return true;
        }
        return false;
    }

    /** 查找数组中元素e所在的索引，如果不存在元素e，则返回-1
     * @param $e
     */
    public function find($e)
    {
        for ($i = 0; $i < $this->size; $i++)
        {
            if($this->data[$i] == $e)
                return $i;
        }
        return -1;
    }

    /** 从数组中删除index位置的元素，并且返回删除的元素
     * @param $index
     */
    public function remove($index)
    {
        try
        {
            if ($index < 0 || $index >= $this->size)
                throw new Exception("Remove Failed.Index is illegal.");
        }catch (Exception $e)
        {
            print($e->getMessage());
        }

        $res = $this->data[$index];
        for($i = $index + 1; $i < $this->size; $i++)
            $this->data[$i-1] = $this->data[$i];
        $this->size--;
        if (intval($this->size) == intval(count($this->data)/4))
        {
            $this->resize(intval(count($this->data)/2));
        }
        return $res;
    }

    /** 从数组中删除第一个元素，返回删除的元素
     * @return mixed
     */
    public function removeFirst()
    {
        return $this->remove(0);
    }

    /** 从数组中删除最后一个元素，返回删除的元素
     * @return mixed
     */
    public function removeLast()
    {
        return $this->remove($this->size - 1);
    }

    /** 从数组中删除元素e
     * @param $e
     */
    public function removeElement($e)
    {
        $index = $this->find($e);
        if ($index != -1)
            $this->remove($index);
    }

    /** 元素i和元素j进行交换
     * @param $i
     * @param $j
     */
    public function swap($i, $j)
    {
        try{
            if ($i < 0 || $i >= $this->size || $j < 0 || $j >= $this->size)
                throw new Exception("Index is illegal.");
        }catch (Exception $e){
            print $e->getMessage();
        }
        $t = $this->data[$i];
        $this->data[$i] = $this->data[$j];
        $this->data[$j] = $t;
    }
}

//$list = new ArrayList(2);
//$list->addLast(11);
//$list->addLast(22);
//print $list;
//$list->addLast(33);
//print $list;
//$list->addLast(44);
//print $list;
//$list->addLast(55);
//$list->addLast(66);
//print $list;
//$list->addLast(77);
//print $list;
//$list->remove(0);
//print $list;
//$list->addLast(88);
//print $list;
//$list->addLast(99);
//print $list;
//$list->addLast(100);
//print $list;
