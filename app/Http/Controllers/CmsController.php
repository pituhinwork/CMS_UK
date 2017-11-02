<?php

namespace App\Http\Controllers;

use App\allClicks;
use App\Urlstore;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Psy\Util\Json;

class CmsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    protected function validator(array $data)
    {
    }

    public function index()
    {
        $link = Urlstore::all();
//        $user_id = Auth::id();
//        Log::info($user_id);
        return view('home')->with('links',$link);
    }

    public function add(Request $request)
    {
        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
            .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
            .'0123456789'); // and any other characters
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $rand = '';
        foreach (array_rand($seed, 5) as $k) $rand .= $seed[$k];

        $link = new Urlstore;
        $link->actions = 0;
        $link->description = $request->get('description');
        $link->name = $request->get('name');
        $link->text = $request->get('text');
//        Log::info($link->text);
        $link->title = $request->get('title');
        $link->clicks = 0;
        $link->url = $rand;
        $link->user_id = Auth::user()->getAuthIdentifier();
        $link->save();
        $link = Urlstore::all();
        return redirect('home')->with('links',$link)->with('success','Url is successfully added!');
    }

    public function edit(Request $request)
    {

    }

    public function destroy(Request $request)
    {

    }

    public function stats($id)
    {
        $from = Carbon::now()->subMonth(1);
        $to = Carbon::now();

        if(allClicks::whereBetween('created_at',[$from,$to])){
            $visitor = allClicks::whereBetween('created_at',[$from,$to])->where('url_id', $id)->select('created_at')
                ->get()
                ->groupBy(function($date) {
                    return Carbon::parse($date->created_at)->toDateString('Y-M-d'); // grouping by years
                    //return Carbon::parse($date->created_at)->format('m'); // grouping by months
                });
        }
        foreach ($visitor as $key => $value)
        {
            Log::info('~~~~~visitor~~~~~~~~~');
            Log::info($key);
            Log::info($value);
        }


        $today = Carbon::now();
        $today = $today->subHours(24);
        $first = (allClicks::where('url_id', $id)->where('created_at','>=',$today)->count());

        $today = Carbon::now();
        $today = $today->subDays(7);
        $second = (allClicks::where('url_id', $id)->where('created_at','>=',$today)->count());

        $today = Carbon::now();
        $today = $today->subDays(30);
        $third = (allClicks::where('url_id', $id)->where('created_at','>=',$today)->count());

        $url = Urlstore::find($id);

        $results = allClicks::where('url_id',$id)->select('country', DB::raw('count(*) as value'))->groupBy('country')->get();
        return view('stats')->with('results',$results)->with('link',$url)->with('first',$first)->with('second',$second)->with('third',$third)
                                ->with('visitors', $visitor);
    }
}
