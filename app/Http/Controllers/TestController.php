<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class TestController extends Controller
{
    //
    public function index(){
        
        $profile_pic = Auth::user()->profilePic()->first()->path;

        return view('test.index')->with('data', $profile_pic);
    }
}
