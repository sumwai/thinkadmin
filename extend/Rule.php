<?php

use think\Db;

class Rule
{


  public static function rules($data = [], $pid = 0, $i = 0){

    if ($data === []){
      $data = Db::name("rules")->select();   
    }

    $result = [];
    foreach ($data as $item){
      // parse icon
      $item['icon'] = self::parse_icon($item['icon']);

      if ($item['pid'] == $pid){
        // get children from item.id
        $children = self::rules($data, $item['id'], $i+1);
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

    return $result;
  }
  
  protected static function parse_icon($icon){
    $icons = explode(' ', $icon);
    foreach($icons as &$item){
      $item = 'layui-icon-' . $item;
    }
    return 'layui-icon ' . implode(' ', $icons);
  }
}
