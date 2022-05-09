<?php

namespace app\admin\model;

use think\Model;

class Rules extends Model
{
  protected $name = 'rules';
  protected $pk = 'id';

  public static function getRuleTitles($ids = [], $sep = ','){
    $instance = new self();
    $data = $instance->where('id', 'in', $ids)->where('pid', 0)->select();
    $result = [];
    foreach ($data as $item){
      $result[] = $item['title'];
      $titles[$item['id']] = $item['title'];
    }

    return implode($sep, $result);
  }
}
