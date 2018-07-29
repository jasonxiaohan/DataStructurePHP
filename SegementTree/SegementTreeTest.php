<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/7/29
 * Time: 22:25
 */

require_once "Merger.php";
require_once "SegementTree.php";

class SegementTreeTest implements Merger
{
    public function merge($a, $b)
    {
        // TODO: Implement merge() method.
        return $a + $b;
    }
}
$nums = [-2, 0, 3, -5, 2, -1];
$segmentTreeTest = new SegementTreeTest();
$segmentTree = new SegementTree($nums, $segmentTreeTest);
print $segmentTree;