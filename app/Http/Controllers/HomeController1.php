<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data = Post::all();// output data using eloquent model
        // dd($data);
        return view('home',['data'=>$data]);
    }

    // public function about(){
    //     $data = [
    //         'about_key' => 'about_value'
    //     ];
    //     return view('about',compact('data'));
    // }

    // public function contact(){
    //     $data = [
    //         'contact_key' => 'contact_value'
    //     ];
    //     return view('contact',compact('data'));
    // }
}
