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

    public function add($word){
        // 递归实现
//        $this->__add($word,strlen($word), $this->root, 0);
        $cur = $this->root;
        for ($i = 0; $i < strlen($word); $i++) {
            if (!isset($cur->next[$word[$i]]))
                $cur->next[$word[$i]] = new Node();
            $cur = $cur->next[$word[$i]];
        }
        if ($cur->isWorld == false) {
            $cur->isWorld = true;
            $this->size += 1;
        }
    }

    /** 向Trie中添加单词word
     * @param $word
     */
    private function __add($word, $len, $node, $index)
    {
        if($len == $index){
            if($node->isWorld == false) {
                $node->isWorld = true;
                $this->size += 1;
            }
            return;
        }
       if(!isset($node->next[$word[$index]])) {
           $node->next[$word[$index]] = new Node();
       }
       $this->__add($word, $len, $node->next[$word[$index]], $index + 1);
    }

    /** 检查单词是否存在于prefix中
     * @param $word
     * @return bool|int
     */
    public function contains($word)
    {
        $cur = $this->root;
        for ($i = 0; $i < strlen($word); $i++) {
            if (!isset($cur->next[$word[$i]]))
                return false;
            $cur = $cur->next[$word[$i]];
        }
        return $cur->isWorld;
    }

    /** 查询是否在Trie中有单词以prefix为前缀
     * @param $prefix
     */
    public function isPrefix($prefix)
    {
        $cur = $this->root;
        for ($i = 0; $i < strlen($prefix); $i++) {
            if (!isset($cur->next[$prefix[$i]]))
                return false;
            $cur = $cur->next[$prefix[$i]];
        }
        return true;
    }

    /** 以搜索文字或正则表达式字符串，字符串只包含字母 . 或 a-z 。 . 可以表示任何一个字母
     * @param $word
     * @return bool
     */
    public function search($word)
    {
        return $this->match($this->root, $word, 0);
    }

    private function match($node, $word, $index)
    {
        if (strlen($word) == $index) {
            return $node->isWorld;
        }
        $c = $word[$index];
        if ($c != ".") {
            if (!isset($node->next[$c]))
                return false;
            return $this->match($node->next[$c], $word, $index+1);
        } else {
            $keys = array_keys($node->next);
            foreach ($keys as $key) {
                if ($this->match($node->next[$key], $word, $index+1))
                    return true;
            }
            return false;
        }
    }
}