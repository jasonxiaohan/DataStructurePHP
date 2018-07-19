<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/7/16
 * Time: 22:21
 */

namespace Home\Interfaces;

include 'Node.php';

class LinkedList
{
    // 虚拟头节点
    private $dummyHead = null;
    // 链表元素个数
    private $size = 0;

    public function __construct()
    {
        $this->dummyHead = new Node(null, null);
    }

    /** 获取链表的元素数量
     * @return mixed|void
     */
    public function getSize()
    {
        return $this->size;
    }

    /** 返回链表是否为空
     * @return mixed|void
     */
    public function isEmpty()
    {
        return $this->size == 0;
    }

    /** 在链表index(0-based)位置添加新的元素e
     * @param $index
     * @param $e
     * @throws \Exception
     */
    public function add($index, $e)
    {
        if($index < 0 || $index > $this->size)
            throw new \Exception("Add failed.Illegal index.");
        $prev = $this->dummyHead;
        for($i=0;$i<$index;$i++)
        {
            $prev = $prev->next;
        }
        $prev->next = new Node($e, $prev->next);
        $this->size += 1;
    }

    /** 在链表头部添加元素e
     * @param $e
     */
    public function addFirst($e)
    {
       $this->add(0, $e);
    }

    /** 在链表末尾添加元素e
     * @param $e
     */
    public function addLast($e)
    {
        $this->add($this->size, $e);
    }

    /** 获得链表的第index(0-based)个位置的元素
     * @param $index
     */
    public function get($index)
    {
        if($index < 0 || $index > $this->size)
            throw new \Exception("Get failed.Illegal index.");
        $cur = $this->dummyHead;
        for($i=0; $i< $index; $i++)
        {
            $cur = $cur->next;
        }
        return $cur->e;
    }

    /**
     * 获得链表的第一个元素
     */
    public function getFirst()
    {
        return $this->get(0);
    }

    /**
     * 获得链表的最后一个元素
     */
    public function getLast()
    {
        return $this->get($this->size - 1);
    }

    /** 查找链表中是否含有元素e
     * @param $e
     */
    public function contains($e)
    {
        $cur = $this->dummyHead->next;
        while ($cur != null)
        {
            if($cur->e == $e)
                return true;
            $cur = $cur->next;
        }
        return false;
    }

    /** 从链表中删除index(0-based)位置的元素，返回删除的元素
     * @param $index
     */
    public function remove($index)
    {
        if($index < 0 || $index > $this->size)
            throw new \Exception("remove failed.Illegal index.");
        $prev = $this->dummyHead;
        for($i = 0; $i < $index; $i++)
        {
            $prev = $prev->next;
        }
        $retNode = $prev->next;
        $prev->next = $retNode->next;
        $retNode->next = null;
        $this->size -= 1;
        return $retNode->e;
    }

    /**
     *  从链表删除第一个元素，并返回删除的元素
     */
    public function removeFirst()
    {
        return $this->remove(0);
    }

    /**
     *  从链表中删除最后一个元素，并返回删除的元素
     */
    public function removeLast()
    {
        return $this->remove($this->size - 1);
    }

    /** 从链表中删除元素e
     * @param $e
     */
    public function removeElement($e)
    {
        $prev = $this->dummyHead;
        while ($prev->next != null) {
            if($prev->next->e == $e)
                break;
            $prev = $prev->next;
        }
        if($prev->next != null) {
           $node = $prev->next;
           $prev->next = $node->next;
           $node->next = null;
           $this->size -= 1;
        }
    }

    public function __toString()
    {
        $res = "";
        $prev = $this->dummyHead;
        while ($prev->next != null)
        {
           $res .= (string)$prev->next."->";
           $prev = $prev->next;
        }
        $res .= "NULL";
        return $res.PHP_EOL;
    }
}

/*$linkedList = new LinkedList();
for($i = 0; $i < 5; $i++)
{
    $linkedList->addFirst($i);
    print($linkedList);
}
$linkedList->add(2, 666);
print $linkedList;
$linkedList->remove(2);
print $linkedList;
$linkedList->removeFirst();
print $linkedList;
$linkedList->removeLast();
print $linkedList;*/

