<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/8/1
 * Time: 18:43
 */

class Node
{
    public $next = [];
    public $isWorld = false;

    public function __construct()
    {
        $this->next = array();
        $this->isWorld = false;
    }
}

class Trie
{
    public $root = null;
    public $size = 0;

    public function __construct()
    {
        $this->root = new Node();
    }

    /**
     *  获取Trie中存储的单词数量
     */
    public function getSize()
    {
        return $this->size;
    }

    /** 向Trie中添加单词word
     * @param $word
     */
    public function add($word)
    {
        $cur = $this->root;
        for ($i = 0; $i < strlen($word); $i++) {
            if ($cur->next[$word[$i]] == null)
                array_push($this->next, $word[$i]);
            $cur = $cur->next[$word[$i]];
        }
        if ($cur->isWorld == false) {
            $cur->isWorld = true;
            $this->size += 1;
        }
    }
}
