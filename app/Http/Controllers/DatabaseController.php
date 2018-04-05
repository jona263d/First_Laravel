<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Activity;
use Auth;

class DatabaseController extends Controller
{
    /**
     * 
     *
     * @return Response
     */
    public function index()
    {
        $p = DB::table('content')->simplePaginate(10);

        return view('dashboard')->with('content', $p);
    }
    public function conget()
    {
        $p = get();
        return view('project/{ cid }', ['content' => $cid ]);
    }
    public function newproject()
    {
        return view('aangemaakt');
    }

    public function Manage()
    {
        // Find latest users
        $activities = Activity::users(600)->get();     // Get active users within the last 1 hour *WERKT NOG NIET HELEMAAL*

        $uid = DB::table('users')->simplePaginate(10);
        return view('Manage')->with('uid', $uid)->with('activities', $activities);
    }

    public function EigenProjecten()
    {
        $bid = auth::user()->BedrijfsID;
        $Table = DB::table('content')->where('BedrijfsID', $bid)->simplePaginate(10);

        return view('EigenOpdrachten')->with('foo', $Table);
    }
}
