<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Admin;
use App\Models\Project;
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

    public function assignEvaluators($groupId){

        //Get group object
        $group = Group::find($groupId);

        //Get project object
        $project = Project::find($group->project_id);

        $keywordsArray = explode(' ', $project->project_keywords);

        $evaluators = DB::table('evaluators')->get(); // Retrieve all evaluators from the database

        // Filter evaluators who are not evaluating more than 5 projects
        $filteredEvaluators = $evaluators->filter(function ($evaluator) {
            // Count the number of projects the evaluator is evaluating
            $evaluationCount = DB::table('evaluations')->where('evaluator_id', $evaluator->evaluator_id)->count();

            // Return evaluators evaluating less than 5 projects
            return $evaluationCount < 5;
        });

        //Now pick all those evaluators whose preference matches with project keywords
        $matchedEvaluators = [];
        foreach ($filteredEvaluators as $evaluator) {
            $evaluatorId = $evaluator->evaluator_id;
            $preferencesArray = explode(' ', $evaluator->evaluator_preferences);

            // Calculate similarity between preferences and project keywords
            $matchingKeywords = array_intersect($preferencesArray,$keywordsArray);
            $matchingScore = count($matchingKeywords);

            // Store evaluator ID and matching score--
            $matchedEvaluators[] = [
                'evaluator_id' => $evaluatorId,
                'matching_score' => $matchingScore
            ];
        }

        // Now fill the pivot table evaluation (Evaluator-Projects M2M relation) and keep the pivot column null currently
        foreach ($matchedEvaluators as $evaluator) {
            //get evaluatorId for attaching with project
            $evaluatorId = $evaluator['evaluator_id'];
            // Assuming $project is an instance of Project model
            $project->evaluator()->attach($evaluatorId, ['evaluation_rating' => null]);
        }

        //Evaluation entries created , now route back to admin page
        return redirect()->route('admin');

    }
}
