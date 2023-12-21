<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Group;
use App\Models\Admin;
use App\Models\Project;
use App\Models\Evaluator;

class AdminController extends Controller
{
    //
    public function index() {
        return view('admin');
    }

    public function submitProject(Request $request){
        // Retrieve form data
        $projectName = $request->input('project_name');
        $memberCount = $request->input('member_count');
        $projectDetails = $request->input('project_details');
        $keywords = $request->input('keywords');

        // An array to hold member names
        $memberNames = [];

        //Insert into projects
        DB::table('projects')->insert([
            'project_name' => $projectName,
            'project_details' => $projectDetails,
            'project_keywords' => $keywords,
            'location_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Fetch the project ID using the project name
        $projectId = DB::table('projects')->where('project_name', "$projectName")->value('project_id');

        // Create a group against the projectID
        DB::table('groups')->insert([
            'group_login' => 'group' . $projectName,
            'group_password' => bcrypt('group' . $projectName),
            'project_id' => $projectId, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Fetch the project ID using the project name
        $groupId = DB::table('groups')->where('project_id', "$projectId")->value('group_id');

        // Create Students and add into database
        for ($i = 1; $i <= $memberCount; $i++) {
            DB::table('students')->insert([
                'student_name' => $request->input('member_' . $i),
                'group_id' => $groupId, 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        //Back to admin
        return view('admin');
    }

    public function registerEvaluator(Request $request){
        // Retrieve form data
        $evaluatorName = $request->input('evaluator_name');
        $evaluatorPrefs = $request->input('evaluator_preferences');

        //Insert into evaluators
        DB::table('evaluators')->insert([
            'evaluator_name' => $evaluatorName,
            'evaluator_login' => 'eval' . $evaluatorName,
            'evaluator_password' => bcrypt('eval' . $evaluatorName),
            'evaluator_preferences' => $evaluatorPrefs,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


         // Fetch the evaluator ID to send to evaluator controller
         $evaluatorId = DB::table('evaluators')->where('evaluator_name', "$evaluatorName")->value('evaluator_id');
         
         return redirect()->route('AssignProjects', ['evaluatorId' => $evaluatorId]); // Pass evaluatorId as a parameter
    }
}
