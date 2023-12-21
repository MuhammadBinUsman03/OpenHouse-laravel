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
            return redirect()->route('evaluator', ['evaluatorId' => $evaluator->evaluator_id]); // Pass evaluator ID as a parameter
        }
        $group = Group::where('group_login', $request->username)->first();
        if ($group) {
            echo $group->group_id;
            return redirect()->route('group', ['groupId' => $group->group_id]); // Pass group ID as a parameter
        }
        echo "No user found";
    }
}
