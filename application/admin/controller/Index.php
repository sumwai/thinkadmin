<?php

namespace app\admin\controller;

use Rule;

class Index
{
    function Index()
    {
        return view();
    }

    function menu()
    {
        header('Content-type: application/json; charset=utf-8');
        return json(Rule::backend()->rules());
    }
}
