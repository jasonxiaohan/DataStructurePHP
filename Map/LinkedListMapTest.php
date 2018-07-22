<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/7/22
 * Time: 16:43
 */

require_once "LinkedListMap.php";
class LinkedListMapTest extends PHPUnit_Framework_TestCase
{
    public $map=null;
    public function __construct()
    {
        $this->map = new LinkedListMap();
        $this->map->add("The", 1);
        $this->map->set("The", 11);
        $this->map->add("And", 1);
        $this->map->set("And",11);
    }

    public function testContains()
    {
        $this->assertEquals($this->map->contains("The"),new Node('The', 11, null));
    }

    public function testIsEmpty()
    {

    }

    public function testGetSize()
    {

    }

    public function testRemove()
    {

    }

    public function testGet()
    {

    }
}
