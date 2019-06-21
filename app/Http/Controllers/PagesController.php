<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = "Home";
        return view('pages.home',compact("title"));
    }
    public function register(){
        $title = "Register";
        return view('pages.register',compact("title"));
    }
    public function fees(){
        $title = "Fees";
        return view('pages.fees',compact("title"));
    }
    public function search(){
        $title = "Search";
        return view('pages.search',compact('title'));
    }
    
}
