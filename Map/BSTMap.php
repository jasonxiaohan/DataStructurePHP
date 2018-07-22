<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/7/22
 * Time: 16:53
 */
require_once "Map.php";

class BinaryNode
{
    public $key,$value = null;
    public $left,$right = null;

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }
}

class BSTMap implements Map
{
    public $root = null;
    public $size = 0;

    public function __construct()
    {
        $this->size = 0;
    }

    public function add($key, $value)
    {
        // TODO: Implement add() method.
        $this->root = $this->__add($this->root, $key, $value);
    }

    private function __add($node, $key, $value)
    {
        if ($node == null) {
            $this->size += 1;
            return new BinaryNode($key, $value);
        }
        if ($key < $node->key) {
            $node->left = $this->__add($node->left, $key, $value);
        } elseif ($key > $node->key) {
            $node->right = $this->__add($node->right, $key, $value);
        }
        return $node;
    }

    public function remove($key)
    {
        // TODO: Implement remove() method.
        $node = $this->getNode($this->root, $key);
        if($node != null)
        {
            $this->root = $this->__remove($this->root, $key);
            return $node;
        }
        return null;
    }

    public function contains($key)
    {
        // TODO: Implement contains() method.
        return $this->getNode($this->root, $key) != null;
    }

    public function get($key)
    {
        // TODO: Implement get() method.
        $node = $this->getNode($this->root, $key);
        return $node != null ? $node->value : null;
    }

    public function set($key, $value)
    {
        // TODO: Implement set() method.
        $node = $this->getNode($this->root, $key);
        if($node == null)
        {
            throw new Exception($key+" doesn't exist!");
        }
        $node->value = $value;
    }

    public function getSize()
    {
        // TODO: Implement getSize() method.
        return $this->size;
    }

    public function isEmpty()
    {
        // TODO: Implement isEmpty() method.
        return $this->size == 0;
    }

    public function getNode($node, $key)
    {
       if($node == null)
           return null;
       if($key == $node->key)
       {
           return $node;
       }
       if($key < $node->key){
           return $this->getNode($node->left, $key);
       }else
           return $this->getNode($node->right, $key);
    }

    // 寻找二分搜索树的最小元素
    public function minimum()
    {
        if($this->size == 0)
            throw new Exception("BST is empty.");
        return $this->__minimum($this->root)->key;
    }

    private function __minimum($node)
    {
        if($node->left == null)
            return $node;
        return $this->__minimum($node->left);
    }

    // 从二分搜索树中删除最小值所在节点，返回最小值
    public function removeMin()
    {
        $e = $this->minimum();
        $this->root = $this->__removeMin($this->root);
        return $e;
    }

    // 删除以node为根的二分搜索树中的最小节点
    // 返回删除节点后新的二分搜索树的根
    private function __removeMin($node)
    {
        if($node->left == null)
        {
            $rightNode = $node->right;
            $node->right = null;
            $this->size -= 1;
            return $rightNode;
        }
        $node->left = $this->__removeMin($node->left);
        return $node;
    }

    // 删除以node为根的二分搜索树中值为e的节点，递归算法
    // 返回删除节点后新的二分搜索树的根
    private function __remove($node, $key)
    {
        if($node == null)
            return null;
        if($key < $node->key)
        {
            $node->left = $this->__remove($node->left, $key);
            return $node;
        }
        elseif ($key > $node->key)
        {
            $node->right = $this->__remove($node->right, $key);
            return $node;
        }
        else {
            // 待删除节点左子树为空的情况
            if($node->left == null)
            {
                $nodeRight = $node->right;
                $node->right = null;
                $this->size -= 1;
                return $nodeRight;
            }
            // 待删除节点右子树为空的情况
            if($node->right == null)
            {
                $nodeLeft = $node->left;
                $this->size -= 1;
                $node->left = null;
                return $nodeLeft;
            }

            // 待删除节点左右子树均不为空的情况

            // 找到比待删除节点大的最小节点, 即待删除节点右子树的最小节点
            // 用这个节点顶替待删除节点的位置

            $successor = $this->__minimum($node->right);
            $successor->right = $this->__removeMin($node->right);
            $successor->left = $node->left;
            $node->right = $node->left = null;
            return $successor;
        }
    }
}

$map = new BSTMap();
$map->add("The", 1);
$map->add("And", 2);
$map->remove("The");
print $map->getSize().PHP_EOL;
print $map->get("And").PHP_EOL;
$map->set("And", "2323");
print $map->get("And");