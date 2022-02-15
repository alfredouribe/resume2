<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function get_resources(Request $request){
        $memory = (memory_get_usage(true))/1048576;

        $data = array(
            "memory" => $memory,
        );

        return $data;
   }
}
