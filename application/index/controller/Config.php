<?php


namespace app\index\controller;

use think\Db;
use function file_get_contents;
use function json_decode;
use function json_encode;
use Rule;

class Config
{

  function test(){
    dump(Rule::rules());
  }
  
  
  function menu(){
    header("Content-type: application/json; charset=utf-8");
    return json(Rule::rules());
  }

  function pear(){
    return file_get_contents(ROOT_PATH . '/application/pear.yaml');
  }

}
