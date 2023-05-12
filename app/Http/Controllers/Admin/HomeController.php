<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {

        return view('admin.home');

    }// end of index

    public function topStatistics()
    {

    }// end of topStatistics

    public function moviesChart()
    {


        return view('admin._movies_chart');

    }// end of moviesChart

}//end of controller
