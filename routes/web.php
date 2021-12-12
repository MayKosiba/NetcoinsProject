<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $stream = Storage::disk('local')->readStream('employees.csv');
    $arr = array();
    while(($line = fgets($stream,4096)) != false){
        if($line == "\n") {continue;}
        $line = explode(',',$line);
        $tmp = array();
        $tmp['firstName'] = $line[0];
        $tmp['lastName'] = $line[1];
        $tmp['email'] = $line[2];
        $tmp['address'] = $line[3];
        $tmp['job'] = $line[4];
        $tmp['id'] = intval($line[5]);
        $arr[] = $tmp;
    }
    return view('employees')->with('employees',$arr);
});
