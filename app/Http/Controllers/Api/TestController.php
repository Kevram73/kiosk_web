<?php

namespace App\Http\Controllers\Api;

class TestController extends Controller
{
    public function index(){
        return response('Welcome on the place', 200);
    }
}
