<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrendPostController extends Controller
{
    //
    public function tpost(){
        return view('admin.tpost.index');
    }
}
