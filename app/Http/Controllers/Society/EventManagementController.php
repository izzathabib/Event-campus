<?php

namespace App\Http\Controllers\Society;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventManagementController extends Controller
{
    public function eventApplicationView()
    {
        return view('society.eventApplication'); 
    }
}
