<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stream = Storage::disk('local')->readStream('employees.csv');
        $arr = array();
        while(($line = fgets($stream,4096)) != false){
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
        return json_encode($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //post
        $id = self::getNextID();
        $input = $request->input('firstName') . ',' . $request->input('lastName') . ',' . $request->input('email') . ',' .$request->input('address') . ',' . $request->input('job') . ',' . $id;
        Storage::disk('local')->append('employees.csv', $input);
        return $id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stream = Storage::disk('local')->readStream('employees.csv');
        $emp = array();
        while(($line = fgets($stream,4096)) != false){
            $line = explode(',',$line);
            $check = intval($line[5]);
            if($check == $id){
                $emp['firstName'] = $line[0];
                $emp['lastName'] = $line[1];
                $emp['email'] = $line[2];
                $emp['address'] = $line[3];
                $emp['job'] = $line[4];
                $emp['id'] = $check;
            }
        }
        return $emp;
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
        //put
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete
    }

    private function getNextID()
    {
        $stream = Storage::disk('local')->readStream('employees.csv');
        $id = 0;
        while(($line = fgets($stream,4096)) != false){
            $line = explode(',',$line);
            $id = $line[5];
        }
        return intval($id) + 1;
    }
}