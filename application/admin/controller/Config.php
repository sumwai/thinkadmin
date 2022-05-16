<?php

namespace app\admin\controller;

use function file_get_contents;

class Config
{
  function pear(){
    // FIXME: 这里需要改为由数据库获取数据
    return file_get_contents(ROOT_PATH . '/config/pear/backend.yaml');
  }

} 
