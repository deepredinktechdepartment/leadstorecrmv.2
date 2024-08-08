<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $pageTitle="Reports";
        return view('reports.index',compact('pageTitle'));
    }
}
