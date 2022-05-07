<?php


// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
// -1: top, 0: middle, 1: bottom
function spacer($l = 0, $len = 2, $space = true){
  if ($len == 0){
    return '';
  }
  switch ((int)$l){
    case -1: 
      $start = '┌';
      break;
    case 0: 
      $start = '│';
      break;
    case 1: 
      $start = '└';
      break;
  }
  $middle = '─';

  $space_char = '&nbsp;';
  if ($space){
    $spacer = sprintf('%s%s%s', str_pad('', 2 * strlen($space_char) * $len, $space_char), $start, str_pad('', strlen($middle), $middle));
    return str_replace('│─', '├─', $spacer);
  }

  return sprintf('%s%s', $start, str_pad('', $len * strlen($middle), $middle));

}
