<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function aboutUs()
    {
        //return public_path('/favicon.ico');
        //return url('/favicon.ico');
        //return route('front.pages.faq');
        //return \Str::random(32);
        //$test = 32.45;
        //dd($test);
        
        //return \Str::slug('Ovo je naziv vesti');
        
        //return bcrypt('wefwgeweg');
        
        //return __('Hello world');
        //return trans('Hello world');
        
        
        
        return view('front.pages.about_us');
    }
    
    public function faq()
    {
        return view('front.pages.faq');
    }
}
