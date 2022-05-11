<?php

use think\Db;

use app\common\model\Rules;

class Rule
{
  public static function backend(){
    $instance = new self();
    $instance->data = Rules::backend();
    return $instance;
  }
  public static function frontend(){
    $instance = new self();
    $instance->data = Rules::frontend();
    return $instance;
  }

  public function rules($data = [], $pid = 0){
    if ($data === []){
      $data = $this->data;
    }
    $result = [];
    foreach ($data as $item){
      // 解析图标 
      $item['icon'] = parse_icon($item['icon']);
              $item['rule'] = url($item['rule']);
      if ($item['pid'] == $pid){
        // 获取当前项的子菜单
        $children = self::rules($data, $item['id']);
        // 如果含有子菜单
        if ($children) {
          // 加入子菜单到children节点
          $item['children'] = $children; 
        }
        // 如果有子节点，设置type为0，反之为1
        $item['type'] = !$children;
        // 如果有子节点，设置href为空，否则为当前项的规则地址
        $item['href'] = $children ? '' : $item['rule'];
        $result[] = $item;
      }
    }
    return collection($result)->toArray();
  }
  
  public function tree(&$rules = [], $r = 0, &$result = []){
    $rules = ($rules === []) ? self::rules() : $rules;

    foreach ($rules as $i => &$rule){
      $is_end = $i === count($rules) - 1;

      $temp = $rule;
      $temp['spacer'] = spacer($is_end, $r, true);
      $temp['title'] = sprintf('%s%s', $temp['spacer'], $temp['title']);
      unset($temp['children']);
      $result[] = $temp;
      if (isset($rule['children'])){
        self::tree($rule['children'], $r+1, $result);
      }
    }
    
    return collection($result)->toArray();
  }

}
