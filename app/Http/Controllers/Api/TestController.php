<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController;

class TestController extends BaseController
{
    public function index(){
        return response('Welcome on the place', 200);
    }
}
