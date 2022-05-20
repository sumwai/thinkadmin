<?php
namespace app\index\controller;

use Rule;

class Index
{
    public function index()
    {
        // show view
        return view();
    }

    function menu()
    {
        header('Content-type: application/json; charset=utf-8');
        return json(Rule::frontend()->rules());
    }
}
