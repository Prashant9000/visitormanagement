<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->role =='superAdmin'){
            return redirect()->route('superAdmin');
        }

        if(Auth::user()->role =='admin'){
            return redirect()->route('admin');
        }

        if(Auth::user()->role =='student'){
            return redirect()->route('student');
        }  
        else{
            return redirect()->route('visitor');
        }





        return view('home');
    }

    public function superAdmin(){
        return view('home');
    }

    public function admin(){
        return view('admin.home');
    }

    public function student(){
        return view('home');
    }

    public function visitor(){
        return view('home');
    }
}
