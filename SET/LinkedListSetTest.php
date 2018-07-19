<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/7/19
 * Time: 18:16
 */

require_once "LinkedListSet.php";
class LinkedListSetTest extends PHPUnit_Framework_TestCase
{
    public $set;
    public function __construct()
    {
        $this->set = new LinkedListSet();
        $this->set->add(1);
        $this->set->add(1);
        $this->set->add(2);
        $this->set->add(3);
    }

    public function testGetSize()
    {
        $this->set->remove(2);
        $this->assertEquals(2, $this->set->getSize());
    }

    public function testIsEmpty()
    {
        $this->assertEquals(false, $this->set->isEmpty());
    }

    public function testContains()
    {
        $this->assertEquals(true, $this->set->contains(1));
    }
}
