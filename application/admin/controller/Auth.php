<?php

namespace app\admin\controller;

use app\admin\model\AuthGroup;
use think\Db;
class Auth
{
    function group($page = 0, $limit = 0)
    {
        if ($page && $limit) {
            return json([
                'code' => 0,
                'data' => AuthGroup::select(),
            ]);
        }
        return view();
    }
}
