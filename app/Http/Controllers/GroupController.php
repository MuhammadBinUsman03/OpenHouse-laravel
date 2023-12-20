<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Admin;
use App\Models\Evaluator;

class GroupController extends Controller
{
    //
    public function index($groupId) {
        // Fetch project details for the  id
        $projectID = DB::table('groups')->where('group_id', "$groupId")->value('project_id');
        $project = DB::table('projects')->where('project_id', "$projectID")->first();
        return view('group',["project"=>$project]);
    }

    public function edit(Request $request, $projectId){
        $projectDetails = $request->input('project_details');
        $keywords = $request->input('keywords');

    
        // Fetch the project ID using the project name
        $project = DB::table('projects')->where('project_id', "$projectId")->first();

        // Update project details if the project is found
        if ($project) {
            DB::table('projects')
                ->where('project_id', $projectId)
                ->update([
                    'project_details' => $projectDetails,
                    'project_keywords' => $keywords
                ]);
        }

        $groupId = DB::table('groups')->where('project_id',$projectId)->value('group_id');
        return redirect()->route('group', ['groupId' => $groupId]);
    }
}
