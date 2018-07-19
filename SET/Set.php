<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/7/19
 * Time: 7:53
 */

/**
 * Interface Set 集合
 */
interface Set
{
    public function add($e);
    public function remove($e);
    public function contains($e);
    public function getSize();
    public function isEmpty();
}