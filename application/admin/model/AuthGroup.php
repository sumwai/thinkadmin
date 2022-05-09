<?php

namespace app\admin\model;

use think\Model;
use function explode;

class AuthGroup extends Model
{
  protected $name = 'auth_group';
  protected $pk = 'id';

  public function getRulesAttr($value = ''){
    $ids = explode(',', $value);
    return Rules::getRuleTitles($ids);
  }

}
