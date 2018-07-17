<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/7/16
 * Time: 22:16
 */
namespace Home\Interfaces;

interface Stack
{
    /**
     *  获取栈的大小
     * @return mixed
     */
    public function getSize();

    /** 判断栈是否为空
     * @return mixed
     */
    public function isEmpty();

    /** 写入栈元素
     * @param $e
     * @return mixed
     */
    public function push($e);

    /** 弹出栈元素
     * @return mixed
     */
    public function pop();

    /** 获取栈顶元素
     * @return mixed
     */
    public function peek();

}