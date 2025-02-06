<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportingController extends Controller
{
    public function transaction_view(){
        return view('reporting.transaction');
    }
}
