<?php

namespace app\admin\model;

use app\common\model\Backend;

class AuthGroup extends Backend 
{
  protected $name = 'auth_group';
  protected $pk = 'id';

  public function getRulesAttr($value = ''){
    $ids = explode(',', $value);
    return \app\common\model\Rules::getRuleTitles($ids);
  }

}
