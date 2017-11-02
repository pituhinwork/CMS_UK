<?php

namespace App\Http\Controllers;

use App\Urlstore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $links = Urlstore::where('user_id', $user_id)->get();
        $clicks = Urlstore::where('user_id', $user_id)->pluck('clicks');
        $click_sum = 0;
        foreach ($clicks as $click)
        {
            $click_sum += $click;
        }
        $beacon = $links->count();
        Log::info($click_sum);
        return view('home')->with('links', $links)->with('beacon',$beacon)->with('click',$click_sum);
    }
}
