<?php

namespace app\admin\controller;

use \Rule;

class Menu
{

  public function Index($page = 0, $limit = 0){
    if ($page && $limit) {
      $data = Rule::tree();
      return json([
        'code' => 0,
        'data' => $data,
        'count' => count($data)
      ]);
    }
    return view();
  }
}
