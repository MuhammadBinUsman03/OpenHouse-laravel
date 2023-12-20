<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Admin;
use App\Models\Evaluator;

class GroupController extends Controller
{
    //
    public function index() {
        return view('group');
    }

    public function edit(){

    }
}
