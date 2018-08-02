<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/8/2
 * Time: 8:21
 */

require_once "Trie.php";

class TrieTest extends PHPUnit_Framework_TestCase
{

    public $trie;
    public function __construct()
    {
        $this->trie = new Trie();
        $this->trie->add("bad");
        $this->trie->add("dad");
        $this->trie->add("mad");
    }

    public function testGetSize()
    {
        $this->assertEquals($this->trie->getSize(), 3);
    }

    public function testIsPrefix()
    {
        $this->assertEquals($this->trie->isPrefix("p"), true);
    }

    public function testContains()
    {
        $this->assertEquals($this->trie->contains("java"), true);
    }

    public function testSearch()
    {
        $this->assertEquals($this->trie->search("b.."), true);
    }
}
