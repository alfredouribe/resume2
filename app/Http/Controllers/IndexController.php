<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $free = shell_exec('free'); 
        // $free = (string) trim($free);
        // $free_arr = explode("\n", $free);
        // $mem = explode(" ", $free_arr[1]);
        // $mem = array_filter($mem);
        // $mem = array_merge($mem);
        // $usedmem = $mem[2];
        // $usedmemInGB = number_format($usedmem / 1048576, 2) . ' GB';
        // $memory1 = $mem[2] / $mem[1] * 100;
        // $memory = round($memory1) . '%';
        // $fh = fopen('/proc/meminfo', 'r');
        // $mem = 0;
        // while ($line = fgets($fh)) {
        //     $pieces = array();
        //     if (preg_match('/^MemTotal:\s+(\d+)\skB$/', $line, $pieces)) {
        //         $mem = $pieces[1];
        //         break;
        //     }
        // }
        // fclose($fh);
        // $totalram = number_format($mem / 1048576, 2) . ' GB';
        
        // //cpu usage
        // $cpu_load = sys_getloadavg(); 
        // $load = $cpu_load[0] . '% / 100%';
        
        return view('index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
