<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Admin;
use App\Models\Evaluator;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

    public function auth(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required' 
        ]);

        $admin = Admin::where('admin_login', $request->username)->first();
        if ($admin) {
            // echo "Admin found";
            return redirect()->route('admin');
        }
        $evaluator = Evaluator::where('evaluator_login', $request->username)->first();
        if ($evaluator) {
            echo "Evaluator found";
            return;
        }
        $group = Group::where('group_login', $request->username)->first();
        if ($group) {
            // echo "Group found";
            return redirect()->route('group');
        }
        echo "No user found";
    }
}
