<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/8/2
 * Time: 10:19
 */

require_once __DIR__."/vendor/autoload.php";

use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Finalseg;

class FileOperation
{
    public static function readFile($filename, &$words)
    {
       if (empty($filename) &&  empty($words)) {
           print "filename is null or words is null";
           return false;
       }

       if (!file_exists($filename)) {
           print "filename is not exists.";
           return false;
       }

        try {
            $data = file($filename);
        }catch (Exception $e) {
           print "Cannot open"+$filename;
           return false;
        }

        // 简单分词
        ini_set("memory_limit", "1024M");
        Jieba::init();
        Finalseg::init();

        foreach($data as $key=>$val) {
            $seg_list = Jieba::cut($val);
            foreach ($seg_list as $k=>$v) {
                if(trim($v) != "" && !in_array(trim($v), ['.',',',';',':','\'']))
                    $words[] = trim($v);
            }
        }
    }
}
