<?php

use think\Db;

use app\admin\model\Rules;

class Rule
{


  public static function rules($data = [], $pid = 0){

    if ($data === []){
      $data = Rules::select(); 
    }

    $result = [];
    foreach ($data as $item){
      // parse icon
      $item['icon'] = self::parse_icon($item['icon']);

      if ($item['pid'] == $pid){
        // get children from item.id
        $children = self::rules($data, $item['id']);
        // if has children 
        if ($children) {
          // add children node
          $item['children'] = $children; 
        }
        // if has children, type = 0, else type = 1
        $item['type'] = !$children;
        // if has children, href = '', else href = item.rule
        $item['href'] = $children ? '' : $item['rule'];

        $result[] = $item;
      }

    }

    return collection($result)->toArray();
  }
  
  protected static function parse_icon($icon){
    $icons = explode(' ', $icon);
    foreach($icons as &$item){
      if (($index = strpos($item, '.')) !== false){
        $icon_type = substr($item, 0, $index);
        $icon_name = substr($item, $index+1);
      }else{
        $icon_type = "";
      }
      switch($icon_type) {
        case 'layui':
          $item = 'layui-icon layui-icon-'.$icon_name;
          break;
        case 'pear':
          $item = 'pear-icon pear-icon-'.$icon_name;
          break;
        default:
      }
    }
    return implode(' ', $icons);
  }

  public static function tree(&$rules = [], $r = 0, &$result = []){
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
