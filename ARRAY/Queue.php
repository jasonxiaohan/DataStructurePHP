<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/15
 * Time: 20:28
 */

namespace Home\Interfaces;
interface Queue
{
   public function getSize();

   // 判断队列是否为空
   public function isEmpty();

   // 入队列
   public function enqueue($e);

   // 出队列
   public function dequeue();

   // 获取队首的元素
   public function getFront();
}